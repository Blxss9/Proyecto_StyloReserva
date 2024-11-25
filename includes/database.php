<?php

$db = mysqli_connect('localhost', 'root', '', 'app_styloreserva');


if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "error de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}



// Conexión a la base de datos
$db = mysqli_connect('localhost', 'root', '', 'app_styloreserva');

if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "Error de depuración: " . mysqli_connect_errno();
    echo "Error de depuración: " . mysqli_connect_error();
    exit;
}



