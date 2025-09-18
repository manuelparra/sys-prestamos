<?php

/**
 * Config
 * All functionality pertaining to App Config.
 * PHP version 8.3.14
 *
 * @category Config
 * @package  Config
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  CVS: <1.0.0>
 * @link     manuelparra.dev
 */

if (!defined('__ROOT__')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

// Laod the security config

require_once __ROOT__ . '/App/Config/security.php';

// Local Enviroment (Linux), comment this lines if you put this files in a
// production environment
//const SERVER_URL = "http://prestamos.com";
//const ERROR_DIR = "/var/www/html/learning/fullstack/php/mvc/prestamos/logs";

// Local Enviroment (macOS), comment this lines if you put this files in a
// production environment,
const SERVER_URL = "https://prestamos:8890";
const ERROR_DIR = "/Users/manuel/Sites/prestamos/logs";

// Production Enviroment, comment this lines if you put this files in a developer
// environment
//const SERVER_URL = "https://prestamos.desliate.com";
//const ERROR_DIR = "/var/www/desliate.com/prestamos/logs/";

// Variables globales
global $currentPage;

// Constantes del sistema
const COMPANY = "Sistema de Prestamos";
const MONEDA = "€";

date_default_timezone_set("Europe/Madrid");
