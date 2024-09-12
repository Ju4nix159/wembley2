<?php
include 'navbar.php';
include "../config/database.php";

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Crear una instancia de la clase Database
    $db = new Database();
    
    // Conectar a la base de datos usando la función conectar
    $conexion = $db->conectar();

    // Validar los datos
    if ($password != $confirm_password) {
        // Contraseñas no coinciden, mostrar SweetAlert
        ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>
        <script>
            window.addEventListener("DOMContentLoaded", () => {
                Swal.fire({
                    title: "Error",
                    text: "Las contraseñas no coinciden",
                    icon: "error",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Volver a intentar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirigir al usuario a la página de registro
                        window.location.href = "registro.php";
                    }
                });
            });
        </script>
        <?php
    } else {
        // Validar si el usuario ya existe en la base de datos
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $result = $conexion->query($sql);

        if ($result->rowCount() == 1) {
            // Usuario ya registrado, mostrar SweetAlert
            ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>
            <script>
                window.addEventListener("DOMContentLoaded", () => {
                    Swal.fire({
                        title: "Error",
                        text: "Usuario ya registrado",
                        icon: "error",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Volver al registro"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirigir al usuario a la página de registro
                            window.location.href = "registro.php";
                        }
                    });
                });
            </script>
            <?php
        } else {
            // El usuario no existe, proceder con el registro
            // Insertar el nuevo usuario en la base de datos
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios (email, password) VALUES ('$email', '$password_hashed')";

            if ($conexion->query($sql) == TRUE) {
                // Registro exitoso, mostrar SweetAlert
                ?>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>
                <script>
                    window.addEventListener("DOMContentLoaded", () => {
                        Swal.fire({
                            title: "Registro exitoso",
                            text: "Usuario registrado correctamente",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "Iniciar Sesion"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirigir al usuario a la página de inicio de sesión
                                window.location.href = "login.php";
                            }
                        });
                    });
                </script>
                <?php
            } else {
                // Mostrar error en el registro
                echo "Error en el registro: " . $conexion->errorInfo();
            }
        }
        // Cerrar la conexión
        $conexion = null;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Registro</title>
    </head>
    <body>
        <div class="contenedor_sesion">
            <div class="form-box">
                <div class="form-value">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <h2 class="text-white p-5" >Registrarse</h2>
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
                        <div class="inputbox">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input type="password" id="confirm_password" name="confirm_password" required>
                            <label for="">Confirmar contraseña</label>
                        </div>
                        <div class="contenedor_boton">
                            <button class="btn btn-primary" type="submit" value="registro">Registrarse</button>
                        </div>
                        <div class="register">
                            <p>ya tienes cuenta?  <a href="login.php">Inica sesion</a></p>
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