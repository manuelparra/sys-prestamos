<?php
/**
 * Home View.
 * Contents of the Home page view.
 * PHP version 8.2.0
 *
 * @category View
 * @package  ViewContent
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  CVS: <1.0.0>
 * @link     manuelparra.dev
 */

use App\Controller\{
    ClientController,
    ItemController,
    BusinessController,
    UserController
};
?>

<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fab fa-dashcube fa-fw"></i> &nbsp; DASHBOARD
    </h3>
    <p class="text-justify">
        Sistema para la gestión de prestamos, este es el panel principal del
        sistema, en esta vista puede seleccionar cualquiera de las opciones
        que se muestran.
    </p>
</div>

<!-- Content -->
<div class="full-box tile-container">
    <?php
    $instClientController = new ClientController();

    $query = $instClientController->queryDataClientController("Count");

    $word = $query->rowCount() > 0 ? "Registros" : "Registro";
    ?>

    <a href="<?php echo SERVER_URL; ?>client-list/" class="tile">
        <div class="tile-tittle">Clientes</div>
        <div class="tile-icon">
            <i class="fas fa-users fa-fw"></i>
            <p>
                <?php
                echo $query->rowCount();
                ?>&nbsp;<?php echo $word; ?>
            </p>
        </div>
    </a>

    <?php
    $instItemController = new ItemController();

    $query = $instItemController->queryDataItemController("Count");
    $word = $query->rowCount() > 0 ? "Registros" : "Registro";
    ?>

    <a href="<?php echo SERVER_URL; ?>item-list/" class="tile">
        <div class="tile-tittle">Items</div>
        <div class="tile-icon">
            <i class="fas fa-pallet fa-fw"></i>
            <p>
                <?php
                echo $query->rowCount();
                ?>&nbsp;<?php echo $word; ?>
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
        $insUserController = new UserController();

        $query = $insUserController->queryDataUserController("Count");
        $word = $query->rowCount() > 0 ? "Registros" : "Registro";
        ?>

        <a href="<?php echo SERVER_URL; ?>user-list/" class="tile">
            <div class="tile-tittle">Usuarios</div>
            <div class="tile-icon">
                <i class="fas fa-user-secret fa-fw"></i>
                <p>
                    <?php
                    echo $query->rowCount();
                    ?>&nbsp;<?php echo $word; ?>
                </p>
            </div>
        </a>
        <?php
    }
    ?>

    <?php
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
