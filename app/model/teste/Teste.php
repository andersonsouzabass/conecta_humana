<?php
/**
 *
 * @author  Anderson Souza
 */
class Teste extends TRecord
{
    const TABLENAME = 'db_teste';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('ativo');
        parent::addAttribute('controller');
    }
}
