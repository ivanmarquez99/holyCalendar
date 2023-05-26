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
        ':rol'=>0));
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

    public function usuarioExiste($nombreUsuario)
    {
        // Realiza la consulta en la base de datos para verificar si el usuario ya existe
        $result = $this->db->exec('SELECT COUNT(*) as count FROM users WHERE nombre_usuario = ?', $nombreUsuario);
        
        // Obtiene el resultado de la consulta
        $count = $result[0]['count'];

        // Retorna true si el usuario existe, false en caso contrario
        return $count > 0;
    }

    public function emailExiste($email)
    {
        // Realiza la consulta en la base de datos para verificar si el email ya existe
        $result = $this->db->exec('SELECT COUNT(*) as count FROM users WHERE email = ?', $email);
        
        // Obtiene el resultado de la consulta
        $count = $result[0]['count'];

        // Retorna true si el usuario existe, false en caso contrario
        return $count > 0;
    }

}
