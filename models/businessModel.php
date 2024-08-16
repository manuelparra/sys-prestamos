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
class businessModel extends mainModel {
    /*-- Function for add information of business --*/
    protected static function query_business_information_model() {
        // SQL Query for query business information
        $sql = "SELECT empresa.*
                FROM empresa";
        $query = mainModel::connection()->prepare($sql);

        $query->execute();

        return $query;
    }
}
