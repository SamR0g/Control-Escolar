<?php
session_start();

// Verificar si el alumno ha iniciado sesión
if (!isset($_SESSION['ID'])) {
    // Si no ha iniciado sesión, redirigirlo al formulario de inicio de sesión
    header("Location: ../Modulos Jefe Area/LogInJefe.php");
    exit;
}

// Definir la variable de matrícula
$matricula = null;

// Verificar si se recibió la matrícula del alumno a eliminar
if (isset($_GET['matricula'])) {
    // Recoger la matrícula del alumno
    $matricula = $_GET['matricula'];

    // Validar que la matrícula no esté vacía y sea un valor válido
    if (empty($matricula) || !is_numeric($matricula)) {
        // Redirigir a una página de error si la matrícula es inválida
        header("Location: error.php");
        exit;
    }
} else {
    // Si no se recibió la matrícula del alumno, redireccionar a la página de error
    header("Location: error.php");
    exit;
}

// Verificar si se ha enviado el formulario de confirmación
if (isset($_POST['confirmar'])) {
    // Si se ha confirmado la eliminación, proceder con la eliminación del alumno

    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "controlescolar");

    // Verificar conexión
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Consulta SQL para eliminar al alumno
    $sql = "DELETE FROM alumnos WHERE Matricula=$matricula";

    // Ejecutar la consulta de eliminación
    if (mysqli_query($conexion, $sql)) {
        // Redireccionar a la página principal después de eliminar el alumno
        header("Location: CRUD.php");
        exit();
    } else {
        // Mostrar un mensaje de error si ocurrió un problema al eliminar el alumno
        echo "Error al eliminar alumno: " . mysqli_error($conexion);
    }

    // Cerrar conexión
    mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Eliminación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        p {
            text-align: center;
        }

        form {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        button {
            margin: 0 10px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Eliminar Alumno</h1>
        <p>¿Estás seguro de eliminar al alumno <?php echo $matricula; ?>?</p>
        <form method="POST">
            <input type="hidden" name="matricula" value="<?php echo $matricula; ?>">
            <button type="submit" name="confirmar">Sí, Eliminar</button>
            <button type="button" onclick="cancelar()">Cancelar</button>
        </form>
    </div>

    <script>
        function cancelar() {
            // Redirigir de vuelta a la página principal
            window.location.href = "CRUD.php";
        }
    </script>
</body>
</html>
