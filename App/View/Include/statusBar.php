<?php
/**
 * StatusBar
 * Contents of the StatusBar
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

<footer class="fixed-bottom status-bar">
    <div class="full-box">
        USUARIO:
        <?php
        echo strtoupper($_SESSION['nombre_spm'])
        . ' '
        . strtoupper($_SESSION['apellido_spm']);
        ?>
    </div>
</footer>
