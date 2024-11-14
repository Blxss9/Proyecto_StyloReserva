<?php
namespace Controllers;

use Model\Usuario;
use MVC\Router;


class LoginController {
    public static function index(Router $router) {
        $titulo = "Iniciar Sesión";
        $router->render('/auth/login', ['titulo' => $titulo]);
    }

    public static function login(Router $router) {
        $router->render('auth/login');
    }

    public static function logout() {
        echo "Desde el Logout";
    }

    public static function olvide(Router $router) {
        
        $router->render('auth/olvide-password');
    }
    public static function recuperar() {
        echo "Desde Recuperar";
    }

    // FUNCIÓN DE CREAR CUENTAS
    public static function crear(Router $router) {
        $titulo = "StyloReserva | Crear Cuenta";
        $usuario = new Usuario;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            debuguear($alertas);
            
        }
        $router->render('/auth/crear-cuenta', [
            'titulo' => $titulo,
            'usuario' => $usuario
        ]);
    

        
        
    }
}

