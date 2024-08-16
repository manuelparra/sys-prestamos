<?php
/**
 * Ajax Business Script
 *
 * All functionality pertaining to the Ajax Business requests.
 *
 * @package Ajax Request
 * @author Manuel Parra
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

if (1) { // isset($_POST['cliente_dni_reg']) || isset($_POST['cliente_id_del']) || isset($_POST['cliente_id_upd'])
    // Instance to client controller
    require_once "./controllers/businessController.php";
    $insBusiness = new businessController();

} else {
    session_start(['name' => "SPM"]);
    session_unset();
    session_destroy();
    header("Location: " . SERVER_URL . "login/");
    exit;
}
