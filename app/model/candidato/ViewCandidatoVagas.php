<?php
/**
 * ViewCandidatoVagas Active Record
 * @author  Anderson Souza
 */
class ViewCandidatoVagas extends TRecord
{
    const TABLENAME = 'view_candidato_vagas';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    private $user; //Objeto usuário
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('empresa');
        parent::addAttribute('system_user_id');
        parent::addAttribute('candidato');
    }

    //Relacionamento do Usuário com o exame
    public function set_user(SystemUser $object)
    {
        $this->user = $object;
        $this->system_user_id = $object->id;
    }    
    
    public function get_user()
    {       
        if (empty($this->user))
            $this->user = new SystemUser($this->system_user_id);
    
        return $this->user;
    }

}
