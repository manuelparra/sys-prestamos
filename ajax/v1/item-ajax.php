<?php
/**
 * Ajax Item Ajax
 *
 * All functionality pertaining to the Ajax item requests.
 *
 * @package Ajax Request
 * @author Manuel Parra
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

if (isset($_POST['item_codigo_reg']) || isset($_POST['item_id_upd']) || isset($_POST['item_id_del'])) {
    // instance to item controller
    require_once "./controllers/itemController.php";
    $insItem = new itemController();

    // Update item
    if (isset($_POST['item_id_upd'])) {
        echo $insItem->update_item_data_controller();
        exit;
    }

    // Delete item
    if (isset($_POST['item_id_del'])) {
        echo $insItem->delete_item_controller();
        exit;
    }

    // Add item
    if (isset($_POST['item_codigo_reg']) && isset($_POST['item_nombre_reg'])) {
        echo $insItem->add_item_controller();
        exit;
    } else {
        echo $insItem->message_item_controller("simple", "error", "Ocurrio un error inesperado",
                                               "No has llenado todos los campos requeridos");
        exit;
    }
} else {
    session_start( ['name' => "SPM"]);
    session_unset();
    session_destroy();
    header("Location:" . SERVER_URL . "login/");
    exit;
}
