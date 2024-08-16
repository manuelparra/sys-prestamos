<?php
/**
 * API Model Class
 *
 * All functionality pertaining to the Endpoint Requests for Ajax Model.
 *
 * @package Model
 * @author Manuel Parra
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
	exit; // Exit if accessed directly
}

/*--- Class Endpoint Model ---*/
class endpointModel {
    /*-- Function for get ajax requests --*/
    protected static function get_endpoint_model($file) {
        $whiteListView = ["client-ajax", "user-ajax", "login-ajax",
                          "search-engine-ajax"];

        $req = "./ajax/v1/error.php";

        if (in_array($file, $whiteListView)) {
            if (is_file("./ajax/v1/" . $file . ".php")) {
                $req = "./ajax/v1/" . $file . ".php";
            }
        }

        return $req;
    }
}
