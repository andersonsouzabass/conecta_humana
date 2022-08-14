<?php
/**
 *
 * @author  Anderson Souza
 */
class Resultado extends TRecord
{
    const TABLENAME = 'db_resultado';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    private $vaga;
    private $resultado;
    private $teste;
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('db_teste_id');
        parent::addAttribute('db_resultado_pontos_id');
        parent::addAttribute('db_vaga_id');
        parent::addAttribute('system_user_id');
        //parent::addAttribute('db_resposta_id');
        parent::addAttribute('ponto');
    }

    public function set_vaga(Vaga $object)
    {
        $this->vaga = $object;
        $this->db_vaga_id = $object->id;
    }    
    
    public function get_vaga()
    {       
        if (empty($this->vaga))
            $this->vaga = new Vaga($this->db_vaga_id);
    
        return $this->vaga;
    }

    public function set_resultadoo(Resultado $object)
    {
        $this->resultado = $object;
        $this->db_resultado_pontos_id = $object->id;
    }    
    
    public function get_resultado()
    {       
        if (empty($this->resultado))
            $this->resultado = new Resultado($this->db_resultado_pontos_id);
    
        return $this->resultado;
    }

    public function set_teste(Teste $object)
    {
        $this->teste = $object;
        $this->db_teste_id = $object->id;
    }    
    
    public function get_teste()
    {       
        if (empty($this->teste))
            $this->teste = new Teste($this->db_teste_id);
    
        return $this->teste;
    }
}
