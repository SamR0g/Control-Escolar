<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['ID'])) {
    header("Location: ../Modulos Jefe Area/LogInJefe.php");
    exit;
}

// Verificar si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricula = $_POST['matricula'];
    $nombreCompleto = $_POST['nombreCompleto'];
    $apellidoPaterno = $_POST['apellidoPaterno'];
    $apellidoMaterno = $_POST['apellidoMaterno'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $correoElectronico = $_POST['correoElectronico'];
    $edad = $_POST['edad'];
    $curp = $_POST['curp'];
    $lugarNacimiento = $_POST['lugarNacimiento'];
    $id_grupo = $_POST['id_grupo'];

    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "controlescolar");

    // Verificar conexión
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Establecer el conjunto de caracteres a utf8mb4
    mysqli_set_charset($conexion, "utf8mb4");

    // Consulta SQL para actualizar los datos del alumno
    $sql = "
        UPDATE alumnos SET 
            NombreCompleto='$nombreCompleto',
            ApellidoPaterno='$apellidoPaterno',
            ApellidoMaterno='$apellidoMaterno',
            FechaNacimiento='$fechaNacimiento',
            CorreoElectronico='$correoElectronico',
            Edad='$edad',
            CURP='$curp',
            lugar_nacimiento='$lugarNacimiento',
            id_grupo='$id_grupo'
        WHERE 
            Matricula='$matricula'
    ";

    if (mysqli_query($conexion, $sql)) {
        echo '
        <script>
            alert("Datos del alumno actualizados correctamente.");
            window.location = "CRUD.php";
        </script>
        ';
        exit;
    } else {
        echo "Error al actualizar los datos: " . mysqli_error($conexion);
    }

    // Cerrar conexión
    mysqli_close($conexion);
}
?>
