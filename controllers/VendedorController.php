<?php

namespace Controllers;

use Model\Vendedor;
use MVC\Router;

class VendedorController {
    public static function crear(Router $router) {

        $vendedor = new Vendedor();
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vendedor->sincronizar($_POST);
        
            $errores = $vendedor->validar();
        
            if(empty($errores)) {
                $resultado = $vendedor->guardar();
        
                if ($resultado) {
                    header("Location: /admin?resultado=4");
                }
            }
        
        }
        
        $router->render("vendedores/crear", [
            "vendedor" => $vendedor,
            "errores" => $errores
        ]); 
    }


    public static function actualizar(Router $router) {

        $id = validarORedireccionar("/admin");

        $vendedor = Vendedor::findRecord($id);
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vendedor->sincronizar($_POST);
        
            $errores = $vendedor->validar();
        
            if (empty($errores)) {
                $resultado = $vendedor->guardar();
        
                if ($resultado) {
                    header("Location: /admin?resultado=5");
                }
            }
        }
        
        
        $router->render("vendedores/actualizar", [
            "vendedor" => $vendedor,
            "errores" => $errores
        ]); 
    }

    public static function eliminar() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            $tipo = $_POST["tipo"];

            if (validarTipo($tipo)) {
                $propiedad = Vendedor::findRecord($id);
                $resultado = $propiedad->eliminar();
                
        
                if ($resultado) {
                    header("Location: /admin?resultado=6");
                }

            }
        } 
    }
}