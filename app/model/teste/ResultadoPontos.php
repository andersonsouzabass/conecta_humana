<?php
/**
 * DbResultadoPontos Active Record
 * @author  Anderson Souza
 */
class ResultadoPontos extends TRecord
{
    const TABLENAME = 'db_resultado_pontos';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    private $teste; // Recebe o objeto teste
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('teste_id');
        parent::addAttribute('ponto');
        parent::addAttribute('ponto_max');
        parent::addAttribute('titulo');
        parent::addAttribute('texto');
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
