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

use App\Model\LoginModel;

if (!defined('ABSPATH')) {
    echo "Acceso no autorizado.";
    exit; // Exit if accessed directly
}


/**
 * Class Login Controller
 *
 * @category   Controller
 * @package    LoginController
 * @subpackage LoginController
 * @author     Manuel Parra <manuelparra@live.com.ar>
 * @license    MIT <https://mit.org>
 * @link       https://manuelparra.dev
 */
class LoginController extends LoginModel
{
    /**
     * Function for user login
     *
     * @return string
     */
    public function loginController(): ?string
    {
        // Clean data
        $usuario = LoginModel::cleanString($_POST['usuario_log']);
        $clave = LoginModel::cleanString($_POST['clave_log']);

        /* Check empy fields */
        if ($usuario == "" || $clave == "") {
            echo '
            <script>
                Swal.fire({
                    title: "Faltan datos.",
                    text: "No has rellenado todos los campos requeridos",
                    type: "error",
                    icon: "error",
                    confirmButtonText: "Aceptar"
                });
            </script>
            ';

            return null;
        }

        /* Check data's integrity */
        /* Check user */
        if (LoginModel::checkData(RUSER, $usuario)) {
            echo '
            <script>
                Swal.fire({
                    title: "Ocurrió un error inesperado",
                    text: "El usuario no coincide con el formato requerido.",
                    type: "error",
                    type: "warning",
                    confirmButtonText: "Aceptar"
                });
            </script>
            ';

            return null;
        }

        /* Check password */
        if (LoginModel::checkData(RPASS, $clave)) {
            echo '
            <script>
                Swal.fire({
                    title: "Ocurrió un error inesperado",
                    text: "La contraseña no coincide con el formato requerido.",
                    type: "error",
                    icon: "warning",
                    confirmButtonText: "Aceptar"
                });
            </script>
            ';

            return null;
        }

        $claveEncryted = LoginModel::encryption($clave);

        $dataLogin = [
            "usuario" => $usuario,
            "clave" => $claveEncryted
        ];

        $query = LoginModel::loginModel($dataLogin);

        if ($query->rowCount() == 1) {
            $row = $query->fetch();

            if ($row['usuario_estado'] == "Deshabilitada") {
                echo '
                <script>
                    Swal.fire({
                        title: "Cuenta Deshabilitada",
                        text: "La cuenta de usuario se encuentra deshabilitada,
                        por favor, contacte con el administrador de sistemas.",
                        type: "error",
                        icon: "error",
                        confirmButtonText: "Aceptar"
                    });
                </script>
                ';

                return null;
            }

            session_start(['name'=>'SPM']);

            $_SESSION['id_spm'] = $row['usuario_id'];
            $_SESSION['nombre_spm'] = $row['usuario_nombre'];
            $_SESSION['apellido_spm'] = $row['usuario_apellido'];
            $_SESSION['usuario_spm'] = $row['usuario_usuario'];
            $_SESSION['privilegio_spm'] = $row['usuario_privilegio'];
            $_SESSION['perfil_spm'] = $row['perfil_nombre'];
            $_SESSION['token_spm'] = md5(uniqid(mt_rand(), true));

            return header("Location: " . SERVER_URL . "home/");
        } else {
            echo '
            <script>
                Swal.fire({
                    title: "Ocurrió un error inesperado",
                    text: "El usuario o la contraseña son incorrectos.",
                    type: "error",
                    icon: "error",
                    confirmButtonText: "Aceptar"
                });
            </script>
            ';

            return null;
        }
    }

    /**
     * Function for forse close session
     *
     * @return string
     */
    public function forceCloseSessionController(): string
    {
        session_unset();
        session_destroy();

        if (headers_sent()) { // If headers are being sent,
            $str = "<script>
                    window.location.href='" . SERVER_URL . "login/';
                    </script>";

            return $str;
        } else {
            return header("Location: " . SERVER_URL . "login/");
        }
    }

    /**
     * Function for close session
     *
     * @return string
     */
    public function closeSessionController(): string
    {
        session_start(['name' => 'SPM']);

        $token = LoginModel::decryption($_POST['token']);
        $usuario = LoginModel::decryption($_POST['usuario']);

        if ($token == $_SESSION['token_spm']
            && $usuario == $_SESSION['usuario_spm']
        ) {
            session_unset();
            session_destroy();
            $res = LoginModel::messageWithParameters(
                "redirect",
                null,
                null,
                null,
                SERVER_URL . "login/"
            );
        } else {
            $res = LoginModel::messageWithParameters(
                "simple",
                "error",
                "Ocurrió un error inesperado",
                "¡No se puedo cerrar la sesión en el sistema!"
            );
        }
        return $res;
    }

    /**
     * Function for encryp data
     *
     * @param string $string String to encrypt
     *
     * @return string
     */
    public function encryptData($string):string
    {
        return LoginModel::encryption($string);
    }
}
