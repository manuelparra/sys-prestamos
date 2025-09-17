<?php
/**
 * 404 View.
 * Contents of 404 View.
 * PHP version 8.2.0
 *
 * @category View
 * @package  ViewContent
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  CVS: <1.0.0>
 * @link     manuelparra.dev
 */

if (!defined('__ROOT__')) {
    header("Location: /login/");
    exit; // exit if accessed directly
}
?>

<!-- Contents -->
<div class="full-box container-404">
    <div>
        <p class="text-center">
            <i class="fas fa-rocket fa-10x"></i>
        </p>
        <h1 class="text-center">
            ERROR 404
        </h1>
        <p class="lead text-center">
            Página no encontrada
        </p>
    </div>
</div>
