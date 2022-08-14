<?php
/**
 * Perguntas Active Record
 * @author  Anderson Souza
 */
class Pergunta extends TRecord
{
    const TABLENAME = 'db_pergunta';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    private $teste; // Recebe o objeto teste

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('pergunta');
        parent::addAttribute('teste_id');
        parent::addAttribute('ativo');
    }

    public function set_teste(Teste $object)
    {
        $this->teste = $object;
        $this->teste_id = $object->id;
    }    
    
    
    public function get_teste()
    {       
        if (empty($this->teste))
            $this->teste = new Teste($this->teste_id);
    
        return $this->teste;
    }
    
}
