<?php
/**
 * Client Model
 * All functionality pertaining to Client Model.
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

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

/**
 * Class Cilent Model
 *
 * @category   Model
 * @package    ClientModel
 * @subpackage ClientModel
 * @author     Manuel Parra <manuelparra@live.com.ar>
 * @license    MIT <https://mit.org>
 * @link       https://manuelparra.dev
 */
class ClientModel extends MainModel
{
    /**
     * Function for add client
     *
     * @param $data contains array
     *
     * @return object
     */
    protected static function addClientModel($data): object
    {
        // SQL Query for insert client
        $sql = "INSERT INTO cliente (cliente_dni, cliente_nombre, cliente_apellido,
                cliente_telefono, cliente_email, cliente_direccion)
                VALUES (:dni, :nombre, :apellido, :telefono, :email, :direccion)";
        $query = MainModel::connection()->prepare($sql);

        $query->bindParam(":dni", $data['dni']);
        $query->bindParam(":nombre", $data['nombre']);
        $query->bindParam(":apellido", $data['apellido']);
        $query->bindParam(":telefono", $data['telefono']);
        $query->bindParam(":email", $data['email']);
        $query->bindParam(":direccion", $data['direccion']);

        $query->execute();

        return $query;
    }

    /**
     * Function for delete client
     *
     * @param $id contains int
     *
     * @return object
     */
    protected static function deleteClientModel($id): object
    {
        $sql = "DELETE FROM cliente
                WHERE cliente.cliente_id = :id";
        $query = MainModel::connection()->prepare($sql);

        $query->bindParam(":id", $id);
        $query->execute();

        return $query;
    }

    /**
     * Function for query client data
     *
     * @param $type contains int
     * @param $id   contains int
     *
     * @return object
     */
    protected static function queryDataClientModel($type, $id = null): object
    {
        if ($type == "Unique") {
            $sql = "SELECT cliente.*
                    FROM cliente
                    WHERE cliente.cliente_id = :id";
            $query = MainModel::connection()->prepare($sql);
            $query->bindParam(":id", $id);
        } elseif ($type == "Count") {
            $sql = "SELECT cliente.cliente_id
                    FROM cliente";
            $query = MainModel::connection()->prepare($sql);
        }

        $query->execute();
        return $query;
    }

    /**
     * Function for update client
     *
     * @param $data contains array
     *
     * @return object
     */
    protected static function updateClientDataModel($data): object
    {
        $sql = "UPDATE cliente SET
                cliente.cliente_dni = :dni,
                cliente.cliente_nombre = :nombre,
                cliente.cliente_apellido = :apellido,
                cliente.cliente_telefono = :telefono,
                cliente.cliente_email = :email,
                cliente.cliente_direccion = :direccion
                WHERE cliente.cliente_id = :id";
        $query = MainModel::connection()->prepare($sql);

        $query->bindParam(":dni", $data['dni']);
        $query->bindParam(":nombre", $data['nombre']);
        $query->bindParam(":apellido", $data['apellido']);
        $query->bindParam(":telefono", $data['telefono']);
        $query->bindParam(":email", $data['email']);
        $query->bindParam(":direccion", $data['direccion']);
        $query->bindParam(":id", $data['id']);

        $query->execute();

        return $query;
    }
}
