<?php

/**
 *
 * Business Model Class
 *
 * All functionality pertaining to the Business Model.
 *
 * @package Model
 * @author Manuel Parra
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

require_once "./models/mainModel.php";

/*--- Class Business ---*/
class businessModel extends mainModel
{
    /*-- Function for add business information --*/
    protected static function add_business_information_model($data)
    {
        // SQL Query for insert business information
        $sql = "INSERT INTO empresa (empresa_nombre, empresa_email, empresa_telefono, empresa_direccion)
                VALUES (:nombre, :email, :telefono, :direccion)";
        $query = mainModel::connection()->prepare($sql);

        $query->bindParam(":nombre", $data['nombre']);
        $query->bindParam(":email", $data['email']);
        $query->bindParam(":telefono", $data['telefono']);
        $query->bindParam(":direccion", $data['direccion']);

        $query->execute();

        return $query;
    }

    /*-- Function for update client data model --*/
    protected static function update_business_data_model($data)
    {
        $sql = "UPDATE empresa SET
                empresa.nombre = :nombre,
                empresa.email = :email,
                empresa.telefono = :telefono,
                empresa.direccion = :direccion
                WHERE empresa.empresa_id = :id";
        $query = mainModel::connection()->prepare($sql);

        $query->bindParam(":nombre", $data['nombre']);
        $query->bindParam(":email", $data['email']);
        $query->bindParam(":telefono", $data['telefono']);
        $query->bindParam(":direccion", $data['direccion']);
        $query->bindParam(":id", $data['id']);

        $query->execute();

        return $query;
    }

    /*-- Function for query information of business --*/
    protected static function query_business_information_model()
    {
        // SQL Query for query business information
        $sql = "SELECT empresa.*
                FROM empresa";
        $query = mainModel::connection()->prepare($sql);

        $query->execute();

        return $query;
    }
}
