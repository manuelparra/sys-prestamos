<?php
/**
 * View Controller
 * All functionality pertaining to View Controller.
 * PHP version 8.2.0
 *
 * @category Controller
 * @package  Controller
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  GIT: 1.0.0
 * @link     manuelparra.dev
 */

namespace App\Controller;

use App\Model\ViewModel;

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

/**
 * Class View Controller
 *
 * @category   Controller
 * @package    ViewController
 * @subpackage ViewController
 * @author     Manuel Parra <manuelparra@live.com.ar>
 * @license    MIT <https://mit.org>
 * @link       https://manuelparra.dev
 */
class ViewController extends ViewModel
{
    /**
     * Function for get template
     *
     * @return string
     */
    public function getTemplateController(): string
    {
        return include_once "./App/View/layout.php";
    }

    /**
     * Function for get view
     *
     * @return string
     */
    public function getViewController(): string
    {
        if (isset($_GET['view'])) {
            $route = explode("/", $_GET['view']);
            $response = ViewModel::getViewModel($route[0]);
        } else {
            $response = "login";
        }
        error_log(print_r($response . "\n", true), 3, ERROR_DIR . "my-errors.log");
        return $response;
    }
}
