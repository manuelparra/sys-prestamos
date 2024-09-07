<?php
/**
 * Item Model
 * All functionality pertaining to Item Model.
 * PHP version 8.2.0
 *
 * @category Model
 * @package  ItemModel
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  GIT: 1.0.0
 * @link     manuelparra.dev
 */

namespace App\Model;

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

/**
 * Class Item Model
 *
 * @category   Model
 * @package    ItemModel
 * @subpackage ItemModel
 * @author     Manuel Parra <manuelparra@live.com.ar>
 * @license    MIT <https://mit.org>
 * @link       https://manuelparra.dev
 */
class ItemModel extends MainModel
{
    /**
     * Function for add item
     *
     * @param $data contains array
     *
     * @return object
     */
    protected static function addItemModel($data): object
    {
        // SQL Query for insert item
        $sql = "INSERT INTO item (item_codigo, item_nombre,
                item_stock, item_estado, item_detalle)
                VALUE (:codigo, :nombre, :stock, :estado, :detalle)";
        $query = MainModel::connection()->prepare($sql);

        $query->bindParam(":codigo", $data['codigo']);
        $query->bindParam(":nombre", $data['nombre']);
        $query->bindParam(":stock", $data['stock']);
        $query->bindParam(":estado", $data['estado']);
        $query->bindParam(":detalle", $data['detalle']);

        $query->execute();

        return $query;
    }

    /**
     * Function for update item
     *
     * @param $data contains array
     *
     * @return object
     */
    protected static function updateItemDataModel($data): object
    {
        $sql = "UPDATE item SET
                item.item_codigo = :codigo,
                item.item_nombre = :nombre,
                item.item_stock = :stock,
                item.item_estado = :estado,
                item.item_detalle = :detalle
                WHERE item.item_id = :id";
        $query = MainModel::connection()->prepare($sql);

        $query->bindParam(":codigo", $data['codigo']);
        $query->bindParam(":nombre", $data['nombre']);
        $query->bindParam(":stock", $data['stock']);
        $query->bindParam(":estado", $data['estado']);
        $query->bindParam(":detalle", $data['detalle']);
        $query->bindParam(":id", $data['id']);

        $query->execute();

        return $query;
    }

    /**
     * Function for query item
     *
     * @param $type contains string
     * @param $id   contains string
     *
     * @return object
     */
    protected static function queryDataItemModel($type, $id = null): object
    {
        if ($type == "Unique") {
            $sql = "SELECT item.*
                    FROM item
                    WHERE item.item_id = :id";
            $query = MainModel::connection()->prepare($sql);
            $query->bindParam(":id", $id);
        } elseif ($type == "Count") {
            $sql = "SELECT item.item_id
                    FROM item";
            $query = MainModel::connection()->prepare($sql);
        }

        $query->execute();
        return $query;
    }

    /**
     * Funciton for delete item
     *
     * @param $id contains integer
     *
     * @return string
     */
    protected static function deleteItemModel($id): object
    {
        $sql = "DELETE FROM item
                WHERE item.item_id = :id";
        $query = MainModel::connection()->prepare($sql);

        $query->bindParam(":id", $id);
        $query->execute();

        return $query;
    }
}
