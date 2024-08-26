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

require_once "./vendor/autoload.php";
require_once "./app/config/app.php";

use App\Controller\ViewController;
use App\Controller\EndpointController;

/*--- ABS Path of the proyect. ---*/
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}


if (isset($_GET['endpoint'])) {
    $endopointreq = new EndpointController();
    $endopoint = $endopointreq->getEndpointController($_GET['endpoint']);

    include_once $endopoint;
}

$template = new ViewController();
$template->getTemplateController();
