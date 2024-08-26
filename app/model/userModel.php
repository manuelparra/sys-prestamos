<?php
/**
 * User Model
 * All functionality pertaining to User Model.
 * PHP version 8.2.0
 *
 * @category User
 * @package  User
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  GIT: 1.0.0
 * @link     manuelparra.dev
 */

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

require_once "./models/mainModel.php";

/**
 * Class User Model
 *
 * @category   User
 * @package    UserModel
 * @subpackage UserModel
 * @author     Manuel Parra <manuelparra@live.com.ar>
 * @license    MIT <https://mit.org>
 * @link       https://manuelparra.dev
 */
class UserModel extends MainModel
{
    /**
     * Function for add user
     *
     * @param $data contains array
     *
     * @return object
     */
    protected static function addUserModel($data): object
    {
        // SQL Query for insert user
        $sql = "INSERT INTO usuario (usuario_dni, usuario_nombre,
                usuario_apellido, usuario_telefono, usuario_direccion,
                usuario_perfil_id, usuario_email, usuario_usuario,
                usuario_clave, usuario_estado, usuario_privilegio)
                VALUES (:dni, :nombre, :apellido, :telefono, :direccion, :perfil,
                :email, :usuario, :clave, :estado, :privilegio)";
        $query = MainModel::connection()->prepare($sql);

        $query->bindParam(":dni", $data['dni']);
        $query->bindParam(":nombre", $data['nombre']);
        $query->bindParam(":apellido", $data['apellido']);
        $query->bindParam(":telefono", $data['telefono']);
        $query->bindParam(":direccion", $data['direccion']);
        $query->bindParam(":perfil", $data['perfil']);
        $query->bindParam(":email", $data['email']);
        $query->bindParam(":usuario", $data['usuario']);
        $query->bindParam(":clave", $data['clave']);
        $query->bindParam(":estado", $data['estado']);
        $query->bindParam(":privilegio", $data['privilegio']);

        $query->execute();

        return $query;
    }

    /**
     * Function for delete user
     *
     * @param $id contains string
     *
     * @return object
     */
    protected static function deleteUserModel($id): object
    {
        $sql = "DELETE FROM usuario
                WHERE usuario.usuario_id = :id";
        $query = MainModel::connection()->prepare($sql);

        $query->bindParam(":id", $id);
        $query->execute();

        return $query;
    }

    /**
     * Function for query user
     *
     * @param $type contains string
     * @param $id   contains string
     *
     * @return object
     */
    protected static function queryDataUserModel($type, $id = null): object
    {
        if ($type == "Unique") {
            $sql = "SELECT usuario.*, perfil.perfil_nombre
                    FROM prestamos.usuario
                    LEFT JOIN prestamos.perfil
                    ON usuario.usuario_perfil_id = perfil.perfil_id
                    WHERE usuario_id = :id";
            $query = MainModel::connection()->prepare($sql);
            $query->bindParam(":id", $id);
        } elseif ($type == "Count") {
            $sql = "SELECT usuario_id
                    FROM usuario
            WHERE usuario_id != 1"; // id = 1 is because 1 is the
                                    // main user id, is the first
                                    // user registered in the system
            $query = MainModel::connection()->prepare($sql);
        }

        $query->execute();
        return $query;
    }

    /**
     * Function for query profile list
     *
     * @return object
     */
    protected static function perfilListUserMode(): object
    {
        $sql = "SELECT perfil_id, perfil_nombre
                FROM perfil
                ORDER BY perfil_nombre DESC";
        $query = MainModel::connection()->prepare($sql);
        $query->execute();
        return $query;
    }

    /**
     * Function for update user data
     *
     * @param $data contains array
     *
     * @return object
     */
    protected static function updateUserDataModel($data): object
    {
        $sql = "UPDATE usuario SET
                usuario.usuario_dni = :dni,
                usuario.usuario_nombre = :nombre,
                usuario.usuario_apellido = :apellido,
                usuario.usuario_telefono = :telefono,
                usuario.usuario_direccion = :direccion,
                usuario.usuario_email = :email,
                usuario.usuario_usuario = :usuario,
                usuario.usuario_clave = :clave,
                usuario.usuario_estado = :estado,
                usuario.usuario_privilegio = :privilegio,
                usuario.usuario_perfil_id = :perfil_id
                WHERE usuario.usuario_id = :id";
        $query = MainModel::connection()->prepare($sql);

        $query->bindParam(":dni", $data['dni']);
        $query->bindParam(":nombre", $data['nombre']);
        $query->bindParam(":apellido", $data['apellido']);
        $query->bindParam(":telefono", $data['telefono']);
        $query->bindParam(":direccion", $data['direccion']);
        $query->bindParam(":email", $data['email']);
        $query->bindParam(":usuario", $data['usuario']);
        $query->bindParam(":clave", $data['clave']);
        $query->bindParam(":estado", $data['estado']);
        $query->bindParam(":privilegio", $data['privilegio']);
        $query->bindParam(":perfil_id", $data['perfil_id']);
        $query->bindParam(":id", $data['id']);

        $query->execute();

        return $query;
    }
}
