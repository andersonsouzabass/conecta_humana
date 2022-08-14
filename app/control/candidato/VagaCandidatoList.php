<?php
/**
 * VagaList Listing
 * @author  <your name here>
 */
class VagaCandidatoList extends TPage
{
    private $form; // form
    private $datagrid; // listing
    private $pageNavigation;
    private $formgrid;
    private $loaded;
    private $deleteButton;
    
    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct()
    {
        parent::__construct();
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_search_Vaga');
        $this->form->setFormTitle('<b>Lista de Vagas Ativas</b>');
        

        // create the form fields
        $id = new TEntry('id');
        $nome = new TEntry('nome');
        $pessoa_id = new TDBUniqueSearch('pessoa_id', 'conecta', 'Pessoa', 'id', 'nome');
        //$ativo = new TRadioGroup('ativo');
        
        $nome->forceUpperCase();

        $nome->setMinLength(3);        
        //$ativo->addItems( ['sim' => 'Sim', 'não' => 'Não', '' => 'Todos'] );
        //$ativo->setLayout('horizontal');


        // add the fields
        $row = $this->form->addFields(  [ new TLabel('Código'), $id ],
                                        [ new TLabel('Vaga'), $nome ]
                                        );
        $row->layout = ['col-sm-2', 'col-sm-8'];

        $row = $this->form->addFields(  [ new TLabel('Empresa'), $pessoa_id ]
                                        );
        $row->layout = ['col-sm-10'];
        /*
        $row = $this->form->addFields(  [ new TLabel('Ativo'), $ativo ]
                                        );
        $row->layout = ['col-sm-4'];
        */

        // set sizes
       // set sizes
       $id->setSize('100%');
       $nome->setSize('100%');
       $pessoa_id->setSize('100%');
        
        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue(__CLASS__ . '_filter_data') );
        
        // add the search form actions
        $btn = $this->form->addAction(_t('Find'), new TAction([$this, 'onSearch']), 'fa:search');
        $btn->class = 'btn btn-sm btn-primary';
        
        // creates a Datagrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->style = 'width: 100%';
        $this->datagrid->datatable = 'true';
        $this->datagrid->enablePopover('<b>Detalhes da Vaga</b>', '<b>Descrição:</b> {descricao}');
        

        // creates the datagrid columns
        $column_id = new TDataGridColumn('id', 'Id', 'right');
        $column_nome = new TDataGridColumn('nome', 'Nome', 'left');
        $column_pessoa_id = new TDataGridColumn('pessoa->nome', 'Empresa', 'left');
        //$column_ativo = new TDataGridColumn('ativo', 'Ativo', 'left');
        $column_dt_fim = new TDataGridColumn('dt_fim', 'Expira', 'left');
        $column_inscrito = new TDataGridColumn('inscrito', 'Inscrito', 'center');


