<?php
/**
 * Candidatura Active Record
 * @author  Anderson Souza
 */
class Candidatura extends TRecord
{
    const TABLENAME = 'db_candidatura';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    const CREATEDAT = 'created_at';

    private $vaga; //Objeto vaga
   
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('system_user_id');
        parent::addAttribute('db_vaga_id');        
    }

    //Relacionamento com candidatura
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
}
