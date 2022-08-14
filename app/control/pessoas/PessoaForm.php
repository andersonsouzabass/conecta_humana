<?php

use Adianti\Control\TPage;
use Adianti\Control\TWindow;

class PessoaForm extends TPage
{
    protected $form; // form
    

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();
        
        /*parent::setSize(0.8, null);
        parent::removePadding();
        parent::removeTitleBar();
        parent::disableEscape();
        */
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_Pessoa');
        $this->form->setFormTitle('<b>Cadastrar Empresa</b>');
        $this->form->setProperty('style', 'margin:0;border:0');
        $this->form->setClientValidation(true);

        // create the form fields
        $id = new TEntry('id');
        $nome = new TEntry('nome'); 
        $sigla = new TEntry('sigla');
        $cnpj = new TEntry('cnpj');
        $observacao = new TText('observacao');
        $cep = new TEntry('cep');
        $logradouro = new TEntry('logradouro');
        $numero = new TEntry('numero');
        $complemento = new TEntry('complemento');
        $bairro = new TEntry('bairro');        
        $cidade = new TEntry('cidade');
        
        $grupo_id = new TDBCombo('grupo_id', 'conecta', 'Grupo', 'id', 'nome');
        $tipo_unidade_id = new TDBCombo('tipo_unidade_id', 'conecta', 'TipoUnidade', 'id', 'nome');
        $estado = new TEntry('estado');

        $ativo = new TEntry('ativo');
        $this->form->addFields( [ new TLabel('Ativo') ], [ $ativo ] );
        $ativo->setValue('sim');
        TQuickForm::hideField('form_Pessoa', 'ativo');

        
        $nome->forceUpperCase();
        $sigla->forceUpperCase();
        $observacao->forceUpperCase();
        $complemento->forceUpperCase();
        $bairro->forceUpperCase();
        $cidade->forceUpperCase();
        $estado->forceUpperCase();
        $logradouro->forceUpperCase();

        $grupo_id->enableSearch(0);        
        $observacao->setSize('100%', 60);
        
        // master fields
        $row = $this->form->addFields(  [ new TLabel('Código'), $id ],
                                        [ new TLabel('CNPJ'), $cnpj ],
                                        [ new TLabel('Empresa'), $nome ],
                                        [ new TLabel('Sigla'), $sigla ]
                                        );
        $row->layout = ['col-sm-2', 'col-sm-2', 'col-sm-6','col-sm-2']; 

        
        $row = $this->form->addFields(  [ new TLabel('CEP'), $cep ],
                                        [ new TLabel('Logradouro'), $logradouro ],
                                        [ new TLabel('Numero'), $numero ]
                                        );
        $row->layout = ['col-sm-2', 'col-sm-8', 'col-sm-2'];

        $row = $this->form->addFields(  [ new TLabel('Complemento'), $complemento ],
                                        [ new TLabel('Bairro'), $bairro ],
                                        [ new TLabel('Estado'), $estado ],
                                        [ new TLabel('Cidade'), $cidade ]
                                        );
        $row->layout = ['col-sm-3', 'col-sm-4', 'col-sm-2', 'col-sm-3'];

        $row = $this->form->addFields(  [ new TLabel('Descrição'), $observacao ]
                                        );
        $row->layout = ['col-sm-12'];
        
        // set sizes
        $id->setSize('100%');
        $grupo_id->setSize('100%');
        $tipo_unidade_id->setSize('100%');

        $nome->setSize('100%');
        $sigla->setSize('100%');
        $observacao->setSize('100%');
        $cep->setSize('100%');
        $logradouro->setSize('100%');
        $numero->setSize('100%');
        $complemento->setSize('100%');
        $bairro->setSize('100%');
        $cidade->setSize('100%');
        $estado->setSize('100%');
        $cnpj->setSize('100%');
        
        $cep->setMask('99.999-999', true);
        $cnpj->setMask('99.999.999/9999-99', true);
        
