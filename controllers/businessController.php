<?php
/**
 * Bussiness Controller
 *
 * All functionality pertaining to Business Controller.
 *
 * @package Controller
 * @author Manuel Parra
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

include_once "./models/businessModel.php";

/*--- Class Business Controller ---*/
class businessController extends businessModel {
    /*-- Contoller's function for query business infrormation --*/
    public function query_business_information_controller() {
        return businessModel::query_business_information_model();
    }
}
