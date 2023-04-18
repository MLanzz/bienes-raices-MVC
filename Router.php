<?php 

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    // Seteamos las urls con sus respectivas funciones
    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn ;
    }

    public function comprobarRutas() {
        $urlActual = $_SERVER["PATH_INFO"] ?? "/";

        $metodo = $_SERVER["REQUEST_METHOD"];

        if ($metodo === "GET") {
            $fn = $this->rutasGET[$urlActual] ?? null;
        }

        if ($fn) {
            // La url existe y tiene una función asociada
            call_user_func($fn, $this);
        } else {
            echo "Pagina No Encontrada";
        }
    }
}