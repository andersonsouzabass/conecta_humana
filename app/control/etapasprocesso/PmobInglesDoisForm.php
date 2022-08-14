<?php

use Adianti\Control\TPage;

/**
 * AtenderClienteForm Form
 * @author  Anderson Souza
 */
class PmobInglesDoisForm extends TPage
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
        $this->form = new BootstrapFormBuilder('form_ingles2');
        $this->form->setFormTitle('<b>Inglês 2</b>');

        // create the form fields
        
        $id = new TEntry('id');
        $db_vaga_id = new TEntry('db_vaga_id'); //Id da vaga
        $nome = new TEntry('nome'); //Nome da vaga

        $texto = new TLabel('texto');
        $texto = 'If an animal can possibly be a pet, someone in the United States is probably living with it, making money from it, or studying its effect on people. Today 61 percent of American families own animals. Pets are important not only to people’s mental health but to their physical well being, too. According to the researchers who have studied the relationship between humans and animals, pets can influence heart rate and blood pressure. They can also improve the emotional state and behaviour of prisoners and the elderly. People are turning to pets more often these days for several reasons. Big city life leads to a loneliness that animals often fulfil. Psychologists suggest that many Americans are recognizing the benefits of pet companionship and turning to them to fill the emptiness in their lives. ‘Pets are a part of the family,’ said one psychologist. ‘We treat our pets as if they were human beings.’ According to one survey, 99 percent of dog and cat owners say that they talk to their pets. Forty percent of the people asked also said they kept pictures of their pets in their wallets and celebrated their pets’ birthdays.';
        
        $titulo = new TLabel('titulo');
        $titulo = 'PETS';

        $resposta1 = new TRadioGroup('resposta1');
        $resposta1->addItems( [
            1 => 'a woman or child who are kept as companion.',
            2 => 'a kind of person who usually keeps animals in prison.',
            3 => 'an animal which is kept as an affectionate companion.',
            4 => 'a special kind of animal shown in pet shops.'] );
        //$resposta1->setLayout('horizontal');

        $resposta2 = new TRadioGroup('resposta2');
        $resposta2->addItems( [
            1 => 'can sometimes suck human blood.',
            2 => 'can have a good effect on blood pressure.',
            3 => 'can make one’s blood pressure get high.',
            4 => 'are inconvenient to human health.'] );

        $resposta3 = new TRadioGroup('resposta3');
        $resposta3->addItems( [
            1 => ' tearful.',
            2 => 'helpful.',
            3 => 'successful.',
            4 => 'dreadful.'] );

        $resposta4 = new TRadioGroup('resposta4');
        $resposta4->addItems( [
            1 => 'develop a dependence on wild animal.',
            2 => 'always rely on their family power.',
            3 => 'sometimes need to be recognized.',
            4 => 'rely more on pets than on human beings.'] );

        $resposta5 = new TRadioGroup('resposta5');
        $resposta5->addItems( [
            1 => 'can improve people’s emotional condition.',
            2 => 'can make old people feel very upset.',
            3 => 'provoke unfriendliness and boredom.',
            4 => 'are the human companions for the rich.'] );

        $resposta6 = new TRadioGroup('resposta6');
        $resposta6->addItems( [
            1 => 'many of the world’s cities have been ignoring their importance.',
            2 => 'there has been a lack of world interest in other animals.',
            3 => 'living in big cities is extremely dangerous and expensive.',
            4 => 'life in large cities make most people feel lonely and isolated.'] );

        $resposta7 = new TRadioGroup('resposta7');
        $resposta7->addItems( [
            1 => 'can make people feel happy and satisfied.',
            2 => 'can cause ordinary people a lot of problems.',
            3 => 'are always an instance of inconvenience.',
            4 => 'have been causing much discomfort.'] );

        $resposta8 = new TRadioGroup('resposta8');
        $resposta8->addItems( [
            1 => 'they want to feel import.',
            2 => 'they need a companion.',
            3 => 'they want to succeed.',
            4 => 'they are very powerful.'] );

        $resposta9 = new TRadioGroup('resposta9');
        $resposta9->addItems( [
            1 => 'like a common animal.',
            2 => 'as if they were animals.',
            3 => 'like people.',
            4 => 'as if they had no feelings.'] );

        
        $row = $this->form->addFields(  [ new TLabel('Código'), $id ],
                                        [ new TLabel('Código da Vaga'), $db_vaga_id ],
                                        [ new TLabel('Nome'), $nome ]
                                        );
        $row->layout = ['col-sm-2', 'col-sm-2', 'col-sm-6'];
                
        $row = $this->form->addFields(  [ new TLabel('<b text-align: center>' . $titulo .'</b>'), $texto ]
                                        );
        $row->layout = ['col-sm-12'];

        $row = $this->form->addFields(  [ new TLabel('<b>1) Choose the option that best completes the following statements, according to the text.<br></b>'), '' ]
                                        );
        $row->layout = ['col-sm-12'];

        $row = $this->form->addFields(  [ new TLabel('<b>1º A pet is :</b><b style="color:red">*</b>' .str_repeat('&nbsp;', 100)), $resposta1 ],
                                        //[ new TLabel(''), '' ],
                                        [ new TLabel('<b>2º Pets:</b><b style="color:red">*</b>' .str_repeat('&nbsp;', 100)), $resposta2 ]
                                        );
        $row->layout = ['col-sm-6', 'col-sm-6'];
       

        $row = $this->form->addFields(  [ new TLabel('<b>3º Pets are companions:</b><b style="color:red">*</b>' .str_repeat('&nbsp;', 100)), $resposta3 ],                                        
                                        [ new TLabel('<b>4º People in wheelchairs:</b><b style="color:red">*</b>' .str_repeat('&nbsp;', 100)), $resposta4 ]
                                        );
        $row->layout = ['col-sm-6', 'col-sm-6'];
        
        $row = $this->form->addFields(  [ new TLabel('<b>5º Pets:</b><b style="color:red">*</b>' .str_repeat('&nbsp;', 100)), $resposta5 ],
                                        [ new TLabel('<b>6º People are turning to pets these days because:</b><b style="color:red">*</b>' .str_repeat('&nbsp;', 50)), $resposta6 ]
                                        );
        $row->layout = ['col-sm-6', 'col-sm-6'];
        
        $row = $this->form->addFields(  [ new TLabel('<b>7º According to the text, animals:</b><b style="color:red">*</b>' .str_repeat('&nbsp;', 70)), $resposta7 ],
                                        [ new TLabel('<b>8º Psychologists say that most Americans have a pet because:</b><b style="color:red">*</b>' .str_repeat('&nbsp;', 40)), $resposta8 ]
                                        );
        $row->layout = ['col-sm-6', 'col-sm-6'];
        
        $row = $this->form->addFields(  [ new TLabel('<b>9º The sentence, ‘We treat our pets as if they were human beings’ means approximately that the pets are treated:</b><b style="color:red">*</b>'), $resposta9 ]                                        
                                        );
        $row->layout = ['col-sm-6'];
        
       

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
        $teste_id = 4; // Id do teste deste form
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
                    $gabarito = $object->getGabaritoInglesDois('resposta' .(string) ($i + 1));
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
        $teste_id = 4; // Id do teste deste form
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
