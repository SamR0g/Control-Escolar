<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "controlescolar";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos del formulario
$matricula = $_POST['matricula'];
$calificacion = $_POST['calificacion'];
$materia = $_POST['materia'];
$asistencia = $_POST['asistencia'];

// Insertar datos en la base de datos
$sql = "INSERT INTO calificaciones1 (Matricula, Calificacion, Materia, Asistencia) VALUES ('$matricula', '$calificacion', '$materia', '$asistencia')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Registro exitoso.');
    window.location.href = '../Modulos Personal/CapturaCalificaciones.php';</script>";} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
