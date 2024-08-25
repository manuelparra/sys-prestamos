<?php
/**
 * Contents of Logout.
 * Contents of the Logout
 * PHP version 8.2.0
 *
 * @category Layout
 * @package  Layout
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  CVS: <1.0.0>
 * @link     manuelparra.dev
 */

require_once "./controllers/loginController.php";
if (!isset($insLoginController)) {
    $insLoginController = new LoginController();
}

$tokenSpm = $insLoginController->encryptData($_SESSION['token_spm']);
$userSpm = $insLoginController->encryptData($_SESSION['usuario_spm']);
?>

<script>
let btn_exit_system = document.querySelector(".btn-exit-system");

    btn_exit_system.addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Deseas cerrar esta sesión?',
            text: "Estas a punto de cerrar la sesión y salir del sistema.",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, salir!',
            cancelButtonText: 'No, cancelar'
        }).then((result) => {
            if (result.value) {
                let url = '<?php echo SERVER_URL . 'endpoint/login-ajax/'; ?>';
                let token = '<?php echo $tokenSpm ?>';
                let usuario = '<?php echo $userSpm; ?>';
                let data = new FormData();
                data.append("token", token);
                data.append("usuario", usuario);

                fetch(url, {
                    method: 'POST',
                    body: data
                })
                .then(res => {
                    return res.json()
                })
                .then(res => {
                    return ajax_alerts(res);
                });
            }
        });
    });
 </script>
