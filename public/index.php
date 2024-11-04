<?php 

// Incluye el archivo de configuración de la aplicación
require_once __DIR__ . '/../includes/app.php';

// Se importan los controladores
use Controllers\LandingController;

// Usa el enrutador de la aplicación
use MVC\Router;

// Crea una nueva instancia del enrutador
$router = new Router();

$router->get('/', [LandingController::class, 'index']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();