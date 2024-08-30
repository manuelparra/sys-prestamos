<?php
/**
 * Layout Template view
 * Contents of the Layout Template view.
 * PHP version 8.2.0
 *
 * @category Layout
 * @package  Layout
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  GIT: 1.0.0
 * @link     manuelparra.dev
 */

use App\Controller\{ViewController, LoginController};

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta
            name="viewport"
            content="width=device-width,
            user-scalable=no,
            initial-scale=1.0,
            maximum-scale=1.0, minimum-scale=1.0"
        >
        <title><?php echo COMPANY; ?></title>

        <!--=============================================
        =            Include CSS files           =
        ==============================================-->

        <?php require "./App/View/Include/links.php"; ?>
    </head>
    <body>
        <?php
        // $IV, instanacia de la vista
        $IV = new ViewController();

        $view = $IV->getViewController();

        if ($view == "login" || $view == "404") {
            include_once "./App/View/Content/" . $view . "-view.php";
        } else {
            session_start(['name'=>'SPM']);

            $_SESSION['currentPage'] = explode("/", $_GET['view']);

            $insLoginController = new LoginController();

            if (!isset($_SESSION['token_spm']) || !isset($_SESSION['usuario_spm'])
                || !isset($_SESSION['privilegio_spm']) || !isset($_SESSION['id_spm'])
            ) {
                echo $insLoginController->forceCloseSessionController();
                exit; // Exit after force to close session
            }
            ?>

            <!-- Main container -->
            <main class="full-box main-container">
                <!-- Nav lateral -->
                <?php include  "./App/View/Include/navLateral.php"; ?>
                <!-- Page content -->
                <section class="full-box page-content">
                    <!-- Nav Bar and the View -->
                    <?php
                        include "./App/View/Include/navBar.php";
                        include $view;
                    ?>
                </section>
            </main>

            <?php
            include "./App/View/Include/logout.php";
        }
        ?>
        <!--=============================================
        =            Include JavaScript files           =
        ==============================================-->
        <?php require "./App/View/Include/scripts.php"; ?>
    </body>
</html>
