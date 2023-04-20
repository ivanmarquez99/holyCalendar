<?php
class Controller {

	protected $f3;
    protected $db;

	function beforeroute(){
	}

	function afterroute(){
	}

	function __construct() {

		$f3=Base::instance();
		$this->f3=$f3;

		$options = array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, // generic attribute
    	\PDO::ATTR_PERSISTENT => TRUE,  // we want to use persistent connections
    	\PDO::MYSQL_ATTR_COMPRESS => TRUE, // MySQL-specific attribute
	    );

	    $db=new DB\SQL(
	        $f3->get('devdb'),
	        $f3->get('devdbusername'),
			$f3->get('devdbpassword'),
			$options
		);

	    $this->db=$db;
	}
}