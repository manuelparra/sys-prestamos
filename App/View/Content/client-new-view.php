<?php
/**
 * New Client View.
 * Contents of New Client View.
 * PHP version 8.2.0
 *
 * @category View
 * @package  ViewContent
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  CVS: <1.0.0>
 * @link     manuelparra.dev
 */

//use App\Controller\LoginController;

//if (!isset($insLoginController)) {
//    $insLoginController = new LoginController();
//}
//
//if ($_SESSION['privilegio_spm'] != 1
//    && $_SESSION['privilegio_spm'] != 2
//) {
//    echo $insLoginController->forceCloseSessionController();
//    exit;
//}
?>

<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-plus fa-fw"></i>
        &nbsp;AGREGAR CLIENTE
    </h3>
    <p class="text-justify">
        Esta vista permite registrar nuevos clientes en el sistema, puede
        ingresar los datos del cliente para registrarlo a continuación.
    </p>
</div>

<!-- Navegation -->
<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a class="active" href="<?php echo SERVER_URL; ?>client-new/">
                <i class="fas fa-plus fa-fw"></i>
                &nbsp;AGREGAR CLIENTE
            </a>
        </li>
        <li>
            <a href="<?php echo SERVER_URL; ?>client-list/">
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

<!-- Content -->
<div class="container-fluid">
    <form
        class="form-neon ajax-form"
        action="<?php echo SERVER_URL; ?>endpoint/client-ajax/"
        method="POST"
        id="new_registration_form"
        data-form="save"
        autocomplete="off"
    >
        <fieldset>
            <legend>
                <i class="fas fa-user"></i>
                &nbsp;Información básica
            </legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label
                                for="cliente_dni"
                                class="bmd-label-floating"
                            >
                                DNI
                            </label>
                            <input
                                type="text"
                                pattern="<?php echo RDNIHTML; ?>"
                                class="form-control"
                                name="cliente_dni_reg"
                                id="cliente_dni"
                                maxlength="10"
                                title="Debe contener ocho numeros,
                                un guión y una letra mayúscula"
                                required
                            >
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="form-group">
                            <label
                                for="cliente_nombre"
                                class="bmd-label-floating"
                            >
                                Nombre
                            </label>
                            <input
                                type="text"
                                pattern="<?php echo RNLN; ?>"
                                class="form-control"
                                name="cliente_nombre_reg"
                                id="cliente_nombre"
                                maxlength="35"
                                required
                            >
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="form-group">
                            <label
                                for="cliente_apellido"
                                class="bmd-label-floating"
                            >
                                Apellido
                            </label>
                            <input
                                type="text"
                                pattern="<?php echo RNLN; ?>"
                                class="form-control"
                                name="cliente_apellido_reg"
                                id="cliente_apellido"
                                maxlength="35"
                                required
                            >
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label
                                for="cliente_telefono"
                                class="bmd-label-floating"
                            >
                                Teléfono
                            </label>
                            <input
                                type="text"
                                pattern="<?php echo RPHONEHTML; ?>"
                                class="form-control"
                                name="cliente_telefono_reg"
                                id="cliente_telefono"
                                maxlength="20"
                                required
                            >
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label
                                for="cliente_email"
                                class="bmd-label-floating"
                            >
                                Email
                            </label>
                            <input
                                type="email"
                                pattern="<?php echo REMAILHTML; ?>"
                                class="form-control"
                                name="cliente_email_reg"
                                id="cliente_email"
                                maxlength="70"
                                required
                            >
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label
                                for="cliente_direccion"
                                class="bmd-label-floating"
                            >
                                Dirección
                            </label>
                            <input
                                type="text"
                                pattern="<?php echo RADDRHTML; ?>"
                                class="form-control"
                                name="cliente_direccion_reg"
                                id="cliente_direccion"
                                maxlength="190"
                                required
                            >
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <p class="text-center" style="margin-top: 40px;">
            <button
                type="button"
                class="btn btn-raised btn-secondary btn-sm"
                id="button_reset">
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
