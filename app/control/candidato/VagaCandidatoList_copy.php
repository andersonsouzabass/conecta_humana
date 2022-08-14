<?php
/**
 * VagaCandidatoList
 *
 * 
 */
class VagaCandidatoList_copy extends TPage
{
    protected $form;     // registration form
    protected $datagrid; // listing
    protected $pageNavigation;
    protected $formgrid;
    protected $deleteButton;
    
    use Adianti\base\AdiantiStandardListTrait;
        
    /**
     * Page constructor
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setDatabase('conecta');            // defines the database
        $this->setActiveRecord('Vaga');   // defines the active record
        $this->setDefaultOrder('id', 'desc');         // defines the default order
        $this->setLimit(10);
        
        //Carrega o array que será utilizado para carregar apenas as únidas permitidas por usuário
        //TTransaction::open('conecta');
        $criteria = new TCriteria;
        $criteria->add( new TFilter( 'dt_fim', '>=', date('Y-m-d')));    
        $criteria->add( new TFilter( 'ativo', '=', 'sim'));
        // // define a standard filter

        $this->addFilterField('id', '=', 'id'); // filterField, operator, formField
        $this->addFilterField('nome', 'like', 'nome'); // filterField, operator, formField       
        $this->addFilterField('ativo', '=', 'sim'); // filterField, operator, formField
        $this->addFilterField('pessoa->nome', 'like', 'empresa'); // filterField, operator, formField
        $this->setDefaultOrder('id', 'asc');         // defines the default order
        $this->setCriteria($criteria); //Carrega apenas os servidores das unidades setadas
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_vagacandidato_list');
        $this->form->setFormTitle('<b>Lista de Vagas Ativas</b>');
        
        // create the form fields
        $id = new TEntry('id');
        $nome = new TEntry('nome');   
        $empresa = new TEntry('empresa');
        $ativo = new TRadioGroup('ativo');
        
        $nome->forceUpperCase();
        
        $nome->setMinLength(0);        
        $ativo->addItems( ['sim' => 'Sim', 'não' => 'Não', '' => 'Todos'] );
        $ativo->setLayout('horizontal');

        $row = $this->form->addFields(  [ new TLabel('Código'), $id ],
                                        [ new TLabel('Vaga'), $nome ]
                                        );
        $row->layout = ['col-sm-2', 'col-sm-8'];

        $row = $this->form->addFields(  [ new TLabel('Empresa'), $empresa ]
                                        );
        $row->layout = ['col-sm-10'];

        $row = $this->form->addFields(  [ new TLabel('Ativo'), $ativo ]
                                        );
        $row->layout = ['col-sm-4'];

        // set sizes
        $id->setSize('100%');
        $nome->setSize('100%');
        $empresa->setSize('100%');
       
        //$ativo->setSize('100%');
        
        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data') );
        
        // add the search form actions
        $btn = $this->form->addAction('Buscar', new TAction([$this, 'onSearch']), 'fa:search');
        $btn->class = 'btn btn-sm btn-primary';
        
        // creates a Datagrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->style = 'width: 100%';
        
        // creates the datagrid columns
        $column_id = new TDataGridColumn('id', 'Código', 'center',  '10%');
        $column_nome = new TDataGridColumn('nome', 'Vaga', 'left');
        $column_empresa = new TDataGridColumn('pessoa->nome', 'Empresa', 'left'); 
        $column_dt_fim = new TDataGridColumn('dt_fim', 'Expira', 'center');
        $column_inscrito = new TDataGridColumn('inscrito', 'Inscrito', 'center');
        $column_ativo = new TDataGridColumn('ativo', 'Ativo', 'center');

        $column_dt_fim->setTransformer( function($value) {
            return TDate::convertToMask($value, 'yyyy-mm-dd', 'dd/mm/yyyy');
        });

        $column_id->setTransformer( function ($value, $object)  {            
            try
            {
                TTransaction::open('conecta');
                $criteria = new TCriteria;
                $candidato_id = TSession::getValue('userid');
                $criteria->add( new TFilter( 'system_user_id', '=', $candidato_id ));  
                $criteria->add( new TFilter( 'db_vaga_id', '=', $object->id ));  
                $customers = Candidatura::getObjects($criteria);                
                
                foreach ($customers as $customer)
                {
                    if ($customer->db_vaga_id == $object->id)                  
                    {
                        $object->inscrito = 'SIM';
                    } 
                    return $value;
                }
                TTransaction::close();
            }
            catch (Exception $e)
            {
                new TMessage('error', $e->getMessage());
            }
        });

        $column_inscrito->setTransformer( function ($value) {
            if ($value == 'SIM')
            {
                $div = new TElement('span');
                $div->class="label label-success";
                $div->style="text-shadow:none; font-size:12px";
                $div->add('SIM');
                return $div;
            }
            else
            {
                $div = new TElement('span');
                $div->class="label label-danger";
                $div->style="text-shadow:none; font-size:12px";
                $div->add('NÃO');
                return $div;
            }
        });
        
        // add the columns to the DataGrid
        $this->datagrid->addColumn($column_id)->setVisibility(false);
        $this->datagrid->addColumn($column_nome); 
        $this->datagrid->addColumn($column_empresa);      
        $this->datagrid->addColumn($column_dt_fim);        
        $this->datagrid->addColumn($column_inscrito);

        //Farois na coluna prazo de vencimento do processo
        $column_dt_fim->setTransformer( function($value, $object)
        {
            $today = new DateTime(date('Y-m-d'));
            $end   = new DateTime($value);            
            $dTempo = $end->diff($today);

            $data = TDate::convertToMask($value, 'yyyy-mm-dd', 'dd/mm/yyyy');
            //(!empty($value) && $today >= $end)
            if (!empty($value) && $today >= $end)
            {
                $div = new TElement('span');
                $div->class="label label-warning";
                $div->style="text-shadow:none; font-size:12px";
                $div->add($data);
                return $div;
            }            
            return $data;
        });

        // creates the datagrid column actions
        $column_id->setAction(new TAction([$this, 'onReload']), ['order' => 'id']);
        $column_nome->setAction(new TAction([$this, 'onReload']), ['order' => 'nome']);
        $column_empresa->setAction(new TAction([$this, 'onReload']), ['order' => 'empresa']);
        
        $column_ativo->enableAutoHide(500);
        
        $action1 = new TDataGridAction(['VagaCandidatoForm', 'onEdit'], ['id'=>'{id}']);
        $action2 = new TDataGridAction([$this, 'onTurnOnOff'], ['id'=>'{id}']);
        $action3 = new TDataGridAction(['TelaTeste', 'onEdit'], ['id'=>'{id}']);

        $action1->setUseButton(TRUE);
        $action2->setUseButton(TRUE);
        $action3->setUseButton(TRUE);
        
        $this->datagrid->addAction($action1, 'Candidatar-se',   'far:edit blue');
        $this->datagrid->addAction($action2 ,'Cancelar inscrição', 'fa:power-off orange');
        $this->datagrid->addAction($action3 ,'Ir para Teste', 'far:check-square green');
        
        
        // create the datagrid model
        $this->datagrid->createModel();
        
        // creates the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction([$this, 'onReload']));
        
        $panel = new TPanelGroup('', 'white');
        $panel->add($this->datagrid);
        $panel->addFooter($this->pageNavigation);
        
        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';        
        $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        $container->add($panel);
        
        parent::add($container);
    }
    
    /**
     * Turn on/off an user
     */
    public function onTurnOnOff($param)
    {
        try
        {
            TTransaction::open('conecta');
            
            $criteria = new TCriteria;
            $criteria->add( new TFilter( 'db_vaga_id', '=', $param['id'] ));

            $repository = new TRepository('Candidatura'); 
            $repository->delete($criteria); 

            new TMessage('info', 'Inscrição cancelada!'); 
            TTransaction::close();
            
            $this->onReload($param);
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();
        }
    }
}
