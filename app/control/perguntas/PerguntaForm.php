<?php

use Adianti\Control\TPage;
use Adianti\Widget\Form\TText;

/**
 * 
 *
 * Anderson SOuza
 */
class PerguntaForm extends TPage
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
        $this->form = new BootstrapFormBuilder('form_Pergunta');
        $this->form->setFormTitle('<b>Criar Pergunta</b>');
        $this->form->setClientValidation(true);
        $this->form->setColumnClasses( 2, ['col-sm-5 col-lg-4', 'col-sm-7 col-lg-8'] );

        //Critério: Listar apenas as empresas com o status ativo = sim
        $criteria_ativo = new TCriteria;
        $criteria_ativo->add( new TFilter( 'ativo', '=', 'sim'));    

        // create the form fields
        $id = new TEntry('id');
        $pergunta = new TText('pergunta');
        $ativo = new TEntry('ativo');
        $teste_id = new TDBUniqueSearch('teste_id', 'conecta', 'Teste', 'id', 'nome', 'nome', $criteria_ativo);

        // master fields
        $row = $this->form->addFields(  [ new TLabel('id'), $id ],
                                        [ new TLabel('Teste'), $teste_id ]
                                        );
        $row->layout = ['col-sm-2', 'col-sm-8'];

        $row = $this->form->addFields(  [ new TLabel('Pergunta'), $pergunta ]                                                      
                                        );
        $row->layout = ['col-sm-12'];

        $row = $this->form->addFields(  [ new TLabel('Ativo'), $ativo ]                                                                   
                                        );
        $row->layout = ['col-sm-4'];
        
        $ativo->setValue('sim');
        $pergunta->addValidation('pergunta', new TRequiredValidator);
        TQuickForm::hideField('form_Pergunta', 'ativo');

        // set sizes
        $id->setSize('100%');
        $pergunta->setSize('100%');
        $teste_id->setSize('100%');;

        //Configurações dos campos
        $id->setEditable(FALSE);
        
        // create the form actions
        $btn = $this->form->addAction( _t('Save'), new TAction(array($this, 'onSave')), 'far:save' );
        $btn->class = 'btn btn-sm btn-primary';
        
        $this->form->addActionLink('Limpar', new TAction(array($this, 'onEdit')),  'fa:eraser red' );
        $this->form->addActionLink('Voltar', new TAction(array('PerguntaList','onReload')),  'fa:times red' );
        $this->form->addHeaderActionLink( 'Voltar',  new TAction(['PerguntaList', 'onReload']), 'fa:times red' );

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
            
            $object = new Pergunta;
            $object->fromArray( (array) $data );
            $object->ativo = "sim";
            $object->store();
                        
            $data = new stdClass;
            $data->id = $object->id;
            TForm::sendData('form_Pergunta', $data);
            
            // close the transaction
            TTransaction::close();
            
            // shows the success message
            new TMessage('info', 'Registro da Pergunta Concluído!');
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
                $object = new Pergunta($key);                                             
                
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
