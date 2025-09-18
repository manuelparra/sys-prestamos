<?php

/**
 * Ajas Login Script
 * All functionality pertaining to the Ajax Login Script
 * PHP version 8.2.0
 *
 * @category Ajax
 * @package  Ajax
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  GIT: 1.0.0
 * @link     manuelparra.dev
 */

use App\Controller\LoginController;

if (!defined('__ROOT__')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

if (isset($_POST['token']) && isset($_POST['usuario'])) {
    // Instance to Login controller
    $insLoginController = new LoginController();
    echo $insLoginController->closeSessionController();
    exit;
} else {
    session_start(['name' => 'SPM']);
    session_unset();
    session_destroy();
    header("Location: " . SERVER_URL . "/login/");
    exit;
}
