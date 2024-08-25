<?php
/**
 * API Model
 * All functionality pertaining to API Model.
 * PHP version 8.2.0
 *
 * @category Model
 * @package  Model
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  GIT: 1.0.0
 * @link     manuelparra.dev
 */

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

/**
 * Class API Model
 *
 * @category   Model
 * @package    EnpointModel
 * @subpackage EnpointModel
 * @author     Manuel Parra <manuelparra@live.com.ar>
 * @license    MIT <https://mit.org>
 * @link       https://manuelparra.dev
 */
class EndpointModel
{
    /**
     * Function for get endpoint model
     *
     * @param $file contains the view name
     *
     * @return string
     */
    protected static function getEndpointModel($file): string
    {
        $whiteListView = ["client-ajax", "user-ajax", "login-ajax",
                          "search-engine-ajax", "business-ajax", "item-ajax"];

        $req = "./ajax/v1/error.php";

        if (in_array($file, $whiteListView)) {
            if (is_file("./ajax/v1/" . $file . ".php")) {
                $req = "./ajax/v1/" . $file . ".php";
            }
        }

        return $req;
    }
}
