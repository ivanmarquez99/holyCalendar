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
        ':rol'=>'visitante'));
    }

    function getByName($nombre)
    {
        $this->load(array('nombre_usuario=?',$nombre));
	    return $this->query;
    }
}
