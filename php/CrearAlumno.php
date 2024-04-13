<?php
// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "controlescolar");

    // Verificar conexión
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Recoger datos del formulario
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

    // Consulta SQL para insertar el nuevo alumno
    $sql = "INSERT INTO alumnos (Matricula, NombreCompleto, ApellidoPaterno, ApellidoMaterno, FechaNacimiento, CorreoElectronico, Semestre, Grupo, Edad, Turno, periodo_escolar, CURP, lugar_nacimiento) 
            VALUES ('$matricula', '$nombreCompleto', '$apellidoPaterno', '$apellidoMaterno', '$fechaNacimiento', '$correoElectronico', '$semestre', '$grupo', '$edad', '$turno', '$periodoEscolar', '$curp', '$lugarNacimiento')";

    if (mysqli_query($conexion, $sql)) {
        echo "<script>alert('Alumno agregado correctamente.');</script>"; // Mostrar una ventana emergente con el mensaje    } else {
        echo "Error al agregar alumno: " . mysqli_error($conexion); // Agregamos un mensaje de error adicional
    }

    // Cerrar conexión
    mysqli_close($conexion);
}
?>
