<?php
require 'vendor/autoload.php';
$f3 = Base::instance();

$db=new DB\SQL( 'mysql:host=localhost;port=3306;dbname=db_recordarme', 'root' );
$f3->set('DB',$db);
$f3->config('config.ini');
$f3->config('routes.ini');
$f3->run();
?>