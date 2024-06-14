<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Alumno.css">
    <style>
        .notification {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #4CAF50;
            color: white;
            padding: 15px;  
            border-radius: 5px;
            opacity: 0;
            transition: opacity 0.5s ease;
            z-index: 1000;
        }
        .error {
            background-color: #f44336;
        }
        .show {
            opacity: 1;
        }
    </style>
    <title>Registro de Cuenta</title>
</head>
<body>

    <div class="container">
        <h2>Registro de Cuenta</h2>
        <form id="registrationForm" action="../php/RegistrarAlumno1.php" method="post">
            <label for="matricula">Matrícula:</label>
            <input type="text" id="matricula" name="matricula" required>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellidoPaterno">Apellido Paterno:</label>
            <input type="text" id="apellidoPaterno" name="apellidoPaterno" required>

            <label for="apellidoMaterno">Apellido Materno:</label>
            <input type="text" id="apellidoMaterno" name="apellidoMaterno" required>

            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Registrar</button>
        </form>
    </div>

    <?php
    // Mostrar notificación de éxito si existe
    if(isset($_GET['success'])):
    ?>
    <div class="notification success show">
        <?php echo $_GET['success']; ?>
    </div>
    <?php endif; ?>

    <?php
    // Mostrar notificación de error si existe
    if(isset($_GET['error'])):
    ?>
    <div class="notification error show">
        <?php echo $_GET['error']; ?>
    </div>
    <?php endif; ?>

    <script>
        // Función para mostrar la notificación
        function mostrarMensaje(mensaje, tipo) {
            var notification = document.createElement("div");
            notification.classList.add("notification");
            notification.classList.add(tipo);
            notification.textContent = mensaje;
            document.body.appendChild(notification);
            setTimeout(function() {
                notification.classList.add("show");
            }, 100); // Muestra la notificación después de 100 milisegundos
            setTimeout(function() {
                notification.classList.remove("show");
                setTimeout(function() {
                    document.body.removeChild(notification);
                }, 500); // Elimina la notificación después de 500 milisegundos
            }, 3000); // Oculta la notificación después de 3 segundos
        }

        <?php if(isset($_GET['error'])): ?>
            mostrarMensaje("<?php echo $_GET['error']; ?>", "error");
        <?php endif; ?>

        <?php if(isset($_GET['success'])): ?>
            mostrarMensaje("<?php echo $_GET['success']; ?>", "success");
        <?php endif; ?>
    </script>

</body>
</html>
