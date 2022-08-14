<?php
/**
 * PmobEmocional Active Record
 * @author  Anderson Lopes de Souza
 */
class PmobEmocional extends TRecord
{
    const TABLENAME = 'pmob_emocional';
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
        parent::addAttribute('pergunta1');
        parent::addAttribute('pergunta2');
        parent::addAttribute('pergunta3');
        parent::addAttribute('pergunta4');
        parent::addAttribute('pergunta5');
        parent::addAttribute('pergunta6');
        parent::addAttribute('pergunta7');
        parent::addAttribute('pergunta8');
        parent::addAttribute('pergunta9');
        parent::addAttribute('pergunta10');
        parent::addAttribute('situacao');
        parent::addAttribute('data_hora_cadastro');
        parent::addAttribute('codigo_usuario_cadastro');
        parent::addAttribute('data_hora_ativado');
        parent::addAttribute('codigo_usuario_ativado');
        parent::addAttribute('data_hora_atualizacao');
        parent::addAttribute('codigo_usuario_atualizacao');
        parent::addAttribute('data_hora_desativado');
        parent::addAttribute('codigo_usuario_desativado');
        
        parent::addAttribute('system_user_id');
        parent::addAttribute('db_vaga_id');
        parent::addAttribute('ponto');
        parent::addAttribute('resultado');
        parent::addAttribute('texto_resultado');
    }


}
