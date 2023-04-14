<?php
require '../models/Usuario.php';
class UsuarioController extends Usuario {

    public function LoginView() {
        require '../views/Usuario/Login.php';
    }
}

if(isset($_GET['action']) && $_GET['action']=='login') {
    $instanciaControlador = new UsuarioController();
    $instanciaControlador->LoginView();

}
?>