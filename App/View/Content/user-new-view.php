<?php
/**
 * New User View.
 * Contents of New User View.
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
        <i class="fas fa-plus fa-fw"></i>
        &nbsp;NUEVO USUARIO
    </h3>
    <p class="text-justify">
        Esta vista permite registrar nuevos usuarios en el sistema,
        puede ingresar y configurar todos los datos necesario para
        darle acceso al sistema a un nuevo usuario.
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a class="active" href="<?php echo SERVER_URL; ?>user-new/">
                <i class="fas fa-plus fa-fw"></i>
                &nbsp;NUEVO USUARIO
            </a>
        </li>
        <li>
            <a href="<?php echo SERVER_URL; ?>user-list/">
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

    $profiles = null;

    $query = $insUserController->queryPerfilListUserModel();
    if ($query->rowCount() > 0) {
        $profiles = $query->fetchAll();
    }
    ?>

    <form
        class="form-neon ajax-form"
        action="<?php echo SERVER_URL; ?>endpoint/user-ajax/"
        method="POST"
        id="new_registration_form"
        data-form="save"
        autocomplete="off"
    >
        <fieldset>
            <legend>
                <i class="far fa-address-card"></i>
                &nbsp;Información personal
            </legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label
                                for="usuario_dni"
                                class="bmd-label-floating"
                            >
                                DNI
                            </label>
                            <input
                                type="text"
                                pattern="<?php echo RDNIHTML; ?>"
                                class="form-control"
                                name="usuario_dni_reg"
                                id="usuario_dni"
                                maxlength="10"
                                title="Debe contener ocho numeros,
                                un guión y una letra mayúscula"
                                required
                            >
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label
                                for="usuario_nombre"
                                class="bmd-label-floating"
                            >
                                Nombres
                            </label>
                            <input
                                type="text"
                                pattern="<?php echo RNLN; ?>"
                                class="form-control"
                                name="usuario_nombre_reg"
                                id="usuario_nombre"
                                maxlength="35"
                                required
                            >
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label
                                for="usuario_apellido"
                                class="bmd-label-floating"
                            >
                                Apellidos
                            </label>
                            <input
                                type="text"
                                pattern="<?php echo RNLN; ?>"
                                class="form-control"
                                name="usuario_apellido_reg"
                                id="usuario_apellido"
                                maxlength="35"
                                required
                            >
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label
                                for="usuario_telefono"
                                class="bmd-label-floating"
                            >
                                Teléfono
                            </label>
                            <input
                                type="text"
                                pattern="<?php echo RPHONEHTML; ?>"
                                class="form-control"
                                name="usuario_telefono_reg"
                                id="usuario_telefono"
                                maxlength="20"
                            >
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label
                                for="usuario_direccion"
                                class="bmd-label-floating"
                            >
                                Dirección
                            </label>
                            <input
                                type="text"
                                pattern="<?php echo RADDRHTML; ?>"
                                class="form-control"
                                name="usuario_direccion_reg"
                                id="usuario_direccion"
                                maxlength="190"
                            >
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group bmd-form-group">
                            <select
                                class="form-control"
                                name="usuario_perfil_reg"
                                id="usuario_perfil"
                            >
                                <option
                                    value="Seleccione"
                                    selected=""
                                    disabled=""
                                >
                                    Seleccione un perfil
                                </option>
                                <?php
                                if (!is_null($profiles)) {
                                    $profile = null;
                                    foreach ($profiles as [ , $profile]) {
                                        echo '
                                        <option value="'
                                        . $profile
                                        . '">'
                                        . $profile
                                        . '</option>'
                                        ;
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>
                <i class="fas fa-user-lock"></i>
                &nbsp;Información de la cuenta
            </legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label
                                for="usuario_usuario"
                                class="bmd-label-floating"
                            >
                                Nombre de usuario
                            </label>
                            <input
                                type="text"
                                pattern="<?php echo RUSER; ?>"
                                class="form-control"
                                name="usuario_usuario_reg"
                                id="usuario_usuario"
                                maxlength="35"
                                required
                            >
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label
                                for="usuario_email"
                                class="bmd-label-floating"
                            >
                                Email
                            </label>
                            <input
                                type="email"
                                pattern="<?php echo REMAILHTML; ?>"
                                class="form-control"
                                name="usuario_email_reg"
                                id="usuario_email"
                                maxlength="70"
                                required
                            >
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label
                                for="usuario_clave_1"
                                class="bmd-label-floating"
                            >
                                Contraseña
                            </label>
                            <input
                                type="password"
                                pattern="<?php echo RPASS; ?>"
                                class="form-control"
                                name="usuario_clave_1_reg"
                                id="usuario_clave_1"
                                maxlength="16"
                                title="Debe contener al menos un número y una
                                letra mayúscula y minúscula, y al menos 8 o
                                más caracteres"
                                required
                            >
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label
                                for="usuario_clave_2"
                                class="bmd-label-floating"
                            >
                                Repetir contraseña
                            </label>
                            <input
                                type="password"
                                pattern="<?php echo RPASS; ?>"
                                class="form-control"
                                name="usuario_clave_2_reg"
                                id="usuario_clave_2"
                                maxlength="16"
                                title="Debe contener al menos un número y una
                                letra mayúscula y minúscula, y al menos 8 o
                                más caracteres"
                                required
                            >
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <br><br><br>
        <fieldset>
            <legend>
                <i class="fas fa-medal"></i>
                &nbsp;Nivel de privilegio
            </legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <p>
                            <span class="badge badge-info">
                                Control total
                            </span>
                            Permisos para registrar, actualizar y eliminar
                        </p>
                        <p>
                            <span class="badge badge-success">
                                Edición
                            </span>
                            Permisos para registrar y actualizar
                        </p>
                        <p>
                            <span class="badge badge-dark">
                                Registrar
                            </span>
                            Solo permisos para registrar
                        </p>
                        <div class="form-group">
                            <select
                                class="form-control"
                                name="usuario_privilegio_reg"
                                required
                            >
                                <option
                                    value=""
                                    selected=""
                                    disabled=""
                                >
                                    Seleccione una opción
                                </option>
                                <option
                                    value="1"
                                >
                                    Control total
                                </option>
                                <option
                                    value="2"
                                >
                                    Edición
                                </option>
                                <option
                                    value="3"
                                >
                                    Registrar
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <p
            class="text-center"
            style="margin-top: 40px;"
        >
            <button
                type="button"
                class="btn btn-raised btn-secondary btn-sm"
                id="button_reset"
            >
                <i class="fas fa-paint-roller"></i>
                &nbsp;LIMPIAR
            </button>
            <button
                type="submit"
                class="btn btn-raised btn-info btn-sm"
            >
                <i class="far fa-save"></i>
                &nbsp;
                GUARDAR
            </button>
        </p>
    </form>
</div>
