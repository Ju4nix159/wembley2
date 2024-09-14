<?php
ob_start();
include 'navbar.php';
include "../config/database.php";

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql_verificar_email = $con->prepare("SELECT * FROM usuarios WHERE email = :email");
    $sql_verificar_email->bindParam(':email', $email, PDO::PARAM_STR);
    $sql_verificar_email->execute();

    $row_count = $sql_verificar_email->rowCount();

    if ($row_count > 0) {
        $usuario = $sql_verificar_email->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $usuario['clave'])) {
            // La contraseña es correcta, iniciar sesión
            $id_usuario = $usuario['id_usuario'];
            $permisos = $usuario['id_permiso'];

            $_SESSION['usuario'] = $email;
            $_SESSION['permiso'] = $permisos;
            $_SESSION['id_usuario'] = $id_usuario;
            header("Location:pagina_principal.php");
        } else {
            // La contraseña es incorrecta, mostrar SweetAlert
            showErrorAlert("Contraseña incorrecta");
        }
    } else {
?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>
        <script>
            window.addEventListener("DOMContentLoaded", () => {
                Swal.fire({
                    title: "Error",
                    text: "El usuario no existe, ¿quieres crear una cuenta?",
                    icon: "error",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Volver al inicio",
                    cancelButtonText: "Registrarse",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "login.php";
                    } else {
                        window.location.href = "registro.php";
                    }
                });
            });
        </script>
    <?php
    }
}

function showErrorAlert($errorMessage)
{
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>
    <script>
        window.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "Error",
                text: "<?php echo $errorMessage; ?>",
                icon: "error",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Volver a intentar"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "login.php";
                }
            });
        });
    </script>
<?php
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Iniciar sesión</title>
</head>
<body">
    <div class="contenedor_sesion">
        <div class="form-box">
            <div class="form-value">
                <form class="form-1" action="<?php ($_SERVER['PHP_SELF']); ?>" method="POST">
                    <h2 class="dispaly-2 text-white p-5">Iniciar Sesión</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" id="email" name="email" required>
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" id="password" name="password" required>
                        <label for="">Contraseña</label>
                    </div>
                    <div class="register">
                        <p>No tienes cuenta? <a href="registro.php">Regístrate</a></p>
                    </div>
                    <div class="contenedor_boton">
                        <button class="btn btn-primary" type="submit" value="login">Iniciar sesión </button>
                    </div>
                </form>


            </div>
        </div>
    </div>
    <?php include("footer.php") ?>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>

</html>