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

            // Al mandar $this como argumento, lo que hacemos es "mantener viva" la instancia de esta clase
            call_user_func($fn, $this);
        } else {
            echo "Pagina No Encontrada";
        }
    }

    // Muestra la vista
    public function render($view) {

        //Comenzamos a almacenar en memoria
        ob_start();

        include __DIR__ . "/views/" . $view . ".php";
        
        // Almacenamos lo que haya en memoria en la variable y liberamos la memoria
        $contenido = ob_get_clean();

        include __DIR__ . "/views/layout.php";
    }
}