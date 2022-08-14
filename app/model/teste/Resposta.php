<?php
/**
 *
 * @author  Anderson Souza
 */
class Resposta extends TRecord
{
    const TABLENAME = 'db_resposta';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    const CREATEDAT = 'created_at';


    private $pergunta;
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('db_pergunta_id');
        parent::addAttribute('resposta');
        parent::addAttribute('system_user_id');
        parent::addAttribute('db_vaga_id');
        parent::addAttribute('db_teste_id');
    }

    public function set_pergunta(Pergunta $object)
    {
        $this->pergunta = $object;
        $this->db_pergunta_id = $object->id;
    }    
    
    public function get_pergunta()
    {       
        if (empty($this->pergunta))
            $this->pergunta = new Pergunta($this->db_pergunta_id);
    
        return $this->pergunta;
    }

    function getGabaritoInglesUm($reposta)
    {
        $array = [];
        $array['resposta1'] = 2;
        $array['resposta2'] = 4;
        $array['resposta3'] = 3;
        $array['resposta4'] = 3;
        $array['resposta5'] = 3;
        $array['resposta6'] = 3;
        $array['resposta7'] = 2;
        $array['resposta8'] = 4;
        $array['resposta9'] = 1;

        return $array[$reposta];        
    }

    function getGabaritoInglesDois($reposta)
    {
        $array = [];
        $array['resposta1'] = 3;
        $array['resposta2'] = 2;
        $array['resposta3'] = 2;
        $array['resposta4'] = 4;
        $array['resposta5'] = 1;
        $array['resposta6'] = 4;
        $array['resposta7'] = 1;
        $array['resposta8'] = 2;
        $array['resposta9'] = 3;

        return $array[$reposta];        
    }


}
