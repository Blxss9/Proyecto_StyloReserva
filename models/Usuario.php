<?php

namespace Model;

class Usuario extends ActiveRecord {
    // BD
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id_usuario', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'fecha_creacion', 'ultima_actualizacion', 'confirmado', 'token'];

    public $id_usuario;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $fecha_creacion;
    public $ultima_actualizacion;
    public $confirmado;
    public $token;

    public function __construct($args = []) {
        // Asignar valores a las propiedades de la clase con los argumentos
        $this->id_usuario = $args['id_usuario'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->fecha_creacion = $args['fecha_creacion'] ?? '';
        $this->ultima_actualizacion = $args['ultima_actualizacion'] ?? '';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
    }

    // Mensajes de validación para la creación de una cuenta
    public function validarNuevaCuenta() {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = 'El Apellido es Obligatorio';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'El Password es Obligatorio';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El Password debe contener al menos 6 caracteres';
        }

        return self::$alertas;
    }

    public function validarLogin() {
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'El Password es Obligatorio';
        }

        return self::$alertas;
    }

    public function validarEmail() {
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }

        return self::$alertas;
    }

    public function validarPassword() {
        if (!$this->password) {
            self::$alertas['error'][] = 'El Password es obligatorio';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El Password debe tener al menos 6 caracteres';
        }

        return self::$alertas;
    }

    // Revisa si el usuario ya existe
    public function existeUsuario() {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        
        $resultado = self::$db->query($query);
        
        if ($resultado->num_rows) {
            self::$alertas['error'][] = 'El usuario ya está registrado';
        }

        return $resultado;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    // Métodos adicionales, por ejemplo, para comprobar el password y verificación de usuario
    public function comprobarPasswordAndVerificado($password) {
        $resultado = password_verify($password, $this->password);

        if (!$resultado) {
            self::$alertas['error'][] = 'Password incorrecto o la cuenta no ha sido verificada';
        } else {
            return true;
        }
    }

    public function crearToken(){
        $this->token = uniqid();
    }
}

