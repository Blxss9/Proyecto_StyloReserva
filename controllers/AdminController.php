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
        $fechas = explode('-', $fecha);

        if(!checkdate($fechas[1], $fechas[2], $fechas[0])) {
            header('Location: /404');
        }

        // Consultas para cada sección
        $consulta = $_GET['buscar'] ?? '';
        if($consulta) {
            $citas = AdminCita::buscarPorCliente($consulta);
        } else {
            $citas = AdminCita::citasPorFecha($fecha);
        }

        $servicios = Servicio::all();
        $usuarios = Usuario::all();

        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'citas' => $citas,
            'fecha' => $fecha,
            'busqueda' => $consulta,
            'servicios' => $servicios,
            'usuarios' => $usuarios
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
