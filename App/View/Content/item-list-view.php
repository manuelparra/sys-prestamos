<?php
/**
 * Item List View.
 * Contents of Item List View.
 * PHP version 8.2.0
 *
 * @category View
 * @package  ViewContent
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  CVS: <1.0.0>
 * @link     manuelparra.dev
 */

use App\Controller\ItemController;
?>

<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-clipboard-list fa-fw"></i>
        &nbsp;LISTA DE ITEMS
    </h3>
    <p class="text-justify">
        Esta vista contiene el listado de todos items registrados,
        puede seleccionar un item para actualizar o eliminar sus datos del sistema.
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="<?php echo SERVER_URL; ?>item-new/">
                <i class="fas fa-plus fa-fw"></i>
                &nbsp;AGREGAR ITEM
            </a>
        </li>
        <li>
            <a class="active" href="<?php echo SERVER_URL; ?>item-list/">
                <i class="fas fa-clipboard-list fa-fw"></i>
                &nbsp;LISTA DE ITEMS
            </a>
        </li>
        <li>
            <a href="<?php echo SERVER_URL; ?>item-search/">
                <i class="fas fa-search fa-fw"></i>
                &nbsp;BUSCAR ITEM
            </a>
        </li>
    </ul>
</div>

<!-- Content -->
<div class="container-fluid">
    <?php

    $insItemController = new ItemController();

    echo $insItemController->paginatorItemController(
        $_SESSION['currentPage'][1],
        15,
        $_SESSION['privilegio_spm'],
        $_SESSION['currentPage'][0],
        ""
    );
    ?>
</div>
