<?php

namespace Model;

class Servicio extends ActiveRecord {
    // Base de datos
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre_servicio', 'precio', 'tiempo_estimado'];

    public $id;
    public $nombre_servicio;
    public $precio;
    public $tiempo_estimado;
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre_servicio = $args['nombre_servicio'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->tiempo_estimado = $args['tiempo_estimado'] ?? '';
    }
}