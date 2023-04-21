<?php 

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController {
    public static function index(Router $router) {

        $propiedades = Propiedad::getAll();
        $resultado = $_GET["resultado"] ?? null;

        $router->render("propiedades/admin", [
            "propiedades" => $propiedades,
            "resultado" => $resultado
        ]);
    }

    public static function crear(Router $router) {

        $propiedad = new Propiedad();
        $vendedores = Vendedor::getAll();
        $errores = Propiedad::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $propiedad->sincronizar($_POST);

        
            if ($_FILES['imagen']['tmp_name']) {
                // Generar nombre único para el archivo a subir
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                // Realiza un resize a la imagen con intevention
                $imagen = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);

            }

            $errores = $propiedad->validar();

            if (empty($errores)){

                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Guardamos la imagen en el servidor
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
        
                // Guardamos en la base de datos
                $resultado = $propiedad->guardar();

                if ($resultado) {
                    // Redireccionamos
                    header("Location: /admin?resultado=1");
                }

            }
        }


        $router->render("propiedades/crear", [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores
        ]); 
    }

    public static function actualizar(Router $router) {
        $id = validarORedireccionar("/admin");

        $propiedad = Propiedad::findRecord($id);
        $vendedores = Vendedor::getAll();
        $errores = Propiedad::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $propiedad->sincronizar($_POST);

    
            if ($_FILES['imagen']['tmp_name']) {
    
                // Generar nombre único para el archivo a subir
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    
                // Realiza un resize a la imagen con intevention
                $imagen = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }
    
            $errores = $propiedad->validar();
    
            if (empty($errores)){
    
                //-------------- Subida de archivos --------------
                if (isset($imagen)){
                    $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                }
                //-------------- /Subida de archivos -------------
    
                $resultado = $propiedad->guardar();
    
                if ($resultado) {
                    // Redireccionamos
                    header("Location: /admin?resultado=2");
                }
    
            }
        }

        $router->render("propiedades/actualizar", [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores
        ]); 
    }

    public static function eliminar() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            $tipo = $_POST["tipo"];

            if (validarTipo($tipo)) {
                $propiedad = Propiedad::findRecord($id);
                $resultado = $propiedad->eliminar();
                
        
                if ($resultado) {
                    header("Location: /admin?resultado=3");
                }

            }
        } 
    }
}