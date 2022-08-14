<?php

use Adianti\Control\TPage;

/**
 * AtenderClienteForm Form
 * @author  Anderson Souza
 */
class PmobInglesUmForm extends TPage
{
    protected $form; // form
    
    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        
        error_reporting(0);
        ini_set(“display_errors”, 0 );

        parent::__construct();
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_ingles1');
        $this->form->setFormTitle('<b>Inglês 1</b>');

        // create the form fields
        
        $id = new TEntry('id');
        $db_vaga_id = new TEntry('db_vaga_id'); //Id da vaga
        $nome = new TEntry('nome'); //Nome da vaga

        $resposta1 = new TRadioGroup('resposta1');
        $resposta1->addItems( [1 => 'kills', 2 => 'will kill', 3 => 'killed', 4 => 'have killed'] );
        //$resposta1->setLayout('horizontal');

        $resposta2 = new TRadioGroup('resposta2');
        $resposta2->addItems( [1 => 'shall work', 2 => 'has worked', 3 => 'worked', 4 => ' will work'] );

        $resposta3 = new TRadioGroup('resposta3');
        $resposta3->addItems( [1 => 'waited', 2 => 'have waited', 3 => 'will wait', 4 => 'had waited'] );

        $resposta4 = new TRadioGroup('resposta4');
        $resposta4->addItems( [1 => 'get', 2 => 'to get', 3 => 'going to get', 4 => 'will get'] );

        $resposta5 = new TRadioGroup('resposta5');
        $resposta5->addItems( [1 => 'travelled', 2 => 'is going to travel', 3 => 'are going to travel', 4 => 'shall travel'] );

        $resposta6 = new TRadioGroup('resposta6');
        $resposta6->addItems( [1 => 'would apply', 2 => 'has been applying', 3 => 'will be applying', 4 => 'shall apply'] );

        $resposta7 = new TRadioGroup('resposta7');
        $resposta7->addItems( [1 => 'to object', 2 => 'object', 3 => 'objects', 4 => ' objecting'] );

        $resposta8 = new TRadioGroup('resposta8');
        $resposta8->addItems( [1 => 'is going', 2 => 'did', 3 => 'does', 4 => 'won’t'] );

        $resposta9 = new TRadioGroup('resposta9');
        $resposta9->addItems( [1 => 'will not keep', 2 => 'won’t to keep', 3 => ' won’t keeps', 4 => 'will keep not'] );

       

        $row = $this->form->addFields(  [ new TLabel('Código'), $id ],
                                        [ new TLabel('Código da Vaga'), $db_vaga_id ],
                                        [ new TLabel('Nome'), $nome ]
                                        );
        $row->layout = ['col-sm-2', 'col-sm-2', 'col-sm-6'];
        
        
        $row = $this->form->addFields(  [ new TLabel('<b>1) Decide which word or phrase best fits each space.<br></b>'), '' ]
                                        );
        $row->layout = ['col-sm-12'];
        

        $row = $this->form->addFields(  [ new TLabel('1º The soldiers ______ enemies when they meet them.<b style="color:red">*</b>'), $resposta1 ],
                                        [ new TLabel(''), '' ],
                                        [ new TLabel('2º He _______ hard until he develops a new medicine.<b style="color:red">*</b>'), $resposta2 ]
                                        );
        $row->layout = ['col-sm-3', 'col-sm-2', 'col-sm-4'];
       

        $row = $this->form->addFields(  [ new TLabel('3º We _______ here until she shows up.<b style="color:red">*</b>'), $resposta3 ],
                                        [ new TLabel(''), '' ],
                                        [ new TLabel('4º I’m really _______ you clean today.<b style="color:red">*</b>'), $resposta4 ]
                                        );
                                        $row->layout = ['col-sm-3', 'col-sm-2', 'col-sm-3'];
        
        $row = $this->form->addFields(  [ new TLabel('5º Those women ______ to Scotland.<b style="color:red">*</b>'), $resposta5 ],
                                        [ new TLabel(''), '' ],
                                        [ new TLabel('6º By this time next July Ted _______ for his scholarship in Lancaster.<b style="color:red">*</b>'), $resposta6 ]
                                        );
                                        $row->layout = ['col-sm-3', 'col-sm-2', 'col-sm-4'];
        
        $row = $this->form->addFields(  [ new TLabel('7º Will he _____ to a rise in our salary?<b style="color:red">*</b>'), $resposta7 ],
                                        [ new TLabel(''), '' ],
                                        [ new TLabel('8º He ______ call you tomorrow.<b style="color:red">*</b>'), $resposta8 ]
                                        );
                                        $row->layout = ['col-sm-3', 'col-sm-2', 'col-sm-2'];
        
        $row = $this->form->addFields(  [ new TLabel('9º Those containers ______ all that liquid.<b style="color:red">*</b>'), $resposta9 ]                                        
                                        );
        $row->layout = ['col-sm-2'];
        
      

        // set sizes
        $id->setSize('100%');
        $nome->setSize('100%');
        $db_vaga_id->setSize('100%');
        $resposta1->setSize('100%');
        $resposta2->setSize('100%');
        $resposta3->setSize('100%');
        $resposta4->setSize('100%');
        $resposta5->setSize('100%');
        $resposta6->setSize('100%');
        $resposta7->setSize('100%');
        $resposta8->setSize('100%');
        $resposta9->setSize('100%');
        /*
        $resposta10->setSize('100%');        
        $resposta11->setSize('100%');
        $resposta12->setSize('100%');
        $resposta13->setSize('100%');
        $resposta14->setSize('100%');
        */
        
