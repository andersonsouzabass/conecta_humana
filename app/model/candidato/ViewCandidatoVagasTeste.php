<?php
/**
 * ViewCandidatoVagasTeste Active Record
 * @author  <your-name-here>
 */
    class ViewCandidatoVagasTeste extends TRecord
{
    const TABLENAME = 'view_candidato_vagas_teste';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('system_user_id');
        parent::addAttribute('system_program_id');
        parent::addAttribute('teste');
        parent::addAttribute('controller');
    }


}
