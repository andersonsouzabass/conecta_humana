<?php
/**
 * 
 * @author  Anderson Souza
 */
class VagaTeste extends TRecord
{
    const TABLENAME = 'db_vaga_teste';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('teste_id');
        parent::addAttribute('vaga_id');
    }
}
