<?php 

// Incluye el archivo de configuración de la aplicación
require_once __DIR__ . '/../includes/app.php';

// Se importan los controladores

use Controllers\CitaController;
use Controllers\LandingController;

// Usa el enrutador de la aplicación
use Controllers\LoginController;
use MVC\Router;

// Importar el APIController
use Controllers\APIController;

// Crea una nueva instancia del enrutador
$router = new Router();

// Ruta Landing Page
$router->get('/', [LandingController::class, 'index']);


// Ruta Login
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Recuperar Contraseña
$router->get('/olvide', [LoginController::class, 'olvide']); // Formulario donde el usuario debe colocar su correo
$router->post('/olvide', [LoginController::class, 'olvide']); // Se identifica el correo y se mandan las indicaciones
$router->get('/recuperar', [LoginController::class, 'recuperar']); // Cuando hace click en el enlace
$router->post('/recuperar', [LoginController::class, 'recuperar']); // Permitirle al usuario agregar una nueva contraseña

// Crear Cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);

// Confirmar Cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

//Area Privada Citas
$router->get('/cita', [CitaController::class, 'index']);
$router->get('/comprobante', [CitaController::class, 'comprobante']);

// API de Citas
$router->get('/api/servicios', [APIController::class, 'index']);
$router->post('/api/citas', [APIController::class, 'guardar']);
$router->post('/api/eliminar', [APIController::class, 'eliminar']);

// API de PayPal
$router->post('/api/orders', [APIController::class, 'createOrder']);
$router->post('/api/orders/capture/:id', [APIController::class, 'captureOrder']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();