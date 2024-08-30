<?php

/**
 * Item Controller
 * All functionality pertaining to Item Controller.
 * PHP version 8.2.0
 *
 * @category Controller
 * @package  ItemController
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  GIT: 1.0.0
 * @link     manuelparra.dev
 */

namespace App\Controller;

use App\Model\ItemModel;

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

/**
 * Class Item Controller
 *
 * @category   Controller
 * @package    ItemController
 * @subpackage ItemController
 * @author     Manuel Parra <manuelparra@live.com.ar>
 * @license    MIT <https://mit.org>
 * @link       https://manuelparra.dev
 */
class ItemController extends ItemModel
{
    /**
     * Function for add item
     *
     * @return object
     */
    public function addItemController(): object
    {
        $codigo = ItemModel::cleanString($_POST['item_codigo_reg']);
        $nombre = ItemModel::cleanString($_POST['item_nombre_reg']);
        $stock = ItemModel::cleanString($_POST['item_stock_reg']);
        $estado = ItemModel::cleanString($_POST['item_stock_reg']);
        $detalle = ItemModel::cleanString($_POST['item_detalle_reg']);

        // Check empty fields
        if (
            $codigo == "" || $nombre = "" || $stock = ""
            || $estado = "" || $detalle = ""
        ) {
            $res = ItemModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrio un error inesperado",
                "No has llenado todos los campos requeridos"
            );

            return $res;
        }

