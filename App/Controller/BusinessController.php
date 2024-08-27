<?php
/**
 * Bussiness Controller
 *
 * All functionality pertaining to Business Controller.
 * PHP version 8.2.0
 *
 * @category Config
 * @package  Config
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  CVS: <1.0.0>
 * @link     manuelparra.dev
 */

namespace App\Controller;

use App\Model\BusinessModel;

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

require_once "./models/businessModel.php";

/**
 * Class Business Controller
 *
 * @category   Controller
 * @package    BusinessController
 * @subpackage BusinessController
 * @author     Manuel Parra <manuelparra@live.com.ar>
 * @license    MIT <https://mit.org>
 * @link       https://manuelparra.dev
 */
class BusinessController extends BusinessModel
{
    /**
     * Function for add business information
     *
     * @return object
     */
    public function addBusinessInformationController(): object
    {
        // Check that there is no business data registered in database.
        $sql = "SELECT empresa_nombre
                FROM empresa";
        $query = BusinessModel::executeSimpleQuery($sql);
        if ($query->rowCount() > 0) {
            $res = BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado.",
                "¡Los datos de la empresa ya se encuentran registrados en sistema!"
            );
            return $res;
        }

        // Clean data
        $nombre = BusinessModel::cleanString($_POST['empresa_nombre_reg']);
        $email = BusinessModel::cleanString($_POST['empresa_email_reg']);
        $telefono = BusinessModel::cleanString($_POST['empresa_telefono_reg']);
        $direccion = BusinessModel::cleanString($_POST['empresa_direccion_reg']);

        // Check empty fields
        if ($nombre == "" || $email == ""
            || $telefono == "" || $direccion == ""
        ) {
            $res = BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrió un error inesperado.",
                "No has llenado todos los campos requeridos."
            );
            return $res;
        }

        // Check data's integrity
        // Check business name
        if (BusinessModel::checkData(RNLN, $nombre)) {
            $res = BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Nombre erróneo.",
                "El Nombre no coincide con el formato solicitado."
            );
            return $res;
        }

        // Check email
        if (BusinessModel::checkData(REMAIL, $email)) {
            $res = BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Email erróneo.",
                "El Email no coincide con el formato solicitado."
            );
            return $res;
        }

        // Check phone
        if ($telefono != "" && BusinessModel::checkData(RPHONE, $telefono)) {
            $res = BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Teléfono erróneo.",
                "El Teléfono no coincide con el formato solicitado."
            );
            return $res;
        }

        //Check address
        if ($direccion != "" && BusinessModel::checkData(RADDR, $direccion)) {
            $res = BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Dirección erróneo.",
                "La Dirección no coincide con el formato solicitado."
            );
            return $res;
        }

        $dataBusinessReg = [
            "nombre" => $nombre,
            "email" => $email,
            "telefono" => $telefono,
            "direccion" => $direccion
        ];

        $query = BusinessModel::addBusinessInformationModel($dataBusinessReg);

        if ($query->rowCount() == 1) {
            $res = BusinessModel::messageWithParameters(
                "reload",
                "success",
                "Datos de Empresa registrados.",
                "Los datos de la Empresa han sido registrados con éxito."
            );
        } else {
            $res = BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado.",
                "No hemos podido registrar los datos de la Empresa."
            );
        }
        return $res;
    }

    /**
     * Function for update business information
     *
     * @return object
     */
    public function updateBusinessInformationController(): object
    {
        // Clean data
        $id = BusinessModel::cleanString($_POST['business_id_upd']);
        $nombre = BusinessModel::cleanString($_POST['empresa_nombre_upd']);
        $email = BusinessModel::cleanString($_POST['empresa_email_upd']);
        $telefono = BusinessModel::cleanString($_POST['empresa_telefono_upd']);
        $direccion = BusinessModel::cleanString($_POST['empresa_direccion_upd']);

        // Check empty fields
        if ($nombre == "" || $email == ""
            || $telefono == "" || $direccion == ""
        ) {

            $res = BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrió un error inesperado",
                "No has llenado todos los campos requeridos."
            );
            return $res;
        }

        // Check data's integrity
        // Check business name
        if (BusinessModel::checkData(RNLN, $nombre)) {
            $res = BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Nombre erróneo",
                "El Nombre no coincide con el formato solicitado."
            );
            return $res;
        }

        // Check email
        if (BusinessModel::checkData(REMAIL, $email)) {
            $res = BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Email erróneo",
                "El Email no coincide con el formato solicitado."
            );
            return $res;
        }

        // Check phone
        if ($telefono != "" && BusinessModel::checkData(RPHONE, $telefono)) {
            $res = BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Teléfono erróneo",
                "El Teléfono no coincide con el formato solicitado."
            );
            return $res;
        }

        //Check address
        if ($direccion != "" && BusinessModel::checkData(RADDR, $direccion)) {
            $res = BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Dirección erróneo",
                "La Dirección no coincide con el formato solicitado."
            );
            return $res;
        }

        $dataBusinessUpd = [
            "id" => BusinessModel::decryption($id),
            "nombre" => $nombre,
            "email" => $email,
            "telefono" => $telefono,
            "direccion" => $direccion
        ];

        $query = BusinessModel::updateBusinessDataModel($dataBusinessUpd);

        if ($query->rowCount() == 1) {
            $res = BusinessModel::messageWithParameters(
                "reload",
                "success",
                "Datos de Empresa actualizados",
                "Los datos de la empresa han sido actualizados con éxito."
            );
        } else {
            $res = BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado.",
                "No hemos podido actualizar los datos de la empresa."
            );
        }

        return $res;
    }

    /**
     * Function for query business information
     *
     * @return object
     */
    public function queryBusinessInformationController(): object
    {
        return BusinessModel::queryBusinessInformationModel();
    }

    /**
     * Function for token business id
     *
     * @param $string conteins string
     *
     * @return object
     */
    public function tokenBusinessController($string): object
    {
        return BusinessModel::encryption($string);
    }
}
