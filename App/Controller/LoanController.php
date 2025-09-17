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

if (!defined('__ROOT__')) {
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
     * @param $privilege contains string
     * @param $url       contains string
     * @param $search    contains string
     *
     * @return string
     */
    public function paginatorLoanReservationController(
        $page,
        $records,
        $privilege,
        $url,
        $search
    ): string {
        $page = LoanModel::cleanString($page);
        $records = LoanModel::cleanString($records);
        $privilege = LoanModel::cleanString($privilege);

        $url = LoanModel::cleanString($url);
        $url = SERVER_URL . "/" . $url . "/";

        $search = LoanModel::cleanString($search);

        $table = "";
        $html = "";

        $page = (isset($page) && $page > 0) ? (int) $page : 1;

        $start = $page > 0 ? (($page * $records) - $records) : 0;

        if (isset($search) && $search != "") {
            $sql = "SELECT SQL_CALC_FOUND_ROWS prestamo.*,
                    cliente.cliente_nombre,
                    cliente.cliente_apellido
                    FROM prestamo
                    LEFT JOIN cliente
                    ON prestamo.cliente_id = cliente.cliente_id
                    WHERE prestamo_fecha_inicio LIKE '%$search%'
                    ORDER BY prestamo_fecha_inicio ASC
                    LIMIT $start, $records";
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

        $table .= '
            <div class="table-responsive">
                <table class="table table-dark table-sm">
                    <thead>
                        <tr class="text-center roboto-medium">
                            <th>#</th>
                            <th>CLIENTE</th>
                            <th>FECHA DE PRÉSTAMO</th>
                            <th>FECHA DE ENTREGA</th>
                            <th>TIPO</th>
                            <th>ESTADO</th>
                            <th>FACTURA</th>
        ';
        if ($privilege == 1 || $privilege == 2) {
            $table .= '
                            <th>ACTUALIZAR</th>
            ';
        }

        if ($privilege == 1) {
            $table .= '
                            <th>ELIMINAR</th>
            ';
        }

        $table .= '
                        </tr>
                    </thead>
                    <body>
        ';

        if ($total >= 1 && $page <= $nPages) {
            $count = $start + 1;
            $startRecord = $start + 1;

            foreach ($rows as $row) {
                $cliente = $row['cliente_nombre'] . " " . $row['cliente_apellido'];
                $table .= '
                        <tr class="text-center">
                            <td> ' . $count . '</td>
                            <td> ' . $cliente . '</td>
                            <td> ' . $row['prestamo_fecha_inicio'] . '</td>
                            <td> ' . $row['prestamo_fecha_final'] . '</td>
                            <td>
                                <span class="badge badge-warning">'
                                    . 'Reservación' . '
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-danger">'
                                    . $row['prestamo_estado'] . '
                                </span>
                            </td>
                            <td>
                                <a href="#" class="btn btn-info">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                            </td>
                ';
                if ($privilege == 1 || $privilege == 2) {
                    $table .= '
                            <td>
                                <a
                                    href="' . SERVER_URL . '/lean-update/"' .
                                    LoanModel::encryption($row['prestamo_id']) .
                                    '/"
                                    class="btn btn-success"
                                >
                                    <i class="fas fa-sync-alt"></i>
                                </a>
                            </td>
                    ';
                }
                if ($privilege == 1) {
                    $table .= '
                            <td>
                                <form
                                    class="ajax-form"
                                    action="' . SERVER_URL . '/endpoint/item-ajax/"
                                    method="POST"
                                    data-form="delete"
                                    autocomplete="off"
                                >
                                    <input
                                        type="hidden"
                                        name="load_id_del" value="' .
                                        LoanModel::encryption($row['prestamo_id']) .
                                        '"
                                    />
                                    <button
                                        type="submit"
                                        class="btn bnt-warning"
                                    >
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                    ';
                }
                $table .= '
                        </tr>
                ';

                $count++;
            }

            $endRecord = $count - 1;
        } else {
            if ($total >= 1) {
                $table .= '
                        <tr class="text-center">
                            <td colspan="9">
                                <a
                                    href="' . $url . '"
                                    class="btn btn-primary btn-raised btn-sm"
                                >
                                    Haga clic aquí para recargar el listado
                                </a>
                            </td>
                        </tr>
                ';
            } else {
                $table .= '
                        <tr class="text-center">
                            <td colspan="9">
                                No se encontraron registros de items en el sistema
                            </td>
                        </tr>
                ';
            }
        }

        $table .= '
                    </tbody>
                </table>
            </div>
        ';

        $buttons = 5;
        $totalButtons = $nPages >= $buttons ? $buttons : $nPages;

        $html = $table;

        if ($total >= 1 && $page <= $nPages) {
            $html .= '
                <p class="text-right">
                    Mostrando item(s): ' .
                $startRecord .
                ' al ' .
                $endRecord .
                ' de un total de ' .
                $total .
                '</p>
            ';

            $html .= LoanModel::paginationTables(
                $page,
                $nPages,
                $url,
                $totalButtons
            );
        }

        return $html;
    }

    /**
     * Function to send messenge loan
     *
     * @param $alert contians string
     * @param $type  contians string
     * @param $title contians string
     * @param $text  contians string
     *
     * @return object
     */
    public function messageLoanController(
        $alert,
        $type,
        $title,
        $text
    ): string {
        return LoanModel::messageWithParameters(
            $alert,
            $type,
            $title,
            $text
        );
    }
}
