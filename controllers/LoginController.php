<?php
/* controllers/LoginController.php */

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginController
{
    public static function login(Router $router)
    {
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Admin($_POST);
            $errores = $auth->validar();

            if (empty($errores)) {
                // Revisar si el usuario existe
                $resultado = $auth->existeUsuario();

                if (!$resultado) {
                    /*  (mensaje de error) */
                    $errores = Admin::getErrores();
                } else {
                    // Revisar si el password es correcto
                    $autenticado = $auth->comprobarPassword($resultado);

                    if ($autenticado) {
                        // Autenticar al usuario
                        $auth->autenticar();
                    } else {
                        /* password incorrecto (mensaje de error) */
                        $errores = Admin::getErrores();
                    }
                }
            }
        }

        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }

    public static function logout()
    {
        session_start();

        $_SESSION = [];

        header('Location: /public');
    }
}
