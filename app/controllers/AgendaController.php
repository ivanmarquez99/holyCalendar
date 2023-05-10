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
      $ubicacion = $this->f3->get('POST.ubicacion');

      $event = new Evento($this->db);

      $event->store($titulo, $descripcion, $fecha_inicio, $hora_inicio, $fecha_fin, $hora_fin, $color, $ubicacion);
    }

    if ($f3->get('SESSION.user_id')) {

      $this->inscritos();
      $this->getEvents();

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

    // Formatear los eventos en un arreglo
    $eventos_formateados = array();
    foreach ($events as $evento) {
      $evento_formateado = array(
        'id' => $evento['id'],
        'title' => $evento['titulo'],
        'start' => $evento['fecha_inicio'] . 'T' . $evento['hora_inicio'],
        'end' => $evento['fecha_fin'] . 'T' . $evento['hora_fin'],
        'color' => $evento['color'],
        'ubicacion' => $evento['ubicacion'],
        'description' => $evento['descripcion']
      );
      array_push($eventos_formateados, $evento_formateado);
    }

    // Convertir el arreglo de eventos en formato JSON
    $eventos_json = json_encode($eventos_formateados);
    // Devolver los datos en formato JSON
    $this->f3->set('json_events', $eventos_json);
  }

  public function eliminarEvento($f3, $params)
  {
    $id = $params['id'];
    $evento = new Evento($this->db);

    if ($evento->deleteEvent($id)) {
      // Redirigir a la página de eventos
      $f3->reroute('/agenda');
    }
  }

  public function editarEvento($f3, $params)
  {
    // Obtener el ID del evento desde los parámetros de la ruta
    $id = $params['id'];

    // Obtener el evento a editar desde el modelo
    $evento = new Evento($this->db);

    $evento->getEventById($id);

    // Renderizar la plantilla de edición de evento
    $f3->set('evento', $evento);
    $f3->set('tituloPagina', 'Editar evento seleccionado');
    echo \Template::instance()->render('../templates/layout/header.htm');
    echo \Template::instance()->render('Agenda/editar_evento.htm');
    echo \Template::instance()->render('../templates/layout/footer.htm');
  }

  public function actualizarEvento($f3)
  {
    // Obtener los datos del formulario
    $id = $f3->get('POST.id');
    $titulo = $f3->get('POST.titulo');
    $descripcion = $f3->get('POST.descripcion');
    $fecha_inicio = $f3->get('POST.fecha_inicio');
    $hora_inicio = $f3->get('POST.hora_inicio');
    $fecha_fin = $f3->get('POST.fecha_fin');
    $hora_fin = $f3->get('POST.hora_fin');
    $color = $f3->get('POST.color');
    $ubicacion = $f3->get('POST.ubicacion');

    $evento = new Evento($this->db);
    // Obtener el evento a actualizar desde el modelo
    $evento->getEventbyId($id);

    // Actualizar los campos del evento
    $evento->titulo = $titulo;
    $evento->descripcion = $descripcion;
    $evento->fecha_inicio = $fecha_inicio;
    $evento->hora_inicio = $hora_inicio;
    $evento->fecha_fin = $fecha_fin;
    $evento->hora_fin = $hora_fin;
    $evento->ubicacion = $ubicacion;
    $evento->color = $color;
    $evento->save();

    // Redirigir a la página de eventos
    $f3->reroute('/agenda');
  }

  public function inscribirse($f3)
  {
    // Obtenemos el id del usuario y del evento
    $usuarioId = $this->f3->get('POST.id-user');
    $eventoId = $this->f3->get('POST.id-event');

    // Crear una instancia del modelo Usuario
    $usuario = new Participantes($this->db);

    // Inscribir al usuario en el evento
    $usuario->inscribirseEvento($usuarioId, $eventoId);

    $f3->reroute('/agenda');
  }

  public function inscritos()
  {
    // Crear una instancia del modelo de participantes
    $participanteModel = new Participantes($this->db);

    // Obtener todos los participantes
    $participants = $participanteModel->getParticipantes();

    $participantes_formateados = array();
    foreach ($participants as $participante) {
      $participante_formateado = array(
        'id' => $participante['id'],
        'usuario_id' => $participante['usuario_id'],
        'evento_id' => $participante['evento_id']
      );
      array_push($participantes_formateados, $participante_formateado);
    }

    $participantsJson = json_encode($participantes_formateados);

    // Pasar los participantes a la vista
    $this->f3->set('participants_json', $participantsJson);
    return $participantsJson;
  }

  public function checkUser($f3)
  {
    $evento = json_decode($f3->get('BODY'), true);

    $eventId = $evento['event'];
    $userId = $evento['user'];

    // Crear una instancia del modelo de participantes
    $participante = new Participantes($this->db);

    // Obtener todos los participantes
    $check = $participante->comprobarParticipante($userId, $eventId);

    echo json_encode($check);
  }

  public function asistenciaList($f3)
  {
    $usuarioId = $this->f3->get('POST.id-user');

    // Crear una instancia del modelo de participantes
    $participante = new Participantes($this->db);
    $evento = new Evento($this->db);

    //Comprobar los eventos en los que participo
    $listEvents = $participante->getEventsbyId($usuarioId);


    $arrEvents = array();
    $eventos_formateados = array();

    foreach ($listEvents as $valor) {
      $event = $evento->getEventbyId($valor['evento_id']);
      foreach ($event as $valor) {

        $organiza = array(
          '#D4AF37' => 'Cofradia',
          '#02cc24' => 'Lagrimas y Favores',
          '#4903fc' => 'Azotes y Columna',
          '#f70505' => 'Exaltación',
          '#000000' => 'Ánimas de ciegos',
          '#0062e3' => 'Mayor Dolor',
          '#014a14' => 'Vera+Cruz'
        );

        $color = $valor['color'];

        $evento_formateado = array(
          'id' => $valor['id'],
          'title' => $valor['titulo'],
          'date' => date('d-m-Y', strtotime($valor['fecha_inicio'])),
          'hour' => date('H:i', strtotime($valor['hora_inicio'])),
          'color' => $organiza[$color],
          'ubicacion' => $valor['ubicacion'],
          'description' => $valor['descripcion']
        );
        array_push($eventos_formateados, $evento_formateado);
      }
    }

    
    

    $this->f3->set('listEvents', $eventos_formateados);
    $this->f3->set('tituloPagina', 'Lista de eventos en los que participas');
    echo \Template::instance()->render('../templates/layout/header-agenda.htm');
    echo \Template::instance()->render('Agenda/lista_eventos.htm');
    echo \Template::instance()->render('../templates/layout/footer.htm');
  }
}
