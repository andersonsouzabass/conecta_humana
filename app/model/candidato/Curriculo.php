<?php
/**
 * PmobTalentos Active Record
 * @author  <your-name-here>
 */
class Curriculo extends TRecord
{
    const TABLENAME = 'pmob_talentos';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    const CREATEDAT = 'created_at';
    const UPDATEDAT = 'updated_at';

    private $user; //Objeto usuário

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('situacao');
        parent::addAttribute('cpf');
        parent::addAttribute('nacionalidade');
        parent::addAttribute('sexo');
        parent::addAttribute('data_nascimento');
        parent::addAttribute('estado_civil');
        parent::addAttribute('deficiencia');
        parent::addAttribute('cid');
        parent::addAttribute('escolaridade');
        parent::addAttribute('cidade');
        parent::addAttribute('bairro');
        parent::addAttribute('numero');
        parent::addAttribute('logradouro');
        parent::addAttribute('cep');
        parent::addAttribute('estado');
        parent::addAttribute('complemento');
        parent::addAttribute('obj_profissional');
        parent::addAttribute('idiomas');
        parent::addAttribute('ultima_empresa');
        parent::addAttribute('dt_inicio_ue');
        parent::addAttribute('dt_fim_ue');
        parent::addAttribute('cargo_ue');
        parent::addAttribute('atividade_exercida_ue');
        parent::addAttribute('emprego_atual_ue');
        parent::addAttribute('empresa_2');
        parent::addAttribute('dt_inicio_e2');
        parent::addAttribute('dt_fim_e2');
        parent::addAttribute('cargo_e2');
        parent::addAttribute('atividade_exercida_e2');        
        parent::addAttribute('empresa_3');
        parent::addAttribute('dt_inicio_e3');
        parent::addAttribute('dt_fim_e3');
        parent::addAttribute('cargo_e3');
        parent::addAttribute('atividade_exercida_e3');
        parent::addAttribute('system_user_id');       
    
    }

    //Relacionamento do Usuário com o curriculo
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
