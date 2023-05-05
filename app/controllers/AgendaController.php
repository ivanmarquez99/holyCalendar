<?php

class AgendaController extends Controller
{
  function agenda($f3)
  {

    if (\Base::instance()->exists('POST.titulo')) {
      $titulo = $this->f3->get('POST.titulo');
      $descripcion = $this->f3->get('POST.descripcion');
      $fecha_inicio = $this->f3->get('POST.fecha_inicio');
      $hora_inicio = $this->f3->get('POST.hora_inicio');
      $fecha_fin = $this->f3->get('POST.fecha_fin');
      $hora_fin = $this->f3->get('POST.hora_fin');
      $color = $this->f3->get('POST.color');

      $event = new Evento($this->db);

      $event->store($titulo, $descripcion, $fecha_inicio, $hora_inicio, $fecha_fin, $hora_fin, $color);
    }

    if ($f3->get('SESSION.user_id')) {
      echo ($this->getEvents());
      $f3->set('tituloPagina', 'holyCalendar');
      echo \Template::instance()->render('../templates/layout/header-agenda.htm');
      echo \Template::instance()->render('Agenda/agenda.htm');
      echo \Template::instance()->render('../templates/layout/footer.htm');
    } else {
      $f3->reroute('/');
    }
  }

  function getEvents()
  {
    // Obtener los eventos de la base de datos
    $eventos = new Evento($this->db);
    $events = $eventos->getEvents();

    // Formatear los eventos en un arreglo que FullCalendar puede entender
    $eventos_formateados = array();
    foreach ($events as $evento) {
      $evento_formateado = array(
        'id' => $evento['id'],
        'title' => $evento['titulo'],
        'start' => $evento['fecha_inicio'] . 'T' . $evento['hora_inicio'],
        'end' => $evento['fecha_fin'] . 'T' . $evento['hora_fin'],
        'color' => $evento['color']
      );
      array_push($eventos_formateados, $evento_formateado);
    }

    // Convertir el arreglo de eventos en formato JSON
    $eventos_json = json_encode($eventos_formateados);
    // Devolver los datos en formato JSON
    $this->f3->set('json_events', $eventos_json);
  }
}
