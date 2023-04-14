<?php
require 'vendor/autoload.php';
$f3 = Base::instance();
$f3->set('AUTOLOAD','app/controllers/');
$f3->route('GET /', 'loginController->index');
$f3->run();
?>