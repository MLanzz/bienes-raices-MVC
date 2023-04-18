<?php 

    require_once __DIR__ . "/../includes/app.php";

    use MVC\Router;
    use Controllers\PropiedadController;


    $router = new Router();

    $router->get("/nosotros", "funcion_nosotros");
    $router->get("/propiedades/crear", "funcion_tienda");
    $router->get("/propiedades/actualizar", "funcion_admin");

    $router->comprobarRutas();