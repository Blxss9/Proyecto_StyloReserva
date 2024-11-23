<?php

namespace Model;

class Cita extends ActiveRecord {
    protected static $tabla = 'citas';
    protected static $columnasDB = ['id', 'fecha', 'hora', 'usuarioId', 'created_at', 'pago', 'estado'];

    public $id;
    public $fecha;
    public $hora;
    public $usuarioId;
    public $created_at;
    public $pago;
    public $estado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->usuarioId = $args['usuarioId'] ?? '';
        $this->created_at = $args['created_at'] ?? '';
        $this->pago = $args['pago'] ?? '';
        $this->estado = $args['estado'] ?? '';
    }
}