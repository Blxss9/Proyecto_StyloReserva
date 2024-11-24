<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController {
    public static function index() {
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    public static function guardar() {
        try {
            // Crear la cita
            $cita = new Cita([
                'fecha' => $_POST['fecha'],
                'hora' => $_POST['hora'],
                'usuarioId' => $_POST['usuarioId'],
                'pago' => $_POST['pago'],
                'estado' => $_POST['estado']
            ]);
            
            $resultado = $cita->guardar();

            if($resultado['resultado']) {
                $idCita = $resultado['id'];
                
                // Almacenar los servicios
                $servicios = explode(',', $_POST['servicios']);
                
                foreach($servicios as $servicioId) {
                    $citaServicio = new CitaServicio([
                        'citaId' => $idCita,
                        'servicioId' => $servicioId
                    ]);
                    $citaServicio->guardar();
                }
                
                // Enviar respuesta exitosa
                echo json_encode(['resultado' => true]);
            } else {
                throw new \Exception('Error al guardar la cita');
            }
            
        } catch(\Exception $e) {
            echo json_encode([
                'resultado' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public static function eliminar() {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $cita = Cita::find($id);
            $cita->eliminar();
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}