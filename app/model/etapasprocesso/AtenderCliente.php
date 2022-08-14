<?php
/**
 * AtenderCliente Active Record
 * @author  <Anderson Lopes de Souza>
 */
class AtenderCliente extends TRecord
{
    const TABLENAME = 'pmob_atender_cliente';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('cargo');
        parent::addAttribute('pergt1');
        parent::addAttribute('pergt2');
        parent::addAttribute('pergt3');
        parent::addAttribute('pergt4');
        parent::addAttribute('pergt5');
        parent::addAttribute('pergt6');
        parent::addAttribute('pergt7');
        parent::addAttribute('pergt8');
        parent::addAttribute('pergt9');
        parent::addAttribute('pergt10');
        parent::addAttribute('pergt11');
        parent::addAttribute('pergt12');
        parent::addAttribute('pergt13');
        parent::addAttribute('pergt14');
        parent::addAttribute('data_hora_cadastro');
        parent::addAttribute('codigo_usuario_cadastro');
        parent::addAttribute('data_hora_ativado');
        parent::addAttribute('codigo_usuario_ativado');
        parent::addAttribute('codigo_usuario_atualizacao');
        parent::addAttribute('data_hora_atualizacao');
        parent::addAttribute('data_hora_desativado');
        parent::addAttribute('codigo_usuario_desativado');
        parent::addAttribute('situacao');
        
        parent::addAttribute('system_user_id');
        parent::addAttribute('db_vaga_id');
        parent::addAttribute('ponto');
        parent::addAttribute('resultado');
        parent::addAttribute('texto_resultado');
    }


}
