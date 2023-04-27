<?php 

class AgendaController extends Controller
{

function agenda($f3){
    $f3->set('tituloPagina', 'holyCalendar');
    echo \Template::instance()->render('../templates/layout/header-agenda.htm');
    echo \Template::instance()->render('Agenda/agenda.htm');
    echo \Template::instance()->render('../templates/layout/footer.htm');
  }
}