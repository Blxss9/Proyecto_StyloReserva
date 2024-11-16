<?php
namespace Controllers;

use classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function index(Router $router) {
        $titulo = "Iniciar Sesión";
        $alertas = [];
        $router->render('/auth/login', [
            'titulo' => $titulo,
            'alertas' => $alertas
        ]);
    }

    public static function login(Router $router) {
        $alertas = [];
        $auth = new Usuario;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if (empty($alertas)) {
                $usuario = Usuario::where('email', $auth->email);

                if ($usuario) {
                    if ($usuario->comprobarPasswordAndVerificado($auth->password)) {
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }

                        $_SESSION['id_usuario'] = $usuario->id_usuario;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['admin'] = $usuario->admin;
                        $_SESSION['login'] = true;

                        $redirect = $usuario->admin === "1" ? '/admin' : '/cita';
                        header("Location: $redirect");
                        exit;
                    }
                }
                Usuario::setAlerta('error', 'Usuario o contraseña incorrectos');
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/login', [
            'alertas' => $alertas
        ]);
    }

    public static function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = [];
        session_destroy();
        header('Location: /');
        exit;
    }

    public static function olvide(Router $router) {
        $router->render('auth/olvide-password');
    }

    public static function recuperar() {
        echo "Desde Recuperar";
    }

    public static function crear(Router $router) {
        $titulo = "StyloReserva | Crear Cuenta";
        $usuario = new Usuario;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            if (empty($alertas)) {
                $existe = $usuario->existeUsuario();

                if ($existe->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    $usuario->hashPassword();
                    $usuario->crearToken();

                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    $email->enviarConfirmacion();

                    if ($usuario->guardar()) {
                        header('Location: /mensaje');
                        exit;
                    }
                }
            }
        }

        $router->render('/auth/crear-cuenta', [
            'titulo' => $titulo,
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router) {
        $router->render('/auth/mensaje');
    }

    public static function confirmar(Router $router) {
        $alertas = [];
        $token = s($_GET['token'] ?? '');

        $usuario = Usuario::where('token', $token);

        if (!$usuario) {
            Usuario::setAlerta('error', 'Token no válido');
        } else {
            $usuario->confirmarCuenta();
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta confirmada correctamente');
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }
}
