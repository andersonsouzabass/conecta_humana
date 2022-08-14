<?php

use Adianti\Control\TPage;
use Adianti\Database\TRepository;
use Adianti\Widget\Form\TLabel;

/**
 * AtenderClienteForm Form
 * @author  Anderson Souza
 */

class AtenderClienteForm extends TPage
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
        $this->form = new BootstrapFormBuilder('form_AtenderCliente');
        $this->form->setFormTitle('<b>Atendimento ao Cliente</b>');

        // create the form fields        
        $id = new TEntry('id'); //id do teste
        $db_vaga_id = new TEntry('db_vaga_id'); //Id da vaga
        $nome = new TEntry('nome'); //Nome da vaga

        $opcoes = [];
        $opcoes[1] = 'Jamais';
        $opcoes[2] = 'Raramente';
        $opcoes[3] = 'Algumas Vezes';
        $opcoes[4] = 'Sempre';

        $escala = New TRadioGroup('escala');
        $escala->addItems( [1 => 'Jamais = 1', 2 => 'Raramente = 2', 3 => 'Algumas Vezes = 3', 4 => 'Sempre = 4'] );

        $this->pergunta1;
        $this->pergunta2;

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

        $resposta11 = new TRadioGroup('resposta11');
        $resposta11->addItems( $opcoes );

        $resposta12 = new TRadioGroup('resposta12');
        $resposta12->addItems( $opcoes );

        $resposta13 = new TRadioGroup('resposta13');
        $resposta13->addItems( $opcoes );

        $resposta14 = new TRadioGroup('resposta14');
        $resposta14->addItems( $opcoes );
        
        
        $row = $this->form->addFields(  [ new TLabel('Registro'), $id ],
                                        [ new TLabel('Código da Vaga'), $db_vaga_id ],
                                        [ new TLabel('Nome'), $nome ]
                                        );
        $row->layout = ['col-sm-2', 'col-sm-2', 'col-sm-6'];
        

        $row = $this->form->addFields(  [ new TLabel('<b>Atribua pontos a cada uma das afirmativas, conforme a seguinte escala:</b>'), $escala ]
                                        );
        $row->layout = ['col-sm-4'];

        
        $row = $this->form->addFields(  [ new TLabel('1- ...sinto prazer ao lidar com pessoas e perceber que posso ajudá-las de alguma forma.<b style="color:red">*</b>'), $resposta1 ],
                                        [ new TLabel('2- ...conheço o perfil da clientela com a qual trabalho e busco sempre identificar suas necessidades e expectativas.<b style="color:red">*</b>'), $resposta2 ]
                                        );
        $row->layout = ['col-sm-6', 'col-sm-6'];
       

        $row = $this->form->addFields(  [ new TLabel('3- ...faço todo o esforço para corresponder às expectativas dos meus clientes, assumindo a responsabilidade por tudo que posso resolver e/ou encaminhando adequadamente, quando o assunto sai de minha alçada.<b style="color:red">*</b>'), $resposta3 ],
                                        [ new TLabel('4-... sei ouvir o cliente, mesmo quando este está fazendo uma reclamação, demonstrando atenção pelo que ele está dizendo.<b style="color:red">*</b>'), $resposta4 ]
                                        );
        $row->layout = ['col-sm-6', 'col-sm-6'];
        
        $row = $this->form->addFields(  [ new TLabel('5-... sou empático, demonstrando compreender seus sentimentos e o meu interesse em resolver seu problema.<b style="color:red">*</b>'), $resposta5 ],
                                        [ new TLabel('6- ... expresso-me claramente e de forma objetiva, usando uma linguagem adequada e profissional.<b style="color:red">*</b>'), $resposta6 ]
                                        );
        $row->layout = ['col-sm-6', 'col-sm-6'];
        
        $row = $this->form->addFields(  [ new TLabel('7-...sou assertiva, assumindo firmemente minhas posições, sem desconsiderar os direitos e o ponto de vista do cliente.<b style="color:red">*</b>'), $resposta7 ],
                                        [ new TLabel('8-...tenho bom autocontrole, conseguindo conter minha ansiedade, estresse, e sentimentos negativos, tomando decisões e agindo de forma equilibrada e profissional.<b style="color:red">*</b>'), $resposta8 ]
                                        );
        $row->layout = ['col-sm-6', 'col-sm-6'];
        
        $row = $this->form->addFields(  [ new TLabel('9- ...estou constantemente buscando conhecer-me melhor, perceber meus pontos de melhoria e avaliando a qualidade do meu trabalho.<b style="color:red">*</b>'), $resposta9 ],
                                        [ new TLabel('10-... busco todas as informações necessárias ao bom desempenho de minha atividade, mesmo que elas não cheguem até a mim, visando orientar, adequadamente, os clientes.<b style="color:red">*</b>'), $resposta10 ]
                                        );
        $row->layout = ['col-sm-6', 'col-sm-6'];
        
        $row = $this->form->addFields(  [ new TLabel('11-...tenho uma atitude receptiva, através do olhar, do sorriso e dos gestos, demonstrando ao cliente meu interesse em atendê-lo bem.<b style="color:red">*</b>'), $resposta11 ],
                                        [ new TLabel('12- ... respeito todos, sem fazer qualquer tipo de discriminação, procurando atender, igualmente, todos, com a maior cortesia.<b style="color:red">*</b>'), $resposta12 ]
                                        );
        $row->layout = ['col-sm-6', 'col-sm-6'];
        
        $row = $this->form->addFields(  [ new TLabel('13- ... tenho os conhecimentos necessários sobre a empresa/setor/serviço/produto e as habilidades técnicas exigidas para fazer um atendimento rápido e eficaz.<b style="color:red">*</b>'), $resposta13 ],
                                        [ new TLabel('14- ... consigo perceber as reclamações dos clientes como uma oportunidade de melhoria e de compreender melhor suas necessidades, entendendo como uma crítica construtiva.<b style="color:red">*</b>'), $resposta14 ]
                                        );
        $row->layout = ['col-sm-6', 'col-sm-6'];
        
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

        $resposta11->addValidation('Pergunta 11', new TRequiredValidator);
        $resposta12->addValidation('Pergunta 12', new TRequiredValidator);
        $resposta13->addValidation('Pergunta 13', new TRequiredValidator);
        $resposta14->addValidation('Pergunta 14', new TRequiredValidator);
        


        if (!empty($id))
        {        
            $id->setEditable(FALSE);  
            $nome->setEditable(FALSE);
            $db_vaga_id->setEditable(FALSE);
            
            $escala->setEditable(FALSE);
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

    function onRetornarTestes()
    {
        TApplication::loadPage(['TelaTeste', 'onEdit']);
    }

    /**
     * Save form data
     * @param $param Request
     */
    public function onSave( $param )
    {
        if (empty($param['id']))
        {
            try
            {                
                TTransaction::open('conecta'); // open a transaction
                $this->form->validate(); // validate form data
                $data = $this->form->getData(); // get form data as array

                $vData = (array) $data;
                $repoPerguntas = Pergunta::where('teste_id', '=', '1')->load();
                
                for ($i = 0; $i <= 13; $i++)
                {
                    $object = new Resposta();
                    $object->system_user_id = TSession::getValue('userid');
                    $object->db_vaga_id = $data->db_vaga_id; //Pega a id do usuário logado
                    $object->db_pergunta_id = $repoPerguntas[$i]->id;
                    $object->db_teste_id = 1;
                    $object->resposta = $vData['resposta' .(string) ($i + 1)];                    
                    $object->store();
                }

                //Calcula e registra o resultado
                $ponto = $data->resposta1 + $data->resposta2 + $data->resposta3 + $data->resposta4 + $data->resposta5 + $data->resposta6 + $data->resposta7 + $data->resposta8 + $data->resposta9 + $data->resposta10 + $data->resposta11 + $data->resposta12 + $data->resposta13 + $data->resposta14;

                //Cadastra o ponto do candidato na avaliação
                $criteria = new TCriteria;                           
                $criteria->add( new TFilter( 'teste_id', '=', 1 ));
                $criteria->add( new TFilter( 'ponto', '<=', $ponto ));   
                $criteria->add( new TFilter( 'ponto_max', '>=', $ponto ));            
                $resultado = ResultadoPontos::getObjects($criteria);
                
                $final = new Resultado();

                //var_dump($criteria);
                foreach ($resultado as $resultado_final)
                {
                    $final->db_teste_id = 1;
                    $final->db_resultado_pontos_id = $resultado_final->id;
                    $final->db_vaga_id = $data->db_vaga_id;
                    $final->system_user_id = TSession::getValue('userid');
                    $final->ponto = $ponto;
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
    { //Carregar os dados a partir do userid e da id da vaga que vem atrás do param
        
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

                $resultado_id = Resultado::where('db_teste_id','=', 1)
                                            ->where('db_vaga_id','=', $detalheVaga->id)
                                            ->where('system_user_id','=', TSession::getValue('userid'))
                                            ->first();

                $data->id = $resultado_id->id;
                
                // o id deste teste = 1
                $respostas = Resposta::where('db_vaga_id', '=', $detalheVaga->id)
                                        ->where('system_user_id', '=', TSession::getValue('userid'))
                                        ->where('db_teste_id', '=', 1)
                                        ->load();
               
                // Preenche as respostas, caso já existam
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

}
