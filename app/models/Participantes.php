<?php

class Participantes extends \DB\SQL\Mapper
{

    public function __construct(DB\SQL $db)
    {
        parent::__construct($db, 'users_events');
    }

    public function getParticipantes()
    {
        $this->load();

        // Devolver los resultados como un array
        return $this->query;
    }

    public function inscribirseEvento($usuarioId, $eventId)
    {
        $this->db->exec(
            'INSERT INTO users_events (usuario_id, evento_id, asistencia) 
        VALUES(:usuario_id, :evento_id, :asistencia)',
            array(
                ':usuario_id' => $usuarioId, ':evento_id' => $eventId, ':asistencia' => 0
            )
        );
    }

    public function eliminarInscripcion($usuarioId, $eventId)
    {
        $this->load(['usuario_id = ? AND evento_id = ?', $usuarioId, $eventId]);
        if ($this->dry()) {
            return false; // El evento no existe
        }
        $this->erase();

        return true;
    }

    public function comprobarParticipante($usuarioId, $eventId)
    {
        // Realiza la consulta en la base de datos para verificar si el usuario ya existe
        $count = $this->count(['usuario_id = ? AND evento_id = ?', $usuarioId, $eventId]);

        // Retorna true si el usuario existe, false en caso contrario
        return $count > 0;
    }

    public function getEventsbyId($usuarioId)
    {
        // Realiza la consulta en la base de datos para verificar si el usuario ya existe
        $this->load(array('usuario_id=?', $usuarioId));

        return $this->query;
    }

    public function getParticipantesbyId($eventId)
    {
        // Consulta para obtener los usuarios que participarán en el evento
        $query = "SELECT users.*, users_events.asistencia
                FROM users_events
                INNER JOIN users ON users.id = users_events.usuario_id
                WHERE users_events.evento_id = :eventId";
        
        // Ejecutar la consulta
        $usuariosParticipantes = $this->db->exec($query, array(':eventId' => $eventId));

        return $usuariosParticipantes;
    }

    public function changeParticipacion($userId, $participa, $eventId)
    {
        $this->load(array('usuario_id = ? AND evento_id = ?', $userId, $eventId));
        
        // Verificar si el registro existe
        if ($this->dry()) {
            return false; // El registro no existe
        }

        // Actualizar el valor de "asistencia" en el registro
        $this->asistencia = $participa;

        // Guardar los cambios en la base de datos
        $this->update();

        return true; // Actualización exitosa
    }
}
