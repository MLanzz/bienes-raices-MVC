<?php 

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];


    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }

    // Seteamos las urls con sus respectivas funciones
    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn ;
    }

    public function comprobarRutas() {
        $urlActual = $_SERVER["PATH_INFO"] ?? "/";

        $metodo = $_SERVER["REQUEST_METHOD"];

        if ($metodo === "GET") {
            $fn = $this->rutasGET[$urlActual] ?? null;
        } elseif ($metodo === "POST") {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        if ($fn) {
            // La url existe y tiene una función asociada

            // Al mandar $this como argumento, lo que hacemos es "mantener viva" la instancia de esta clase
            call_user_func($fn, $this);
        } else {
            echo "Pagina No Encontrada";
        }
    }

    // Muestra la vista
    public function render($view, $datos = []) {

        // Creamos variables con los nombre de las keys del arreglo asociativo $datos
        // Así podemos utilizarlas en las vistas
        foreach ($datos as $key => $value) {
            $$key = $value;
        }

        //Comenzamos a almacenar en memoria
        ob_start();

        include __DIR__ . "/views/" . $view . ".php";
        
        // Almacenamos lo que haya en memoria en la variable y liberamos la memoria
        $contenido = ob_get_clean();

        include __DIR__ . "/views/layout.php";
    }
}