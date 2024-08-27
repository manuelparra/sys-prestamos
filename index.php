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

// Autoloader Reister
spl_autoload_register(
    function ($className) {
        $path = __DIR__.'/'.str_replace('\\', '/', $className).'.php';
        include_once $path;
    }
);

require_once "./App/Config/app.php";

use App\Controller\ViewController;
use App\Controller\EndpointController;

if (isset($_GET['endpoint'])) {
    $endopointreq = new EndpointController();
    $endopoint = $endopointreq->getEndpointController($_GET['endpoint']);

    include_once $endopoint;
}

$template = new ViewController();
$template->getTemplateController();
