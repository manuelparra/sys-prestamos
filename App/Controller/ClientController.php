<?php
/**
 * Client Controller
 * All functionality pertaining to Client Controller.
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

use App\Model\ClientModel;

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

/**
 * Class Client Controller
 *
 * @category   Controller
 * @package    ClientController
 * @subpackage ClientController
 * @author     Manuel Parra <manuelparra@live.com.ar>
 * @license    MIT <https://mit.org>
 * @link       https://manuelparra.dev
 */
class ClientController extends ClientModel
{
    /**
     * Function for add client
     *
     * @return string
     */
    public function addClientController(): string
    {
        $dni = ClientModel::cleanString($_POST['cliente_dni_reg']);
        $nombre = ClientModel::cleanString($_POST['cliente_nombre_reg']);
        $apellido = ClientModel::cleanString($_POST['cliente_apellido_reg']);
        $telefono = ClientModel::cleanString($_POST['cliente_telefono_reg']);
        $email = ClientModel::cleanString($_POST['cliente_email_reg']);
        $direccion = ClientModel::cleanString($_POST['cliente_direccion_reg']);

        // Check empty fields
        if ($dni == "" || $nombre == "" || $apellido == ""
            || $telefono == "" || $email == "" || $direccion == ""
        ) {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrió un error inesperado",
                "No has llenado todos los campos requeridos"
            );
        }

