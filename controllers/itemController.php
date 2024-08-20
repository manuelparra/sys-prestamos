<?php
/**
 * Item Controller
 *
 * All functionality pertaining to Item Controller.
 *
 * @package Controller
 * @author Manuel Parra
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

include_once "./models/itemModel.php";

/*--- Class Item Controller ---*/
class itemController extends itemModel {
    /*-- Controller's function for client pagination --*/
    public function paginator_item_controller($page, $records, $privilege, $url, $search) {
        $page = itemModel::clean_string($page);
        $records = itemModel::clean_string($records);
        $privilege = itemModel::clean_string($privilege);

        $url = itemModel::clean_string($url);
        $url = SERVER_URL . $url . "/";

        $search = itemModel::clean_string($search);

        $table = "";
        $html = "";

        $page = (isset($page) && $page > 0) ? (int) $page : 1;

        $start = $page > 0 ? (($page * $records) - $records) : 0;

        if (isset($search) && $search != "") {
            $sql = "SELECT SQL_CALC_FOUND_ROWS *
                    FROM item
                    WHERE item_codigo LIKE '%$search%'
                    OR item_nombre LIKE '%$search%'
                    OR cliente_apellido LIKE '%$search%'
                    ORDER BY item_nombre ASC
                    LIMIT $start, $records";

        } else {
            $sql = "SELECT SQL_CALC_FOUND_ROWS *
                    FROM item
                    ORDER BY item_nombre ASC
                    LIMIT $start, $records";
        }

        $dbcnn = itemModel::connection();

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
                        <th>CÓDIGO</th>
                        <th>NOMBRE</th>
                        <th>STOCK</th>
                        <th>DETALLE</th>';

        if ($privilege == 1 || $privilege == 2) {
            $table .= '<th>ACTUALIZAR</th>';
        }

        if ($privilege == 1) {
            $table .= '<th>ELIMINAR</th>';
        }

        $table .= ' </tr>
                </thead>
                <tbody>
        ';

        if ($total >= 1 && $page <= $nPages) {
            $count = $start + 1;
            $start_record = $start + 1;

            foreach ($rows as $row) {
                $table .= '
                <tr class="text-center" >
                    <td>' . $count . '</td>
                    <td>' . $row['item_codigo'] . '</td>
                    <td>' . $row['item_nombre'] . '</td>
                    <td>' . $row['item_stock'] . '</td>
                    <td>' . $row['item_detalle'] . '</td>
                    <td>
                        <button type="button" class="btn btn-info" data-toggle="popover" data-trigger="hover"
                        title="' . $row['cliente_nombre'] .' ' . $row['cliente_apellido'] . '" data-content="' . $row['cliente_direccion'] . '">
                            <i class="fas fa-info-circle"></i>
                        </button>
                    </td>';
                if ($privilege == 1 || $privilege == 2) {
                    $table .= '
                        <td>
                            <a href="' . SERVER_URL . 'client-update/' . itemModel::encryption($row['cliente_id'])  . '/" class="btn btn-success">
                                <i class="fas fa-sync-alt"></i>
                            </a>
                        </td>
                    ';
                }
                if ($privilege == 1) {
                    $table .= '
                        <td>
                            <form class="ajax-form"  action="' . SERVER_URL . 'endpoint/client-ajax/" method="POST" data-form="delete" autocomplete="off">
                                <input type="hidden" name="cliente_id_del" value="' . itemModel::encryption($row['cliente_id']) . '">
                                <button type="submit" class="btn btn-warning">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    ';
                }
                $table .= '</tr>';

                $count++;
            }

            $end_record = $count - 1;
        } else {
            if ($total >= 1) {
                $table .= '
                <tr class="text-center" >
                    <td colspan="9"><a href="' . $url . '" class="btn btn-primary btn-raised btn-sm">Haga clic aquí para recargar el listado</a></td>
                </tr>
                ';
            } else {
                $table .= '
                <tr class="text-center"
                    <td colspan="9">No hay registros en el sistema</td>
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
        $total_buttons = $nPages >= $buttons ?  $buttons : $nPages;

        $html = $table;

        if ($total >= 1 && $page <= $nPages) {
            $html .= '<p class="text-right">Mostrando cliente(s): ' . $start_record . ' al ' . $end_record . ' de un total de ' . $total . '</p>';

            $html .= itemModel::pagination_tables($page, $nPages, $url, $total_buttons);
        }

        return $html;
    }
}
