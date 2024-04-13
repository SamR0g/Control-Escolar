<?php
// Mostrar errores de PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificar si se recibieron datos del formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "controlescolar");

    // Verificar conexión
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Recoger los datos del formulario
    $matricula = $_POST['matricula'];
    $nombreCompleto = $_POST['nombreCompleto'];
    $apellidoPaterno = $_POST['apellidoPaterno'];
    $apellidoMaterno = $_POST['apellidoMaterno'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $correoElectronico = $_POST['correoElectronico'];
    $semestre = $_POST['semestre'];
    $grupo = $_POST['grupo'];
    $edad = $_POST['edad'];
    $turno = $_POST['turno'];
    $periodoEscolar = $_POST['periodoEscolar'];
    $curp = $_POST['curp'];
    $lugarNacimiento = $_POST['lugarNacimiento'];

    // Consulta SQL para actualizar los datos del alumno
    $sql = "UPDATE alumnos SET NombreCompleto='$nombreCompleto', ApellidoPaterno='$apellidoPaterno', ApellidoMaterno='$apellidoMaterno', FechaNacimiento='$fechaNacimiento', CorreoElectronico='$correoElectronico', Semestre='$semestre', Grupo='$grupo', Edad='$edad', Turno='$turno', periodo_escolar='$periodoEscolar', CURP='$curp', lugar_nacimiento='$lugarNacimiento' WHERE Matricula='$matricula'";

    if (mysqli_query($conexion, $sql)) {
        echo "<script>alert('Cambios guardados correctamente.');</script>";    } else {
        echo "Error al guardar cambios: " . mysqli_error($conexion);
    }

    // Cerrar conexión
    mysqli_close($conexion);
} else {
    // Redireccionar a la página de error si no se recibieron datos del formulario
    header("Location: error.php");
    exit();
}
?>
