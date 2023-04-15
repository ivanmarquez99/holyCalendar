<?php

class UsuarioController extends Controller{

    function render($f3){
		$f3->set('tituloPagina','holyCalendar');
        $f3->set('header','header.htm');
        $f3->set('footer','footer.htm');
        echo \Template::instance()->render('../templates/layout/header.htm');
        echo View::instance()->render('Usuario/login.htm');
        echo \Template::instance()->render('../templates/layout/footer.htm');
	}

  function register($f3){
		$f3->set('tituloPagina','Registro');
        $f3->set('header','header.htm');
        $f3->set('footer','footer.htm');
        echo \Template::instance()->render('../templates/layout/header.htm');
        echo View::instance()->render('Usuario/register.htm');
        echo \Template::instance()->render('../templates/layout/footer.htm');
	}


}
