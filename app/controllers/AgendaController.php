<?php 

class AgendaController extends Controller
{

function agenda($f3){
    $f3->set('tituloPagina', 'holyCalendar');
    $f3->set('header', 'header.htm');
    $f3->set('footer', 'footer.htm');
    echo \Template::instance()->render('../templates/layout/header.htm');
    echo \Template::instance()->render('Agenda/agenda.htm');
    echo \Template::instance()->render('../templates/layout/footer.htm');
  }
}