<?php
namespace Controllers;

use classes\Email;
use Model\Usuario;
use MVC\Router;


class LoginController {
    public static function index(Router $router) {
        $titulo = "Iniciar Sesión";
        $router->render('/auth/login', ['titulo' => $titulo]);
    }

    public static function login(Router $router) {
        $alertas = [];

        $auth = new Usuario;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);

            $alertas = $auth->validarLogin();
            
            if(empty($alertas)){
                //verificar si el usuario existe
                $usuario = Usuario::where('email', $auth->email);

                if($usuario){
                    //verificar si el password es correcto
                    if($usuario->comprobarPasswordAndVerificado(password: $auth->password)){
                        // Autenticar el usuario
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;


                        // Redireccionamiento
                        if($usuario->admin === "1") {
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        } else {
                            header('Location: /cita');
                        }
                        exit;
                    }
                    }else{
                        Usuario::setAlerta('error', 'El usuario no existe');
                    }
            }

        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/login', [
        'alertas' => $alertas,
    ]);
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

        // Alertas vacías
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            // Revisar que alertas está vacío
            if(empty($alertas)) {
                    //verificar que el usuario no este registrado
                    $resultado = $usuario->existeUsuario();

                    if($resultado->num_rows) {
                        $alertas = Usuario::getAlertas();
            } else {
                // hashear el password
                $usuario->hashPassword();

                // generar un token unico
                $usuario->crearToken();

                // Envio de email
                $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                
                $email->enviarConfirmacion();

                //crear el usuario
                $resultado = $usuario->guardar();
                if($resultado) {
                    header('Location: /mensaje');
                }

                debuguear($usuario);
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
    public static function confirmar(Router $router){
        $alertas = [];
        $token= s($_GET['token']);  
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
            //mostrar mensaje de error
            Usuario::setAlerta('error', 'Token No Valido');
        }else{
            //modificar a usuario confirmado
            $usuario->confirmado = 1;
            $usuario->token = null;
            
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta comprobada Correctamente');
        }
        //Obtener alertas
        $alertas = Usuario::getAlertas();

        //Renderizar la vista
        $router->render('auth/confirmar-cuenta', [
            'alertas'=>$alertas
        ]);
    }
}



