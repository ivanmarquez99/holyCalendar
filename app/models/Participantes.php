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
            'INSERT INTO users_events (usuario_id, evento_id) 
        VALUES(:usuario_id, :evento_id)',
            array(
                ':usuario_id' => $usuarioId, ':evento_id' => $eventId
            )
        );
    }

    public function comprobarParticipante($usuarioId, $eventId)
    {
        $this->load(['usuario_id = ? AND evento_id = ?', $usuarioId, $eventId]);

        return $this->query;
    }
}

?>