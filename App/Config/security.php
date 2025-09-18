<?php

/**
 * Config
 * All functionality pertaining to App Security.
 * PHP version 8.3.14
 *
 * @category Config
 * @package  Security
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  CVS: <1.0.0>
 * @link     manuelparra.dev
 */

if (!defined('__ROOT__')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}


// Constantes de patrones de validación
// Para el código
const RCOD = "[a-zA-Z0-9-]{1,45}";

// Para el nombre de la Empresa
const RBNAME = "[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9¿? ]{1,140}";

// Para el NIF de la empresa
const RBNIF = "[AB0-9]{9}";

// Para el nombre del Item
const RNAME = "[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9¿? ]{1,150}";

// Para el stock del Item
const RSTOCK = "[0-9]{1,9}";

// Para el estado
const RESTADO = "[a-zA-Z]{1,15}";

// Para el detalle
const RDETALLE = "[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}";

// Para el DNI
const RDNI = "^[XYZ]?\d{5,8}[A-HJ-NP-TV-Z]$";
const RDNIHTML = "^(?:\d{8}[A-HJ-NP-TV-Z]|[XYZ]\d{7}[A-HJ-NP-TV-Z])$";

// Para el nombre y el apellido
const RNLN = "[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}";

// Para el teléfono
const RPHONE = "[0-9()+]{9,20}";
const RPHONEHTML = "[0-9\(\)+]{9,20}";

// Para la dirección
const RADDR = "[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}";
const RADDRHTML = "[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\(\).,#\- ]{1,190}";

// Para la dirección de email
const REMAIL = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$";
const REMAILHTML = "[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$";

// Para el nombre de usuario
const RUSER = "[a-zA-Z0-9]{1,35}";

// Para la clave de usuario
const RPASS = "^(?=(?:.*\d))(?=.*[A-Z])(?=.*[a-z])(?=.*[.,*!?¿¡\/#$%&])\S{8,16}$";
