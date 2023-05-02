<?php 

namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginController {
    public static function login(Router $router) {

        $errores = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Admin($_POST);

            $errores = $auth->validar();

            if(empty($errores)) {
                // Verificar si el usuario existe
                $resultado = $auth->existeUsuario();

                // Si no existe el usuario obtenemos el error
                if(!$resultado) {
                    $errores = Admin::getErrores();
                } else {
                    // Verificamos password
                    $autenticado = $auth->comprobarPassword($resultado);

                    if(!$autenticado) {
                        $errores = Admin::getErrores();
                    } else {
                        $auth->autenticar();
                    }
                }
            }
        }

        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }

    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /');

    }
}