<?php

class UsuarioController {
    
    public function LoginView() {
        $view=\View::instance();
        echo $view->render('Usuario\login.html','text/html');
    }
    
}
?>