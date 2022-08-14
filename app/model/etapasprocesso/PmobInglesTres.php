<?php
/**
 * PmobIngles1 Active Record
 * @author  Anderson Souza
 */
class PmobInglesTres extends TRecord
{
    const TABLENAME = 'pmob_ingles3';
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
        parent::addAttribute('flag_p1');
        parent::addAttribute('flag_p2');
        parent::addAttribute('flag_p3');
        parent::addAttribute('flag_p4');
        parent::addAttribute('flag_p5');
        parent::addAttribute('flag_p6');
        parent::addAttribute('flag_p7');
        parent::addAttribute('flag_p8');
        parent::addAttribute('flag_p9');
        parent::addAttribute('data_hora_cadastro');
        parent::addAttribute('codigo_usuario_cadastro');
        parent::addAttribute('data_hora_ativado');
        parent::addAttribute('codigo_usuario_ativado');
        parent::addAttribute('data_hora_atualizacao');
        parent::addAttribute('codigo_usuario_atualizacao');
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
