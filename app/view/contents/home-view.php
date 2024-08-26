<?php
/**
 * Contents of Home view.
 * Contents of the Home page view.
 * PHP version 8.2.0
 *
 * @category Config
 * @package  Config
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  CVS: <1.0.0>
 * @link     manuelparra.dev
 */
?>

<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fab fa-dashcube fa-fw"></i> &nbsp; DASHBOARD
    </h3>
    <p class="text-justify">
        Sistema para la gestión de prestamos, este es el panel principal del
        sistema, en esta vista puede seleccionar cualquiera de las opciones
        que se muestran a continuación.
    </p>
</div>

<!-- Content -->
<div class="full-box tile-container">
    <?php
    require_once "./controllers/clientController.php";
    $instClientController = new ClientController();

    $query = $instClientController->queryDataClientController("Count");
    ?>

    <a href="<?php echo SERVER_URL; ?>client-list/" class="tile">
        <div class="tile-tittle">Clientes</div>
        <div class="tile-icon">
            <i class="fas fa-users fa-fw"></i>
            <p>
                <?php
                echo $query->rowCount();
                ?>&nbsp;Registro
                <?php
                if ($query->rowCount() > 1) {
                    echo 's';
                }
                ?>
            </p>
        </div>
    </a>

    <?php
    require_once "./controllers/itemController.php";
    $instItemController = new ItemController();

    $query = $instItemController->queryDataItemController("Count");
    ?>

    <a href="<?php echo SERVER_URL; ?>item-list/" class="tile">
        <div class="tile-tittle">Items</div>
        <div class="tile-icon">
            <i class="fas fa-pallet fa-fw"></i>
            <p>
                <?php
                echo $query->rowCount();
                ?>
                &nbsp;Registro
                <?php
                if ($query->rowCount() > 1) {
                    echo 's';
                }
                ?>
            </p>
        </div>
    </a>

    <a href="<?php echo SERVER_URL; ?>reservation-reservation/" class="tile">
        <div class="tile-tittle">Reservaciones</div>
        <div class="tile-icon">
            <i class="far fa-calendar-alt fa-fw"></i>
            <p>30 Registros</p>
        </div>
    </a>

    <a href="<?php echo SERVER_URL; ?>reservation-pending/" class="tile">
        <div class="tile-tittle">Prestamos</div>
        <div class="tile-icon">
            <i class="fas fa-hand-holding-usd fa-fw"></i>
            <p>200 Registros</p>
        </div>
    </a>

    <a href="<?php echo SERVER_URL; ?>reservation-list/" class="tile">
        <div class="tile-tittle">Finalizados</div>
        <div class="tile-icon">
            <i class="fas fa-clipboard-list fa-fw"></i>
            <p>700 Registros</p>
        </div>
    </a>

    <?php
    if ($_SESSION['privilegio_spm'] == 1) {
        include_once "./controllers/userController.php";

        $insUserController = new UserController();

        $query = $insUserController->queryDataUserController("Count");
        ?>

        <a href="<?php echo SERVER_URL; ?>user-list/" class="tile">
            <div class="tile-tittle">Usuarios</div>
            <div class="tile-icon">
                <i class="fas fa-user-secret fa-fw"></i>
                <p>
                    <?php
                    echo $query->rowCount();
                    ?>
                    &nbsp;Registro
                    <?php
                    if ($query->rowCount() > 1) {
                        echo 's';
                    }
                    ?>
                </p>
            </div>
        </a>
        <?php
    }
    ?>

    <?php
    require_once "./controllers/businessController.php";
    $instBusinessController = new BusinessController();

    $query = $instBusinessController->queryBusinessInformationController();
    ?>

    <a href="<?php echo SERVER_URL; ?>company/" class="tile">
        <div class="tile-tittle">Empresa</div>
        <div class="tile-icon">
            <i class="fas fa-store-alt fa-fw"></i>
            <p><?php echo $query->rowCount(); ?> Registro</p>
        </div>
    </a>
</div>
