<?php

class LoginController extends Controller
{

  public function login($f3) {

    

    if ($f3->get('SESSION.user_id')) {
      $f3->reroute('/agenda');
    }
   
    $f3->set('SESSION.login_error', '');
    
    if ($f3->VERB == 'POST') {
    
    // Obtener las credenciales del usuario desde el formulario de inicio de sesión
    $username = $f3->get('POST.user');
    $password = $f3->get('POST.password');

    // Buscar el usuario en la base de datos
    $user = new Usuario($this->db);
    $user ->getByName($username);

    // Verificar si el usuario existe y si la contraseña es correcta
    if ($user->dry() || !password_verify($password, $user->password)) {
      $f3->set('SESSION.login_error', 'Nombre de usuario o contraseña incorrectos.');
      $f3->reroute('/');
    } else {
      // Iniciar sesión y redirigir al usuario a la página de inicio
      $f3->set('SESSION.user_id', $user->id);
      $f3->set('SESSION.user_rol', $user->rol);
      $f3->set('SESSION.user_name', $user->nombre_usuario);
      $f3->reroute('/agenda');
    }
  }

  $f3->set('tituloPagina', 'Inicio');
  $f3->set('header', 'header.htm');
  $f3->set('footer', 'footer.htm');
  echo \Template::instance()->render('../templates/layout/header.htm');
  echo \Template::instance()->render('Usuario/login.htm');
  echo \Template::instance()->render('../templates/layout/footer.htm');
  }

}
