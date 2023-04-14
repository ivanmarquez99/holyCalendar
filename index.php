<?php
require 'vendor/autoload.php';
$f3 = Base::instance();
$f3->set('AUTOLOAD','app/controllers/');
$f3->route('GET /', 'UsuarioController->LoginView');
$f3->run();
?>