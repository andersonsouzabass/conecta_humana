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
    
    private $teste; // recebe o objeto teste
    private $vaga; // recebe o objeto vaga    

    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('teste_id');
        parent::addAttribute('vaga_id');
    }

    //Relacionamento com Vaga
    public function set_vaga(Vaga $object)
    {
        $this->vaga = $object;
        $this->vaga_id = $object->id;
    }    
    
    public function get_vaga()
    {       
        if (empty($this->vaga))
            $this->vaga = new Vaga($this->vaga_id);
    
        return $this->vaga;
    }

     //Relacionamento com Teste
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
