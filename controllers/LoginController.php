<?php
namespace Controllers;
use MVC\Router;


class LoginController {
    public static function index(Router $router) {
        $titulo = "Iniciar Sesión";
        $router->render('/auth/login', ['titulo' => $titulo]);
    }
}