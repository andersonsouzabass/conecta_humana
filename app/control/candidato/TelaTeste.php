<?php
/**
 * SinglePageView
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class TelaTeste extends TPage
{
    /**
     * Constructor method
     */
    public function __construct()
    {
        parent::__construct();

        error_reporting(0);
        ini_set(“display_errors”, 0 );

        //Formulário de cabeçalho da tela
        $this->cabecalho = new BootstrapFormBuilder('form_cabecalho');
        $this->cabecalho->setFormTitle('<b>TESTES DA VAGA</b>');
        $this->cabecalho->setClientValidation(true);
        $this->cabecalho->setColumnClasses( 2, ['col-sm-5 col-lg-4', 'col-sm-7 col-lg-8'] );

        //Atributos do cabeçalho
        $id = new TEntry('id');
        $nome = new TEntry('nome');

        //Preenche a tela com os dados da vaga
        $row = $this->cabecalho->addFields(  [ new TLabel('Código da Vaga'), $id ],
                                             [ new TLabel('Vaga'), $nome ]
                                             );
        $row->layout = ['col-sm-2', 'col-sm-6']; 

        $id->setSize('100%');
        $nome->setSize('100%');

        $id->setEditable(FALSE);  
        $nome->setEditable(FALSE); 
       
        // Preenhe o conteiner do form
        $container = new TVBox;
        $container->style = 'width: 100%';
        // $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->cabecalho);
        parent::add($container);
    }
    
    public function onEdit( $param )
    {
        if (!empty(TSession::getValue('db_vaga_id'))) {
            $param['key'] = TSession::getValue('db_vaga_id');
        }
        TSession::setValue('db_vaga_id', $null);

        try
        {
            if (isset($param['key']))
            {                
                $key = $param['key'];  // get the parameter $key
                TTransaction::open('conecta'); // open a transaction

                $objVaga = new Vaga($key); // instantiates the Active Record

                // Verifica se o candidato está inscrito na vaga
                $inscrito = $objVaga->getEstaInscrito( TSession::getValue('userid') );
                if ( $inscrito) {
                    $this->cabecalho->setData($objVaga);
            
                    $testes = $objVaga->getVagaTeste();
    
                    foreach ($testes as $teste)
                    {
                        //Constrói um form para cada teste apontado
                        $this->form = new BootstrapFormBuilder('form_' .$teste->nome);
                        $this->form->setFormTitle('<b>' .$teste->nome .'</b>');
                        $this->form->setClientValidation(true);
                        $this->form->setColumnClasses( 2, ['col-sm-5 col-lg-4', 'col-sm-7 col-lg-8'] );
                    
                        $action = new TAction( [$teste->controller, 'onEdit'], ['id' => $objVaga->id]);
                        $bt_teste = new TActionLink('Ir para o teste', $action, 'white', 10, '', 'far:check-square #FEFF00');
                        $bt_teste->class='btn btn-success';
                        $this->form->add($bt_teste);
    
                        // Preenhe o conteiner do form
                        $container = new TVBox;
                        $container->style = 'width: 100%';
                        // $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
                        $container->add($this->form);
                        parent::add($container);
                    }
                } else {
                    new TMessage('erro', 'Você não está inscrito(a) nesta vaga!');
                    TApplication::loadPage('VagaCandidatoList');
                }
                
                TTransaction::close();
            }
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }

    public function abreTeste( $controller)
    {
        var_dump($controller);
        //TApplication::loadPage($controller);
    }
}
