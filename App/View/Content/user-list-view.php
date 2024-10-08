<?php
/**
 * User List View.
 * Contents of User List View.
 * PHP version 8.2.0
 *
 * @category View
 * @package  ViewContent
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  CVS: <1.0.0>
 * @link     manuelparra.dev
 */

use App\Controller\{UserController, LoginController};

if ($_SESSION['privilegio_spm'] != 1) {
    if (!isset($insLoginController)) {
        $insLoginController = new LoginController();
    }
    echo $insLoginController->forceCloseSessionController();
    exit;
}
?>

<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-clipboard-list fa-fw"></i>
        &nbsp;LISTA DE USUARIOS
    </h3>
    <p class="text-justify">
        Esta vista contiene el listado de todos los usuarios registrados,
        puede seleccionar un usuario para actualizar o eliminar sus datos
        del sistema.
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="<?php echo SERVER_URL; ?>user-new/">
                <i class="fas fa-plus fa-fw"></i>
                &nbsp;NUEVO USUARIO
            </a>
        </li>
        <li>
            <a class="active" href="<?php echo SERVER_URL; ?>user-list/">
                <i class="fas fa-clipboard-list fa-fw"></i>
                &nbsp;LISTA DE USUARIOS
            </a>
        </li>
        <li>
            <a href="<?php echo SERVER_URL; ?>user-search/">
                <i class="fas fa-search fa-fw"></i>
                &nbsp;BUSCAR USUARIO
            </a>
        </li>
    </ul>
</div>

<!-- Content -->
<div class="container-fluid">
    <?php

    $insUserController = new UserController();

    echo $insUserController->paginatorUserController(
        $_SESSION['currentPage'][1],
        15,
        $_SESSION['privilegio_spm'],
        $_SESSION['id_spm'],
        $_SESSION['currentPage'][0],
        ""
    );
    ?>
</div>
