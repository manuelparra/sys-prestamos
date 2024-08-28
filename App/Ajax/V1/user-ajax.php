<?php
/**
 * Ajas User Script
 * All functionality pertaining to the Ajax User Script
 * PHP version 8.2.0
 *
 * @category Ajax
 * @package  Ajax
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  GIT: 1.0.0
 * @link     manuelparra.dev
 */

use App\Controller\UserController;

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

if (isset($_POST['usuario_dni_reg'])
    || isset($_POST['usuario_id_del'])
    || isset($_POST['usuario_id_upd'])
) {
    // Instance to user controller
    $insUser = new UserController();

    // Update user
    if (isset($_POST['usuario_id_upd'])) {
        echo $insUser->updateUserDataController();
        exit;
    }

    // Delete user
    if (isset($_POST['usuario_id_del'])) {
        echo $insUser->deleteUserController();
        exit;
    }

    // Add user
    if ((isset($_POST['usuario_dni_reg'])
        && !empty($_POST['usuario_dni_reg']))
        && (isset($_POST['usuario_nombre_reg'])
        && !empty($_POST['usuario_nombre_reg']))
        && (isset($_POST['usuario_usuario_reg'])
        && !empty($_POST['usuario_usuario_reg']))
        && (isset($_POST['usuario_email_reg'])
        && !empty($_POST['usuario_email_reg']))
        && (isset($_POST['usuario_clave_1_reg'])
        && !empty($_POST['usuario_clave_1_reg']))
        && (isset($_POST['usuario_clave_1_reg'])
        && !empty($_POST['usuario_clave_1_reg']))
        && (isset($_POST['usuario_privilegio_reg'])
        && !empty($_POST['usuario_privilegio_reg']))
    ) {
        echo $insUser->addUserController();
        exit;
    } else {
        echo $insUser->messageUserController(
            "simple",
            "error",
            "Ocurrió un error inesperado",
            "No has llenado todos los campos requeridos."
        );
        exit;
    }
} else {
    session_start(['name' => 'SPM']);
    session_unset();
    session_destroy();
    header("Location: " . SERVER_URL . "login/");
    exit;
}
