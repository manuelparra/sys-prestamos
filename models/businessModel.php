<?php
/**
 * Business Model
 * All functionality pertaining to Item Model.
 * PHP version 8.2.0
 *
 * @category Model
 * @package  BusinessModel
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
 * Class Business Model
 *
 * @category   Model
 * @package    BusinessModel
 * @subpackage BusinessModel
 * @author     Manuel Parra <manuelparra@live.com.ar>
 * @license    MIT <https://mit.org>
 * @link       https://manuelparra.dev
 */
class BusinessModel extends MainModel
{
    /**
     * Function for add business information
     *
     * @param $data contains array
     *
     * @return object
     */
    protected static function addBusinessInformationModel($data): object
    {
        // SQL Query for insert business information
        $sql = "INSERT INTO empresa (
                empresa_nombre, empresa_email,
                empresa_telefono, empresa_direccion)
                VALUES (:nombre, :email, :telefono, :direccion)";
        $query = MainModel::connection()->prepare($sql);

        $query->bindParam(":nombre", $data['nombre']);
        $query->bindParam(":email", $data['email']);
        $query->bindParam(":telefono", $data['telefono']);
        $query->bindParam(":direccion", $data['direccion']);

        $query->execute();

        return $query;
    }

    /**
     * Function for update business information
     *
     * @param $data contains array
     *
     * @return object
     */
    protected static function updateBusinessDataModel($data): object
    {
        $sql = "UPDATE empresa SET
                empresa_nombre = :nombre,
                empresa_email = :email,
                empresa_telefono = :telefono,
                empresa_direccion = :direccion
                WHERE empresa_id = :id";
        $query = MainModel::connection()->prepare($sql);

        $query->bindParam(":nombre", $data['nombre']);
        $query->bindParam(":email", $data['email']);
        $query->bindParam(":telefono", $data['telefono']);
        $query->bindParam(":direccion", $data['direccion']);
        $query->bindParam(":id", $data['id']);

        $query->execute();

        return $query;
    }

    /**
     * Function for query business information
     *
     * @return object
     */
    protected static function queryBusinessInformationModel(): object
    {
        // SQL Query for query business information
        $sql = "SELECT empresa.*
                FROM empresa";
        $query = MainModel::connection()->prepare($sql);

        $query->execute();

        return $query;
    }
}
