<?php

class Usuario extends \DB\SQL\Mapper {

    public function __construct(DB\SQL $db) {
	    parent::__construct($db,'users');
	}

	public function all() {
	    $this->load();
	    return $this->query;
	}

    function insertar($nombre, $correo, $password)
    {
        $this->db->exec('INSERT INTO users (nombre_usuario,email,password,rol) 
        VALUES(:nombre,:correo,:password,:rol)',
        array(':nombre'=>$nombre,':correo'=>$correo,'password'=>password_hash($password, PASSWORD_DEFAULT),
        ':rol'=>1));
    }

    function getByName($nombre)
    {
        $this->load(array('nombre_usuario=?',$nombre));
	    return $this->query;
    }

    public function getByEmail($email)
	{
		$this->load(array('email=?', $email));
		return $this->query;
	}
	
	public function getById($id) 
	{
		$this->load(array('id=?',$id));
		$this->copyTo('POST');
	}
	
	public function login($id) 
	{
		$this->load(array('id=?',$id));
		$this->copyTo('SESSION');
	}

}
