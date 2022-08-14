<?php

use Adianti\Control\TPage;

/**
 * AtenderClienteForm Form
 * @author  Anderson Souza
 */
class EmocionalForm extends TPage
{
    protected $form; // form
    
    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        //error_reporting(0);
        //ini_set(“display_errors”, 0 );

        parent::__construct();
              
        // creates the form
        $this->form = new BootstrapFormBuilder('form_emocional');
        $this->form->setFormTitle('<b>Teste Emocional</b>');
        

        // create the form fields
        
        $id = new TEntry('id');
        $db_vaga_id = new TEntry('db_vaga_id'); //Id da vaga
        $nome = new TEntry('nome'); //Nome da vaga

        $opcoes = [];
        $opcoes[1] = 'Jamais';
        $opcoes[2] = 'Raramente';
        $opcoes[3] = 'À Vezes';
        $opcoes[4] = 'Quase Sempre';
        $opcoes[5] = 'Sempre';

        $escala = New TRadioGroup('escala');
        $escala->addItems( [1 => 'Jamais = 1', 2 => 'Raramente = 2', 3 => 'À Vezes = 3', 4 => 'Quase Sempre = 4', 5 => 'Sempre = 5'] );

        $resposta1 = new TRadioGroup('resposta1');
        $resposta1->addItems( $opcoes );
        //$resposta1->setLayout('horizontal');

        $resposta2 = new TRadioGroup('resposta2');
        $resposta2->addItems( $opcoes );

        $resposta3 = new TRadioGroup('resposta3');
        $resposta3->addItems( $opcoes );

        $resposta4 = new TRadioGroup('resposta4');
        $resposta4->addItems( $opcoes );

        $resposta5 = new TRadioGroup('resposta5');
        $resposta5->addItems( $opcoes );

        $resposta6 = new TRadioGroup('resposta6');
        $resposta6->addItems( $opcoes );

        $resposta7 = new TRadioGroup('resposta7');
        $resposta7->addItems( $opcoes );

        $resposta8 = new TRadioGroup('resposta8');
        $resposta8->addItems( $opcoes );

        $resposta9 = new TRadioGroup('resposta9');
        $resposta9->addItems( $opcoes );

        $resposta10 = new TRadioGroup('resposta10');
        $resposta10->addItems( $opcoes );

        // Montagem do formulário
        $row = $this->form->addFields(  [ new TLabel('Código'), $id ],
                                        [ new TLabel('Código da Vaga'), $db_vaga_id ],
                                        [ new TLabel('Nome'), $nome ]
                                        );
        $row->layout = ['col-sm-2', 'col-sm-2', 'col-sm-6'];
        

        $row = $this->form->addFields(  [ new TLabel('<b>Atribua pontos a cada uma das afirmativas, conforme a seguinte escala:</b>'), $escala ]
                                        );
        $row->layout = ['col-sm-4'];


        $row = $this->form->addFields(  [ new TLabel('1- ...que persiste quando está frente a um novo desafio, não desistindo nas primeiras dificuldades ...<b style="color:red">*</b>'), $resposta1 ],
                                        [ new TLabel('2- ...que procura se colocar no lugar do outro, sendo compreensiva em relação aos momentos difíceis de outra pessoa...<b style="color:red">*</b>'), $resposta2 ]
                                        );
        $row->layout = ['col-sm-6', 'col-sm-6'];
       

        $row = $this->form->addFields(  [ new TLabel('3-...que consegue manifestar suas emoções de acordo com as pessoas, situações e o momento oportuno...<b style="color:red">*</b>'), $resposta3 ],
                                        [ new TLabel('4-...que consegue controlar suas emoções, mantendo a calma nos momentos difíceis...<b style="color:red">*</b>'), $resposta4 ]
                                        );
        $row->layout = ['col-sm-6', 'col-sm-6'];
        
        $row = $this->form->addFields(  [ new TLabel('5-... que tem uma visão realista de si mesmo, com adequada percepção de suas potencialidades e limitações...<b style="color:red">*</b>'), $resposta5 ],
                                        [ new TLabel('6- ...que consegue superar seus sentimentos de frustração quando alguma coisa não dá certo, procurando aprender com as experiências negativas...<b style="color:red">*</b>'), $resposta6 ]
                                        );
        $row->layout = ['col-sm-6', 'col-sm-6'];
        
