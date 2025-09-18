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
     * @return string
     */
    public function addBusinessInformationController(): string
    {
        // Check that there is no business data registered in database.
        $sql = "SELECT empresa_nif
                FROM empresa";
        $query = BusinessModel::executeSimpleQuery($sql);
        if ($query->rowCount() > 0) {
            return BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado.",
                "¡Los datos de la empresa ya se encuentran registrados en sistema!"
            );
        }

        // Clean data
        $nif = BusinessModel::cleanString($_POST['empresa_nif_reg']);
        $nombre = BusinessModel::cleanString($_POST['empresa_nombre_reg']);
        $email = BusinessModel::cleanString($_POST['empresa_email_reg']);
        $telefono = BusinessModel::cleanString($_POST['empresa_telefono_reg']);
        $direccion = BusinessModel::cleanString($_POST['empresa_direccion_reg']);

        // Check empty fields
        if ($nif == "" || $nombre == "" || $email == ""
            || $telefono == "" || $direccion == ""
        ) {
            return BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrió un error inesperado.",
                "No has llenado todos los campos requeridos."
            );
        }

        // Chequeo la integridad de los datos
        // Chequeo el NIF
        if (BusinessModel::checkData(RBNIF, $nif)) {
            return BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Formato de NIF erróneo.",
                "El NIF no coincide con el formato requerido para este campo."
            );
        }

        // Chequeo la Razón Social de la Empresa / Nombre de Empresa
        if (BusinessModel::checkData(RBNAME, $nombre)) {
            return BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Razón Social / Nombre erróneo.",
                "La Razón Social / Nombre no coincide con el formato solicitado."
            );
        }

        // Chequeo la derección de email
        if (BusinessModel::checkData(REMAIL, $email)) {
            return BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Email erróneo.",
                "El Email no coincide con el formato solicitado."
            );
        }

        // Chequeo el numero de telefono
        if ($telefono != "" && BusinessModel::checkData(RPHONE, $telefono)) {
            return BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Teléfono erróneo.",
                "El Teléfono no coincide con el formato solicitado."
            );
        }

        // Chequeo la dirección de la empresa
        if ($direccion != "" && BusinessModel::checkData(RADDR, $direccion)) {
            return BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Dirección erróneo.",
                "La Dirección no coincide con el formato solicitado."
            );
        }

        $data = [
            "nif" => $nif,
            "nombre" => $nombre,
            "email" => $email,
            "telefono" => $telefono,
            "direccion" => $direccion
        ];

        $query = BusinessModel::addBusinessInformationModel($data);

        if ($query->rowCount() == 1) {
            return BusinessModel::messageWithParameters(
                "reload",
                "success",
                "Datos de Empresa registrados.",
                "Los datos de la Empresa han sido registrados con éxito."
            );
        } else {
            return BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado.",
                "No hemos podido registrar los datos de la Empresa."
            );
        }
    }

    /**
     * Function for update business information
     *
     * @return string
     */
    public function updateBusinessController(): string
    {
        // Limpio la data que recibo del formulario
        $id = BusinessModel::cleanString($_POST['empresa_id_upd']);
        $nif = BusinessModel::cleanString($_POST['empresa_nif_upd']);
        $nombre = BusinessModel::cleanString($_POST['empresa_nombre_upd']);
        $email = BusinessModel::cleanString($_POST['empresa_email_upd']);
        $telefono = BusinessModel::cleanString($_POST['empresa_telefono_upd']);
        $direccion = BusinessModel::cleanString($_POST['empresa_direccion_upd']);

        // Chequeo que no haya campos vacíos
        if ($nif == "" || $nombre == "" || $email == ""
            || $telefono == "" || $direccion == ""
        ) {
            return BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrió un error inesperado",
                "No has llenado todos los campos requeridos."
            );
        }

        // Chequeo la integriadad de la data
        // Cheoque el campo NIF
        if (BusinessModel::checkData(RBNIF, $nif)) {
            return BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Formato de NIF erróneo",
                "El NIF no coincide con el formato requerido para este campo."
            );
        }

        // Chequeo el campo Razón Social / Nombre de Empreasa
        if (BusinessModel::checkData(RBNAME, $nombre)) {
            return BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Nombre erróneo",
                "El Nombre no coincide con el formato solicitado."
            );
        }

        // Chequeo el correo electrónico de la empresa
        if (BusinessModel::checkData(REMAIL, $email)) {
            return BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Email erróneo",
                "El Email no coincide con el formato solicitado."
            );
        }

        // Cheoqueo el numero de teleofono de la empreasa
        if ($telefono != "" && BusinessModel::checkData(RPHONE, $telefono)) {
            return BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Teléfono erróneo",
                "El Teléfono no coincide con el formato solicitado."
            );
        }

        // Cheoqueo la dirección de la empreasa
        if ($direccion != "" && BusinessModel::checkData(RADDR, $direccion)) {
            return BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Dirección erróneo",
                "La Dirección no coincide con el formato solicitado."
            );
        }

        $data = [
            "id" => BusinessModel::decryption($id),
            "nif" => $nif,
            "nombre" => $nombre,
            "email" => $email,
            "telefono" => $telefono,
            "direccion" => $direccion
        ];

        // Sending data to update item model
        if (BusinessModel::updateBusinessDataModel($data)) {
            return BusinessModel::messageWithParameters(
                "reload",
                "success",
                "Datos actualizados",
                "Los datos de la empresa han sido actualizados."
            );
        } else {
            return BusinessModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado.",
                "No hemos podido actualizar los datos de la empresa."
            );
        }
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
    public function tokenBusinessController($string): string
    {
        return BusinessModel::encryption($string);
    }
}