        $id->setEditable(FALSE);
        $nome->addValidation('Nome', new TRequiredValidator);
        $cnpj->addValidation('CNPJ', new TRequiredValidator);

        $cnpj->setExitAction(new TAction(array($this, 'onChangeCNPJ')));
        $cep->setExitAction (new TAction(array($this, 'onExitCEP'   )));
        
        // Início de contatos
        $this->fieldlist = new TFieldList;
        $this->fieldlist-> width = '100%';
        $this->fieldlist->enableSorting();

        $tipo = new TCombo('list_tipo[]');
        $contato = new TEntry('list_contato[]');
        $responsavel = new TEntry('list_responsavel[]');
        $principal = new TCombo('list_principal[]');
        $observacao = new TEntry('list_observacao[]');

        $tipo->addItems([
            'email' => 'E-mail',
            'fone_fixo' => 'Telefone Fixo',
            'celular' => 'Celular'
            ]);

        $principal->addItems([
            'sim' => 'Sim',
            'não' => 'Não'
            ]);

        $tipo->setSize('100%');
        $contato->setSize('100%');
        $responsavel->setSize('100%');
        $principal->setSize('100%');
        $observacao->setSize('100%');

        $this->fieldlist->addField( '<b>Tipo</b>', $tipo);
        $this->fieldlist->addField( '<b>Contato</b>', $contato);
        $this->fieldlist->addField( '<b>Responsavel</b>', $responsavel);
        $this->fieldlist->addField( '<b>Principal</b>', $principal);
        $this->fieldlist->addField( '<b>Observação</b>', $observacao);

        $this->form->addField($tipo);
        $this->form->addField($contato);
        $this->form->addField($responsavel);
        $this->form->addField($principal);
        $this->form->addField($observacao);
        
        //$this->form->addContent( [''] );
        $this->form->addContent( [ TElement::tag('h5', '<b>Contatos</b>', [ 'style'=>'background: whitesmoke; padding: 5px; border-radius: 5px; margin-top: 5px'] ) ] );
        $this->form->addFields( [$this->fieldlist] );
        //Fim de contatos                                    


