<?php 

use Model\ActiveRecord;

require __DIR__ . '/../vendor/autoload.php';
 // Cargar variables de entorno
 $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
 $dotenv->load();


require 'funciones.php';
require 'database.php';
require 'paypal-config.php';


// Configurar zona horaria para Chile
date_default_timezone_set('America/Santiago');

// Conectarnos a la base de datos
ActiveRecord::setDB($db);

