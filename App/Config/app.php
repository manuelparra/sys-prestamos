<?php

/**
 * App Config
 * All functionality pertaining to App Config.
 * PHP version 8.2.0
 *
 * @category Config
 * @package  Config
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  CVS: <1.0.0>
 * @link     manuelparra.dev
 */

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}


// Local Enviroment (Linux), comment this lines if you put this files in a
// production environment
//const SERVER_URL = "http://prestamos.com/";
//const ERROR_DIR = "/var/www/html/learning/fullstack/php/mvc/prestamos/logs/";

// Local Enviroment (macOS), comment this lines if you put this files in a
// production environment,
const SERVER_URL = "https://prestamos.com/";
const ERROR_DIR = "/Users/manuel/Sites/prestamos/logs/";

// Production Enviroment, comment this lines if you put this files in a developer
// environment
//const SERVER_URL = "https://prestamos.desliate.com/";
//const ERROR_DIR = "/var/www/desliate.com/prestamos/logs/";

const COMPANY = "Sistema de Prestamos";
const MONEDA = "€";

// Constantes de patrones de validación
// for code
const RCOD = "[a-zA-Z0-9-]{1,45}";
// for business name
const RBNAME = "[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9¿? ]{1,140}";
// for business name
const RNAME = "[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9¿? ]{1,150}";
// for item stock
const RSTOCK = "[0-9]{1,9}";
// for estado
const RESTADO = "[a-zA-Z]{1,15}";
// for detalle
const RDETALLE = "[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}";
// for dni
const RDNI = "[0-9]{8}[-]{1}[TRWAechoGMYFPDXBNJZSQVHLCKE]{1}";
const RDNIHTML = "[0-9]{8}[\-]{1}[TRWAechoGMYFPDXBNJZSQVHLCKE]{1}";
// for name and last name
const RNLN = "[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}";
// for phone

const RPHONE = "[0-9()+]{9,20}";
const RPHONEHTML = "[0-9\(\)+]{9,20}";
// for address
const RADDR = "[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}";
const RADDRHTML = "[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\(\).,#\- ]{1,190}";
// for email
const REMAIL = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$";
// for user
const RUSER = "[a-zA-Z0-9]{1,35}";
// for password
const RPASS = "^(?=(?:.*\d))(?=.*[A-Z])(?=.*[a-z])(?=.*[.,*!?¿¡\/#$%&])\S{8,16}$";

date_default_timezone_set("Europe/Madrid");