        //Botoões do form
        $this->form->addHeaderActionLink( _t('Close'),  new TAction(array('PessoaList','onReload')),  'fa:times red' );
        $btn = $this->form->addAction(_t('Save'), new TAction([$this, 'onSave'], ['static'=>'1']), 'fa:save');
        $btn->class = 'btn btn-sm btn-primary';
        $this->form->addActionLink('Limpar',  new TAction([$this, 'onClear']), 'fa:eraser red');
        $this->form->addActionLink('Cancelar', new TAction(array('PessoaList','onReload')),  'fa:times red' );

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
        try
        {
            TTransaction::open('conecta'); // open a transaction
            
            $this->form->validate(); // validate form data
            $data = $this->form->getData(); // get form data as array
            
            $object = new Pessoa;  // create an empty object
            $object->fromArray( (array) $data); // load the object with data
            $object->store(); // save the object
            
            //Rotina de registro dos contatos
            Contato::where('doc', '=', str_replace(['.', '-', '/'], ['', '', ''], $param['cnpj']))->delete();            
            if( !empty($param['list_tipo']) AND is_array($param['list_tipo']) )
            {
                foreach( $param['list_tipo'] as $row => $tipo)
                {
                    if (!empty($tipo))
                    {
                        $detail = new Contato;
                        $detail->doc = str_replace(['.', '-', '/'], ['', '', ''], $param['cnpj']);
                        $detail->tipo = $param['list_tipo'][$row];
                        $detail->contato = $param['list_contato'][$row];
                        $detail->responsavel = $param['list_responsavel'][$row];
                        $detail->principal = $param['list_principal'][$row];
                        $detail->observacao = $param['list_observacao'][$row];
                        $detail->store();
                    }
                }
            }
            //Fim de contato
            
            // get the generated id
            $data->id = $object->id;
            
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
        $vazio = 0;
        try
        {
            $this->fieldlist->addHeader();
            $detail = new stdClass;

            if (isset($param['key']))
            {
                $key = $param['key'];
                TTransaction::open('conecta');

                $object = new Pessoa($key);
                $this->form->setData($object);

                $items  = Contato::where('doc', '=', $object->cnpj)->load();                
                if ($items)
                {   
                    foreach($items  as $item )
                    {
                        $detail->list_tipo = $item->tipo;
                        $detail->list_contato = $item->contato;
                        $detail->list_responsavel = $item->responsavel;
                        $detail->list_principal = $item->principal;
                        $detail->list_observacao = $item->observacao;
                        $this->fieldlist->addDetail($detail);
                       
                        $vazio = 1;
                    }
                    $this->fieldlist->addCloneAction();
                }
                else
                {
                    $this->onClear($param);
                }
                TTransaction::close();
            }
            else
            {
                $this->onClear($param);
            }

            // Inclui a lista d contatos vazia caso não tenha nada na base
            if ($vazio == 0) {
                $this->fieldlist->addDetail($detail);
                $this->fieldlist->addCloneAction();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    static function onChangeCNPJ($param)
    {          
        if (!empty($param['cnpj']) && empty($param['nome'])) {
            
            try
            {
                session_write_close();

                $cnpj = preg_replace('/[^0-9]/', '', $param['cnpj']);
                $url  = 'http://receitaws.com.br/v1/cnpj/'.$cnpj;
           
                $content = @file_get_contents($url);
               
                if ($content !== false)
                {
                    $data = new stdClass;
                    if (empty($content->erro)) {
                        
                        $cnpj_data = json_decode($content);

                        $data->nome = $cnpj_data->nome;
                        $data->logradouro = $cnpj_data->logradouro;
                        $data->numero = $cnpj_data->numero;
                        $data->cep = $cnpj_data->cep;
                        $data->cidade = $cnpj_data->municipio;
                        $data->bairro = $cnpj_data->bairro;
                        $data->estado = $cnpj_data->uf;                        
                    } else {
                        
                        $data->nome = '';
                        $data->logradouro = '';
                        $data->numero = '';
                        $data->cep = '';
                        $data->cidade = '';
                        $data->bairro = '';
                        $data->estado = '';
                    }
                    TForm::sendData('form_Pessoa', $data, false, true);
                }
            }
            catch (Exception $e)
            {
                new TMessage('error', $e->getMessage());
            }
        }
    }

    
    static function onExitCEP($cep_param)
    {
        session_write_close();

        if (empty($cep_param['logradouro'])) {

            try
            {
                $cep = preg_replace('/[^0-9]/', '', $cep_param['cep']);                
                $url = 'https://viacep.com.br/ws/'.$cep.'/json/';                
                
                $content = @file_get_contents($url);
                
                if ($content !== false)
                {
                    $cep_data = json_decode($content);
                    
                    $data = new stdClass;
                    if (empty($cep_data->erro)) {
                        $data->logradouro  = $cep_data->logradouro;
                        $data->complemento = $cep_data->complemento;
                        $data->bairro      = $cep_data->bairro;
                        $data->estado      = $cep_data->uf;
                        $data->cidade      = $cep_data->localidade;
                    }
                    else {
                        $data->logradouro  = '';
                        $data->complemento = '';
                        $data->bairro      = '';
                        $data->estado   = '';
                        $data->cidade   = '';
                    }
                    TForm::sendData('form_Pessoa', $data, false, true);
                }
            }
            catch (Exception $e)
            {
                new TMessage('error', $e->getMessage());
            }
            
        }
        
    }
    
    /**
     * Closes window
     */
    public static function onClose()
    {
        parent::closeWindow();
    }
}
