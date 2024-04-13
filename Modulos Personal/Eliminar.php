<?php
session_start();

// Verificar si el alumno ha iniciado sesión
if (!isset($_SESSION['ID'])) {
    // Si no ha iniciado sesión, redirigirlo al formulario de inicio de sesión
    header("Location: ../Modulos Personal/LogInPersonal.php");
    exit;
}

// Verificar si se recibió la matrícula del alumno a eliminar
if (isset($_GET['matricula'])) {
    // Recoger la matrícula del alumno
    $matricula = $_GET['matricula'];

    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "controlescolar");

    // Verificar conexión
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Consulta SQL para eliminar al alumno
    $sql = "DELETE FROM alumnos WHERE Matricula='$matricula'";

    if (mysqli_query($conexion, $sql)) {
        // Redireccionar a la página principal después de eliminar el alumno
        header("Location: ListadoAlumno.php");
        exit();
    } else {
        echo "Error al eliminar alumno: " . mysqli_error($conexion);
    }

    // Cerrar conexión
    mysqli_close($conexion);
} else {
    // Si no se recibió la matrícula del alumno, redireccionar a la página de error
    header("Location: error.php");
    exit();
}
?>
