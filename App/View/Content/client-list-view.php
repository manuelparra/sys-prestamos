<?php
/**
 * Client List View.
 * Contents of Client List View.
 * PHP version 8.2.0
 *
 * @category View
 * @package  ViewContent
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  CVS: <1.0.0>
 * @link     manuelparra.dev
 */

use App\Controller\ClientController;
?>

<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-clipboard-list fa-fw"></i>
        &nbsp;LISTA DE CLIENTES
    </h3>
    <p class="text-justify">
        Esta vista contiene el listado de todos los clientes registrados,
        puede seleccionar un cliente para actualizar o eliminar sus datos
        del sistema.
    </p>
</div

<!-- Navegation -->
<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="<?php echo SERVER_URL; ?>client-new/">
                <i class="fas fa-plus fa-fw"></i>
                &nbsp;AGREGAR CLIENTE
            </a>
        </li>
        <li>
            <a class="active" href="<?php echo SERVER_URL; ?>client-list/">
                <i class="fas fa-clipboard-list fa-fw"></i>
                &nbsp;LISTA DE CLIENTES
            </a>
        </li>
        <li>
            <a href="<?php echo SERVER_URL; ?>client-search/">
                <i class="fas fa-search fa-fw"></i>
                &nbsp;BUSCAR CLIENTE
            </a>
        </li>
    </ul>
</div>

<!-- Content here-->
<div class="container-fluid">
    <?php

    $insClientController = new ClientController();

    echo $insClientController->paginatorClientController(
        $_SESSION['currentPage'][1],
        15,
        $_SESSION['privilegio_spm'],
        $_SESSION['currentPage'][0],
    );
    ?>
</div>
