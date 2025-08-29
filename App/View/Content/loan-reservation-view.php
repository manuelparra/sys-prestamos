<?php
/**
 * Contents of Loan Reservation View.
 * Contents of the loan reservation view.
 * PHP version 8.2.0
 *
 * @category View
 * @package  ViewContent
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  CVS: <1.0.0>
 * @link     manuelparra.dev
 */

use App\Controller\LoanController;
?>

<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="far fa-calendar-alt fa-fw"></i>
        &nbsp;RESERVACIONES
    </h3>
    <p class="text-justify">
        Esta vista contiene el listado de todas las reservaciones registradas.
        Puede seleccionar una reservación para actualizarla, eliminarla o
        gestionar los préstamos.
    </p>
</div>

<!-- Navegation -->
<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="<?php echo SERVER_URL; ?>loan-new/">
                <i class="fas fa-plus fa-fw"></i>
                &nbsp;NUEVO PRÉSTAMO
            </a>
        </li>
        <li>
            <a class="active" href="<?php echo SERVER_URL; ?>loan-reservation/">
                <i class="far fa-calendar-alt"></i>
                &nbsp;RESERVACIONES
            </a>
        </li>
        <li>
            <a href="<?php echo SERVER_URL; ?>loan-pending/">
                <i class="fas fa-hand-holding-usd fa-fw"></i>
                &nbsp;PRÉSTAMOS
            </a>
        </li>
        <li>
            <a href="<?php echo SERVER_URL; ?>loan-list/">
                <i class="fas fa-clipboard-list fa-fw"></i>
                &nbsp;FINALIZADOS
            </a>
        </li>
        <li>
            <a href="<?php echo SERVER_URL; ?>loan-search/">
                <i class="fas fa-search-dollar fa-fw"></i>
                &nbsp;BUSCAR POR FECHA
            </a>
        </li>
    </ul>
</div>

<!-- Content -->
<div class="container-fluid">
    <?php
    $insLoanController = new LoanController();
    echo $insLoanController->paginatorLoanReservationController(
        $_SESSION['currentPage'][1],
        15,
        $_SESSION['privilegio_spm'],
        $_SESSION['currentPage'][0],
        ""
    );
    ?>
</div>
