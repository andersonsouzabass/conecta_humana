<?php
/**
 * CurriculoForm Form
 * @author  Anderson Souza
 */
class CurriculoForm extends TPage
{
    protected $form; // form
    
    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();
        
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_Curriculo');
        $this->form->setFormTitle('<b>Meu Currículo</b>');

        // create the form fields
        //Dados pessoais
        $id = new TEntry('id'); 
        $nome = new TEntry('nome');        
        $cpf = new TEntry('cpf');
        $nacionalidade = new TEntry('nacionalidade');
        $sexo = new TCombo('sexo');
        $data_nascimento = new TDate('data_nascimento');
        $estado_civil = new TCombo('estado_civil');
        $deficiencia = new TCombo('deficiencia');
        $cid = new TEntry('cid');
        $escolaridade = new TCombo('escolaridade');
        $conecta = new TCombo('conecta');

        //Endereço
        $cidade = new TEntry('cidade');
        $logradouro = new TEntry('logradouro');
        $numero = new TEntry('numero');
        $bairro = new TEntry('bairro');
        $cep = new TEntry('cep');
        $estado = new TEntry('estado');
        $complemento = new TEntry('complemento');

        //Experiências profissionais
        $obj_profissional = new TEntry('obj_profissional');
        $idiomas = new TText('idiomas');

        $ultima_empresa = new TEntry('ultima_empresa');
        $dt_inicio_ue = new TDate('dt_inicio_ue');
        $dt_fim_ue = new TDate('dt_fim_ue');
        $cargo_ue = new TEntry('cargo_ue');
        $atividade_exercida_ue = new TText('atividade_exercida_ue');
        $emprego_atual_ue = new TCombo('emprego_atual_ue');

        $empresa_2 = new TEntry('empresa_2');
        $dt_inicio_e2 = new TDate('dt_inicio_e2');
        $dt_fim_e2 = new TDate('dt_fim_e2');
        $cargo_e2 = new TEntry('cargo_e2');
        $atividade_exercida_e2 = new TText('atividade_exercida_e2');

        $empresa_3 = new TEntry('empresa_3');
        $dt_inicio_e3 = new TDate('dt_inicio_e3');
        $dt_fim_e3 = new TDate('dt_fim_e3');
        $cargo_e3 = new TEntry('cargo_e3');
        $atividade_exercida_e3 = new TText('atividade_exercida_e3');

        //Parâmetros de busca js
        $cep->setExitAction (new TAction(array($this, 'onExitCEP')));

        //Itens dos combos
        $sexo->addItems( [
            'feminino' => 'Feminino', 
            'masculino' => 'Masculino', 
            'prefiro não informar' => 'Prefiro não informar'] );

        $estado_civil->addItems( [
            'solteiro' => 'Solteiro(a)', 
            'casado' => 'Casado(a)', 
            'divorciado' => 'Divorciado(a)',
            'viúvo' => 'Viúvo(a)',
            'separado' => 'Separado(a)',
            'uniao estavel' => 'União Estável'
            ] );

        $deficiencia->addItems( [
            'não' => 'Não', 
            'sim' => 'Sim'            
            ] );

        $escolaridade->addItems( [
            'Ensino Fundamental incompleto' => 'Ensino Fundamental incompleto',
            'Ensino Fundamental completo' => 'Ensino Fundamental completo',
            'Ensino médio incompleto' => 'Ensino médio incompleto',
            'Ensino médio completo' => 'Ensino médio completo',
            'Ensino técnico incompleto' => 'Ensino técnico incompleto',
            'Ensino técnico completo' => 'Ensino técnico completo',
            'Ensino superior incompleto'=> 'Ensino superior incompleto',
            'Ensino superior completo' => 'Ensino superior completo',
            'Pós graduação incompleto' => 'Pós graduação incompleto',
            'Pós graduação completo' => 'Pós graduação completo',
            'Mestrado' => 'Mestrado',
            'Doutorado' => 'Doutorado'
            ] );

        $conecta->addItems( [
            'Não' => 'Não', 
            'Sim' => 'Sim',
            'Talvez' => 'Talvez'            
            ] );

        $emprego_atual_ue->addItems( [
            'não' => 'Não', 
            'sim' => 'Sim'            
            ] );

