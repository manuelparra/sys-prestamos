<?php
/**
 * Loan Controller
 * All functionality pertaining to Loan Controller.
 * PHP version 8.2.0
 *
 * @category Controller
 * @package  Controller
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  GIT: 1.0.0
 * @link     manuelparra.dev
 */

namespace App\Controller;

use App\Model\LoanModel;

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

/**
 * Class Loan Controller
 *
 * @category   Controller
 * @package    LoanController
 * @subpackage LoanController
 * @author     Manuel Parra <manuelparra@live.com.ar>
 * @license    MIT <https://mit.org>
 * @link       https://manuelparra.dev
 */
class LoanController extends LoanModel
{

}
