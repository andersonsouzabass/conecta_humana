<?php
/**
 * PmobComportamental Active Record
 * @author  <your-name-here>
 */
class PmobComportamental extends TRecord
{
    const TABLENAME = 'pmob_comportamental';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('empresa');
        parent::addAttribute('comunicativo');
        parent::addAttribute('otimista');
        parent::addAttribute('foco_relacionamentos');
        parent::addAttribute('executor');
        parent::addAttribute('ousado');
        parent::addAttribute('dinamicos');
        parent::addAttribute('objetivo');
        parent::addAttribute('comandante');
        parent::addAttribute('racional');
        parent::addAttribute('avesso_rotina');
        parent::addAttribute('orientacao_resultados');
        parent::addAttribute('generalista');
        parent::addAttribute('analista');
        parent::addAttribute('foco_tarefas');
        parent::addAttribute('realista');
        parent::addAttribute('planejador');
        parent::addAttribute('conservador');
        parent::addAttribute('sistematica');
        parent::addAttribute('estavel');
        parent::addAttribute('conciliador');
        
        parent::addAttribute('emocional');
        parent::addAttribute('orientacao_processos');
        parent::addAttribute('rotineiro');
        parent::addAttribute('especialista');
        
        parent::addAttribute('situacao');
        parent::addAttribute('data_hora_cadastro');
        parent::addAttribute('data_hora_ativado');
        parent::addAttribute('codigo_usuario_ativado');
        parent::addAttribute('codigo_usuario_desativado');
        parent::addAttribute('data_hora_atualizacao');
        parent::addAttribute('codigo_usuario_atualizacao');
        parent::addAttribute('data_hora_desativado');
        
        parent::addAttribute('system_user_id');
        parent::addAttribute('db_vaga_id');
        parent::addAttribute('ponto');
        parent::addAttribute('resultado');
        parent::addAttribute('texto_resultado');
    }


}
