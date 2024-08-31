<?php
/**
 * Ajax Item Script
 * All functionality pertaining to the Ajax Item Script
 * PHP version 8.2.0
 *
 * @category Ajax
 * @package  AjaxItem
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  GIT: 1.0.0
 * @link     manuelparra.dev
 */

use App\Controller\ItemController;

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

if (isset($_POST['item_codigo_reg'])
    || isset($_POST['item_id_upd'])
    || isset($_POST['item_id_del'])
) {
    // Instance to item controller
    $insItemController = new ItemController();

    // Update item
    if (isset($_POST['item_id_upd'])) {
        echo $insItemController->updateItemDataController();
        exit;
    }

    // Delete item
    if (isset($_POST['item_id_del'])) {
        echo $insItemController->deleteItemController();
        exit;
    }

    // Add item
    if (isset($_POST['item_codigo_reg']) 
        && isset($_POST['item_nombre_reg'])
    ) {
        echo $insItemController->addItemController();
        exit;
    } else {
        echo $insItemController->messageItemController(
            "simple",
            "error",
            "Ocurrio un error inesperado",
            "No has llenado todos los campos requeridos"
        );
        exit;
    }
} else {
    session_start(['name' => "SPM"]);
    session_unset();
    session_destroy();
    header("Location:" . SERVER_URL . "login/");
    exit;
}
