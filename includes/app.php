<?php 

require 'funciones.php';
require 'database.php';
require 'paypal-config.php';
require __DIR__ . '/../vendor/autoload.php';

// Conectarnos a la base de datos
use Model\ActiveRecord;
ActiveRecord::setDB($db);