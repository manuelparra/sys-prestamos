<?php
/**
 * Index File
 * Contents of the Index File. All functionality pertaining to App Config.
 * PHP version 8.3.14
 *
 * @category Config
 * @package  Config
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  CVS: <1.0.0>
 * @link     manuelparra.dev
 */

/*--- ROOT Path of the proyect. ---*/
if (!defined('__ROOT__')) {
    define('__ROOT__', dirname(__FILE__));
}

// Autoloader Reister
spl_autoload_register(
    function ($class) {
        $path = __DIR__.'/'.str_replace('\\', '/', $class).'.php';
        include_once $path;
    }
);

require_once __ROOT__ . "/App/Config/app.php";

use App\Controller\EndpointController;
use App\Controller\ViewController;

if (isset($_GET['endpoint'])) {
    $endopointreq = new EndpointController();
    $endopoint = $endopointreq->getEndpointController($_GET['endpoint']);

    include_once $endopoint;
}

$template = new ViewController();
$template->getTemplateController();
