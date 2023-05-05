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

    public function store($titulo, $descripcion, $fecha_inicio, $hora_inicio, $fecha_fin, $hora_fin, $color)
    {
        $this->db->exec(
            'INSERT INTO events (titulo, descripcion, fecha_inicio, hora_inicio, fecha_fin, hora_fin, color) 
        VALUES(:titulo,:descripcion,:fecha_inicio,:hora_inicio, :fecha_fin, :hora_fin, :color)',
            array(
                ':titulo' => $titulo, ':descripcion' => $descripcion, 'fecha_inicio' => $fecha_inicio,
                ':hora_inicio' => $hora_inicio, ':fecha_fin' => $fecha_fin, ':hora_fin' => $hora_fin, ':color' => $color
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
}
