<?php
/**
 * Contents of Company view.
 *
 * Contents of company page view.
 *
 * @package View
 * @author Manuel Parra
 * @version 1.0.0
 */

if ($_SESSION['privilegio_spm'] != 1) {
    echo $insLoginController->force_close_session_controller();
    exit;
}
?>

<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-building fa-fw"></i> &nbsp; INFORMACÓN DE LA EMPRESA
    </h3>
    <p class="text-justify">
        Esta vista permite registrar/modificar la información de la empresa, puede ingresar o actualizar los datos a continuación.
    </p>
</div>

<?php
require_once "./controllers/businessController.php";
$insBusinessController = new businessController();

$query = $insBusinessController->query_business_information_controller();

if ($query->rowCount() == 0 && $_SESSION['privilegio_spm'] == 1) {
?>

<!-- Content -->
<div class="container-fluid">
    <form class="form-neon ajax-form" action="<?php echo SERVER_URL; ?>endpoint/business-ajax/" method="POST"
    id="new_registration_form" data-form="save" autocomplete="off">
        <fieldset>
            <legend><i class="far fa-building"></i> &nbsp; Información de la empresa</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="empresa_nombre" class="bmd-label-floating">Nombre de la empresa</label>
                            <input type="text" pattern="[a-zA-z0-9áéíóúÁÉÍÓÚñÑ. ]{1,70}" class="form-control" name="empresa_nombre_reg" id="empresa_nombre" maxlength="70">
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="empresa_email" class="bmd-label-floating">Correo</label>
                            <input type="email" class="form-control" name="empresa_email_reg" id="empresa_email" maxlength="70">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="empresa_telefono" class="bmd-label-floating">Telefono</label>
                            <input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="empresa_telefono_reg" id="empresa_telefono" maxlength="20">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="empresa_direccion" class="bmd-label-floating">Dirección</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="empresa_direccion_reg" id="empresa_direccion" maxlength="190">
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <br><br><br>
        <p class="text-center" style="margin-top: 40px;">
            <button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
            &nbsp; &nbsp;
            <button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
        </p>
    </form>
</div>

<?php
} elseif ($query->rowCount() == 1 && ($_SESSION['privilegio_spm'] == 1 || $_SESSION['privilegio_spm'] == 2)) {
    $fields = $query->fetch();
?>

<div class="container-fluid">
    <form class="form-neon ajax-form" action="<?php echo SERVER_URL; ?>endpoint/business-ajax/" method="POST"
    id="update_registration_form" data-form="update" autocomplete="off">
        <input type="hidden" name="business_id_upd" value="<?php echo $fields['empresa_id']; ?>">
        <fieldset>
            <legend><i class="far fa-building"></i> &nbsp;Actualizar Información de la empresa</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="empresa_nombre" class="bmd-label-floating">Nombre de la empresa</label>
                            <input type="text" pattern="[a-zA-z0-9áéíóúÁÉÍÓÚñÑ. ]{1,70}" class="form-control" name="empresa_nombre_upd" id="empresa_nombre" maxlength="70" value="<?php echo $fields['empresa_nombre']; ?>">
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="empresa_email" class="bmd-label-floating">Correo</label>
                            <input type="email" class="form-control" name="empresa_email_upd" id="empresa_email" maxlength="70" value="<?php echo $fields['empresa_email']; ?>">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="empresa_telefono" class="bmd-label-floating">Telefono</label>
                            <input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="empresa_telefono_upd" id="empresa_telefono" maxlength="20" value="<?php echo $fields['empresa_telefono']; ?>">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="empresa_direccion" class="bmd-label-floating">Dirección</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="empresa_direccion_upd" id="empresa_direccion" maxlength="190" value="<?php echo $fields['empresa_direccion']; ?>">
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
</div>
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
