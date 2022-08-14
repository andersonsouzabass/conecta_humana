<?php

use Adianti\Control\TPage;

/**
 * 
 *
 * Anderson SOuza
 */
class VagaCandidatoForm extends TPage
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
        $this->form = new BootstrapFormBuilder('form_VagaCandidato');
        $this->form->setFormTitle('<b>Cadidatar-se a vaga</b>');
        $this->form->setClientValidation(true);
        $this->form->setColumnClasses( 2, ['col-sm-5 col-lg-4', 'col-sm-7 col-lg-8'] );

        // create the form fields
        $id = new TEntry('id');
        $nome = new TEntry('nome');
        $ativo = new TEntry('ativo');
        $pessoa_id = new TDBCombo('pessoa_id', 'conecta', 'Pessoa', 'id', 'nome');
        $dt_fim = new TDate('dt_fim');
        $descricao = new TText('descricao');        

        $nome->forceUpperCase();

        // master fields
        $row = $this->form->addFields(  [ new TLabel('Código'), $id ],
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

        TQuickForm::hideField('form_VagaCandidato', 'ativo');

        // set sizes
        $id->setSize('100%');
        $nome->setSize('100%');
        $pessoa_id->setSize('100%');
        $dt_fim->setSize('100%');
        $descricao->setSize('100%');

        //Configurações dos campos
        $id->setEditable(FALSE);
        $nome->setEditable(FALSE);
        $pessoa_id->setEditable(FALSE);
        $dt_fim->setEditable(FALSE);
        $descricao->setEditable(FALSE);

        $descricao->setMaxLength('500');

        $dt_fim->setMask('dd/mm/yyyy');
        $dt_fim->setDatabaseMask('yyyy-mm-dd');
        
        // create the form actions
        $btn = $this->form->addAction( 'Candidatar-me', new TAction(array($this, 'onSave')), 'far:save' );
        $btn->class = 'btn btn-sm btn-primary';
        
        //$this->form->addActionLink('Limpar', new TAction(array($this, 'onEdit')),  'fa:eraser red' );
        $this->form->addActionLink('Voltar', new TAction(array('VagaCandidatoList','onReload')),  'fa:times red' );
        $this->form->addHeaderActionLink( 'Voltar',  new TAction(['VagaCandidatoList', 'onReload']), 'fa:times red' );

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        // $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        
        parent::add($container);
    }
    
    public function onEdit( $param )
    {
        try
        {
            if (isset($param['key']))
            {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open('conecta'); // open a transaction
                $object = new Vaga($key); // instantiates the Active Record
                $this->form->setData($object); // fill the form
                TTransaction::close(); // close the transaction
            }
            else
            {
                $this->form->clear(TRUE);
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    public function onSave( $param )
    {
        try
        {
            TTransaction::open('conecta'); // open a transaction
            
            
            $this->form->validate(); // validate form data
            $data = $this->form->getData(); // get form data as array
            
            $object = new Candidatura;  // create an empty object
            $object->db_vaga_id = $data->id;
            $object->system_user_id = TSession::getValue('userid');
            $object->fromArray( (array) $data); // load the object with data
            $object->store(); // save the object
            
            // get the generated id
            $data->id = $object->id;
            
            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction
            
            new TMessage('info', 'Canditarura realizada com sucesso!');
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
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
