<?php

class UsuarioController extends Controller{

    function render($f3){
		$f3->set('tituloPagina','holyCalendar');
        $f3->set('header','header.htm');
        $f3->set('footer','footer.htm');
        $template=new Template;
        echo $template->render('Usuario/login.htm');
	}


}
?>