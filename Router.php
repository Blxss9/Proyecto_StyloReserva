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
        
        // Obtener la URL actual
        $currentUrl = $_SERVER['REQUEST_URI'] ?? '/';
        
        // Limpiar la URL de parámetros GET y slashes múltiples
        $urlLimpia = strtok($currentUrl, '?');
        $urlLimpia = preg_replace('#/+#', '/', $urlLimpia); // Reemplaza múltiples slashes con uno solo
        $urlLimpia = rtrim($urlLimpia, '/'); // Elimina el slash final si existe
        
        // Si la URL está vacía después de limpiar, establecerla como '/'
        if (empty($urlLimpia)) {
            $urlLimpia = '/';
        }

        // Debug para ver qué URL está llegando
        error_log('URL Original: ' . $currentUrl);
        error_log('URL Limpia: ' . $urlLimpia);
        
        $method = $_SERVER['REQUEST_METHOD'];

        // Verificar si es una ruta de API
        $esRutaApi = strpos($urlLimpia, '/api/') === 0;
        
        if ($esRutaApi) {
            header('Content-Type: application/json');
        }

        // Extraer parámetros de URL para rutas dinámicas
        if (strpos($urlLimpia, '/api/orders/capture/') === 0) {
            $urlLimpia = '/api/orders/capture/:id';
        }

        if ($method === 'GET') {
            $fn = $this->getRoutes[$urlLimpia] ?? null;
            // Debug para ver las rutas disponibles
            error_log('Rutas GET disponibles: ' . print_r(array_keys($this->getRoutes), true));
        } else {
            $fn = $this->postRoutes[$urlLimpia] ?? null;
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
            error_log('Ruta no encontrada: ' . $urlLimpia);
            if ($esRutaApi) {
                http_response_code(404);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Ruta no encontrada'
                ]);
            } else {
                http_response_code(404);
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
