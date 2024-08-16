<?php
/**
 * Contents of Client Data Update view
 *
 * Contents of the user Data Update page view.
 *
 * @package View
 * @author Manuel Parra
 * @version 1.0.0
 */

if ($_SESSION['privilegio_spm'] != 1 && $_SESSION['privilegio_spm'] != 2) {
    echo $insLoginController->force_close_session_controller();
    exit;
}
?>

<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-sync-alt fa-fw"></i> &nbsp; ACTUALIZAR CLIENTE
    </h3>
    <p class="text-justify">
        Esta vista permite la modificación de los datos de clientes del sistema, puede modificar los datos del usuario.
    </p>
</div>

<?php if ($_SESSION['privilegio_spm'] == 1 || $_SESSION['privilegio_spm'] == 2) { ?> <!-- Show the fallowing options if the user privilege is iqual to 1 (admin) or 2 register and edit -->
<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="<?php echo SERVER_URL; ?>client-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR CLIENTE</a>
        </li>
        <li>
            <a href="<?php echo SERVER_URL; ?>client-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE CLIENTES</a>
        </li>
        <li>
            <a href="<?php echo SERVER_URL; ?>client-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR CLIENTE</a>
        </li>
    </ul>
</div>
<?php } ?>

<!-- Content -->
<div class="container-fluid">
    <?php
    require_once "./controllers/clientController.php";
    $insClientController = new clientController();

    $query = $insClientController->query_data_client_controller('Unique', $current_page[1]);

    if ($query->rowCount() == 1) {
        $fields = $query->fetch();
    ?>
    <form class="form-neon ajax-form" action="<?php echo SERVER_URL; ?>endpoint/client-ajax/" method="POST" data-form="update" autocomplete="off">
        <input type="hidden" name="cliente_id_upd" value="<?php echo $current_page[1]; ?>">
        <fieldset>
            <legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label for="cliente_dni" class="bmd-label-floating">DNI</label>
                            <input type="text" pattern="[0-9]{8}[\-]{1}[TRWAGMYFPDXBNJZSQVHLCKE]{1}" class="form-control" name="cliente_dni_upd"
                            id="cliente_dni" maxlength="10" value="<?php echo $fields['cliente_dni']; ?>" required >
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="form-group">
                            <label for="cliente_nombre" class="bmd-label-floating">Nombre</label>
                            <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="cliente_nombre_upd"
                            id="cliente_nombre" maxlength="35" value="<?php echo $fields['cliente_nombre']; ?>" required >
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="form-group">
                            <label for="cliente_apellido" class="bmd-label-floating">Apellidos</label>
                            <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="cliente_apellido_upd"
                            id="cliente_apellido" maxlength="35" value="<?php echo $fields['cliente_apellido']; ?>" required >
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="cliente_telefono" class="bmd-label-floating">Teléfono</label>
                            <input type="text" pattern="[0-9()+]{9,20}" class="form-control" name="cliente_telefono_upd"
                            id="cliente_telefono" maxlength="20" value="<?php echo $fields['cliente_telefono']; ?>" required >
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="cliente_email" class="bmd-label-floating">Email</label>
                            <input type="email" patter="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" name="cliente_email_upd"
                            id="cliente_email" maxlength="70" value="<?php echo $fields['cliente_email']; ?>" required >
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="cliente_direccion" class="bmd-label-floating">Dirección</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="cliente_direccion_upd"
                            id="cliente_direccion" maxlength="190" value="<?php echo $fields['cliente_direccion']; ?>" required >
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <br><br><br>
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