        // Check data's integrity
        // Check DNI
        if (ClientModel::checkData(RDNI, $dni)) {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Formato de DNI erróneo",
                "El DNI no coincide con el formato solicitado."
            );
        }

        // Check first name
        if (ClientModel::checkData(RNLN, $nombre)) {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Nombre erróneo",
                "El Nombre no coincide con el formato solicitado."
            );
        }

        // Check last name
        if (ClientModel::checkData(RNLN, $apellido)) {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Apellido erróneo",
                "El Apellido no coincide con el formato solicitado."
            );
        }

        // Check phone
        if (ClientModel::checkData(RPHONE, $telefono)) {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Telefono erróneo",
                "El Telefono no coincide con el formato solicitado."
            );
        }

        // Check email
        if (ClientModel::checkData(REMAIL, $email)) {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Email erróneo",
                "El Email no coincide con el formato solicitado."
            );
        }

        // Check address
        if (ClientModel::checkData(RADDR, $direccion)) {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Dirección erróneo",
                "La Dirección no coincide coon el formato solicitado."
            );
        }

        // Check DNI as unique data in database
        $sql = "SELECT cliente_dni
                FROM cliente
                WHERE cliente_dni = '$dni'";
        $query = ClientModel::executeSimpleQuery($sql);

        if ($query->rowCount() > 0) {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado",
                "¡Ya existe un cliente con este DNI registrado en el sistema!"
            );
        }

        // Check email as unique data in database
        $sql = "SELECT cliente_email
                FROM cliente
                WHERE cliente_email = '$email'";
        $query = ClientModel::executeSimpleQuery($sql);

        if ($query->rowCount() > 0) {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado",
                "¡El email del cliente ya se encuentra registrado en el sistema!"
            );
        }

        $data_client_reg = [
            "dni" => $dni,
            "nombre" => $nombre,
            "apellido" => $apellido,
            "telefono" => $telefono,
            "email" => $email,
            "direccion" => $direccion
        ];

        $query = ClientModel::addClientModel($data_client_reg);

        if ($query->rowCount() == 1) {
            return ClientModel::messageWithParameters(
                "clean",
                "success",
                "Cliente registrado",
                "Los datos del cliente han sido registrados con éxito."
            );
        } else {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrio un error inesperado",
                "No hemos podido registrar el cliente."
            );
        }
    }

    /**
     * Function for client's pagination
     *
     * @param $page      contains int
     * @param $records   contains int
     * @param $privilege contains int
     * @param $url       contains string
     * @param $search    contains string
     *
     * @return strnig
     */
    public function paginatorClientController(
        $page,
        $records,
        $privilege,
        $url,
        $search = null
    ): string {
        $page = ClientModel::cleanString($page);
        $records = ClientModel::cleanString($records);
        $privilege = ClientModel::cleanString($privilege);

        $url = ClientModel::cleanString($url);
        $url = SERVER_URL . $url . "/";

        $search = ClientModel::cleanString($search);

        $table = "";
        $html = "";

        $page = (isset($page) && $page > 0) ? (int) $page : 1;

        $start = $page > 0 ? (($page * $records) - $records) : 0;

        if (isset($search)) {
            $sql = "SELECT SQL_CALC_FOUND_ROWS *
                    FROM cliente
                    WHERE cliente_dni LIKE '%$search%'
                    OR cliente_nombre LIKE '%$search%'
                    OR cliente_apellido LIKE '%$search%'
                    OR cliente_telefono LIKE '%$search%'
                    OR cliente_email LIKE '%$search%'
                    OR cliente_direccion LIKE '%$search%'
                    ORDER BY cliente_nombre ASC
                    LIMIT $start, $records";
        } else {
            $sql = "SELECT SQL_CALC_FOUND_ROWS *
                    FROM cliente
                    ORDER BY cliente_nombre ASC
                    LIMIT $start, $records";
        }

        $dbcnn = ClientModel::connection();

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
                        <th>DNI</th>
                        <th>NOMBRE</th>
                        <th>APELLIDO</th>
                        <th>TELEFONO</th>
                        <th>DIRECCIÓN</th>';

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
                $id = ClientModel::encryption($row['cliente_id']);
                $nombreApellido = $row['cliente_nombre'] .
                    ' ' . $row['cliente_apellido'];

                $table .= '
                <tr class="text-center" >
                    <td>' . $count . '</td>
                    <td>' . $row['cliente_dni'] . '</td>
                    <td>' . $row['cliente_nombre'] . '</td>
                    <td>' . $row['cliente_apellido'] . '</td>
                    <td>' . $row['cliente_telefono'] . '</td>
                    <td>
                        <button
                            type="button"
                            class="btn btn-info"
                            data-toggle="popover"
                            data-trigger="hover"
                            title="' . $nombreApellido . '"
                            data-content="' . $row['cliente_direccion'] . '"
                        >
                            <i class="fas fa-info-circle"></i>
                        </button>
                    </td>';
                if ($privilege == 1 || $privilege == 2) {
                    $table .= '
                        <td>
                            <a
                                href="' . SERVER_URL . 'client-update/' . $id . '/"
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
                                action="' . SERVER_URL . 'endpoint/client-ajax/"
                                method="POST"
                                data-form="delete"
                                autocomplete="off"
                            >
                                <input
                                    type="hidden"
                                    name="cliente_id_del"
                                    value="' . $id . '">
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
                        No se encontro registros de clientes en el sistema
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
            $html .= '<p class="text-right">
                Mostrando cliente(s): ' . $startRecord
                . ' al ' . $endRecord
                . ' de un total de '
                . $total
                . '</p>';

            $html .= ClientModel::paginationTables(
                $page,
                $nPages,
                $url,
                $totalButtons
            );
        }

        return $html;
    }

    /**
     * Function for delete client
     *
     * @return string
     */
    public function deleteClientController(): string
    {
        // reciving client id
        $id = ClientModel::decryption($_POST['cliente_id_del']);
        $id = ClientModel::cleanString($id);

        // Checking that the client exists in the database
        $sql = "SELECT cliente.cliente_id
                FROM cliente
                WHERE cliente.cliente_id = '$id'";
        $query = ClientModel::executeSimpleQuery($sql);

        if (!$query->rowCount() > 0) {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado",
                "¡El cliente que intenta eliminar no existe en el sistema!"
            );
        }

        // Cheching if the client has associated loan records
        $sql = "SELECT prestamo.cliente_id
                FROM prestamo
                WHERE prestamo.cliente_id = '$id'
                LIMIT 1";
        $query = ClientModel::executeSimpleQuery($sql);

        if ($query->rowCount() > 0) {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado",
                "El cliente tiene prestamos asociados."
            );
        }

        // Checking privileges of current user
        session_start(['name' => 'SPM']);
        if ($_SESSION['privilegio_spm'] != 1) {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado",
                "¡No tienes los permisos necesarios!"
            );
        }

        // deleting client
        $query = ClientModel::deleteClientModel($id);

        if ($query->rowCount() == 1) {
            return (ClientModel::messageWithParameters(
                "reload",
                "success",
                "Cliente eliminado",
                "El cliente ha sido eliminado del sistema con exito."
            ));
        } else {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado.",
                "No hemos podido eliminar el cliente."
            );
        }
    }

    /**
     * Function for query client
     *
     * @param $type contains string
     * @param $id   contains int
     *
     * @return object
     */
    public function queryDataClientController($type, $id = null): object
    {
        $type = ClientModel::cleanString($type);

        if (!is_null($id)) {
            $id = ClientModel::decryption($id);
            $id = ClientModel::cleanString($id);
        }

        return ClientModel::queryDataClientModel($type, $id);
    }

    /**
     * Function for send message to user
     *
     * @param $alert contains string
     * @param $type  contains string
     * @param $title contains string
     * @param $text  contains string
     *
     * @return string
     */
    public function messageClientController(
        $alert,
        $type,
        $title,
        $text
    ): string {
        return ClientModel::messageWithParameters(
            $alert,
            $type,
            $title,
            $text
        );
    }

    /**
     * Function for update client
     *
     * @return string|bool
     */
    public function updateClientDataController(): string
    {
        // recieving the id
        $id = ClientModel::decryption($_POST['cliente_id_upd']);
        $id = ClientModel::cleanString($id);
        $id = (int) $id;

        // checking client id in the database
        $sql = "SELECT cliente.*
                FROM cliente
                WHERE cliente.cliente_id = $id";
        $query = ClientModel::executeSimpleQuery($sql);

        if ($query->rowCount() == 1) {
            $fields = $query->fetch();
        } else {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado.",
                "El cliente no existe en base de datos, intente nuevamente."
            );
        }

        $dni = ClientModel::cleanString($_POST['cliente_dni_upd']);
        $nombre = ClientModel::cleanString($_POST['cliente_nombre_upd']);
        $apellido = ClientModel::cleanString($_POST['cliente_apellido_upd']);
        $telefono = ClientModel::cleanString($_POST['cliente_telefono_upd']);
        $email = ClientModel::cleanString($_POST['cliente_email_upd']);
        $direccion = ClientModel::cleanString($_POST['cliente_direccion_upd']);

        // check empty fields
        if ($dni == "" || $nombre == "" || $apellido == ""
            || $telefono == "" || $email == "" || $direccion == ""
        ) {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrió un error inesperado",
                "No has llenado todos los campos requeridos"
            );
        }

        // Check data's integrity
        // Check DNI
        if (ClientModel::checkData(RDNI, $dni)) {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Formato de DNI erróneo",
                "El DNI no coincide con el formato solicitado."
            );
        }

        // Check first name
        if (ClientModel::checkData(RNLN, $nombre)) {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Nombre erróneo",
                "El Nombre no coincide con el formato solicitado."
            );
        }

        // Check last name
        if (ClientModel::checkData(RNLN, $apellido)) {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Apellido erróneo",
                "El Apellido no coincide con el formato solicitado."
            );
        }

        // Check phone
        if (ClientModel::checkData(RPHONE, $telefono)) {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Telefono erróneo",
                "El Telefono no coincide con el formato solicitado."
            );
        }

        // Check email
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Check email as unique in database
            if ($email != $fields['cliente_email']) {
                $sql = "SELECT cliente_email
                        FROM cliente
                        WHERE cliente_email = '$email'";
                $query = ClientModel::executeSimpleQuery($sql);
                if ($query->rowCount() > 0) {
                    return ClientModel::messageWithParameters(
                        "simple",
                        "error",
                        "Ocurrío un error inesperado",
                        "¡El Email ya se encuentra registrado en el sistema!"
                    );
                }
            }
        } else {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Email erróneo",
                "El correo no coincide con el formato solicitado."
            );
        }

        // Check address
        if (ClientModel::checkData(RADDR, $direccion)) {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Dirección erróneo",
                "La Dirección no coincide coon el formato solicitado."
            );
        }

        // Check DNI as unique data in database
        if ($dni != $fields['cliente_dni']) {
            $sql = "SELECT cliente_dni
                    FROM cliente
                    WHERE cliente_dni = '$dni'";
            $query = ClientModel::executeSimpleQuery($sql);

            if ($query->rowCount() > 0) {
                return ClientModel::messageWithParameters(
                    "simple",
                    "error",
                    "Ocurrío un error inesperado",
                    "¡Ya existe un cliente con este DNI registrado en el sistema!"
                );
            }
        }

        // Checking privileges
        session_start(['name' => 'SPM']);
        if ($_SESSION['privilegio_spm'] != 1 && $_SESSION['privilegio_spm'] != 2) {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado",
                "¡No tienes los permisos necesarios para realizar esta operación!"
            );
        }

        // Preparing data to send to the model
        $data = [
            "dni" => $dni,
            "nombre" => $nombre,
            "apellido" => $apellido,
            "telefono" => $telefono,
            "email" => $email,
            "direccion" => $direccion,
            "id" => $id
        ];

        // Sending data to update user model
        if (ClientModel::updateClientDataModel($data)) {
            return ClientModel::messageWithParameters(
                "reload",
                "success",
                "Datos Actualizados",
                "Los datos han sido actualizados.",
            );
        } else {
            return ClientModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrio un error inesperado",
                "No hemos podido actualizar los datos.",
            );
        }
    }
}
