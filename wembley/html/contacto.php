<?php include 'navbar.php'; ?>

<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contacto</title>

    <link rel="shortcut icon" href="../imagen/icono.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/b408879b64.js" 
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body class="no_scroll_bar">
    <div class="contenedor_contacto">
        <div class="contenedor_informacion">
            <h1>CONTÁCTATE CON NOSOTROS</h1>
            <div class="contenedor_informacion__data">
                <p><i class="fa-solid fa-phone"></i> 123456789</p>
                <p><i class="fa-solid fa-envelope"></i> wembleyinfoshop@gmail.com</p>
                <p><i class="fa-solid fa-location-dot"></i> Río Tercero, Córdoba.</p>
            </div>
            <div class="contenedor_informacion__links">
                <a href="https://web.facebook.com/profile.php?id=100091745557330" class="btn btn-primary btn-lg" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                <a class="btn btn-primary btn-lg" href="https://www.instagram.com/wembleyutileria/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
        <form class="form-1">
            <div class="contenedor_contacto__input">
                <input type="text" placeholder="Nombre y apellido" required>
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="contenedor_contacto__input">
                <input type="email" required placeholder="Correo electrónico">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="contenedor_contacto__input">
                <input type="text" placeholder="Asunto">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <div class="contenedor_contacto__input">
                <textarea placeholder="Escribe tu mensaje..."></textarea>
            </div>
            <button class="btn btn-primary btn-lg" type="submit">Enviar mensaje</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
