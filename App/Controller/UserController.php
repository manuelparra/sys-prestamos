<?php
/**
 * User Controller
 * All functionality pertaining to User Controller.
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

use App\Model\UserModel;

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}

/**
 * Class User Controller
 *
 * @category   Controller
 * @package    UserController
 * @subpackage UserController
 * @author     Manuel Parra <manuelparra@live.com.ar>
 * @license    MIT <https://mit.org>
 * @link       https://manuelparra.dev
 */
class UserController extends UserModel
{

    /**
     * Function for add user
     *
     * @return object
     */
    public function addUserController(): object
    {
        // Clean data
        $dni = UserModel::cleanString($_POST['usuario_dni_reg']);
        $nombre = UserModel::cleanString($_POST['usuario_nombre_reg']);
        $apellido = UserModel::cleanString($_POST['usuario_apellido_reg']);
        $telefono = UserModel::cleanString($_POST['usuario_telefono_reg']);
        $direccion = UserModel::cleanString($_POST['usuario_direccion_reg']);
        $perfil = UserModel::cleanString($_POST['usuario_perfil_reg']);

        $usuario = UserModel::cleanString($_POST['usuario_usuario_reg']);
        $email = UserModel::cleanString($_POST['usuario_email_reg']);
        $clave1 = UserModel::cleanString($_POST['usuario_clave_1_reg']);
        $clave2 = UserModel::cleanString($_POST['usuario_clave_2_reg']);

        $privilegio = UserModel::cleanString($_POST['usuario_privilegio_reg']);

        // Check empty fields
        if ($dni == "" || $nombre == "" || $apellido == ""
            || $usuario == "" || $email == ""
            || $clave1 == "" || $clave2 == ""
        ) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrió un error inesperado",
                "No has llenado todos los campos requeridos."
            );
            return $res;
        }

        // Check data's integrity
        // Check DNI
        if (UserModel::checkData(RDNI, $dni)) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Formato de DNI erróneo",
                "El DNI no coincide con el formato solicitado."
            );
            return $res;
        }

        // Check first name
        if (UserModel::checkData(RNLN, $nombre)) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Nombre erróneo",
                "El Nombre no coincide con el formato solicitado."
            );
            return $res;
        }

        // Check last name
        if (UserModel::checkData(RNLN, $apellido)) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Apellido erróneo",
                "El Apellido no coincide con el formato solicitado."
            );
            return $res;
        }

        // Check phone
        if ($telefono != "" && UserModel::checkData(RPHONE, $telefono)) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Teléfono erróneo",
                "El Teléfono no coincide con el formato solicitado."
            );
            return $res;
        }

        //Check address
        if ($direccion != "" && UserModel::checkData(RADDR, $direccion)) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Dirección erróneo",
                "La Dirección no coincide con el formato solicitado."
            );
            return $res;
        }

        // Check Perfil as a record stored in database
        if ($perfil != "" && $perfil != "Seleccione") {
            $sql = "SELECT perfil_id
                    FROM perfil
                    WHERE perfil_nombre = '$perfil'";
            $query = UserModel::executeSimpleQuery($sql);
            if ($query->rowCount() != 1) {
                $res = UserModel::messageWithParameters(
                    "simple",
                    "error",
                    "Ocurrío un error inesperado",
                    "¡El perfil seleccionado no se encuentra registrado!"
                );
                return $res;
            } else {
                $row = $query->fetch();
                $perfilId = $row['perfil_id'];
            }

        } else {
            $perfilId = null;
        }

        // Check username
        if (UserModel::checkData(RUSER, $usuario)) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Usuario erróneo",
                "El Usuario no coincide con el formato solicitado."
            );
            return $res;
        }

        // Check email
        if (UserModel::checkData(REMAIL, $email)) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Email erróneo",
                "El Email no coincide con el formato solicitado."
            );
            return $res;
        }

        // Check passwords
        if ($clave1 == $clave2) {
            if (UserModel::checkData(RPASS, $clave1) ) {
                $res = UserModel::messageWithParameters(
                    "simple",
                    "error",
                    "Formato de Contraseña erróneo",
                    "La Contraseña no coincide con el formato solicitado."
                );
                return $res;
            } else {
                $clave = UserModel::encryption($clave1);
            }
        } else {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Contraseñas diferentes",
                "Las Contraseñas deben coincidir."
            );
            return $res;
        }

        // Check Privilege
        if ($privilegio < 1 || $privilegio > 3) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado",
                "!El Privilegio seleccionado no es valido!"
            );
            return $res;
        }

        // Check DNI as unique data in database
        $sql = "SELECT usuario_dni
                FROM usuario
                WHERE usuario_dni = '$dni'";
        $query = UserModel::executeSimpleQuery($sql);
        if ($query->rowCount() > 0) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado",
                "¡El DNI ya se encuentra registrado en el sistema!"
            );
            return $res;
        }

        // Check user as unique data in database
        $sql = "SELECT usuario_usuario
                FROM usuario
                WHERE usuario_usuario = '$usuario'";
        $query = UserModel::executeSimpleQuery($sql);
        if ($query->rowCount() > 0) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado",
                "¡El nombre de usuario ya se encuentra registrado en el sistema!"
            );
            return $res;
        }

        // Check email as unique data in database
        $sql = "SELECT usuario_email
                FROM usuario
                WHERE usuario_email = '$email'";
        $query = UserModel::executeSimpleQuery($sql);
        if ($query->rowCount() > 0) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado",
                "¡El nombre email ya se encuentra registrado en el sistema!"
            );
            return $res;
        }

        $perfilId = is_null($perfilId) ? $perfilId : (int) $perfilId;

        $dataUserReg = [
            "dni" => $dni,
            "nombre" => $nombre,
            "apellido" => $apellido,
            "telefono" => $telefono,
            "direccion" => $direccion,
            "perfil" =>  $perfilId,
            "email" => $email,
            "usuario" => $usuario,
            "clave" => $clave,
            "estado" => "Activa",
            "privilegio" => (int) $privilegio
        ];

        $query = UserModel::addUserModel($dataUserReg);

        if ($query->rowCount() == 1) {
            $res = UserModel::messageWithParameters(
                "clean",
                "success",
                "Usuario registrado",
                "Los datos del usuario han sido registrado con exito."
            );
        } else {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado.",
                "No hemos podido registrar el usuario."
            );
        }
        return $res;
    }

    /**
     * Function for send message
     *
     * @param $alert contains string
     * @param $type  contains string
     * @param $title contains string
     * @param $text  contains string
     *
     * @return string
     */
    public function messageUserController(
        $alert,
        $type,
        $title,
        $text
    ): string {
        return UserModel::messageWithParameters(
            $alert,
            $type,
            $title,
            $text
        );
    }

    /**
     * Function for users pagination
     *
     * @param $page      contains string
     * @param $records   contains string
     * @param $privilege contains string
     * @param $id        contains string
     * @param $url       contains string
     * @param $search    contains string
     *
     * @return string
     */
    public function paginatorUserController(
        $page,
        $records,
        $privilege,
        $id,
        $url,
        $search
    ): object {
        $page = UserModel::cleanString($page);
        $records = UserModel::cleanString($records);
        $privilege = UserModel::cleanString($privilege);
        $id = UserModel::cleanString($id);
        $url = UserModel::cleanString($url);

        $url = SERVER_URL . $url . "/";

        $search = UserModel::cleanString($search);

        $table = "";
        $html = "";

        $page = (isset($page) && $page > 0) ? (int) $page : 1;

        $start = $page > 0 ? (($page * $records) - $records) : 0;

        if (isset($search) && $search != "") {
            $sql = "SELECT SQL_CALC_FOUND_ROWS *
                    FROM usuario
                    WHERE ((usuario.usuario_id != $id
                    AND usuario.usuario_id != 1)
                    AND (usuario.usuario_dni LIKE '%$search%'
                    OR usuario.usuario_nombre LIKE '%$search%'
                    OR usuario.usuario_apellido LIKE '%$search%'
                    OR usuario.usuario_telefono LIKE '%$search%'
                    OR usuario.usuario_usuario LIKE '%$search%'
                    OR usuario.usuario_email LIKE '%$search%'))
                    ORDER BY usuario.usuario_nombre ASC
                    LIMIT $start, $records";
        } else {
            $sql = "SELECT SQL_CALC_FOUND_ROWS *
                    FROM usuario
                    WHERE usuario.usuario_id != $id
                    AND usuario.usuario_id != 1
                    ORDER BY usuario.usuario_nombre ASC
                    LIMIT $start, $records";
        }

        $db_cnn = UserModel::connection();

        $query = $db_cnn->query($sql);
        $rows = $query->fetchAll();

        $total = $db_cnn->query("SELECT FOUND_ROWS()");
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
                        <th>TELÉFONO</th>
                        <th>USUARIO</th>
                        <th>EMAIL</th>
                        <th>ACTUALIZAR</th>
                        <th>ELIMINAR</th>
                    </tr>
                </thead>
                <tbody>
        ';

        if ($total >= 1 && $page <= $nPages) {
            $count = $start + 1;
            $startRecord = $start + 1;

            foreach ($rows as $row) {
                $table .= '
                <tr class="text-center" >
                    <td>' . $count . '</td>
                    <td>' . $row['usuario_dni'] . '</td>
                    <td>' . $row['usuario_nombre'] . '</td>
                    <td>' . $row['usuario_apellido'] . '</td>
                    <td>' . $row['usuario_telefono'] . '</td>
                    <td>' . $row['usuario_usuario'] . '</td>
                    <td>' . $row['usuario_email'] . '</td>
                    <td>
                        <a href="' . SERVER_URL . 'user-update/' .
                            UserModel::encryption($row['usuario_id'])  .
                            '/" class="btn btn-success"
                        >
                            <i class="fas fa-sync-alt"></i>
                        </a>
                    </td>
                    <td>
                        <form class="ajax-form"
                            action="' . SERVER_URL . 'endpoint/user-ajax/"
                            method="POST"
                            data-form="delete"
                            autocomplete="off"
                        >
                            <input
                                type="hidden"
                                name="usuario_id_del"
                                value="' .
                                UserModel::encryption($row['usuario_id']) . '"
                            >
                            <button type="submit" class="btn btn-warning">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                ';

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
                            Haga clic aca para recargar el listado
                        </a>
                    </td>
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
        $totalButtons = $nPages >= $buttons ?  $buttons : $nPages;

        $html = $table;

        if ($total >= 1 && $page <= $nPages) {
            $html .= '<p class="text-right">
                          Mostrando usuario(s): ' .
                          $startRecord . ' al ' .
                          $endRecord .
                          ' de un total de ' .
                          $total .
                     '</p>';

            $html .= UserModel::paginationTables(
                $page,
                $nPages,
                $url,
                $totalButtons
            );
        }

        return $html;
    }

    /**
     * Function for delete user
     *
     * @return object
     */
    public function deleteUserController(): object
    {
        // reciving user id
        $id = UserModel::decryption($_POST['usuario_id_del']);
        $id = UserModel::cleanString($id);

        // Checking primary user
        if ($id == 1) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado",
                "No podemos eliminar el usuario principal del sistema."
            );
            return $res;
        }

        // Checking that the user exists in the database
        $sql = "SELECT usuario.usuario_id
                FROM usuario
                WHERE usuario.usuario_id = '$id'";
        $query = UserModel::executeSimpleQuery($sql);

        if (!$query->rowCount() > 0) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado",
                "¡El usuario que intenta eliminar no existe en el sistema!"
            );
            return $res;
        }

        // Checking if the user has associated loan records
        $sql = "SELECT prestamo.usuario_id
                FROM prestamo
                WHERE prestamo.usuario_id = '$id'
                LIMIT 1";
        $query = UserModel::executeSimpleQuery($sql);
        if ($query->rowCount() > 0) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado",
                "No es posible eliminar este usuario."
            );
            return $res;
        }

        // Checking privileges of current user
        session_start(['name' => 'SPM']);
        if ($_SESSION['privilegio_spm'] != 1) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado",
                "¡No tienes los permisos necesarios para realizar esta operación!"
            );
            return $res;
        }

        // Deleting user of the system
        $query = UserModel::deleteUserModel($id);

        if ($query->rowCount() == 1) {
            $res = UserModel::messageWithParameters(
                "reload",
                "success",
                "Usuario eliminado",
                "El usuario ha sido eliminado del sistema con exito."
            );
        } else {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado.",
                "No hemos podido eliminar el usuario."
            );
        }

        return $res;
    }

    /**
     * Function for query user data
     *
     * @param $type contains string
     * @param $id   contains string
     *
     * @return object
     */
    public function queryDataUserController($type, $id = null): object
    {
        $type = UserModel::cleanString($type);

        if (!is_null($id)) {
            $id = UserModel::decryption($id);
            $id = UserModel::cleanString($id);
        }
        return UserModel::queryDataUserModel($type, $id);
    }

    /**
     * Function for query perfil lint user
     *
     * @return object
     */
    public function queryPerfilListUserModel(): object
    {
        return UserModel::perfilListUserMode();
    }

    /**
     * Function for update user date
     *
     * @return object
     */
    public function updateUserDataController(): object
    {
        // Receiving the id
        $id = UserModel::decryption($_POST['usuario_id_upd']);
        $id = UserModel::cleanString($id);
        $id = (int) $id;

        // Checking user id in the database
        $sql = "SELECT usuario.*
                FROM usuario
                WHERE usuario.usuario_id = '$id'";
        $query = UserModel::executeSimpleQuery($sql);

        if ($query->rowCount() == 1) {
            $fields = $query->fetch();
        } else {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado.",
                "El usuario no existe en base de datos, intente nuevamente."
            );
            return $res;
        }

        $dni = UserModel::cleanString($_POST['usuario_dni_upd']);
        $nombre = UserModel::cleanString($_POST['usuario_nombre_upd']);
        $apellido = UserModel::cleanString($_POST['usuario_apellido_upd']);
        $telefono = UserModel::cleanString($_POST['usuario_telefono_upd']);
        $direccion = UserModel::cleanString($_POST['usuario_direccion_upd']);
        $perfil = UserModel::cleanString($_POST['usuario_perfil_upd']);

        $usuario = UserModel::cleanString($_POST['usuario_usuario_upd']);
        $email = UserModel::cleanString($_POST['usuario_email_upd']);

        $estado = isset($_POST['usuario_estado_upd']) ?
        UserModel::cleanString($_POST['usuario_estado_upd']) :
        $fields['usuario_estado'];

        $clave1 = UserModel::cleanString($_POST['usuario_clave_nueva_1_upd']);
        $clave2 = UserModel::cleanString($_POST['usuario_clave_nueva_2_upd']);

        $privilegio = isset($_POST['usuario_privilegio_upd']) ?
        UserModel::cleanString($_POST['usuario_privilegio_upd']) :
        $fields['usuario_privilegio'];

        $adminUsuario = UserModel::cleanString($_POST['usuario_admin']);
        $adminClave = UserModel::cleanString($_POST['clave_admin']);

        $accountType = UserModel::cleanString($_POST['account_type']);

        // Check empty fields
        if ($dni == "" || $nombre == "" || $apellido == ""
            || $usuario == "" || $email == ""
            || $adminUsuario == "" || $adminClave == ""
        ) {

            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrió un error inesperado",
                "No has llenado todos los campos requeridos."
            );
            return $res;
        }

        // Check data's ingrity
        // Check DNI
        if (UserModel::checkData(RDNI, $dni)) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Formato de DNI erróneo",
                "El DNI no coincide con el formato solicitado."
            );
            return $res;
        }

        // Check first name
        if (UserModel::checkData(RNLN, $nombre)) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Nombre erróneo",
                "El Nombre no coincide con el formato solicitado."
            );
            return $res;
        }

        // Check last name
        if (UserModel::checkData(RNLN, $apellido)) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Apellido erróneo",
                "El Apellido no coincide con el formato solicitado."
            );
            return $res;
        }

        // Check phone
        if ($telefono != "" && UserModel::checkData(RPHONE, $telefono)) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Teléfono erróneo",
                "El Teléfono no coincide con el formato solicitado."
            );
            return $res;
        }

        // Check direction
        if ($direccion != "" && UserModel::checkData(RADDR, $direccion)) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Dirección erróneo",
                "La Dirección no coincide con el formato solicitado."
            );
            return $res;
        }

        // Check Perfil as a record stored in database
        $perfil_id = !is_null($fields['usuario_perfil_id']) ?
        (int) $fields['usuario_perfil_id'] :
        null;

        if ($perfil != "" && $perfil != "Seleccione") {
            $sql = "SELECT perfil.perfil_id
                    FROM perfil
                    WHERE perfil.perfil_nombre = '$perfil'";
            $query = UserModel::executeSimpleQuery($sql);
            if ($query->rowCount() != 1) {
                $res = UserModel::messageWithParameters(
                    "simple",
                    "error",
                    "Ocurrío un error inesperado",
                    "¡El perfil seleccionado no se encuentra registrado!"
                );
                return $res;
            } else {
                $row = $query->fetch();
                $perfilId = (int) $row['perfil_id'];;
            }
        }

        // Check username
        if (UserModel::checkData(RUSER, $usuario)) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Usuario erróneo",
                "El Usuario no coincide con el formato solicitado."
            );
            return $res;
        }

        // Check email
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Check email as unique in database
            if ($email != $fields['usuario_email']) {
                $sql = "SELECT usuario_email
                        FROM usuario
                        WHERE usuario_email = '$email'";
                $query = UserModel::executeSimpleQuery($sql);
                if ($query->rowCount() > 0) {
                    $res = UserModel::messageWithParameters(
                        "simple",
                        "error",
                        "Ocurrío un error inesperado",
                        "¡El Email ya se encuentra registrado en el sistema!"
                    );
                    return $res;
                }
            }
        } else {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Email erróneo",
                "El Email no coincide con el formato solicitado."
            );
            return $res;
        }

        // Check status
        if ($estado != "Activa" && $estado != "Deshabilitada") {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado",
                "!El Estado de la cuenta no es valido!"
            );
            return $res;
        }

        /* Check password */
        if ($clave1 != "" || $clave2 != "") {
            if ($clave1 == $clave2) {
                if (UserModel::checkData(RPASS, $clave1)) {
                    $res = UserModel::messageWithParameters(
                        "simple",
                        "error",
                        "Formato de Contraseña erróneo",
                        "La Contraseña no coincide con el formato solicitado."
                    );
                    return $res;
                }
                $clave = UserModel::encryption($clave1);
            } else {
                $res = UserModel::messageWithParameters(
                    "simple",
                    "error",
                    "Contraseñas diferentes",
                    "Las nuevas Contraseñas no coinciden."
                );
                return $res;
            }
        } else {
            $clave = $fields['usuario_clave'];
        }

        // Check Privilege
        $privilegio = (int) $privilegio;
        if ($privilegio < 1 || $privilegio > 3) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado",
                "!El Privilegio seleccionado no es valido!"
            );
            return $res;
        }

        // Check admin user
        if (UserModel::checkData(RUSER, $adminUsuario)) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Usuario erróneo",
                "Tu usuario no coincide con el formato solicitado."
            );
            return $res;
        }

        // Check admin clave
        if (UserModel::checkData(RPASS, $adminClave)) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Formato de Clave erróneo",
                "Tu clave de usuario no coincide con el formato solicitado."
            );
            return $res;
        }

        $admin_clave = UserModel::encryption($adminClave);

        // Check DNI as unique data
        if ($dni != $fields['usuario_dni']) {
            $sql = "SELECT usuario_dni
                    FROM usuario
                    WHERE usuario_dni = '$dni'";
            $query = UserModel::executeSimpleQuery($sql);
            if ($query->rowCount() > 0) {
                $res = UserModel::messageWithParameters(
                    "simple",
                    "error",
                    "Ocurrío un error inesperado",
                    "¡El DNI ya se encuentra registrado en el sistema!"
                );
                return $res;
            }
        }

        // Check username as unique in database
        if ($usuario != $fields['usuario_usuario']) {
            $sql = "SELECT usuario_usuario
                    FROM usuario
                    WHERE usuario_usuario = '$usuario'";
            $query = UserModel::executeSimpleQuery($sql);
            if ($query->rowCount() > 0) {
                $res = UserModel::messageWithParameters(
                    "simple",
                    "error",
                    "Ocurrío un error inesperado",
                    "¡El nombre de usuario ya se encuentra registrado en el sistema!"
                );
                return $res;
            }
        }

        // Checking credentials to update data
        if ($accountType == "Propia") {
            $sql = "SELECT usuario_id
                    FROM usuario
                    WHERE usuario_usuario = '$adminUsuario'
                    AND usuario_clave = '$adminClave'
                    AND usuario_id = '$id'";
            $query = UserModel::executeSimpleQuery($sql);
        } else {
            session_start(['name' => 'SPM']);
            if ($_SESSION['privilegio_spm'] != 1) {
                $res = UserModel::messageWithParameters(
                    "simple",
                    "error",
                    "Ocurrío un error inesperado",
                    "¡No tienes los permisos necesarios."
                );
                return $res;
            }

            $adminId = (int) $_SESSION['id_spm'];

            $sql = "SELECT usuario_id
                    FROM usuario
                    WHERE usuario_usuario = '$adminUsuario'
                    AND usuario_clave = '$adminClave'
                    AND usuario_id = $adminId";
            $query = UserModel::executeSimpleQuery($sql);
        }

        if ($query->rowCount() <= 0) {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado",
                "¡El Nombre o la Clave de Administrador no son validos!"
            );
            return $res;
        }

        // Preparing data to send to the model
        $data = [
            "dni" => $dni,
            "nombre" => $nombre,
            "apellido" => $apellido,
            "telefono" => $telefono,
            "direccion" => $direccion,
            "email" => $email,
            "usuario" => $usuario,
            "clave" => $clave,
            "estado" => $estado,
            "privilegio" => $privilegio,
            "perfil_id" => $perfilId,
            "id" => $id
        ];

        // Sending data to update user model
        if (UserModel::updateUserDataModel($data)) {
            $res = UserModel::messageWithParameters(
                "reload",
                "success",
                "Datos Actualizados",
                "Los datos han sido actualizados con éxito."
            );
        } else {
            $res = UserModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrío un error inesperado",
                "No hemos podido actualizar los datos."
            );
        }

        return $res;
    }
}
