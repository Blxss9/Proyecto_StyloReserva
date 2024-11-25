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
        
        // Almacena la Cita y devuelve el ID
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        $id = $resultado['id'];

        // Almacena la Cita y el Servicio

        // Almacena los Servicios con el ID de la Cita
        $idServicios = explode(",", $_POST['servicios']);
        foreach($idServicios as $idServicio) {
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        echo json_encode(['resultado' => $resultado]);
    }

    public static function eliminar() {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $cita = Cita::find($id);
            $cita->eliminar();
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }

    public static function createOrder() {
        header('Content-Type: application/json');
        
        try {
            $datos = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($datos['servicios']) || empty($datos['servicios'])) {
                throw new Exception('No hay servicios seleccionados');
            }

            // Guardar en sesión para usar después
            $_SESSION['paypal_order'] = [
                'servicios' => $datos['servicios'],
                'fecha' => $datos['fecha'] ?? date('Y-m-d'),
                'hora' => $datos['hora'] ?? '00:00',
                'usuarioId' => $datos['usuarioId'] ?? $_SESSION['id']
            ];

            // Calcular el total
            $total = array_reduce($datos['servicios'], function($carry, $servicio) {
                return $carry + floatval($servicio['precio']);
            }, 0);

            $accessToken = getPayPalAccessToken();
            
            $order = [
                'intent' => 'CAPTURE',
                'purchase_units' => [[
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => number_format($total, 2, '.', '')
                    ]
                ]]
            ];

            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => PAYPAL_API_URL . '/v2/checkout/orders',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $accessToken,
                    'PayPal-Request-Id: ' . uniqid()
                ],
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($order),
                CURLOPT_SSL_VERIFYPEER => false // Solo para desarrollo
            ]);
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            
            if (curl_errno($ch)) {
                throw new Exception(curl_error($ch));
            }
            
            curl_close($ch);

            if ($httpCode === 201) {
                $orderData = json_decode($response, true);
                echo json_encode(['id' => $orderData['id']]);
            } else {
                throw new Exception('Error al crear la orden en PayPal');
            }
        } catch (Exception $e) {
            error_log('Error en createOrder: ' . $e->getMessage());
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public static function captureOrder() {
        header('Content-Type: application/json');
        
        try {
            // Log para debugging
            error_log("Iniciando captureOrder");
            
            if (!isset($_SESSION['id'])) {
                throw new \Exception('Usuario no autenticado');
            }

            // Obtener y validar OrderID
            $uri = $_SERVER['REQUEST_URI'];
            error_log("URI recibida: " . $uri);
            
            // Extraer ID de la orden
            preg_match('/\/api\/orders\/capture\/([A-Z0-9]+)$/', $uri, $matches);
            $orderId = $matches[1] ?? null;
            error_log("OrderID extraído: " . ($orderId ?? 'null'));

            if (!$orderId) {
                throw new \Exception('ID de orden no proporcionado');
            }

            // Obtener token de PayPal
            $accessToken = getPayPalAccessToken();
            if (empty($accessToken)) {
                throw new \Exception('No se pudo obtener el token de PayPal');
            }

            // Capturar el pago
            $ch = curl_init();
            $captureUrl = PAYPAL_API_URL . "/v2/checkout/orders/$orderId/capture";
            error_log("URL de captura: " . $captureUrl);
            
            curl_setopt_array($ch, [
                CURLOPT_URL => $captureUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $accessToken,
                    'Prefer: return=representation'
                ],
                CURLOPT_POST => true,
                CURLOPT_SSL_VERIFYPEER => false // Solo para desarrollo
            ]);
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            error_log("Respuesta PayPal - HTTP Code: " . $httpCode);
            error_log("Respuesta PayPal: " . $response);
            
            if (curl_errno($ch)) {
                throw new \Exception('Error cURL: ' . curl_error($ch));
            }
            
            curl_close($ch);

            if ($httpCode === 201 || $httpCode === 200) {
                $paypalData = json_decode($response, true);
                
                // Crear la cita
                $cita = new Cita([
                    'fecha' => $_SESSION['paypal_order']['fecha'] ?? date('Y-m-d'),
                    'hora' => $_SESSION['paypal_order']['hora'] ?? '00:00',
                    'usuarioId' => $_SESSION['id'],
                    'pago' => 'COMPLETED',
                    'estado' => 'confirmada'
                ]);
                
                $resultado = $cita->guardar();
                
                if ($resultado['resultado']) {
                    $servicios = [];
                    $total = 0;
                    
                    // Guardar servicios
                    if (isset($_SESSION['paypal_order']['servicios'])) {
                        foreach ($_SESSION['paypal_order']['servicios'] as $servicio) {
                            $citaServicio = new CitaServicio([
                                'citaId' => $resultado['id'],
                                'servicioId' => $servicio['id']
                            ]);
                            $citaServicio->guardar();
                            
                            // Agregar al array de servicios para el comprobante
                            $servicios[] = [
                                'nombre' => $servicio['nombre_servicio'],
                                'precio' => number_format($servicio['precio'], 0, ',', '.')
                            ];
                            $total += floatval($servicio['precio']);
                        }
                    }
                    
                    // Preparar datos del comprobante
                    $comprobante = [
                        'ordenId' => $paypalData['id'],
                        'fecha' => date('d/m/Y', strtotime($cita->fecha)),
                        'hora' => $cita->hora,
                        'total' => '$' . number_format($total, 0, ',', '.'),
                        'servicios' => $servicios
                    ];
                    
                    // Guardar el comprobante en la sesión
                    $_SESSION['comprobante'] = $comprobante;
                    
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Pago procesado correctamente',
                        'comprobanteUrl' => '/comprobante'
                    ]);
                    return;
                }
                
                throw new \Exception('Error al guardar la cita');
            } else {
                throw new \Exception('Error en la respuesta de PayPal: ' . $response);
            }
        } catch (\Exception $e) {
            error_log('Error en captureOrder: ' . $e->getMessage());
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}