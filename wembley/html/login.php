<?php
include 'navbar.php';
include "../config/database.php";

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];


    // Verificar si el email existe en la base de datos
    $sql_check_email = "SELECT * FROM usuarios WHERE email = '$email'";
    $result_check_email = $con->query($sql_check_email);

    if ($result_check_email) {
        $row_count = $result_check_email->rowCount();

        if ($row_count > 0) {
            // El email existe, ahora comprobar la contraseña
            $user = $result_check_email->fetch(PDO::FETCH_ASSOC);
            

            if (password_verify($password,$user['password'])) {


                $sql_id_usuario = $con->prepare("SELECT id_usuario FROM usuarios WHERE email = :email");
                $sql_id_usuario->bindParam(':email', $email, PDO::PARAM_STR);
                $sql_id_usuario->execute();

                $id_usuario = $sql_id_usuario->fetch(PDO::FETCH_ASSOC)['id_usuario'];
                
                $permisos = $user['id_permiso'];
                $_SESSION['email'] = $email;
                $_SESSION['permisos'] = $permisos;
                $_SESSION['id_usuario'] = $id_usuario;

            
                if ($permisos == 1) {
                    
                    header("Location: paneluser.php");
                } else if ($permisos == 2) {
                    header("Location: admin/dashboard.php");
                }
            } else {
                // La contraseña es incorrecta, mostrar SweetAlert
                showErrorAlert("Contraseña incorrecta");
            }
        } else {
            // El email no existe, mostrar SweetAlert con botón de registro
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
                            // Redirigir al usuario a la página de inicio de sesión
                            window.location.href = "login.php";
                        } else {
                            // Redirigir al usuario a la página de registro
                            window.location.href = "registro.php";
                        }
                    });
                });
            </script>
            <?php
        }
    } else {
        // Error al verificar el email, mostrar SweetAlert
        showErrorAlert("Error al verificar el email");
    }

    // Cerrar la conexión a la base de datos
    $db = NULL;
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
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Volver a intentar"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirigir al usuario a la página de inicio de sesión
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
                <form action=" <?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
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
                        <p>No tienes cuenta?  <a href="registro.php">Regístrate</a></p>
                    </div>
                    <div class="contenedor_boton">
                        <button class="btn btn-primary" type="submit" value="login">Iniciar sesión </button>
                    </div>
                </form>
                

            </div>
        </div>
    </div>
    <?php include ("footer.php")?>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
