<?php 

namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index(Router $router) {
        $propiedades = Propiedad::get(3);
        $router->render('paginas/index',[
            "propiedades" => $propiedades,
            "inicio" => true
        ]);
    }

    public static function nosotros(Router $router) {
        $router->render('paginas/nosotros', []);
    }

    public static function propiedades(Router $router) {
        $propiedades = Propiedad::getAll();

        $router->render('paginas/propiedades', [
            "propiedades" => $propiedades
        ]);
    }

    public static function propiedad(Router $router) {
        $id = validarORedireccionar("/propiedades");
        $propiedad = Propiedad::findRecord($id);

        $router->render('paginas/propiedad', [
            "propiedad" => $propiedad
        ]);
    }

    public static function blog(Router $router) {
        $router->render('paginas/blog', []);
    }

    public static function entrada(Router $router) {
        $router->render('paginas/entrada', []);
    }

    public static function contacto(Router $router) {

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            // Crear una instancia de PHPMailer

            $mail = new PHPMailer();

            // Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '9c6fd3a5e10451';
            $mail->Password = 'e947aad2035306';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            // Configurar contenido del mail
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';
            
            // Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            
            // Definir contenido
            $contenido = '<html><p>Tienes un nuevo mensaje</p></html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';

            // Enviar email
            if($mail->send()) {
                echo 'Mensaje enviado';
            } else {
                echo 'El mensaje no pudo enviarse';
            }
        }
        
        $router->render('paginas/contacto', []);
    }
}