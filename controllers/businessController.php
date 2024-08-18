<?php
/**
 * Bussiness Controller
 *
 * All functionality pertaining to Business Controller.
 *
 * @package Controller
 * @author Manuel Parra
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

include_once "./models/businessModel.php";

/*--- Class Business Controller ---*/
class businessController extends businessModel {
    /*-- Controller's function for add business information --*/
    public function add_business_information_controller() {
        // Check that there is no business data registered in database.
        $query = businessModel::execute_simple_query("SELECT empresa_nombre
                                                      FROM empresa");
        if ($query->rowCount() > 0) {
            $res = businessModel::message_with_parameters("simple", "error", "Ocurrío un error inesperado.",
                                                          "¡Los datos de la empresa ya se encuentran registrados en sistema!");
            return $res;
        }

        // Clean data
        $nombre = businessModel::clean_string($_POST['empresa_nombre_reg']);
        $email = businessModel::clean_string($_POST['empresa_email_reg']);
        $telefono = businessModel::clean_string($_POST['empresa_telefono_reg']);
        $direccion = businessModel::clean_string($_POST['empresa_direccion_reg']);

        // Check empty fields
        if ($nombre == "" || $email == "" || $telefono == "" ||
            $direccion == "") {

            $res = businessModel::message_with_parameters("simple", "error", "Ocurrió un error inesperado.",
                                                          "No has llenado todos los campos requeridos.");
            return $res;
        }

        // Check data's integrity
        // Check business name
        if (businessModel::check_data("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $nombre)) {
            $res = businessModel::message_with_parameters("simple", "error", "Formato de Nombre erróneo.",
                                                      "El Nombre no coincide con el formato solicitado.");
            return $res;
        }

        // Check email
        if (businessModel::check_data("[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$", $email)) {
            $res = businessModel::message_with_parameters("simple", "error", "Formato de Email erróneo.",
                                                      "El Email no coincide con el formato solicitado.");
            return $res;
        }

        // Check phone
        if ($telefono != "" && businessModel::check_data("[0-9()+]{9,20}", $telefono)) {
            $res = businessModel::message_with_parameters("simple", "error", "Formato de Teléfono erróneo.",
                                                      "El Teléfono no coincide con el formato solicitado.");
            return $res;
        }

        //Check address
        if ($direccion != "" && businessModel::check_data("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $direccion)) {
            $res = businessModel::message_with_parameters("simple", "error", "Formato de Dirección erróneo.",
                                                      "La Dirección no coincide con el formato solicitado.");
            return $res;
        }

        $data_business_reg = [
            "nombre" => $nombre,
            "email" => $email,
            "telefono" => $telefono,
            "direccion" => $direccion
        ];

        $query = businessModel::add_business_information_model($data_business_reg);

        if ($query->rowCount() == 1) {
            $res = businessModel::message_with_parameters("clean", "success", "Datos de Empresa registrados.",
                                                          "Los datos de la Empresa han sido registrados con éxito.");
        } else {
            $res = businessModel::message_with_parameters("simple", "error", "Ocurrío un error inesperado.",
                                                          "No hemos podido registrar los datos de la Empresa.");
        }
        return $res;
    }

    /*-- Controller's function for update business information --*/
    public function update_business_information_controller() {
        // Clean data
        $id = businessModel::clean_string($_POST['business_id_upd']);
        $nombre = businessModel::clean_string($_POST['empresa_nombre_upd']);
        $email = businessModel::clean_string($_POST['empresa_email_upd']);
        $telefono = businessModel::clean_string($_POST['empresa_telefono_upd']);
        $direccion = businessModel::clean_string($_POST['empresa_direccion_upd']);

        // Check empty fields
        if ($nombre == "" || $email == "" || $telefono == "" ||
            $direccion == "") {

            $res = businessModel::message_with_parameters("simple", "error", "Ocurrió un error inesperado",
                                                          "No has llenado todos los campos requeridos.");
            return $res;
        }

        // Check data's integrity
        // Check business name
        if (businessModel::check_data("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $nombre)) {
            $res = businessModel::message_with_parameters("simple", "error", "Formato de Nombre erróneo",
                                                      "El Nombre no coincide con el formato solicitado.");
            return $res;
        }

        // Check email
        if (businessModel::check_data("[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$", $email)) {
            $res = businessModel::message_with_parameters("simple", "error", "Formato de Email erróneo",
                                                      "El Email no coincide con el formato solicitado.");
            return $res;
        }

        // Check phone
        if ($telefono != "" && businessModel::check_data("[0-9()+]{9,20}", $telefono)) {
            $res = businessModel::message_with_parameters("simple", "error", "Formato de Teléfono erróneo",
                                                      "El Teléfono no coincide con el formato solicitado.");
            return $res;
        }

        //Check address
        if ($direccion != "" && businessModel::check_data("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $direccion)) {
            $res = businessModel::message_with_parameters("simple", "error", "Formato de Dirección erróneo",
                                                      "La Dirección no coincide con el formato solicitado.");
            return $res;
        }

        $data_business_upd = [
            "id" => $id,
            "nombre" => $nombre,
            "email" => $email,
            "telefono" => $telefono,
            "direccion" => $direccion
        ];

        $query = businessModel::update_business_data_model($data_business_upd);

        if ($query->rowCount() == 1) {
            $res = businessModel::message_with_parameters("clean", "success", "Datos de Empresa registrados",
                                                          "Los datos de la empresa han sido registrados con éxito.");
        } else {
            $res = businessModel::message_with_parameters("simple", "error", "Ocurrío un error inesperado.",
                                                          "No hemos podido registrar los datos de la empresa.");
        }

        return $res;
    }

    /*-- Contoller's function for query business infrormation --*/
    public function query_business_information_controller() {
        return businessModel::query_business_information_model();
    }
}
