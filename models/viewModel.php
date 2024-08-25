<?php
/**
 * View Model
 * All functionality pertaining to View Model.
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
 * Class View Model
 *
 * @category   Model
 * @package    ViewModel
 * @subpackage ViewModel
 * @author     Manuel Parra <manuelparra@live.com.ar>
 * @license    MIT <https://mit.org>
 * @link       https://manuelparra.dev
 */
class ViewModel
{
    /**
     * Function for get view Model
     *
     * @param $view contains the view name
     *
     * @return string
     */
    protected static function getViewModel($view): string
    {
        $whiteListView = ["home", "client-list", "client-new", "client-search",
        "client-update", "company", "item-list", "item-new", "item-search",
        "item-update", "reservation-list", "reservation-new", "reservation-pending",
        "reservation-reservation", "reservation-search", "reservation-update",
        "user-list", "user-new", "user-search", "user-update"];

        $content = "404";

        if (in_array($view, $whiteListView)) {
            if (is_file("./views/contents/" . $view . "-view.php")) {
                $content = "./views/contents/" . $view . "-view.php";
            }
        } elseif ($view == "login" || $view == "index") {
            $content = "login";
        }

        return $content;
    }
}
