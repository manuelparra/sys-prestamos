<?php
/**
 * Contents of Update Item View.
 * Contents of the update item view.
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
        <i class="fas fa-sync-alt fa-fw"></i>
        &nbsp;ACTUALIZAR ITEM
    </h3>
    <p class="text-justify">
        Esta vista permite la modificación de los datos de items
        del sistema, puede modificar los datos del item.
    </p>
</div>

<!-- Navegation -->
<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="<?php echo SERVER_URL; ?>item-new/html">
                <i class="fas fa-plus fa-fw"></i>
                &nbsp;AGREGAR ITEM
            </a>
        </li>
        <li>
            <a href="<?php echo SERVER_URL; ?>item-list/">
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
    if ($_SESSION['privilegio_spm'] == 1
        || $_SESSION['privilegio_spm'] == 2
    ) {
        if (!isset($insItemController)) {
            $insItemController = new ItemController();
        }

        $query = $insItemController->queryDataItemController(
            'Unique',
            $_SESSION['currentPage'][1]
        );

        if ($query->rowCount() == 1) {
            $fields = $query->fetch();
            ?>
            <form
                class="form-neon ajax-form"
                action="<?php echo SERVER_URL; ?>endpoint/item-ajax/"
                method="POST"
                data-form="update"
                autocomplete="off"
            >
                <input
                    type="hidden"
                    name="item_id_upd"
                    value="<?php echo $_SESSION['currentPage'][1]; ?>"
                >
                <fieldset>
                    <legend>
                        <i class="far fa-plus-square"></i>
                        &nbsp;Información del item
                    </legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label
                                        for="item_codigo"
                                        class="bmd-label-floating"
                                    >
                                        Códido
                                    </label>
                                    <input
                                        type="text"
                                        pattern="<?php echo RCOD; ?>"
                                        class="form-control"
                                        name="item_codigo_upd"
                                        id="item_codigo"
                                        value="<?php echo $fields[1]; ?>"
                                        maxlength="45"
                                    >
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label
                                        for="item_nombre"
                                        class="bmd-label-floating"
                                    >
                                        Nombre
                                    </label>
                                    <input
                                        type="text"
                                        pattern="<?php echo RNAME; ?>"
                                        class="form-control"
                                        name="item_nombre_upd"
                                        id="item_nombre"
                                        value="<?php echo $fields[2]; ?>"
                                        maxlength="140"
                                    >
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label
                                        for="item_stock"
                                        class="bmd-label-floating"
                                    >
                                        Stock
                                    </label>
                                    <input
                                        type="num"
                                        pattern="<?php echo RSTOCK; ?>"
                                        class="form-control"
                                        name="item_stock_upd"
                                        id="item_stock"
                                        value="<?php echo $fields[3]; ?>"
                                        maxlength="9"
                                    >
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label
                                        for="item_estado"
                                        class="bmd-label-floating"
                                    >
                                        Estado
                                    </label>
                                    <select
                                        class="form-control"
                                        name="item_estado_upd"
                                        id="item_estado"
                                    >
                                        <?php
                                        if (is_null($fields[4])) {
                                            ?>
                                            <option
                                                value="" selected=""
                                                disabled=""
                                            >
                                                Seleccione una opción
                                            </option>
                                            <option
                                                value="Habilitado"
                                            >
                                                Habilitado
                                            </option>
                                            <option
                                                value="Deshabilitado"
                                            >
                                                Deshabilitado
                                            </option>
                                            <?php
                                        } else {
                                            ?>
                                            <option
                                                value="<?php echo  $fields[4]; ?>"
                                            >
                                                <?php echo  $fields[4]; ?>
                                            </option>
                                            <?php
                                            if ($fields[4] == "Habilitado") {
                                                ?>
                                                <option
                                                    value="Deshabilitado"
                                                >
                                                    Deshabilitado
                                                </option>
                                                <?php
                                            } else {
                                                ?>
                                                <option
                                                    value="Habilitado"
                                                >
                                                    Habilitado
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label
                                        for="item_detalle"
                                        class="bmd-label-floating"
                                    >
                                        Detalle
                                    </label>
                                    <input
                                        type="text"
                                        pattern="<?php echo RDETALLE; ?>"
                                        class="form-control"
                                        name="item_detalle_upd"
                                        id="item_detalle"
                                        value="<?php echo $fields[5]; ?>"
                                        maxlength="190"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <p class="text-center" style="margin-top: 40px;">
                    <button
                        type="submit"
                        class="btn btn-raised btn-success btn-sm"
                    >
                        <i class="fas fa-sync-alt"></i>
                        &nbsp;ACTUALIZAR
                    </button>
                </p>
            </form>
            <?php
        } else {
            ?>
            <div class="alert alert-danger text-center" role="alert">
                <p><i class="fas fa-exclamation-triangle fa-5x"></i></p>
                <h4 class="alert-heading">¡Ocurrió un error inesperado!</h4>
                <p class="mb-0">
                    Lo sentimos, no podemos mostrar la información
                    solicitada debido a un error.
                </p>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="alert alert-danger text-center" role="alert">
            <p><i class="fas fa-exclamation-triangle fa-5x"></i></p>
            <h4 class="alert-heading">¡Ocurrió un error inesperado!</h4>
            <p class="mb-0">
                Lo sentimos, no podemos mostrar la información
                solicitada debido a un error.
            </p>
        </div>
        <?php
    }
    ?>
</div>