        // add the columns to the DataGrid
        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_nome);
        $this->datagrid->addColumn($column_pessoa_id);    
        $this->datagrid->addColumn($column_dt_fim);        
        $this->datagrid->addColumn($column_inscrito);

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
        $this->pageNavigation->setWidth($this->datagrid->getWidth());
        
        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        $container->add(TPanelGroup::pack('', $this->datagrid, $this->pageNavigation));
        
        parent::add($container);
    }
    
    /**
     * Inline record editing
     * @param $param Array containing:
     *              key: object ID value
     *              field name: object attribute to be updated
     *              value: new attribute content 
     */
    public function onInlineEdit($param)
    {
        try
        {
            // get the parameter $key
            $field = $param['field'];
            $key   = $param['key'];
            $value = $param['value'];
            
            TTransaction::open('conecta'); // open a transaction with database
            $object = new Vaga($key); // instantiates the Active Record
            $object->{$field} = $value;
            $object->store(); // update the object in the database
            TTransaction::close(); // close the transaction
            
            $this->onReload($param); // reload the listing
            new TMessage('info', "Record Updated");
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }
    
    /**
     * Register the filter in the session
     */
    public function onSearch()
    {
        // get the search form data
        $data = $this->form->getData();
        
        // clear session filters
        TSession::setValue(__CLASS__.'_filter_id',   NULL);
        TSession::setValue(__CLASS__.'_filter_nome',   NULL);
        TSession::setValue(__CLASS__.'_filter_pessoa_id',   NULL);
        //TSession::setValue(__CLASS__.'_filter_ativo',   NULL);
        TSession::setValue(__CLASS__.'_filter_dt_fim',   NULL);
        TSession::setValue(__CLASS__.'_filter_descricao',   NULL);

        if (isset($data->id) AND ($data->id)) {
            $filter = new TFilter('id', '=', $data->id); // create the filter
            TSession::setValue(__CLASS__.'_filter_id',   $filter); // stores the filter in the session
        }


        if (isset($data->nome) AND ($data->nome)) {
            $filter = new TFilter('nome', 'like', "%{$data->nome}%"); // create the filter
            TSession::setValue(__CLASS__.'_filter_nome',   $filter); // stores the filter in the session
        }


        if (isset($data->pessoa_id) AND ($data->pessoa_id)) {
            $filter = new TFilter('pessoa_id', '=', $data->pessoa_id); // create the filter
            TSession::setValue(__CLASS__.'_filter_pessoa_id',   $filter); // stores the filter in the session
        }


        /*
        if (isset($data->ativo) AND ($data->ativo)) {
            $filter = new TFilter('ativo', '=', $data->ativo); // create the filter
            TSession::setValue(__CLASS__.'_filter_ativo',   $filter); // stores the filter in the session
        }
        */

        if (isset($data->dt_fim) AND ($data->dt_fim)) {
            $filter = new TFilter('dt_fim', 'like', "%{$data->dt_fim}%"); // create the filter
            TSession::setValue(__CLASS__.'_filter_dt_fim',   $filter); // stores the filter in the session
        }


        if (isset($data->descricao) AND ($data->descricao)) {
            $filter = new TFilter('descricao', 'like', "%{$data->descricao}%"); // create the filter
            TSession::setValue(__CLASS__.'_filter_descricao',   $filter); // stores the filter in the session
        }

        
        // fill the form with data again
        $this->form->setData($data);
        
        // keep the search data in the session
        TSession::setValue(__CLASS__ . '_filter_data', $data);
        
        $param = array();
        $param['offset']    =0;
        $param['first_page']=1;
        $this->onReload($param);
    }
    
    /**
     * Load the datagrid with data
     */
    public function onReload($param = NULL)
    {
        try
        {
            // open a transaction with database 'conecta'
            TTransaction::open('conecta');
            
            // creates a repository for Vaga
            $repository = new TRepository('Vaga');
            $limit = 10;
            // creates a criteria
            $criteria = new TCriteria;
            
            // default order
            if (empty($param['order']))
            {
                $param['order'] = 'id';
                $param['direction'] = 'asc';
            }
            $criteria->setProperties($param); // order, offset
            $criteria->setProperty('limit', $limit);
            

            if (TSession::getValue(__CLASS__.'_filter_id')) {
                $criteria->add(TSession::getValue(__CLASS__.'_filter_id')); // add the session filter
            }


            if (TSession::getValue(__CLASS__.'_filter_nome')) {
                $criteria->add(TSession::getValue(__CLASS__.'_filter_nome')); // add the session filter
            }


            if (TSession::getValue(__CLASS__.'_filter_pessoa_id')) {
                $criteria->add(TSession::getValue(__CLASS__.'_filter_pessoa_id')); // add the session filter
            }

            /*
            if (TSession::getValue(__CLASS__.'_filter_ativo')) {
                $criteria->add(TSession::getValue(__CLASS__.'_filter_ativo')); // add the session filter
            }
            */

            if (TSession::getValue(__CLASS__.'_filter_dt_fim')) {
                $criteria->add(TSession::getValue(__CLASS__.'_filter_dt_fim')); // add the session filter
            }


            if (TSession::getValue(__CLASS__.'_filter_descricao')) {
                $criteria->add(TSession::getValue(__CLASS__.'_filter_descricao')); // add the session filter
            }

            
            // load the objects according to criteria
            $objects = $repository->load($criteria, FALSE);
            
            if (is_callable($this->transformCallback))
            {
                call_user_func($this->transformCallback, $objects, $param);
            }
            
            $this->datagrid->clear();
            if ($objects)
            {
                // iterate the collection of active records
                foreach ($objects as $object)
                {
                    // add the object inside the datagrid
                    $this->datagrid->addItem($object);
                }
            }
            
            // reset the criteria for record count
            $criteria->resetProperties();
            $count= $repository->count($criteria);
            
            $this->pageNavigation->setCount($count); // count of records
            $this->pageNavigation->setProperties($param); // order, page
            $this->pageNavigation->setLimit($limit); // limit
            
            // close the transaction
            TTransaction::close();
            $this->loaded = true;
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();
        }
    }
    
    /**
     * Ask before deletion
     */
    public static function onDelete($param)
    {
        // define the delete action
        $action = new TAction([__CLASS__, 'Delete']);
        $action->setParameters($param); // pass the key parameter ahead
        
        // shows a dialog to the user
        new TQuestion(AdiantiCoreTranslator::translate('Do you really want to delete ?'), $action);
    }
    
    /**
     * Delete a record
     */
    public static function Delete($param)
    {
        try
        {
            $key=$param['key']; // get the parameter $key
            TTransaction::open('conecta'); // open a transaction with database
            $object = new Vaga($key, FALSE); // instantiates the Active Record
            $object->delete(); // deletes the object from the database
            TTransaction::close(); // close the transaction
            
            $pos_action = new TAction([__CLASS__, 'onReload']);
            new TMessage('info', AdiantiCoreTranslator::translate('Record deleted'), $pos_action); // success message
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }
    
    /**
     * method show()
     * Shows the page
     */
    public function show()
    {
        // check if the datagrid is already loaded
        if (!$this->loaded AND (!isset($_GET['method']) OR !(in_array($_GET['method'],  array('onReload', 'onSearch')))) )
        {
            if (func_num_args() > 0)
            {
                $this->onReload( func_get_arg(0) );
            }
            else
            {
                $this->onReload();
            }
        }
        parent::show();
    }

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
