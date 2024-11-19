<?php

namespace Model;

class Servicio extends ActiveRecord {
    // Base de datos
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre_servicio', 'precio'];

    public $id;
    public $nombre_servicio;
    public $precio;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre_servicio = $args['nombre_servicio'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }
}