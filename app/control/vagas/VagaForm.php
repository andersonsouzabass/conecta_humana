<?php

use Adianti\Control\TPage;

/**
 * 
 *
 * Anderson SOuza
 */
class VagaForm extends TPage
{
    protected $form; // form
    
    //use Adianti\Base\AdiantiStandardFormTrait; // Standard form methods
    
    /**
     * Class constructor
     * Creates the page and the registration form
     */
    function __construct()
    {
        parent::__construct();
        /*
     
        parent::setSize( 0.6, null);
        parent::removePadding();
        parent::removeTitleBar();
        parent::disableEscape();
        */
        
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_Vaga');
        $this->form->setFormTitle('<b>Criar Vaga</b>');
        $this->form->setClientValidation(true);
        $this->form->setColumnClasses( 2, ['col-sm-5 col-lg-4', 'col-sm-7 col-lg-8'] );

        //Critério: Listar apenas as empresas com o status ativo = sim
        $criteria_ativo = new TCriteria;
        $criteria_ativo->add( new TFilter( 'ativo', '=', 'sim'));    

        // create the form fields
        $id = new TEntry('id');
        $nome = new TEntry('nome');
        $ativo = new TEntry('ativo');
        $pessoa_id = new TDBUniqueSearch('pessoa_id', 'conecta', 'Pessoa', 'id', 'nome', null, $criteria_ativo);
        $dt_fim = new TDate('dt_fim');
        $descricao = new TText('descricao');

        $nome->forceUpperCase();

        // master fields
        $row = $this->form->addFields(  [ new TLabel('id'), $id ],
                                        [ new TLabel('Vaga'), $nome ]                                                                           
                                        );
        $row->layout = ['col-sm-2', 'col-sm-10'];

        $row = $this->form->addFields(  [ new TLabel('Empresa'), $pessoa_id ],
                                        [ new TLabel('Expira em'), $dt_fim ]                                                                 
                                        );
        $row->layout = ['col-sm-9', 'col-sm-3'];

        $row = $this->form->addFields(  [ new TLabel('Descrição da Vaga'), $descricao ]                                                      
                                        );
        $row->layout = ['col-sm-12'];

        $row = $this->form->addFields(  [ new TLabel('Ativo'), $ativo ]                                                                   
                                        );
        $row->layout = ['col-sm-4'];
        
        $ativo->setValue('sim');
        $nome->addValidation('Nome', new TRequiredValidator);
        TQuickForm::hideField('form_Vaga', 'ativo');

        //$this->form->addFields( [new TFormSeparator('  ')] );
        $this->teste_list = new TCheckList('teste_list');
        $this->teste_list->style = 'width: 100%';
        $this->teste_list->setIdColumn('id');
        $this->teste_list->addColumn('id',    'ID',    'center',  '10%');        
        $col_nome = $this->teste_list->addColumn('nome', 'Teste',    'left',   '40%');
        $col_nome->enableAutoHide(500);
        $this->teste_list->setHeight(200);
        $this->teste_list->makeScrollable();        

        $col_nome->enableSearch(); 
        $search_nome = $col_nome->getInputSearch();
        $search_nome->placeholder = _t('Search');
        $search_nome->style = 'width:50%;margin-left: 4px; border-radius: 4px';
                
        //$this->form->addFields( [new TFormSeparator('Atribuir Especialidades')] );
        $this->form->addFields( [$this->teste_list] );
        $this->form->addFields( [new TFormSeparator('')] );

        TTransaction::open('permission');
        $criteria = new TCriteria;
        $criteria->add(new TFilter('ativo', '=', 'sim'));
        $this->teste_list->addItems( Teste::get($criteria) );
        TTransaction::close();

        // set sizes
        $id->setSize('100%');
        $nome->setSize('100%');
        $pessoa_id->setSize('100%');
        $dt_fim->setSize('100%');
        $descricao->setSize('100%');

        //Configurações dos campos
        $id->setEditable(FALSE);
        $descricao->setMaxLength('500');

        $dt_fim->setMask('dd/mm/yyyy');
        $dt_fim->setDatabaseMask('yyyy-mm-dd');
        
        // create the form actions
        $btn = $this->form->addAction( _t('Save'), new TAction(array($this, 'onSave')), 'far:save' );
        $btn->class = 'btn btn-sm btn-primary';
        
        $this->form->addActionLink('Limpar', new TAction(array($this, 'onEdit')),  'fa:eraser red' );
        $this->form->addActionLink('Voltar', new TAction(array('VagaList','onReload')),  'fa:times red' );
        $this->form->addHeaderActionLink( 'Voltar',  new TAction(['VagaList', 'onReload']), 'fa:times red' );

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        // $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        
        parent::add($container);
    }
    

     /**
     * Save user data
     */
    public function onSave($param)
    {
        try
        {
            // open a transaction with database 'permission'
            TTransaction::open('conecta');
            
            $data = $this->form->getData();
            $this->form->setData($data);
            
            $object = new Vaga;
            $object->fromArray( (array) $data );
            $object->ativo = "sim";
            $object->store();
                        
            if (!empty($data->teste_list))
            {
                VagaTeste::where('vaga_id', '=', $object->id)->delete();            
                foreach ($data->teste_list as $teste_id)
                {
                    $object->addVagaTeste( $teste_id  );
                }
            }
            
                        
            $data = new stdClass;
            $data->id = $object->id;
            TForm::sendData('form_Vaga', $data);
            
            // close the transaction
            TTransaction::close();
            
            // shows the success message
            new TMessage('info', 'Registro Vaga Concluído!');
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();
        }
    }
    
    /**
     * method onEdit()
     * Executed whenever the user clicks at the edit button da datagrid
     */
    function onEdit($param)
    {
        try
        {
            if (isset($param['key']))
            {
                $key=$param['key'];
                TTransaction::open('conecta');
                
                // Isntância do objeto Vaga
                $object = new Vaga($key);                                             
                $vaga_ids = array();
                foreach ($object->getVagaTeste() as $vVaga)
                {
                    $vaga_ids[] = $vVaga->id;
                }
                $object->teste_list = $vaga_ids;     
                $this->form->setData($object);
                TTransaction::close();
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();
        }
    }
    /**
     * Close side panel
     */
    public static function onClose($param)
    {
        TScript::create("Template.closeRightPanel()");
    }
}