        //Validações de campos obrigatórios        
        $resposta1->addValidation('Questão 1', new TRequiredValidator);
        $resposta2->addValidation('Questão 2', new TRequiredValidator);
        $resposta3->addValidation('Questão 3', new TRequiredValidator);
        $resposta4->addValidation('Questão 4', new TRequiredValidator);
        $resposta5->addValidation('Questão 5', new TRequiredValidator);
        $resposta6->addValidation('Questão 6', new TRequiredValidator);
        $resposta7->addValidation('Questão 7', new TRequiredValidator);
        $resposta8->addValidation('Questão 8', new TRequiredValidator);
        $resposta9->addValidation('Questão 9', new TRequiredValidator);
        //$resposta10->addValidation('resposta10', new TRequiredValidator);

        if (!empty($id))
        {        
            $id->setEditable(FALSE);  
            $nome->setEditable(FALSE);
            $db_vaga_id->setEditable(FALSE);
            //$escala->setEditable(FALSE);  
        }

        if (empty($id))
        {   
            $resposta1->setEditable(FALSE);
        }
        
        // create the form actions
        $btn = $this->form->addAction( _t('Save'), new TAction(array($this, 'onSave')), 'far:save' );
        $btn->class = 'btn btn-sm btn-primary';
        
        $action = new TDataGridAction(['TelaTeste', 'onEdit']);

        $this->form->addActionLink('Limpar', new TAction(array($this, 'onEdit')),  'fa:eraser red' );
        $this->form->addActionLink('Cancelar', $action,  'fa:times red' );
        $this->form->addHeaderActionLink( 'Fechar',  $action, 'fa:times red' );
        
        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        // $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        
        parent::add($container);
    }

    /**
     * Save form data
     * @param $param Request
     */
    public function onSave( $param )
    {
        $teste_id = 6; // Id do teste deste form
        if (empty($param['id']))
        {
            try
            {                
                TTransaction::open('conecta'); // open a transaction
                $this->form->validate(); // validate form data
                $data = $this->form->getData(); // get form data as array

                $vData = (array) $data;
                $repoPerguntas = Pergunta::where('teste_id', '=', $teste_id)->load();
                
                $pontoFinal = 0;
                for ($i = 0; $i <= 8; $i++)
                {
                    $object = new Resposta();
                    $object->system_user_id = TSession::getValue('userid');
                    $object->db_vaga_id = $data->db_vaga_id; //Pega a id do usuário logado
                    $object->db_pergunta_id = $repoPerguntas[$i]->id;
                    $object->db_teste_id = $teste_id;
                    $object->resposta = $vData['resposta' .(string) ($i + 1)];
                    $object->store();
                    $gabarito = $object->getGabaritoInglesUm('resposta' .(string) ($i + 1));
                    $pontoFinal = $pontoFinal + ($gabarito == $object->resposta ? 1 : 0);
                }
                
                $final = new Resultado();               
                $final->db_teste_id = $teste_id;
                $final->db_vaga_id = $data->db_vaga_id;
                $final->system_user_id = TSession::getValue('userid');
                $final->ponto = $pontoFinal;
                $final->store(); // Registra o resultado do teste
                
                // get the generated id
                $data->id = $final->id;
                
                $this->form->setData($data); // fill form data
                TTransaction::close(); // close the transaction
                new TMessage('info', AdiantiCoreTranslator::translate('Record saved'));
                
            }
            catch (Exception $e) // in case of exception
            {
                new TMessage('error', $e->getMessage()); // shows the exception error message
                $this->form->setData( $this->form->getData() ); // keep form data
                TTransaction::rollback(); // undo all pending operations
            }
        }   
        else
        {
            $this->form->validate(); // validate form data
            $data = $this->form->getData(); // get form data as array           
            
            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction
            
            new TMessage('info', 'Avaliação já registrada, <br>não é possível mais alterar!');
        }      
    }
    
    /**
     * Clear form data
     * @param $param Request
     */
    public function onClear( $param )
    {
        $this->form->clear(TRUE);
    }
    
    /**
     * Load object to form data
     * @param $param Request
     */
    public function onEdit( $param )
    {
        $teste_id = 6; // Id do teste deste form
        try
        {
            if (isset($param['id']))
            {
                $key = $param['id'];  // get the parameter $key
                TTransaction::open('conecta'); // open a transaction

                $data = new stdClass;                

                $detalheVaga = new Vaga($key);

                $data->db_vaga_id = $detalheVaga->id;
                $data->nome = $detalheVaga->nome;

                TSession::setValue('db_vaga_id', $detalheVaga->id);

                $resultado_id = Resultado::where('db_teste_id','=', $teste_id)
                                            ->where('db_vaga_id','=', $detalheVaga->id)
                                            ->where('system_user_id','=', TSession::getValue('userid'))
                                            ->first();

                $resultado_id == null ? null : $data->id = $resultado_id->id;                
                
                // o id deste teste = 2
                $respostas = Resposta::where('db_vaga_id', '=', $detalheVaga->id)
                                        ->where('system_user_id', '=', TSession::getValue('userid'))
                                        ->where('db_teste_id', '=', $teste_id)
                                        ->load();
               
                if ($respostas) {
                    $data->resposta1 = $respostas[0]->resposta;
                    $data->resposta2 = $respostas[1]->resposta;
                    $data->resposta3 = $respostas[2]->resposta;
                    $data->resposta4 = $respostas[3]->resposta;
                    $data->resposta5 = $respostas[4]->resposta;
                    $data->resposta6 = $respostas[5]->resposta;
                    $data->resposta7 = $respostas[6]->resposta;
                    $data->resposta8 = $respostas[7]->resposta;
                    $data->resposta9 = $respostas[8]->resposta; 
                }                            

                $this->form->setData($data); // Preenche o form com dados da session

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
    
    public static function onClose($param)
    {
        parent::closeWindow();
    }
}
