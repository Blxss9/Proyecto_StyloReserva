<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas()
    {
        session_start();
        
        $currentUrl = $_SERVER['REQUEST_URI'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        // Separar la URL base de los parámetros GET
        $splitURL = explode('?', $currentUrl);
        $currentUrl = $splitURL[0];

        // Agregar log para depuración
        error_log('URL base: ' . $currentUrl);
        error_log('Método HTTP: ' . $method);

        // Verificar si es una ruta de API
        $esRutaApi = strpos($currentUrl, '/api/') === 0;
        
        if ($esRutaApi) {
            header('Content-Type: application/json');
        }

        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null;
            error_log('Ruta encontrada en GET: ' . ($fn ? 'sí' : 'no'));
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }

        if ($fn) {
            try {
                call_user_func($fn, $this);
            } catch (\Exception $e) {
                error_log('Error en la ruta: ' . $e->getMessage());
                if ($esRutaApi) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]);
                } else {
                    $this->render('error', [
                        'titulo' => 'Error',
                        'mensaje' => $e->getMessage()
                    ]);
                }
            }
        } else {
            error_log('Ruta no encontrada: ' . $currentUrl);
            if ($esRutaApi) {
                http_response_code(404);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Ruta no encontrada'
                ]);
            } else {
                $this->render('error404', [
                    'titulo' => 'Página No Encontrada',
                    'esError404' => true
                ]);
            }
        }
    }

    public function render($view, $datos = [])
    {

        // Leer lo que le pasamos  a la vista
        foreach ($datos as $key => $value) {
            $$key = $value;  // Doble signo de dolar significa: variable variable, básicamente nuestra variable sigue siendo la original, pero al asignarla a otra no la reescribe, mantiene su valor, de esta forma el nombre de la variable se asigna dinamicamente
        }

        ob_start(); // Almacenamiento en memoria durante un momento...

        // entonces incluimos la vista en el layout
        include_once __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); // Limpia el Buffer
        include_once __DIR__ . '/views/layout.php';
    }
}
