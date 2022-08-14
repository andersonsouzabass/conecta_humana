<?php
/**
 * PmobPerfilComportamental Active Record
 * @author  <your-name-here>
 */
class PmobPerfilComportamental extends TRecord
{
    const TABLENAME = 'pmob_perfil_comportamental';
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
        parent::addAttribute('flag_p10');
        parent::addAttribute('flag_p11');
        parent::addAttribute('flag_p12');
        parent::addAttribute('flag_p13');
        parent::addAttribute('flag_p14');
        parent::addAttribute('flag_p15');
        parent::addAttribute('flag_p16');
        parent::addAttribute('flag_p17');
        parent::addAttribute('flag_p18');
        parent::addAttribute('flag_p19');
        parent::addAttribute('flag_p20');
        parent::addAttribute('flag_p21');
        parent::addAttribute('flag_p22');
        parent::addAttribute('flag_p23');
        parent::addAttribute('flag_p24');
        parent::addAttribute('flag_p25');
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

        parent::addAttribute('i');
        parent::addAttribute('o');
        parent::addAttribute('c');
        parent::addAttribute('a');
    }


}
