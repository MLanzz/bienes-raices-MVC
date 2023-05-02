<?php 

namespace Model;

class Admin extends ActiveRecord {
    // Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar() {
        if (!$this->email) {
            self::$errores[] = "El email es obligatorio o no es valido";
        }

        if (!$this->password) {
            self::$errores[] = "El password es obligatorio";
        }

        return self::$errores;
    }

    public function existeUsuario() {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . self::$db->escape_string($this->email) . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if (!$resultado->num_rows) {
            self::$errores[] = "No existe el usuario ingresado";
            return;
        }

        return $resultado;

    }

    public function comprobarPassword($resultado) {
        $usuario = $resultado->fetch_object();

        $auth = password_verify($this->password, $usuario->password);

        if (!$auth) {
            self::$errores[] = "Contraseña incorrecta";
            return;
        }

        return $auth;
    }

    public function autenticar() {
        session_start();

        // Completamos el array de sesion
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }
}