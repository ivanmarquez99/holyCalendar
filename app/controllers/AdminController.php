<?php

class AdminController extends Controller
{
    function adminAsistencia($f3)
    {
        $this->listEvents();

        if ($f3->get('SESSION.user_id')) {
            $f3->set('tituloPagina', 'Panel de administración');
            echo \Template::instance()->render('../templates/layout/header-lista.htm');
            echo \Template::instance()->render('Admin/new-admin.htm');
            echo \Template::instance()->render('../templates/layout/footer.htm');
        } else {
            $f3->reroute('/');
        }
    }

    function listEvents()
    {
        $evento = new Evento($this->db);

        $listEvents = $evento->getPreviousEvents();

        $eventos_formateados = array();
        foreach ($listEvents as $valor) {
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

            $evento_limpio = array(
                'id' => $valor['id'],
                'title' => $valor['titulo'],
                'date' => date('Y-m-d', strtotime($valor['fecha_inicio'])),
                'hour' => date('H:i', strtotime($valor['hora_inicio'])),
                'organizer' => $organiza[$color],
                'ubication' => $valor['ubicacion'],
                'description' => $valor['descripcion']
            );
            array_push($eventos_formateados, $evento_limpio);
        }

        $this->f3->set('anteriores_eventos', $eventos_formateados);
    }

    function eventsInformation($f3)
    {

        $id = $f3->get('POST.select-project');

        $evento = new Evento($this->db);

        $EventList = $evento->getEventbyId($id);

        foreach ($EventList as $valor) {
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

            $evento_limpio = array(
                'id' => $valor['id'],
                'title' => $valor['titulo'],
                'date' => date('Y-m-d', strtotime($valor['fecha_inicio'])),
                'hour' => date('H:i', strtotime($valor['hora_inicio'])),
                'organizer' => $organiza[$color],
                'ubicacion' => $valor['ubicacion'],
                'description' => $valor['descripcion']
            );
        }

        return $evento_limpio;
    }

    public function participantesById($f3)
    {
        $eventId = $f3->get('POST.eventId');

        $participante = new Participantes($this->db);

        $participantes = $participante->getParticipantesbyId($eventId);

        echo json_encode($participantes);
    }

    public function asistenciaCheck($f3)
    {

        $participacion = $f3->get('POST.participa');
        $userId = $f3->get('POST.userId');
        $eventId = $f3->get('POST.eventId');

        $participante = new Participantes($this->db);
        if ($participacion=="true") {
            $participante->changeParticipacion($userId, 1, $eventId);
        } else {
            $participante->changeParticipacion($userId, 0, $eventId);
        }

        if($participante) {
            $f3->reroute('/agenda/admin', null, ['select-project' => $eventId], 'POST');
        } else {
            echo "Algo falló";
        }
    }
}
