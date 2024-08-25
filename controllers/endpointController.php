<?php
/**
 * API Controller
 * All functionality pertaining to API Controller.
 * PHP version 8.2.0
 *
 * @category Controller
 * @package  Controller
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  GIT: 1.0.0
 * @link     manuelparra.dev
 */

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

require_once "./models/endpointModel.php";

/**
 * Class Endpoint Controller
 *
 * @category   Controller
 * @package    EndpointController
 * @subpackage EndpointController
 * @author     Manuel Parra <manuelparra@live.com.ar>
 * @license    MIT <https://mit.org>
 * @link       https://manuelparra.dev
 */
class EndpointController extends EndpointModel
{
    /**
     * Function for get endpoint controller
     *
     * @param $endpoint contains the view name
     *
     * @return string
     */
    public function getEndpointController($endpoint): string
    {
        $route = explode("/", $endpoint);
        $path = EndpointModel::getEndpointModel($route[1]);

        return $path;
    }
}
