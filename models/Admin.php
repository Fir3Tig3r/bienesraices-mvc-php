<?php
/* models/Admin.php */

namespace Model;

class Admin extends ActiveRecord
{
    /* Base de datos */
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];

    /* Variables */
    public $id;
    public $email;
    public $password;

    /* Constructor */
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    /* Validacion */
    public function validar()
    {
        if (!$this->email) {
            self::$errores[] = "El email es obligatorio";
        }

        if (!$this->password) {
            self::$errores[] = "El password es obligatorio";
        }

        return self::$errores;
    }

    /* Revisar si el usuario existe */
    public function existeUsuario()
    {
        /* revisar si un usuario existe o no */
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);

        if (!$resultado->num_rows) {
            self::$errores[] = "El usuario no existe";
            return;
        }

        return $resultado;
    }

    /* Verificar si el password es correcto */
    public function comprobarPassword($resultado)
    {
        $usuario = $resultado->fetch_object();

        /* verificar si el password es correcto */
        $autenticado = password_verify($this->password, $usuario->password);

        if (!$autenticado) {
            self::$errores[] = "El password es incorrecto";
        }

        return $autenticado;
    }

    /* Autenticar al usuario */
    public function autenticar()
    {
        /* iniciar la sesion */
        session_start();

        /* llenar el arreglo de la sesion */
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        /* redireccionar al administrador */
        header('Location: /public/admin');
    }
}
