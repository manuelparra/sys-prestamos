<?php
/**
 * Ajax Client
 * All functionality pertaining to Ajax Cilent
 * PHP version 8.2.0
 *
 * @category Ajax
 * @package  AjaxRequest
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  GIT: 1.0.0
 * @link     manuelparra.dev
 */

use App\Controller\ClientController;

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

if (isset($_POST['cliente_dni_reg'])
    || isset($_POST['cliente_id_del'])
    || isset($_POST['cliente_id_upd'])
) {
    // Instance to client controller
    $insClientController = new ClientController();

    // Update client
    if (isset($_POST['cliente_id_upd'])) {
        echo $insClientController->updateClientDataController();
        exit;
    }

    // Delete client
    if (isset($_POST['cliente_id_del'])) {
        echo $insClientController->deleteClientController();
        exit;
    }

    // Add client
    if (isset($_POST['cliente_dni_reg'])
        && isset($_POST['cliente_nombre_reg'])
    ) {
        echo $insClientController->addClientController();
        exit;
    } else {
        echo $insClientController->messageClientController(
            "simple",
            "error",
            "Ocurrió un error inesperado",
            "No has llenado todos los campos requeridos."
        );
        exit;
    }
} else {
    session_start(['name' => "SPM"]);
    session_unset();
    session_destroy();
    header("Location: " . SERVER_URL . "login/");
    exit;
}
