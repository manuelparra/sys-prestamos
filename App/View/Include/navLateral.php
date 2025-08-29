<?php
/**
 * NavLateral
 * Contents of the NavLateral
 * PHP version 8.2.0
 *
 * @category View
 * @package  ViewLayout
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  CVS: <1.0.0>
 * @link     manuelparra.dev
 */
?>

<section class="full-box nav-lateral">
    <div class="full-box nav-lateral-bg show-nav-lateral"></div>
    <div class="full-box nav-lateral-content">
        <nav class="full-box nav-lateral-menu">
            <ul>
                <li>
                    <a href="<?php echo SERVER_URL; ?>home/">
                        <i class="fab fa-dashcube fa-fw"></i>
                        &nbsp;Dashboard
                    </a>
                </li>

                <li>
                    <a href="#" class="nav-btn-submenu">
                        <i class="fas fa-users fa-fw"></i>
                        &nbsp;Clientes
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo SERVER_URL; ?>client-new/">
                                <i class="fas fa-plus fa-fw"></i>
                                &nbsp;Agregar Cliente
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SERVER_URL; ?>client-list/">
                                <i class="fas fa-clipboard-list fa-fw"></i>
                                &nbsp;Lista de clientes
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SERVER_URL; ?>client-search/">
                                <i class="fas fa-search fa-fw"></i>
                                &nbsp;Buscar cliente
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#" class="nav-btn-submenu">
                        <i class="fas fa-pallet fa-fw"></i>
                        &nbsp;Items
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo SERVER_URL; ?>item-new/">
                                <i class="fas fa-plus fa-fw"></i>
                                &nbsp;Agregar item
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SERVER_URL; ?>item-list/">
                                <i class="fas fa-clipboard-list fa-fw"></i>
                                &nbsp;Lista de items
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SERVER_URL; ?>item-search/">
                                <i class="fas fa-search fa-fw"></i>
                                &nbsp;Buscar item
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#" class="nav-btn-submenu">
                        <i class="fas fa-file-invoice-dollar fa-fw"></i>
                        &nbsp;Préstamos
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo SERVER_URL; ?>loan-new/">
                                <i class="fas fa-plus fa-fw"></i>
                                &nbsp;Nuevo préstamo
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SERVER_URL; ?>loan-reservation/">
                                <i class="far fa-calendar-alt fa-fw"></i>
                                &nbsp;Reservaciones
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SERVER_URL; ?>loan-pending/">
                                <i class="fas fa-hand-holding-usd fa-fw"></i>
                                &nbsp;Préstamos
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SERVER_URL; ?>loan-list/">
                                <i class="fas fa-clipboard-list fa-fw"></i>
                                &nbsp;Finalizados
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SERVER_URL; ?>loan-search/">
                                <i class="fas fa-search-dollar fa-fw"></i>
                                &nbsp;Buscar por fecha
                            </a>
                        </li>
                    </ul>
                </li>

                <?php
                if ($_SESSION['privilegio_spm'] == 1) {
                    ?>
                    <li>
                        <a href="#" class="nav-btn-submenu">
                            <i class="fas  fa-user-secret fa-fw"></i>
                            &nbsp;Usuarios
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="<?php echo SERVER_URL; ?>user-new/">
                                    <i class="fas fa-plus fa-fw"></i>
                                    &nbsp;Nuevo usuario
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo SERVER_URL; ?>user-list/">
                                    <i class="fas fa-clipboard-list fa-fw"></i>
                                    &nbsp;Lista de usuarios
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo SERVER_URL; ?>user-search/">
                                    <i class="fas fa-search fa-fw"></i>
                                    &nbsp;Buscar usuario
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo SERVER_URL; ?>company/">
                            <i class="fas fa-store-alt fa-fw"></i>
                            &nbsp;Empresa
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </nav>
    </div>
</section>
