<?php
/**
 * Contents of NavBar.
 * Contents of the NavBar
 * PHP version 8.2.0
 *
 * @category Layout
 * @package  Layout
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  CVS: <1.0.0>
 * @link     manuelparra.dev
 */

use App\Controller\LoginController;

if (!isset($insLoginController)) {
    $insLoginController = new LoginController();
}

$idSpm = $insLoginController->encryptData($_SESSION['id_spm'])
?>

<nav class="full-box navbar-info">
    <a href="#" class="float-left show-nav-lateral">
        <i class="fas fa-exchange-alt"></i>
    </a>
    <a href="<?php echo SERVER_URL . 'user-update/' . $idSpm  . '/'; ?>">
        <i class="fas fa-user-cog"></i>
    </a>
    <a href="#" class="btn-exit-system">
        <i class="fas fa-power-off"></i>
    </a>
</nav>

