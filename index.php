<?php
/**
 * Index File
 * Contents of the Index File. All functionality pertaining to App Config.
 * PHP version 8.2.0
 *
 * @category Config
 * @package  Config
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  CVS: <1.0.0>
 * @link     manuelparra.dev
 */

/*--- ABS Path of the proyect. ---*/
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

require_once "./config/app.php";

if (isset($_GET['endpoint'])) {
    include_once "./controllers/endpointController.php";

    $endopointreq = new EndpointController();
    $endopoint = $endopointreq->getEndpointController($_GET['endpoint']);

    include_once $endopoint;
}

require_once "./controllers/viewController.php";

$template = new ViewController();
$template->getTemplateController();
