<?php
/**
 * Login Model
 * All functionality pertaining to Login Model.
 * PHP version 8.2.0
 *
 * @category Login
 * @package  Login
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  GIT: 1.0.0
 * @link     manuelparra.dev
 */

namespace App\Model;

if (!defined('__ROOT__')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

/**
 * Class Login Model
 *
 * @category   Model
 * @package    LoginModel
 * @subpackage LoginModel
 * @author     Manuel Parra <manuelparra@live.com.ar>
 * @license    MIT <https://mit.org>
 * @link       https://manuelparra.dev
 */
class LoginModel extends MainModel
{
    /**
     * Function for user login
     *
     * @param $data contains array
     *
     * @return object
     */
    protected static function loginModel($data): object
    {
        $sql = "SELECT  usuario.*, perfil.perfil_nombre
                FROM usuario LEFT JOIN perfil
                ON usuario.usuario_perfil_id = perfil.perfil_id
                WHERE usuario.usuario_usuario = :usuario
                AND usuario.usuario_clave = :clave";

        $query = MainModel::connection()->prepare($sql);
        $query->bindParam(":usuario", $data['usuario']);
        $query->bindParam(":clave", $data['clave']);
        $query->execute();

        return $query;
    }
}