        // add the fields
        //Início de dados pessoais
        $this->form->addContent( [ TElement::tag('h5', '<b>Dados Pessoais</b>', [ 'style'=>'background: whitesmoke; padding: 5px; border-radius: 5px; margin-top: 5px'] ) ] );
        
        $row = $this->form->addFields(  [ new TLabel('Matrícula'), $id ],
                                        [ new TLabel('Nome'), $nome ],
                                        [ new TLabel('Nascimento'), $data_nascimento ]                                                                             
                                        );
        $row->layout = ['col-sm-2', 'col-sm-6', 'col-sm-2'];

        $row = $this->form->addFields(  [ new TLabel('CPF'), $cpf ],
                                        [ new TLabel('Nacionalidade'), $nacionalidade ],
                                        [ new TLabel('Genêro'), $sexo ],
                                        [ new TLabel('Estado Civíl'), $estado_civil ]                                
                                        );
        $row->layout = ['col-sm-2', 'col-sm-2', 'col-sm-2', 'col-sm-2'];

        $row = $this->form->addFields(  [ new TLabel('Pessoa com Deficiência'), $deficiencia ],
                                        [ new TLabel('CID'), $cid ],
                                        [ new TLabel('Escolaridade'), $escolaridade ]                                                                               
                                        );
        $row->layout = ['col-sm-2', 'col-sm-2', 'col-sm-4'];
        //Fim de dados pessoais

        //Início de Endereços
        $this->form->addContent( [ TElement::tag('h5', '<b>Endereço</b>', [ 'style'=>'background: whitesmoke; padding: 5px; border-radius: 5px; margin-top: 5px'] ) ] );
        
        $row = $this->form->addFields(  [ new TLabel('CEP'), $cep ],
                                        [ new TLabel('Logradouro'), $logradouro ],
                                        [ new TLabel('Número'), $numero ]
                                        );
        $row->layout = ['col-sm-2', 'col-sm-8', 'col-sm-2'];

        $row = $this->form->addFields(  [ new TLabel('Complemento'), $complemento ],
                                        [ new TLabel('Bairro'), $bairro ],
                                        [ new TLabel('Cidade'), $cidade ],
                                        [ new TLabel('Estado'), $estado ]
                                        );
        $row->layout = ['col-sm-4', 'col-sm-3', 'col-sm-3', 'col-sm-2'];
        //Fim de endereços

        //Início de Contatos
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
        //Fim de Contatos

        //Início de experiências profissinais
        $this->form->addContent( [ TElement::tag('h5', '<b>Experiências Profissionais</b>', [ 'style'=>'background: whitesmoke; padding: 5px; border-radius: 5px; margin-top: 5px'] ) ] );
        
        $row = $this->form->addFields(  [ new TLabel('Objetivo Profissional'), $obj_profissional ]
                                        );
        $row->layout = ['col-sm-12'];

        $row = $this->form->addFields(  [ new TLabel('Idiomas'), $idiomas ]
                                        );
        $row->layout = ['col-sm-12'];
        
        $this->form->addContent( [ TElement::tag('h5', '<b>Última Empresa</b>' ) ] );

        $row = $this->form->addFields(  [ new TLabel('Empresa'), $ultima_empresa ],
                                        [ new TLabel('Início'), $dt_inicio_ue ],
                                        [ new TLabel('Término'), $dt_fim_ue ]
                                        );
        $row->layout = ['col-sm-8', 'col-sm-2', 'col-sm-2'];

        $row = $this->form->addFields(  [ new TLabel('Cargo'), $cargo_ue ],
                                        [ new TLabel('Emprego Atual'), $emprego_atual_ue ]
                                        );
        $row->layout = ['col-sm-8', 'col-sm-2'];

        $row = $this->form->addFields(  [ new TLabel('Atividades Exercidas'), $atividade_exercida_ue ]
                                        );
        $row->layout = ['col-sm-12'];

        $this->form->addContent( [ TElement::tag('h5', '<b>Penúltima Empresa</b>' ) ] );
        
        $row = $this->form->addFields(  [ new TLabel('Empresa'), $empresa_2 ],
                                        [ new TLabel('Início'), $dt_inicio_e2 ],
                                        [ new TLabel('Término'), $dt_fim_e2 ]
                                        );
        $row->layout = ['col-sm-8', 'col-sm-2', 'col-sm-2'];

        $row = $this->form->addFields(  [ new TLabel('Cargo'), $cargo_e2 ]
                                        );
        $row->layout = ['col-sm-8'];

