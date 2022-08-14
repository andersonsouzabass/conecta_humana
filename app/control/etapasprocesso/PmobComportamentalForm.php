<?php

use Adianti\Control\TPage;

/**
 * AtenderClienteForm Form
 * @author  Anderson Souza
 */
class PmobComportamentalForm extends TPage
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
        $this->form = new BootstrapFormBuilder('form_comportamento');
        $this->form->setFormTitle('<b>Avaliação Comportamental</b>');

        // create the form fields
        
        $id = new TEntry('id');
        $db_vaga_id = new TEntry('db_vaga_id'); //Id da vaga
        $nome = new TEntry('nome'); //Nome da vaga


        $opcoes = array();
        $opcoes[1]='1';
        $opcoes[2]='2';
        $opcoes[3]='3';
        $opcoes[4]='4';
        $opcoes[5]='5';
        $opcoes[6]='6';
        $opcoes[7]='7';
        $opcoes[8]='8';
        $opcoes[9]='9';
        $opcoes[10]='10';
        /*
        $nome = new TEntry('nome');
        $cargo = new TEntry('cargo');
        */
        $escala = New TRadioGroup('escala');
        $escala->addItems( [1 => 'Jamais = 1', 2 => 'Raramente = 2', 3 => 'À Vezes = 3', 4 => 'Quase Sempre = 5', 5 => 'Sempre = 5'] );
        
        $texto = new TLabel('texto');
        $texto = 'Competências';
        
        $titulo = new TLabel('titulo');
        $titulo = 'Instruções';

        $resposta1 = new TRadioGroup('resposta1');
        $resposta1->addItems($opcoes);
        $resposta1->setLayout('horizontal');
        $resposta1->setUseButton();
        
        $resposta2 = new TRadioGroup('resposta2');
        $resposta2->addItems($opcoes);
        $resposta2->setLayout('horizontal');
        $resposta2->setUseButton();

        $resposta3 = new TRadioGroup('resposta3');
        $resposta3->addItems($opcoes);
        $resposta3->setLayout('horizontal');
        $resposta3->setUseButton();

        $resposta4 = new TRadioGroup('resposta4');
        $resposta4->addItems($opcoes);
        $resposta4->setLayout('horizontal');
        $resposta4->setUseButton();

        $resposta5 = new TRadioGroup('resposta5');
        $resposta5->addItems($opcoes);
        $resposta5->setLayout('horizontal');
        $resposta5->setUseButton();

        $resposta6 = new TRadioGroup('resposta6');
        $resposta6->addItems($opcoes);
        $resposta6->setLayout('horizontal');
        $resposta6->setUseButton();

        $resposta7 = new TRadioGroup('resposta7');
        $resposta7->addItems($opcoes);
        $resposta7->setLayout('horizontal');
        $resposta7->setUseButton();

        $resposta8 = new TRadioGroup('resposta8');
        $resposta8->addItems($opcoes);
        $resposta8->setLayout('horizontal');
        $resposta8->setUseButton();

        $resposta9 = new TRadioGroup('resposta9');
        $resposta9->addItems($opcoes);
        $resposta9->setLayout('horizontal');
        $resposta9->setUseButton();

        $resposta10 = new TRadioGroup('resposta10');
        $resposta10->addItems($opcoes);
        $resposta10->setLayout('horizontal');
        $resposta10->setUseButton();
        
        $resposta11 = new TRadioGroup('resposta11');
        $resposta11->addItems($opcoes);
        $resposta11->setLayout('horizontal');
        $resposta11->setUseButton();
        
        $resposta12 = new TRadioGroup('resposta12');
        $resposta12->addItems($opcoes);
        $resposta12->setLayout('horizontal');
        $resposta12->setUseButton();

        $resposta13 = new TRadioGroup('resposta13');
        $resposta13->addItems($opcoes);
        $resposta13->setLayout('horizontal');
        $resposta13->setUseButton();

        $resposta14 = new TRadioGroup('resposta14');
        $resposta14->addItems($opcoes);
        $resposta14->setLayout('horizontal');
        $resposta14->setUseButton();

        $resposta15 = new TRadioGroup('resposta15');
        $resposta15->addItems($opcoes);
        $resposta15->setLayout('horizontal');
        $resposta15->setUseButton();

        $resposta16 = new TRadioGroup('resposta16');
        $resposta16->addItems($opcoes);
        $resposta16->setLayout('horizontal');
        $resposta16->setUseButton();

        $resposta17 = new TRadioGroup('resposta17');
        $resposta17->addItems($opcoes);
        $resposta17->setLayout('horizontal');
        $resposta17->setUseButton();

        $resposta18 = new TRadioGroup('resposta18');
        $resposta18->addItems($opcoes);
        $resposta18->setLayout('horizontal');
        $resposta18->setUseButton();

        $resposta19 = new TRadioGroup('resposta19');
        $resposta19->addItems($opcoes);
        $resposta19->setLayout('horizontal');
        $resposta19->setUseButton();

        $resposta20 = new TRadioGroup('resposta20');
        $resposta20->addItems($opcoes);
        $resposta20->setLayout('horizontal');
        $resposta20->setUseButton();

        $resposta21 = new TRadioGroup('resposta21');
        $resposta21->addItems($opcoes);
        $resposta21->setLayout('horizontal');
        $resposta21->setUseButton();

        $resposta22 = new TRadioGroup('resposta22');
        $resposta22->addItems($opcoes);
        $resposta22->setLayout('horizontal');
        $resposta22->setUseButton();

        $resposta23 = new TRadioGroup('resposta23');
        $resposta23->addItems($opcoes);
        $resposta23->setLayout('horizontal');
        $resposta23->setUseButton();

        $resposta24 = new TRadioGroup('resposta24');
        $resposta24->addItems($opcoes);
        $resposta24->setLayout('horizontal');
        $resposta24->setUseButton();

        $lb_01 = new TLabel('<b>Comunicativo</b><b style="color:red">*</b>');
        $lb_02 = new TLabel('<b>Otimista</b><b style="color:red">*</b>');
        $lb_03 = new TLabel('<b>Foco em relacionamentos</b><b style="color:red">*</b>');
        $lb_04 = new TLabel('<b>Executor</b><b style="color:red">*</b>');
        $lb_05 = new TLabel('<b>Ousado</b><b style="color:red">*</b>');
        $lb_06 = new TLabel('<b>Dinâmicos</b><b style="color:red">*</b>');
        $lb_07 = new TLabel('<b>Objetivo</b><b style="color:red">*</b>');
        $lb_08 = new TLabel('<b>Comandante</b><b style="color:red">*</b>');
        $lb_09 = new TLabel('<b>Racional</b><b style="color:red">*</b>');
        $lb_10 = new TLabel('<b>Avesso à rotina</b><b style="color:red">*</b>');

        $lb_11 = new TLabel('<b>Orientação a resultados</b><b style="color:red">*</b>');
        $lb_12 = new TLabel('<b>Generalista</b><b style="color:red">*</b>');
        $lb_13 = new TLabel('<b>Analista</b><b style="color:red">*</b>');
        $lb_14 = new TLabel('<b>Foco em Tarefas</b><b style="color:red">*</b>');
        $lb_15 = new TLabel('<b>Realista</b><b style="color:red">*</b>');
        $lb_16 = new TLabel('<b>Planejador</b><b style="color:red">*</b>');
        $lb_17 = new TLabel('<b>Conservador</b><b style="color:red">*</b>');
        $lb_18 = new TLabel('<b>Sistemática</b><b style="color:red">*</b>');
        $lb_19 = new TLabel('<b>Estável</b><b style="color:red">*</b>');
        $lb_20 = new TLabel('<b>Conciliador</b><b style="color:red">*</b>');

        $lb_21 = new TLabel('<b>Emocional</b><b style="color:red">*</b>');
        $lb_22 = new TLabel('<b>Orientação a processos</b><b style="color:red">*</b>');
        $lb_23 = new TLabel('<b>Rotineiro</b><b style="color:red">*</b>');
        $lb_24 = new TLabel('<b>Especialista</b><b style="color:red">*</b>');
        
        $row = $this->form->addFields(  [ new TLabel('Código'), $id ],
                                        [ new TLabel('Código da Vaga'), $db_vaga_id ],
                                        [ new TLabel('Nome'), $nome ]
                                        );
        $row->layout = ['col-sm-2', 'col-sm-2', 'col-sm-6'];
        
        $this->form->addContent( [ TElement::tag('h5', '<b>' .$texto .'</b>', [ 'style'=>'background: whitesmoke; padding: 5px; border-radius: 5px; margin-top: 5px'] ) ] );
              
        //Início das perguntas
        $row = $this->form->addFields(  [ $lb_01 .str_repeat('&nbsp;', 20), $resposta1 ],
                                        [ $lb_02 .str_repeat('&nbsp;', 20), $resposta2 ],
                                        [ $lb_03 .str_repeat('&nbsp;', 20), $resposta3 ],
                                        [ $lb_04 .str_repeat('&nbsp;', 20), $resposta4 ],
        );
        $row->layout = ['col-sm-3', 'col-sm-3', 'col-sm-3', 'col-sm-3'];

        $row = $this->form->addFields(  [ $lb_05 .str_repeat('&nbsp;', 20), $resposta5 ],
                                        [ $lb_06 .str_repeat('&nbsp;', 20), $resposta6 ],
                                        [ $lb_07 .str_repeat('&nbsp;', 20), $resposta7 ],
                                        [ $lb_08 .str_repeat('&nbsp;', 20), $resposta8 ],
        );
        $row->layout = ['col-sm-3', 'col-sm-3', 'col-sm-3', 'col-sm-3'];

        $row = $this->form->addFields(  [ $lb_09 .str_repeat('&nbsp;', 20), $resposta9 ],
                                        [ $lb_10 .str_repeat('&nbsp;', 20), $resposta10 ],
                                        [ $lb_11 .str_repeat('&nbsp;', 20), $resposta11 ],
                                        [ $lb_12 .str_repeat('&nbsp;', 20), $resposta12 ],
        );
        $row->layout = ['col-sm-3', 'col-sm-3', 'col-sm-3', 'col-sm-3'];

        $row = $this->form->addFields(  [ $lb_13 .str_repeat('&nbsp;', 20), $resposta13 ],
                                        [ $lb_14 .str_repeat('&nbsp;', 20), $resposta14 ],
                                        [ $lb_15 .str_repeat('&nbsp;', 20), $resposta15 ],
                                        [ $lb_16 .str_repeat('&nbsp;', 20), $resposta16 ],
        );
        $row->layout = ['col-sm-3', 'col-sm-3', 'col-sm-3', 'col-sm-3'];

        $row = $this->form->addFields(  [ $lb_17 .str_repeat('&nbsp;', 20), $resposta17 ],
                                        [ $lb_18 .str_repeat('&nbsp;', 20), $resposta18 ],
                                        [ $lb_19 .str_repeat('&nbsp;', 20), $resposta19 ],
                                        [ $lb_20 .str_repeat('&nbsp;', 20), $resposta20 ],
        );
        $row->layout = ['col-sm-3', 'col-sm-3', 'col-sm-3', 'col-sm-3'];

        $row = $this->form->addFields(  [ $lb_21 .str_repeat('&nbsp;', 20), $resposta21 ],
                                        [ $lb_22 .str_repeat('&nbsp;', 20), $resposta22 ],
                                        [ $lb_23 .str_repeat('&nbsp;', 20), $resposta23 ],
                                        [ $lb_24 .str_repeat('&nbsp;', 20), $resposta24 ],
        );
        $row->layout = ['col-sm-3', 'col-sm-3', 'col-sm-3', 'col-sm-3'];


        //Fim de Parte de 21 a 30

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

        $resposta11->setSize('100%');
        $resposta12->setSize('100%');
        $resposta13->setSize('100%');
        $resposta14->setSize('100%');
        $resposta15->setSize('100%');
        $resposta16->setSize('100%');
        $resposta17->setSize('100%');
        $resposta18->setSize('100%');
        $resposta19->setSize('100%');        
        $resposta20->setSize('100%');   
        
        $resposta21->setSize('100%');
        $resposta22->setSize('100%');
        $resposta23->setSize('100%');        
        $resposta24->setSize('100%');   
        
        
        
        //Validações de campos obrigatórios        
        $resposta1->addValidation('Comunicativo', new TRequiredValidator);
        $resposta2->addValidation('Otimista', new TRequiredValidator);
        $resposta3->addValidation('Foco em relacionamentos', new TRequiredValidator);
        $resposta4->addValidation('Executor', new TRequiredValidator);
        $resposta5->addValidation('Ousado', new TRequiredValidator);
        $resposta6->addValidation('Dinâmicos', new TRequiredValidator);
        $resposta7->addValidation('Objetivo', new TRequiredValidator);
        $resposta8->addValidation('Comandante', new TRequiredValidator);
        $resposta9->addValidation('Racional', new TRequiredValidator);
        $resposta10->addValidation('Avesso à rotina', new TRequiredValidator);

        $resposta11->addValidation('Orientação a resultados', new TRequiredValidator);
        $resposta12->addValidation('Generalista', new TRequiredValidator);
        $resposta13->addValidation('Analista', new TRequiredValidator);
        $resposta14->addValidation('Foco em Tarefas', new TRequiredValidator);
        $resposta15->addValidation('Realista', new TRequiredValidator);
        $resposta16->addValidation('Planejador', new TRequiredValidator);
        $resposta17->addValidation('Conservador', new TRequiredValidator);
        $resposta18->addValidation('Sistemática', new TRequiredValidator);
        $resposta19->addValidation('Estável', new TRequiredValidator);
        $resposta20->addValidation('Conciliador', new TRequiredValidator);

        $resposta21->addValidation('Emocional', new TRequiredValidator);
        $resposta22->addValidation('Orientação a processos', new TRequiredValidator);
        $resposta23->addValidation('Rotineiro', new TRequiredValidator);
        $resposta24->addValidation('Especialista', new TRequiredValidator);

       
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
        $teste_id = 3; // Id do teste deste form
        if (empty($param['id']))
        {
            try
            {                
                TTransaction::open('conecta'); // open a transaction
                $this->form->validate(); // validate form data
                $data = $this->form->getData(); // get form data as array

                $vData = (array) $data;
                $repoPerguntas = Pergunta::where('teste_id', '=', $teste_id)->load();
                
                var_dump($vData);

                $pontoFinal = 0;
                for ($i = 0; $i <= 23; $i++)
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
        $teste_id = 3; // Id do teste deste form
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

                    $data->resposta11 = $respostas[10]->resposta;
                    $data->resposta12 = $respostas[11]->resposta;
                    $data->resposta13 = $respostas[12]->resposta;
                    $data->resposta14 = $respostas[13]->resposta;
                    $data->resposta15 = $respostas[14]->resposta;
                    $data->resposta16 = $respostas[15]->resposta;
                    $data->resposta17 = $respostas[16]->resposta;
                    $data->resposta18 = $respostas[17]->resposta;
                    $data->resposta19 = $respostas[18]->resposta;
                    $data->resposta20 = $respostas[19]->resposta;

                    $data->resposta21 = $respostas[20]->resposta;
                    $data->resposta22 = $respostas[21]->resposta;
                    $data->resposta23 = $respostas[22]->resposta;
                    $data->resposta24 = $respostas[23]->resposta; 
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