        // Check data's integrity
        // Check Codigo
        if (ItemModel::checkData(RCOD, $codigo)) {
            $res = ItemModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Código erróneo",
                "El Código no coincide con el formato solicitado."
            );
            return $res;
        }

        // Check item name
        if (ItemModel::checkData(RBNAME, $nombre)) {
            $res = ItemModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Nombre erróneo",
                "El Nombre no coincide con el formato solicitado."
            );
            return $res;
        }

        // Check item stock
        if (ItemModel::checkData(RSTOCK, $stock)) {
            $res = ItemModel::messageWithParameters(
                "simple",
                "error",
                "Formato de stock erróneo",
                "El stock no coincide con el formato solicitado."
            );
            return $res;
        }

        // Check item estado
        if (ItemModel::checkData(RESTADO, $estado)) {
            $res = ItemModel::messageWithParameters(
                "simple",
                "error",
                "Formato de estado erróneo",
                "El estado no coincide con el formato solicitado."
            );
            return $res;
        }

        // Check detalle estado
        if (ItemModel::checkData(RESTADO, $detalle)) {
            $res = ItemModel::messageWithParameters(
                "simple",
                "error",
                "Formato de detalle erróneo",
                "El detalle no coincide con el formato solicitado."
            );
            return $res;
        }

        $dataItemReg = [
            "codigo" => $codigo,
            "nmobre" => $nombre,
            "stock" => $stock,
            "estado" => $estado,
            "detalle" => $detalle,
        ];

        $query = ItemModel::addItemModel($dataItemReg);

        if ($query->rowCount() == 1) {
            $res = ItemModel::messageWithParameters(
                "clean",
                "success",
                "Item rigistrado",
                "Los datos del item han sido registrados con éxito."
            );
        } else {
            $res = ItemModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrio un error inesperado",
                "No hemos podido registrar el item."
            );
        }

        return $res;
    }

    /**
     * Function for update item
     *
     * @return object
     */
    public function updateItemDataController(): object
    {
        $id = ItemModel::decryption(['item_id_upd']);
        $id = ItemModel::cleanString($id);
        $id = (int) $id;

        /* Checking item id in the database */
        $sql = "SELECT item.*
                FROM item
                WHERE item.item_id = '$id'";
        $query = ItemModel::executeSimpleQuery($sql);

        if ($query->rowCount() == 1) {
            $fields = $query->fetch();
        } else {
            return ItemModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrio un error inesperado",
                "El item no existe en base de datos."
            );
        }

        $codigo = ItemModel::cleanString($_POST['item_codigo_upd']);
        $nombre = ItemModel::cleanString($_POST['item_nombre_upd']);
        $stock = ItemModel::cleanString(['item_stock_upd']);
        $estado = ItemModel::cleanString(['item_estado_upd']);
        $detalle = ItemModel::cleanString(['item_detalle_upd']);

        // Check empty fields
        if (
            $codigo == "" || $nombre == ""
            || $stock == "" || $estado == ""
            || $detalle == ""
        ) {
            return ItemModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrio un error inesperado",
                "Faltan campos por rellenar."
            );
        }

        // Check data integrity
        // Check codigo item
        if (ItemModel::checkData(RCOD, $codigo)) {
            return ItemModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Código erróneo",
                "El Código no coincide con el formato solicitado."
            );
        }

        // Verfico si el código introducido por el usuario se encuentra
        // registrado en el sistema.
        if ($codigo != $fields('item_codigo')) { // Si el usuario introdujo un codigo
            $sql = "SELECT item.item_codigo
                    FROM item
                    WHERE item.item_codigo = '$codigo'";
            $query = ItemModel::executeSimpleQuery($sql); // Consulto en la DB
            if ($query->rowCount() > 0) {
                return ItemModel::messageWithParameters(
                    "simple",
                    "error",
                    "Ocurrio un error inesperado",
                    "¡El Código ya se encuentra registrado en sistema!"
                );
            }
        }

        // Check name
        if (ItemModel::checkData(RNAME, $nombre)) {
            return ItemModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Nombre erróneo",
                "El Nombre no coincide con el formato solicitado."
            );
        }

        // Verifico si el nombre introducido por el usuario es encuentra
        // registrado en el sistema

        if ($nombre != $fields('item_nombre')) {
            $sql = "SELECT item.item_nombre
                    FROM item
                    WHERE item.item_nombre = '$nombre'";
            $query = ItemModel::executeSimpleQuery($sql);
            if ($query->rowCount() > 0) {
                return ItemModel::messageWithParameters(
                    "simple",
                    "error",
                    "Ocurrio un error inesperado",
                    "¡El Nombre ya se encuentra rigistrado en el sistema!"
                );
            }
        }

        // Check Stock
        if (ItemModel::checkData(RSTOCK, $stock)) {
            return ItemModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Stock errónea",
                "El Stock no coincide con el formato solicitado."
            );
        }

        // Check Estado
        if (ItemModel::checkData(RESTADO, $estado)) {
            return ItemModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Estado erróneo",
                "El Estado no coincide con el formato solicitado"
            );
        }

        // Verifico si el Estado es una de las dos opciones
        // definidas en el frontend
        if ($estado != "Habilitado" && $estado != "Deshabilitado") {
            return ItemModel::messageWithParameters(
                "simple",
                "error",
                "Estado Incorrecto",
                "El estado no es válido"
            );
        }

        // Check Detalle
        if (ItemModel::checkData(RDETALLE, $detalle)) {
            return ItemModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Detalle erróneo",
                "El Detalle no coincide con el formato solicitado"
            );
        }

        //  Preparing data to update item in the detabase
        $data = [
            "codigo" => $codigo,
            "nombre" => $nombre,
            "stock" => $stock,
            "estado" => $estado,
            "detalle" => $detalle,
            "id" => $id
        ];

        // Sending data to update item model
        if (ItemModel::updateItemDataModel($data)) {
            return ItemModel::messageWithParameters(
                "reload",
                "success",
                "Datos actualizados",
                "Los datos del item han sido actualizados."
            );
        } else {
            return ItemModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrio un error inesperado",
                "No hemos podido actualizar los datos"
            );
        }
    }

    /**
     * Function for query item
     *
     * @param $type contains string
     * @param $id   contains string
     *
     * @return object
     */
    public function queryDataItemController($type, $id = null): object
    {
        $type = ItemModel::cleanString($type);
        $id = ItemModel::cleanString($id);

        if (!is_null($id)) {
            $id = ItemModel::decryption($id);
        }

        return ItemModel::queryDataItemModel($type, $id);
    }

    /**
     * Function for delete item
     *
     * @return object
     */
    public function deleteItemController(): object
    {
        // recivirng item id
        $id = ItemModel::decryption($_POST['item_id_del']);
        $id = ItemModel::cleanString($id);

        // Checking that client exists in the database
        $sql = "SELECT item.item_id
                FROM item
                WHERE item.item_id = '$id'";
        $query = ItemModel::connection()->prepare($sql);

        if (!$query->rowCount() > 0) {
            $res = ItemModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado",
                "¡El item que intenta eliminar no existe en el sistema!"
            );
            return $res;
        }
    }

    /**
     * Function for paginator item controller
     *
     * @param $page      contains string
     * @param $records   contains string
     * @param $privilege contains string
     * @param $url       contains string
     * @param $search    contains string
     *
     * @return string
     */
    public function paginatorItemController(
        $page,
        $records,
        $privilege,
        $url,
        $search
    ): string {
        $page = ItemModel::cleanString($page);
        $records = ItemModel::cleanString($records);
        $privilege = ItemModel::cleanString($privilege);

        $url = ItemModel::cleanString($url);
        $url = SERVER_URL . $url . "/";

        $search = ItemModel::cleanString($search);

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

        $dbcnn = ItemModel::connection();

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
            $startRecord = $start + 1;

            foreach ($rows as $row) {
                $nombreApellido = $row['item_estado'] . ' ' . $row['item_detalle'];
                $table .= '
                <tr class="text-center" >
                    <td>' . $count . '</td>
                    <td>' . $row['item_codigo'] . '</td>
                    <td>' . $row['item_nombre'] . '</td>
                    <td>' . $row['item_stock'] . '</td>
                    <td>
                        <button
                            type="button"
                            class="btn btn-info"
                            data-toggle="popover"
                            data-trigger="hover"
                            title="Estado y Detalle"
                            data-content="' . $nombreApellido . '"
                        >
                            <i class="fas fa-info-circle"></i>
                        </button>
                    </td>';
                if ($privilege == 1 || $privilege == 2) {
                    $table .= '
                        <td>
                            <a
                                href="' . SERVER_URL . 'item-update/' .
                        ItemModel::encryption($row['item_id'])  .
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
                                action="' . SERVER_URL . 'endpoint/item-ajax/"
                                method="POST" data-form="delete"
                                autocomplete="off"
                            >
                                <input
                                    type="hidden"
                                    name="item_id_del" value="' .
                        ItemModel::encryption($row['item_id']) .
                        '"
                                >
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

            $endRecord = $count - 1;
        } else {
            if ($total >= 1) {
                $table .= '
                <tr class="text-center" >
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
                <tr class="text-center"
                    <td colspan="9">
                        No se encontro registros de items en el sistema
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
        $totalButtons = $nPages >= $buttons ?  $buttons : $nPages;

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
                '
                </p>';

            $html .= ItemModel::paginationTables(
                $page,
                $nPages,
                $url,
                $totalButtons
            );
        }

        return $html;
    }

    /**
     * Function for send message item
     *
     * @param $alert contains string
     * @param $type  contains string
     * @param $title contains string
     * @param $text  contains string
     *
     * @return object
     */
    public function messageItemController(
        $alert,
        $type,
        $title,
        $text
    ): object {
        return ItemModel::messageWithParameters(
            $alert,
            $type,
            $title,
            $text
        );
    }
}