        $row = $this->form->addFields(  [ new TLabel('Atividades Exercidas'), $atividade_exercida_e2 ]
                                        );
        $row->layout = ['col-sm-12'];

        $this->form->addContent( [ TElement::tag('h5', '<b>Antepenúltima Empresa</b>' ) ] );
        
        $row = $this->form->addFields(  [ new TLabel('Empresa'), $empresa_3 ],
                                        [ new TLabel('Início'), $dt_inicio_e3 ],
                                        [ new TLabel('Término'), $dt_fim_e3 ]
                                        );
        $row->layout = ['col-sm-8', 'col-sm-2', 'col-sm-2'];

        $row = $this->form->addFields(  [ new TLabel('Cargo'), $cargo_e3 ]
                                        );
        $row->layout = ['col-sm-8'];

        $row = $this->form->addFields(  [ new TLabel('Atividades Exercidas'), $atividade_exercida_e3 ]
                                        );
        $row->layout = ['col-sm-12'];
        //Fim de experiências profissionais


            /*
            * Carregamento inicial da página
            *    Aqui, o nome do candidato deve vir da tabela de usuário carregado pela session        
            */
            try
            {
                TTransaction::open('conecta');
                $id_user = SystemUser::find(TSession::getValue('userid'));                
                if ($id_user instanceof SystemUser)
                {
                    $nome->setValue($id_user->name);
                }                
                TTransaction::close();
            }
            catch (Exception $e)
            {
                new TMessage('error', $e->getMessage());
            }
            // Fim do preenchimento dos campos do cadastro

        // set sizes
        $id->setSize('100%');
        $nome->setSize('100%');
        
        $cpf->setSize('100%');
        $nacionalidade->setSize('100%');
        $sexo->setSize('100%');
        $data_nascimento->setSize('100%');
        $estado_civil->setSize('100%');
        $deficiencia->setSize('100%');
        $cid->setSize('100%');
        $escolaridade->setSize('100%');
        $conecta->setSize('100%');

        $cidade->setSize('100%');
        $logradouro->setSize('100%');
        $numero->setSize('100%');
        $bairro->setSize('100%');
        $cep->setSize('100%');
        $estado->setSize('100%');
        $complemento->setSize('100%');

        $obj_profissional->setSize('100%');
        $idiomas->setSize('100%');

        $ultima_empresa->setSize('100%');
        $dt_inicio_ue->setSize('100%');
        $dt_fim_ue->setSize('100%');
        $cargo_ue->setSize('100%');
        $atividade_exercida_ue->setSize('100%');
        $emprego_atual_ue->setSize('100%');
        $empresa_2->setSize('100%');
        $dt_inicio_e2->setSize('100%');
        $dt_fim_e2->setSize('100%');
        $cargo_e2->setSize('100%');
        $atividade_exercida_e2->setSize('100%');
        $empresa_3->setSize('100%');
        $dt_inicio_e3->setSize('100%');
        $dt_fim_e3->setSize('100%');
        $cargo_e3->setSize('100%');
        $atividade_exercida_e3->setSize('100%');        
       
        $nome->forceUpperCase();
        $cpf->forceUpperCase();
        $nacionalidade->forceUpperCase();
        $data_nascimento->forceUpperCase();
        $cid->forceUpperCase();
        $cidade->forceUpperCase();
        $logradouro->forceUpperCase();
        $numero->forceUpperCase();
        $bairro->forceUpperCase();
        $cep->forceUpperCase();
        $estado->forceUpperCase();
        $complemento->forceUpperCase();
        $obj_profissional->forceUpperCase();
        $idiomas->forceUpperCase();
        $ultima_empresa->forceUpperCase();
        $dt_inicio_ue->forceUpperCase();
        $dt_fim_ue->forceUpperCase();
        $cargo_ue->forceUpperCase();
        $atividade_exercida_ue->forceUpperCase();
        $empresa_2->forceUpperCase();
        $dt_inicio_e2->forceUpperCase();
        $dt_fim_e2->forceUpperCase();
        $cargo_e2->forceUpperCase();
        $atividade_exercida_e2->forceUpperCase();
        $empresa_3->forceUpperCase();
        $dt_inicio_e3->forceUpperCase();
        $dt_fim_e3->forceUpperCase();
        $cargo_e3->forceUpperCase();
        $atividade_exercida_e3->forceUpperCase();

