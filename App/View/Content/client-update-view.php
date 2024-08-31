<?php
/**
 * Client Update View.
 * Contents of Client Update View.
 * PHP version 8.2.0
 *
 * @category View
 * @package  ViewContent
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  CVS: <1.0.0>
 * @link     manuelparra.dev
 */

use App\Controller\{LoginController, ClientController};

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
        <i class="fas fa-sync-alt fa-fw"></i>
        &nbsp;ACTUALIZAR CLIENTE
    </h3>
    <p class="text-justify">
        Esta vista permite la modificación de los datos de clientes del sistema,
        puede modificar los datos del cliente.
    </p>
</div>

<?php
if ($_SESSION['privilegio_spm'] == 1
    || $_SESSION['privilegio_spm'] == 2
) {
    ?>
    <!-- Show the fallowing options if the user privilege
    is iqual to 1 (admin) or 2 register and edit -->
    <div class="container-fluid">
        <ul class="full-box list-unstyled page-nav-tabs">
            <li>
                <a href="<?php echo SERVER_URL; ?>client-new/">
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
    <?php
}
?>

<!-- Content -->
<div class="container-fluid">
    <?php
    $insClientController = new ClientController();

    $query = $insClientController->queryDataClientController(
        'Unique',
        $_SESSION['currentPage'][1]
    );

    if ($query->rowCount() == 1) {
        $fields = $query->fetch();
        ?>
        <form
            class="form-neon ajax-form"
            action="<?php echo SERVER_URL; ?>endpoint/client-ajax/"
            method="POST"
            data-form="update"
            autocomplete="off"
        >
            <input
                type="hidden"
                name="cliente_id_upd"
                value="<?php echo $_SESSION['currentPage'][1]; ?>"
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
                                    name="cliente_dni_upd"
                                    id="cliente_dni"
                                    maxlength="10"
                                    value="<?php echo $fields[1]; ?>"
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
                                    name="cliente_nombre_upd"
                                    id="cliente_nombre"
                                    maxlength="35"
                                    value="<?php echo $fields[2]; ?>"
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
                                    Apellidos
                                </label>
                                <input
                                    type="text"
                                    pattern="<?php echo RNLN; ?>"
                                    class="form-control"
                                    name="cliente_apellido_upd"
                                    id="cliente_apellido"
                                    maxlength="35"
                                    value="<?php echo $fields[3]; ?>"
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
                                    name="cliente_telefono_upd"
                                    id="cliente_telefono"
                                    maxlength="20"
                                    value="<?php echo $fields[4]; ?>"
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
                                    name="cliente_email_upd"
                                    id="cliente_email"
                                    maxlength="70"
                                    value="<?php echo $fields[5]; ?>"
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
                                    name="cliente_direccion_upd"
                                    id="cliente_direccion"
                                    maxlength="190"
                                    value="<?php echo $fields[6]; ?>"
                                    required
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <br><br><br>
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
    ?>
</div>
