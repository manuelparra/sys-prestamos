<?php
/**
 *
 * Item Model Class
 *
 * All functionality pertaining to the Item Model.
 *
 * @package Model
 * @author Manuel Parra
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

require_once "./models/mainModel.php";

/*--- Class Client ---*/
class itemModel extends mainModel {
    /*-- Function for add item --*/
    protected static function add_item_model($data) {
        // SQL Query for insert item
        $sql = "INSERT INTO item (item_codigo, item_nombre,
                item_stock, item_estado, item_detalle)
                VALUE (:codigo, :nombre, :stock, :estado, :detalle)";
        $query = mainModel::connection()->prepare($sql);

        $query->bindParam(":codigo", $data['codigo']);
        $query->bindParam(":nombre", $data['nombre']);
        $query->bindParam(":stock", $data['stock']);
        $query->bindParam(":estado", $data['estado']);
        $query->bindParam(":detalle", $data['detalle']);

        $query->execute();

        return $query;
    }
}

