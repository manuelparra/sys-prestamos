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
    /*-- Controller's function for add client --*/
    public function add_item_controller() {
        $codigo = itemModel::clean_string($_POST['item_codigo_reg']);
        $nombre = itemModel::clean_string($_POST['item_nombre_reg']);
        $stock = itemModel::clean_string($_POST['item_stock_reg']);
        $estado = itemModel::clean_string($_POST['item_stock_reg']);
        $detalle = itemModel::clean_string($_POST['item_detalle_reg']);

        // Check empty fields
        if ($codigo == "" || $nombre = "" || $stock = "" ||
            $estado = "" || $detalle = "") {
            $res = itemModel::message_with_parameters("simple", "error", "Ocurrio un error inesperado",
                                                      "No has llenado todos los campos requeridos");

            return $res;
        }

        // Check data's integrity
        // Check Codigo
        if (itemModel::check_data("[a-zA-Z0-9-]{1,45}", $codigo)) {
            $res = itemModel::message_with_parameters("simple", "error", "Formato de Código erróneo",
                                                      "El Código no coincide con el formato solicitado.");
            return $res;
        }

        // Check item name
        if (itemModel::check_data("[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 ]{1,140}", $nombre)) {
            $res = itemModel::message_with_parameters("simple", "error", "Formato de Nombre erróneo",
                                                      "El Nombre no coincide con el formato solicitado.");
            return $res;
        }

        // Check item stock
        if (itemModel::check_data("[0-9]{1,9}", $stock)) {
            $res = itemModel::message_with_parameters("simple", "error", "Formato de stock erróneo",
                                                      "El stock no coincide con el formato solicitado.");
            return $res;
        }

        // Check item stock
        if (itemModel::check_data("[0-9]{1,9}", $stock)) {
            $res = itemModel::message_with_parameters("simple", "error", "Formato de stock erróneo",
                                                      "El stock no coincide con el formato solicitado.");
            return $res;
        }

        $data_item_reg = [
            "codigo" => $codigo,
            "nmobre" => $nombre,
            "stock" => $stock,
            "estado" => $estado,
            "detalle" => $detalle,
        ];

        $query = itemModel::add_item_model($data_item_reg);

        if ($query->rowCount() == 1) {
            $res = itemModel::message_with_parameters("clean", "success", "Item rigistrado",
                                                      "Los datos del item han sido registrados con éxito.");
        } else {
            $res = itemModel::message_with_parameters("simple", "error", "Ocurrio un error inesperado",
                                                      "No hemos podido registrar el item.");
        }

        return $res;
    }

    /*-- Controller's function for query items --*/
    public function query_data_item_controller($type, $id = NULL) {
        $type = itemModel::clean_string($type);
        $id = itemModel::clean_string($id);

        if (!is_null($id)) {
            $id = itemModel::decryption($id);
        }

        return itemModel::query_data_item_model($type, $id);
    }

    /*-- Controller's function for delete item --*/
    public function delete_item_controller() {
        // recivirng item id
        $id = itemModel::decryption($_POST['item_id_del']);
        $id = itemModel::clean_string($id);

        // Checking that client exists in the database
        $sql = "SELECT item.item_id
                FROM item
                WHERE item.item_id = '$id'";
        $query = itemModel::connection()->prepare($sql);

        if (!$query->rowCount() > 0) {
            $res = itemModel::message_with_parameters("simple", "error", "Ocurrío un error inesperado",
                                                      "¡El item que intenta eliminar no existe en el sistema!");
            return $res;
        }
    }

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
                        <th>INFO</th>';

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
                    <td>
                        <button type="button" class="btn btn-info" data-toggle="popover" data-trigger="hover"
                        title="Estado y Detalle" data-content="' . $row['item_estado'] . ' ' . $row['item_detalle'] . '">
                            <i class="fas fa-info-circle"></i>
                        </button>
                    </td>';
                if ($privilege == 1 || $privilege == 2) {
                    $table .= '
                        <td>
                            <a href="' . SERVER_URL . 'item-update/' . itemModel::encryption($row['item_id'])  . '/" class="btn btn-success">
                                <i class="fas fa-sync-alt"></i>
                            </a>
                        </td>
                    ';
                }
                if ($privilege == 1) {
                    $table .= '
                        <td>
                            <form class="ajax-form"  action="' . SERVER_URL . 'endpoint/item-ajax/" method="POST" data-form="delete" autocomplete="off">
                                <input type="hidden" name="item_id_del" value="' . itemModel::encryption($row['item_id']) . '">
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
                    <td colspan="9">No se encontro registros de items en el sistema</td>
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
            $html .= '<p class="text-right">Mostrando item(s): ' . $start_record . ' al ' . $end_record . ' de un total de ' . $total . '</p>';

            $html .= itemModel::pagination_tables($page, $nPages, $url, $total_buttons);
        }

        return $html;
    }

    /*-- Controller's function for sent message item --*/
    public function message_item_controller($alert, $type, $title, $text) {
        return itemModel::message_with_parameters($alert, $type, $title, $text);
    }
}
