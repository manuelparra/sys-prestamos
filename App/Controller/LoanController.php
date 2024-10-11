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

    /**
     * Function for paginator loan reservation cotroller
     *
     * @param $page      contains string
     * @param $records   contains string
     * @param $privilage contains string
     * @param $url       contains string
     * @param $search    contains string
     *
     * @return string
     */
    public function paginatorLoanReservationController(
        $page,
        $records,
        $privilage,
        $url,
        $search
    ): string {
        $page = LoanModel::cleanString($page);
        $records = LoanModel::cleanString($records);
        $privilage = LoanModel::cleanString($privilage);

        $url = LoanModel::cleanString($url);
        $url = SERVER_URL . $url . "/";

        $search = LoanModel::cleanString($search);

        $table = "";
        $html = "";

        $page = (isset($page) && $page > 0) ? (int) $page : 1;

        $start = $page > 0 ? (($page * $records) - $records) : 0;

        if (isset($search) && $search != "") {
            $sql = "SELECT SQL_CALC_FOUND_ROWS *
            FROM prestamo
            WHERE prestamo_fecha_inicio LIKE '%$search%'
            ORDER BY prestamo_fecha_inicio ASC
            LIMIT $start, $records";;
        } else {
            $sql = "SELECT SQL_CALC_FOUND_ROWS *
                    FROM prestamo
                    ORDER BY prestamo_fecha_inicio ASC
                    LIMIT $start, $records";
        }

        $dbcnn = LoanModel::connection();

        $query = $dbcnn->query($sql);
        $rows = $query->fetchAll();

        $total = $dbcnn->query("SELECT FOUND_ROWS()");
        $total = (int) $total->fetchColumn();

        $nPages = ceil($total / $records);

        $table .= '';
    }
}
