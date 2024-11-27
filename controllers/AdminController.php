<?php

namespace Controllers;

use Model\AdminCita;
use MVC\Router;
use Model\Servicio;
use Model\Usuario;

class AdminController {
    public static function index(Router $router) {
        isAdmin();

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $consulta = $_GET['buscar'] ?? '';

        // Obtener todas las citas para estadísticas generales
        $todasLasCitas = AdminCita::all();
        
        // Filtrar citas según los parámetros
        if($fecha && $consulta) {
            $citas = AdminCita::buscarPorFechaYCliente($fecha, $consulta);
        } elseif($fecha) {
            $citas = AdminCita::citasPorFecha($fecha);
        } elseif($consulta) {
            $citas = AdminCita::buscarPorCliente($consulta);
        } else {
            $citas = $todasLasCitas;
        }

        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'citas' => $citas,
            'todasLasCitas' => $todasLasCitas,
            'fecha' => $fecha,
            'busqueda' => $consulta
        ]);
    }

    public static function actualizarEstado() {
        isAdmin();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $estado = $_POST['estado'];

            if(!$id || !$estado) {
                echo json_encode(['tipo' => 'error', 'mensaje' => 'Datos incompletos']);
                return;
            }

            $resultado = AdminCita::actualizarEstado($id, $estado);

            if($resultado) {
                echo json_encode(['tipo' => 'exito', 'mensaje' => 'Estado actualizado correctamente']);
            } else {
                echo json_encode(['tipo' => 'error', 'mensaje' => 'Error al actualizar el estado']);
            }
        }
    }
}
