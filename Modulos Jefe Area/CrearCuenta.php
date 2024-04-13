<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/CrearCuenta.css">
    <title>Registro de Cuenta</title>
</head>
<body>

    <div class="container">
        <h2>Registro de Cuenta</h2>
        <form id="registrationForm" action="../php/RegistrarAlumno.php" method="post">
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

        <div id="registroExitoso">
            <div id="circuloImagen">
                <!-- Puedes cargar una imagen aquí -->
                <img src="../Imagenes/Paloma verde.png" alt="Imagen de usuario">
            </div>
            ¡Usuario registrado!
        </div>
    </div>

    <script>
        // Puedes mantener la función mostrarMensaje() si quieres mostrar el mensaje después de enviar el formulario.
        function mostrarMensaje() {
            var registroExitoso = document.getElementById("registroExitoso");
            registroExitoso.style.display = "block";
        }
    </script>

</body>
</html>
