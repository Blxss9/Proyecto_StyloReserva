<?php
namespace Controllers;
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
    public static function crear(Router $router) {
        $router->render('auth/crear-cuenta',[
            
        ]);
        
    }
}

