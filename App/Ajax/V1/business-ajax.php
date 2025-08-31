<?php
/**
 * Ajax Business Script
 * All functionality pertaining to Endpoint Model.
 * PHP version 8.3.0
 *
 * @category Ajax
 * @package  Ajax-Request
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  GIT: 1.0.0
 * @link     manuelparra.dev
 */

use App\Controller\BusinessController;

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}


if (isset($_POST['empresa_nif_reg'])
    || isset($_POST['empresa_id_upd'])
) {
    // Instance to Business Controller
    $insBusiness = new BusinessController();

    // Add business information
    if (isset($_POST['empresa_nif_reg'])) {
        echo $insBusiness->addBusinessInformationController();
        exit;
    }

    // Update Business Information
    if (isset($_POST['empresa_id_upd'])) {
        echo $insBusiness->updateBusinessController();
        exit;
    }
} else {
    session_start(['name' => "SPM"]);
    session_unset();
    session_destroy();
    header("Location: " . SERVER_URL . "login/");
    exit;
}
