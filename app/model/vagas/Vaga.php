<?php
/**
 * Vaga Active Record
 * @author  Anderson Souza
 */
class Vaga extends TRecord
{
    const TABLENAME = 'db_vaga';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    private $pessoa; // Recebe o objeto pessoa
   

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('pessoa_id');
        parent::addAttribute('ativo');
        parent::addAttribute('dt_fim');
        parent::addAttribute('descricao');        
    }

    public function set_pessoa(Pessoa $object)
    {
        $this->pessoa = $object;
        $this->pessoa_id = $object->id;
    }    
    
    public function get_pessoa()
    {       
        if (empty($this->pessoa))
            $this->pessoa = new Pessoa($this->pessoa_id);
    
        return $this->pessoa;
    }

    function addVagaTeste($id)
    {
        $object = new VagaTeste;
        $object->teste_id = $id;
        $object->vaga_id = $this->id;
        $object->store();
    }
    
    public function getVagaTeste()
    {
        return parent::loadAggregate('Teste', 'VagaTeste', 'vaga_id', 'teste_id', $this->id);
    }

    public function getEstaInscrito($user_id)
     {
        $inscrito = 0;
        $inscrito = Candidatura::where('system_user_id', '=', $user_id)
                                ->where('db_vaga_id', '=', $this->id)
                                ->count();

        return $inscrito > 0 ? true : false;
     }

}
