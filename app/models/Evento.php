<?php
class Evento extends \DB\SQL\Mapper
{

    public function __construct(DB\SQL $db)
    {
        parent::__construct($db, 'events');
    }

    public function all()
    {
        $this->load();
        return $this->query;
    }

    public function store($titulo, $descripcion, $fecha_inicio, $hora_inicio, $fecha_fin, $hora_fin, $color, $ubicacion)
    {
        $this->db->exec(
            'INSERT INTO events (titulo, descripcion, fecha_inicio, hora_inicio, fecha_fin, hora_fin, color, ubicacion) 
        VALUES(:titulo,:descripcion,:fecha_inicio,:hora_inicio, :fecha_fin, :hora_fin, :color, :ubicacion)',
            array(
                ':titulo' => $titulo, ':descripcion' => $descripcion, 'fecha_inicio' => $fecha_inicio,
                ':hora_inicio' => $hora_inicio, ':fecha_fin' => $fecha_fin, ':hora_fin' => $hora_fin, ':color' => $color,
                ':ubicacion' => $ubicacion
            )
        );
    }

    public function getEvents()
    {
        // Realizar una consulta SELECT en la tabla 'events'
        // Ordenar los resultados por fecha de inicio
        $this->load(array(), array('ORDER' => 'start ASC'));

        // Devolver los resultados como un array
        return $this->query;
    }

    public function deleteEvent($id)
    {
        $this->load(['id = ?', $id]);
        if ($this->dry()) {
            return false; // El evento no existe
        }
        $this->erase();

        return true;
    }

    public function getEventbyId($id)
    {
        $this->load(array('id=?',$id));
        return $this->query;
    }

    public function getNextEvents()
    {
        $fechaActual = date('Y-m-d');
        $cantidad = 4;
        
        $this->load("fecha_inicio >= '$fechaActual'", ['order' => 'fecha_inicio ASC', 'limit' => $cantidad]);

        return $this->query;
    }

}
