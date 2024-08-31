<?php
/**
 * Contents of New Item View.
 * Contents of the new item view.
 * PHP version 8.2.0
 *
 * @category View
 * @package  ViewContent
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  CVS: <1.0.0>
 * @link     manuelparra.dev
 */

use App\Controller\LoginController;

if (!isset($insLoginController)) {
    $insLoginController = new LoginController();
}

if ($_SESSION['privilegio_spm'] != 1
    && $_SESSION['privilegio_spm'] != 2
) {
    echo $insLoginController->forceCloseSessionController();
    exit;
}
?>

<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-plus fa-fw"></i>
        &nbsp;AGREGAR ITEM
    </h3>
    <p class="text-justify">
        Esta vista permite registrar nuevos items en el sistema, puede
        ingresar los datos del item para registrarlo a continuación.
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a class="active" href="<?php echo SERVER_URL; ?>item-new/">
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
    <form
        class="form-neon ajax-form"
        action="<?php echo SERVER_URL; ?>endpoint/item-ajax/"
        method="POST"
        id="new_registration_form"
        data-form="save"
        autocomplete="off"
    >
        <fieldset>
            <legend><i class="far fa-plus-square"></i>
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
                                name="item_codigo_reg"
                                id="item_codigo"
                                maxlength="35"
                                required
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
                                pattern="<?php echo RBNAME; ?>"
                                class="form-control"
                                name="item_nombre_reg"
                                id="item_nombre"
                                maxlength="140"
                                required
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
                                pattern="<?php echo RBNAME; ?>"
                                class="form-control"
                                name="item_stock_reg"
                                id="item_stock"
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
                                name="item_estado_reg"
                                id="item_estado"
                            >
                                <option
                                    value=""
                                    selected=""
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
                                name="item_detalle_reg"
                                id="item_detalle"
                                maxlength="190"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <p class="text-center" style="margin-top: 40px;">
            <button
                type="reset"
                class="btn btn-raised btn-secondary btn-sm"
            >
                <i class="fas fa-paint-roller"></i>
                &nbsp;LIMPIAR
            </button>
            <button
                type="submit"
                class="btn btn-raised btn-info btn-sm"
            >
                <i class="far fa-save"></i>
                &nbsp;GUARDAR
            </button>
        </p>
    </form>
</div>
