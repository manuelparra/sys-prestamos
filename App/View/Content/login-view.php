<?php
/**
 * Contents of Login View
 * Contents of the User Login View.
 * PHP version 8.2.0
 *
 * @category View
 * @package  View
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  GIT: 1.0.0
 * @link     manuelparra.dev
 */

namespace App\View\Content;

use App\Controller\LoginController;

$user = ""; // user value text
$pass = ""; // password value text

if (isset($_POST['usuario_log']) && isset($_POST['clave_log'])) {
    $insLoginController = new LoginController();
    echo $insLoginController->loginController();

    $user = $_POST['usuario_log'];
    $pass = $_POST['clave_log'];
}
?>

<div class="login-container">
    <div class="login-content">
        <p class="text-center">
            <i class="fas fa-user-circle fa-5x"></i>
        </p>
        <p class="text-center">
            Inicia sesión con tu usuario y contraseña
        </p>
        <form id="login-form" method="POST" autocomplete="off" >
            <div class="form-group">
                <label for="name" class="bmd-label-floating">
                    <i class="fas fa-user-secret"></i>
                    &nbsp;Usuario
                </label>
                <input
                    type="text"
                    class="form-control"
                    id="name"
                    name="usuario_log"
                    pattern="<?php echo RUSER; ?>"
                    maxlength="35"
                    value="<?php echo $user; ?>"
                    autocomplete="off"
                    required
                >
            </div>
            <div class="form-group">
                <label for="password" class="bmd-label-floating">
                    <i class="fas fa-key"></i>
                    &nbsp;Contraseña
                </label>
                <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="clave_log"
                    pattern="<?php echo RPASS; ?>"
                    maxlength="16"
                    value="<?php echo $pass; ?>"
                    autocomplete="on"
                    required
                >
            </div>
            <button
                type="submit"
                class="btn-login text-center"
            >
                INICIAR SESIÓN
            </button>
        </form>
    </div>
</div>
