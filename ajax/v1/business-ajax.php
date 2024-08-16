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

if (isset($_POST['empresa_nombre_reg']) || isset($_POST['business_id_upd']) {
    // Instance to business controller
    require_once "./controllers/businessController.php";
    $insBusiness = new businessController();

    // Update Business Information
    if (isset($_POST['business_id_upd'])) {
        echo $insBusiness->update_business_information_controller();
        exit;
    }

    // Add Business Information
    if(isset($_POST['empresa_nombre_reg'])) {
        echo $insBusiness->add_business_information_controller();
        exit;
    }
} else {
    session_start(['name' => "SPM"]);
    session_unset();
    session_destroy();
    header("Location: " . SERVER_URL . "login/");
    exit;
}
