<?php

namespace Model;

class AdminCita extends ActiveRecord {
    protected static $tabla = 'citas';
    protected static $columnasDB = ['id', 'fecha', 'hora', 'usuarioId', 'created_at', 'pago', 'estado'];

    public $id;
    public $fecha;
    public $hora;
    public $usuarioId;
    public $created_at;
    public $pago;
    public $estado;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->usuarioId = $args['usuarioId'] ?? '';
        $this->created_at = $args['created_at'] ?? '';
        $this->pago = $args['pago'] ?? '';
        $this->estado = $args['estado'] ?? '';
    }

    public static function citasPorFecha($fecha) {
        $query = "SELECT citas.id, citas.hora, citas.fecha, citas.estado, citas.pago, ";
        $query .= "CONCAT(usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $query .= "usuarios.email, usuarios.telefono, ";
        $query .= "GROUP_CONCAT(DISTINCT servicios.nombre_servicio SEPARATOR ', ') as servicios, ";
        $query .= "SUM(servicios.precio) as total ";
        $query .= "FROM citas ";
        $query .= "LEFT OUTER JOIN usuarios ON usuarios.id = citas.usuarioId ";
        $query .= "LEFT OUTER JOIN citasServicios ON citasServicios.citaId = citas.id ";
        $query .= "LEFT OUTER JOIN servicios ON servicios.id = citasServicios.servicioId ";
        $query .= "WHERE fecha = '$fecha' ";
        $query .= "GROUP BY citas.id ";
        $query .= "ORDER BY hora";

        return self::consultarSQL($query);
    }

    public static function buscarPorCliente($busqueda) {
        $query = "SELECT citas.id, citas.hora, citas.fecha, citas.estado, citas.pago, ";
        $query .= "CONCAT(usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $query .= "usuarios.email, usuarios.telefono, ";
        $query .= "GROUP_CONCAT(DISTINCT servicios.nombre_servicio SEPARATOR ', ') as servicios, ";
        $query .= "SUM(servicios.precio) as total ";
        $query .= "FROM citas ";
        $query .= "LEFT OUTER JOIN usuarios ON usuarios.id = citas.usuarioId ";
        $query .= "LEFT OUTER JOIN citasServicios ON citasServicios.citaId = citas.id ";
        $query .= "LEFT OUTER JOIN servicios ON servicios.id = citasServicios.servicioId ";
        $query .= "WHERE CONCAT(usuarios.nombre, ' ', usuarios.apellido) LIKE '%$busqueda%' ";
        $query .= "OR usuarios.email LIKE '%$busqueda%' ";
        $query .= "OR usuarios.telefono LIKE '%$busqueda%' ";
        $query .= "GROUP BY citas.id ";
        $query .= "ORDER BY fecha, hora";

        return self::consultarSQL($query);
    }

    public static function actualizarEstado($id, $estado) {
        $query = "UPDATE citas SET estado = ? WHERE id = ? LIMIT 1";
        $stmt = self::$db->prepare($query);
        return $stmt->execute([$estado, $id]);
    }
}