        //Formatação de campos
        $id->setEditable(FALSE);
        $cpf->setMask('999.999.999-99', true);
        $data_nascimento->setMask('dd/mm/yyyy');
        $data_nascimento->setDataBaseMask('yyyy-mm-dd');

        $dt_inicio_ue->setMask('dd/mm/yyyy');
        $dt_inicio_ue->setDataBaseMask('yyyy-mm-dd');
        $dt_fim_ue->setMask('dd/mm/yyyy');
        $dt_fim_ue->setDataBaseMask('yyyy-mm-dd');

        $dt_inicio_e2->setMask('dd/mm/yyyy');
        $dt_inicio_e2->setDataBaseMask('yyyy-mm-dd');
        $dt_fim_e2->setMask('dd/mm/yyyy');
        $dt_fim_e2->setDataBaseMask('yyyy-mm-dd');

        $dt_inicio_e3->setMask('dd/mm/yyyy');
        $dt_inicio_e3->setDataBaseMask('yyyy-mm-dd');
        $dt_fim_e3->setMask('dd/mm/yyyy');
        $dt_fim_e3->setDataBaseMask('yyyy-mm-dd');

        $cep->setMask('99.999-999', true);



        //Campos obrigatórios
        $cpf->addValidation('CPF', new TRequiredValidator);
        

        // create the form actions
        $btn = $this->form->addAction(_t('Save'), new TAction([$this, 'onSave']), 'fa:save');
        $btn->class = 'btn btn-sm btn-primary';
        $this->form->addActionLink(_t('New'),  new TAction([$this, 'onEdit']), 'fa:eraser red');
        
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
            
            $object = new Curriculo;  // create an empty object
            $object->fromArray( (array) $data); // load the object with data
            $object->system_user_id = TSession::getValue('userid');
            $object->store(); // save the object
            
            //Rotina de registro dos contatos
            Contato::where('doc', '=', str_replace(['.', '-', '/'], ['', '', ''], $param['cpf']))->delete();            
            if( !empty($param['list_tipo']) AND is_array($param['list_tipo']) )
            {
                foreach( $param['list_tipo'] as $row => $tipo)
                {
                    if (!empty($tipo))
                    {
                        $detail = new Contato;
                        $detail->doc = str_replace(['.', '-', '/'], ['', '', ''], $param['cpf']);
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
    public function onEdit()
    {
        try
        {
            TTransaction::open('conecta'); // open a transaction

            $detail = new stdClass;

            $detail->id = TSession::getValue('userid');
            $detail->nome = TSession::getValue('username');

            $this->form->setData($detail); // Preenche o form com dados da session

            $criteria = new TCriteria;
            $criteria->add( new TFilter( 'system_user_id', '=', TSession::getValue('userid')));
            $curriculo = Curriculo::getObjects($criteria);

            foreach ( $curriculo as $meucurrilo )
            {
                $this->form->setData($meucurrilo);

                $items  = Contato::where('doc', '=', $meucurrilo->cpf)->load();    
                $this->fieldlist->addHeader();
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
                    }                    
                    $this->fieldlist->addCloneAction();                    
                }
                else
                {
                    $this->fieldlist->addDetail($detail);
                    $this->fieldlist->addCloneAction();          
                } //Fim de contatos 

            }
            TTransaction::close(); // close the transaction
            
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    public static function onExitCEP($param)
    {
        session_write_close();

        try
        {
            $cep = preg_replace('/[^0-9]/', '', $param['cep']);
            $url = 'https://viacep.com.br/ws/'.$cep.'/json/';
            
            $content = @file_get_contents($url);

            if ($content !== false)
            {
                $cep_data = json_decode($content);
                
                $data = new stdClass;
                if (empty($cep_data->erro))
                {
                    $data->logradouro  = $cep_data->logradouro;
                    $data->complemento = $cep_data->complemento;
                    $data->bairro      = $cep_data->bairro;
                    $data->estado      = $cep_data->uf;
                    $data->cidade      = $cep_data->localidade;
                }
                else
                {
                    $data->logradouro  = '';
                    $data->complemento = '';
                    $data->bairro      = '';
                    $data->estado   = '';
                    $data->cidade   = '';
                }
                TForm::sendData('form_Curriculo', $data, false, true);
            }
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}
