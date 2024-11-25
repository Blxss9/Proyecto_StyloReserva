<?php 

require 'funciones.php';
require 'database.php';
require 'paypal-config.php';
require __DIR__ . '/../vendor/autoload.php';

// Configurar zona horaria para Chile
date_default_timezone_set('America/Santiago');

// Conectarnos a la base de datos
use Model\ActiveRecord;
ActiveRecord::setDB($db);

define('URL_BASE', 'http://localhost:5000');  // Ajusta esto según tu puerto