        $row = $this->form->addFields(  [ new TLabel('7- ...que quando tem alguma dificuldade com outra pessoa, procura conversar diretamente com ela, evitando fofocas e mal entendido ...<b style="color:red">*</b>'), $resposta7 ],
                                        [ new TLabel('8- ... que é muito difícil perder a paciência com as pessoas de que gosto. Se perco, logo recupero e me arrependo de ter perdido ...<b style="color:red">*</b>'), $resposta8 ]
                                        );
        $row->layout = ['col-sm-6', 'col-sm-6'];
        
        $row = $this->form->addFields(  [ new TLabel('9- ... que consegue expressar suas opiniões de forma clara e percebe que é ouvida com atenção ...<b style="color:red">*</b>'), $resposta9 ],
                                        [ new TLabel('10-... que se sente segura diante das outras pessoas...<b style="color:red">*</b>'), $resposta10 ]
                                        );
        $row->layout = ['col-sm-6', 'col-sm-4'];
              

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
        $resposta10->setSize('100%');
        
        
        //Validações de campos obrigatórios        
        $resposta1->addValidation('Pergunta 1', new TRequiredValidator);
        $resposta2->addValidation('Pergunta 2', new TRequiredValidator);
        $resposta3->addValidation('Pergunta 3', new TRequiredValidator);
        $resposta4->addValidation('Pergunta 4', new TRequiredValidator);
        $resposta5->addValidation('Pergunta 5', new TRequiredValidator);
        $resposta6->addValidation('Pergunta 6', new TRequiredValidator);
        $resposta7->addValidation('Pergunta 7', new TRequiredValidator);
        $resposta8->addValidation('Pergunta 8', new TRequiredValidator);
        $resposta9->addValidation('Pergunta 9', new TRequiredValidator);
        $resposta10->addValidation('Pergunta 10', new TRequiredValidator);

        if (!empty($id))
        {        
            $id->setEditable(FALSE);  
            $escala->setEditable(FALSE);  
            $nome->setEditable(FALSE);
            $db_vaga_id->setEditable(FALSE);
        }

        if (empty($id))
        {   
            $resposta1->setEditable(FALSE);
        }
        
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
        $teste_id = 2; // Id do teste deste form
        if (empty($param['id']))
        {
            try
            {                
                TTransaction::open('conecta'); // open a transaction
                $this->form->validate(); // validate form data
                $data = $this->form->getData(); // get form data as array

                $vData = (array) $data;
                $repoPerguntas = Pergunta::where('teste_id', '=', '2')->load();
                
                $pontoFinal = 0;
                for ($i = 0; $i <= 9; $i++)
                {
                    $object = new Resposta();
                    $object->system_user_id = TSession::getValue('userid');
                    $object->db_vaga_id = $data->db_vaga_id; //Pega a id do usuário logado
                    $object->db_pergunta_id = $repoPerguntas[$i]->id;
                    $object->db_teste_id = $teste_id;
                    $object->resposta = $vData['resposta' .(string) ($i + 1)];
                    $object->store();
                    $pontoFinal = $pontoFinal + $vData['resposta' .(string) ($i + 1)];
                }

                //Cadastra o ponto do candidato na avaliação
                $criteria = new TCriteria;                           
                $criteria->add( new TFilter( 'teste_id', '=', $teste_id ));
                $criteria->add( new TFilter( 'ponto', '<=', $pontoFinal ));   
                $criteria->add( new TFilter( 'ponto_max', '>=', $pontoFinal ));            
                $resultado = ResultadoPontos::getObjects($criteria);
                
                $final = new Resultado();

                //var_dump($criteria);
                foreach ($resultado as $resultado_final)
                {
                    $final->db_teste_id = $teste_id;
                    $final->db_resultado_pontos_id = $resultado_final->id;
                    $final->db_vaga_id = $data->db_vaga_id;
                    $final->system_user_id = TSession::getValue('userid');
                    $final->ponto = $pontoFinal;
                    //$final->db_resposta_id = $object->id;
                    $final->store(); // Registra o resultado do teste
                }
                
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
        $teste_id = 2; // Id do teste deste form
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
                    $data->resposta10 = $respostas[9]->resposta;    
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
