<?php

class AsistenciaController extends Controller
{
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

    public function eliminarAsistencia($f3)
    {
        $usuarioId = $this->f3->get('POST.id-user');
        $eventoId = $this->f3->get('POST.id-event');
        $inscripcion = new Participantes($this->db);

        if ($inscripcion->eliminarInscripcion($usuarioId, $eventoId)) {
            // Redirigir a la página de eventos
            echo "Está funcionando";
            $f3->reroute('/agenda/asistencias');
        } else {
            echo "No está funcionando";
        }
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

  
}
