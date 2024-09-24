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

if (!isset($insLoginController)) {
    $insLoginController = new LoginController();
}

$idSPM = $insLoginController->encryptData($_SESSION['id_spm']);

if ($_SESSION['privilegio_spm'] != 1
    && $idSPM  != $_SESSION['currentPage'][1]
) {
    echo $insLoginController->forceCloseSessionController();
    exit;
}
?>

<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-sync-alt fa-fw"></i>
        &nbsp;ACTUALIZAR USUARIO
    </h3>
    <p class="text-justify">
        Esta vista permite la modificación de los datos de usuario
        del sistema, puede modificar los datos y la
        configuración del usuario.
    </p>
</div>

// show the fallowing options if user privilege is iqual to 1 (admin)
<?php
if ($_SESSION['privilegio_spm'] == 1) {
    ?>
    <div class="container-fluid">
        <ul class="full-box list-unstyled page-nav-tabs">
            <li>
                <a href="<?php echo SERVER_URL; ?>user-new/">
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
    <?php
}
?>

<!-- Content -->
<div class="container-fluid">
    <?php
    $insUserController = new UserController();

    $query = $insUserController->queryDataUserController(
        'Unique',
        $_SESSION['currentPage'][1]
    );

    if ($query->rowCount() == 1) {
        $fields = $query->fetch();
        ?>
        <form
            class="form-neon ajax-form"
            action="<?php echo SERVER_URL; ?>endpoint/user-ajax/"
            method="POST"
            data-form="update"
            autocomplete="off"
        >
            <input
                type="hidden"
                name="usuario_id_upd"
                value="<?php echo $_SESSION['currentPage'][1]; ?>"
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
                                    name="usuario_dni_upd"
                                    id="usuario_dni"
                                    maxlength="10"
                                    value="<?php echo $fields[0]; ?>"
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
                                    Nombre
                                </label>
                                <input
                                    type="text"
                                    pattern="<?php echo RNLN; ?>"
                                    class="form-control"
                                    name="usuario_nombre_upd"
                                    id="usuario_nombre"
                                    maxlength="35"
                                    value="<?php echo $fields[1]; ?>"
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
                                    name="usuario_apellido_upd"
                                    id="usuario_apellido"
                                    maxlength="35"
                                    value="<?php echo $fields[2]; ?>"
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
                                    name="usuario_telefono_upd"
                                    id="usuario_telefono"
                                    maxlength="20"
                                    value="<?php echo $fields[3]; ?>"
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
                                    name="usuario_direccion_upd"
                                    id="usuario_direccion"
                                    maxlength="190"
                                    value="<?php echo $fields[4]; ?>"
                                >
                            </div>
                        </div>

                        // show the fallowing options if user privilege is iqual to 1 (admin)
                        <?php
                        if ($_SESSION['privilegio_spm'] == 1) {
                            ?>
                            <div class="col-12">
                                <div class="form-group bmd-form-group">
                                    <select
                                        class="form-control"
                                        name="usuario_perfil_upd"
                                        id="usuario_perfil"
                                    >
                                    <?php
                                    if (is_null($fields[5])) {
                                        ?>
                                        <option
                                            value="Seleccione"
                                            selected=""
                                            disabled=""
                                        >
                                            Seleccione un perfil
                                        </option>
                                        <?php
                                    } else {
                                        ?>
                                        <option
                                            value="<?php echo  $fields[5]; ?>" 
                                            selected=""
                                        >
                                            <?php echo  $fields[5]; ?>
                                        </option>
                                        <?php
                                    }

                                    $profiles = null;

                                    $query = $insUserController->queryPerfilListUserModel();
                                    if ($query->rowCount() > 0) {
                                        $profiles = $query->fetchAll();
                                    }

                                        if (!is_null($profiles)) {
                                            foreach($profiles as $profile) {
                                                if ($fields['usuario_perfil_id'] != $profile['perfil_id']) {
                                                    echo '<option value="' . $profile['perfil_nombre'] . '">' . $profile['perfil_nombre'] . '</option>';
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </fieldset>
            <br><br><br>
            <fieldset>
                <legend><i class="fas fa-user-lock"></i> &nbsp; Información de la cuenta</legend>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="usuario_usuario" class="bmd-label-floating">Nombre de usuario</label>
                                <input
                                    type="text"
                                    pattern="[a-zA-Z0-9]{1,35}"
                                    class="form-control"
                                    name="usuario_usuario_upd"
                                    id="usuario_usuario"
                                    maxlength="35"
                                    value="<?php echo $fields['usuario_usuario']; ?>"
                                >
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="usuario_email" class="bmd-label-floating">Email</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    name="usuario_email_upd"
                                    id="usuario_email"
                                    maxlength="70"
                                    value="<?php echo $fields['usuario_email']; ?>"
                                >
                            </div>
                        </div>
                        <?php if ($_SESSION['privilegio_spm'] == 1 && $fields['usuario_id'] != 1) { ?> <!-- Show the fallowing options if user privilege is iqual to 1 (admin) -->
                        <div class="col-12">
                            <div class="form-group">
                                <span>Estado de la cuenta  &nbsp; <?php echo ($fields['usuario_estado'] == "Activa") ? '<span class="badge badge-info">Activa</span>' : '<span class="badge badge-danger">Deshabilitada</span>'; ?></span>
                                <select class="form-control" name="usuario_estado_upd">
                                    <?php
                                    if ($fields['usuario_estado'] == "Activa") {
                                        echo '<option value="Activa" selected="">Activa</option>';
                                        echo '<option value="Deshabilitada">Deshabilitada</option>';
                                    } else {
                                        echo '<option value="Activa">Activa</option>';
                                        echo '<option value="Deshabilitada" selected="" >Deshabilitada</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </fieldset>
            <br><br><br>
            <fieldset>
                <legend style="margin-top: 40px;"><i class="fas fa-lock"></i> &nbsp; Nueva contraseña</legend>
                <p>Para actualizar la contraseña de esta cuenta ingrese una nueva y vuelva a escribirla. En caso que no desee actualizarla debe dejar vacíos los dos campos de las contraseñas.</p>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="usuario_clave_nueva_1" class="bmd-label-floating">Contraseña</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    name="usuario_clave_nueva_1_upd"
                                    id="usuario_clave_nueva_1"
                                    pattern="^(?=(?:.*\d))(?=.*[A-Z])(?=.*[a-z])(?=.*[.,*!?¿¡\/#$%&])\S{8,16}$"
                                    maxlength="16"
                                    required
                                >
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="usuario_clave_nueva_2" class="bmd-label-floating">Repetir contraseña</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    name="usuario_clave_nueva_2_upd"
                                    id="usuario_clave_nueva_2"
                                    pattern="^(?=(?:.*\d))(?=.*[A-Z])(?=.*[a-z])(?=.*[.,*!?¿¡\/#$%&])\S{8,16}$" maxlength="16"
                                    required
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>

            <?php if ($_SESSION['privilegio_spm'] == 1 && $fields['usuario_id'] != 1) { ?> <!-- Show the fallowing options if user privilege is iqual to 1 (admin) -->
            <br><br><br>
            <fieldset>
                <legend><i class="fas fa-medal"></i> &nbsp; Nivel de privilegio</legend>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <p><span class="badge badge-info">Control total</span> Permisos para registrar, actualizar y eliminar</p>
                            <p><span class="badge badge-success">Edición</span> Permisos para registrar y actualizar</p>
                            <p><span class="badge badge-dark">Registrar</span> Solo permisos para registrar</p>
                            <div class="form-group">
                                <select class="form-control" name="usuario_privilegio_upd">
                                    <option value="" <?php echo (is_null($fields['usuario_privilegio'])) ? 'selected=""' : ''; ?> disabled="">Seleccione una opción</option>
                                    <option value="1" <?php if ($fields['usuario_privilegio'] == 1) { echo 'selected=""'; } ?>>Control total <?php if ($fields['usuario_privilegio'] == 1) { echo '(Actual)'; } ?></option>
                                    <option value="2" <?php if ($fields['usuario_privilegio'] == 2) { echo 'selected=""'; } ?>>Edición <?php if ($fields['usuario_privilegio'] == 2) { echo '(Actual)'; } ?></option>
                                    <option value="3" <?php if ($fields['usuario_privilegio'] == 3) { echo 'selected=""'; } ?>>Registrar <?php if ($fields['usuario_privilegio'] == 3) { echo '(Actual)'; } ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <?php } ?>

            <br><br><br>
            <fieldset>
                <p class="text-center">Para poder guardar los cambios en esta cuenta debe de ingresar su nombre de usuario y contraseña</p>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="usuario_admin" class="bmd-label-floating">Nombre de usuario</label>
                                <input
                                    type="text"
                                    pattern="[a-zA-Z0-9]{1,35}"
                                    class="form-control"
                                    name="usuario_admin"
                                    id="usuario_admin"
                                    maxlength="35"
                                    required
                                >
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="clave_admin" class="bmd-label-floating">Contraseña</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    name="clave_admin"
                                    id="clave_admin"
                                    pattern="^(?=(?:.*\d))(?=.*[A-Z])(?=.*[a-z])(?=.*[.,*!?¿¡\/#$%&])\S{8,16}$"
                                    maxlength="16"
                                    required
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <?php if ($insLoginController->encrypt_data($_SESSION['id_spm']) != $current_page[1]) { ?>
            <input type="hidden" name="account_type" value="Impropia">
            <?php } else { ?>
            <input type="hidden" name="account_type" value="Propia">
            <?php } ?>
            <p class="text-center" style="margin-top: 40px;">
                <button type="submit" class="btn btn-raised btn-success btn-sm"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALIZAR</button>
            </p>
        </form>
        <?php
    } else {
    ?>
    <div class="alert alert-danger text-center" role="alert">
        <p><i class="fas fa-exclamation-triangle fa-5x"></i></p>
        <h4 class="alert-heading">¡Ocurrió un error inesperado!</h4>
        <p class="mb-0">Lo sentimos, no podemos mostrar la información solicitada debido a un error.</p>
    </div>
    <?php
    }
    ?>
</div>

