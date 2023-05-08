<?php

class RegistroController extends Controller
{

  function register($f3){

    $f3->set('error', '');
    $f3->set('nombre', '');
    $f3->set('email', '');
    $f3->set('password', '');

    if ($f3->VERB == 'POST') {
      $nombre = $f3->get('POST.usuario');
      $correo = $f3->get('POST.correo');
      $password = $f3->get('POST.password');

      $error = $this->validarRegistro($nombre, $correo, $password);

      if (!$error) {

        $usuario = new Usuario($this->db);
        $usuario->insertar($nombre, $correo, $password);

        // Redirigir al usuario a una página de éxito
        $f3->set('SESSION.user_id', $usuario->id);
        $f3->set('SESSION.user_rol', $usuario->rol);
        $f3->reroute('/agenda');
      } else {
        // Mostrar el formulario de registro con los errores
        $f3->set('error', $error);
        $f3->set('nombre', $nombre);
        $f3->set('email', $correo);
        $f3->set('password', $password);
      }
    }

    $f3->set('tituloPagina', 'Registro');
    $f3->set('header', 'header.htm');
    $f3->set('footer', 'footer.htm');
    echo \Template::instance()->render('../templates/layout/header.htm');
    echo \Template::instance()->render('Usuario/register.htm');
    echo \Template::instance()->render('../templates/layout/footer.htm');
  }

  private function validarRegistro($nombre, $email, $password) {
    $error = '';

    $user = new Usuario($this->db);
    $username = $user->usuarioExiste($nombre);
    $useremail = $user->emailExiste($email);

    if ($username) {
      $error = 'El usuario está en uso';
    } elseif (empty($nombre)) {
      $error = 'El nombre es obligatorio.';
    } elseif (strlen($nombre) > 100) {
      $error = 'El nombre no puede tener más de 100 caracteres.';
    } elseif ($useremail) {
      $error = 'El email está en uso';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error = 'El correo electrónico no es válido.';
    } elseif (empty($password)) {
      $error = 'La contraseña es obligatoria.';
    } elseif (strlen($password) < 6) {
      $error = 'La contraseña debe tener al menos 6 caracteres.';
    }

    return $error;
  }

  function disconnect($f3){
    $f3->clear('SESSION.user_id');
    $f3->reroute('/');
  }

}
