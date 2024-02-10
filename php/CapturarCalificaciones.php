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
$id_materia = $_POST['id_materia'];
$nombre_materia = $_POST['nombre_materia'];
$calificacion = $_POST['calificacion'];
$asistencia = $_POST['asistencia'];

// Insertar datos en la base de datos
$sql = "INSERT INTO calificaciones (IDMateria, NombreMatera, Calificacion, Asistencia) VALUES ('$id_materia', '$nombre_materia', '$calificacion', '$asistencia')";

if ($conn->query($sql) === TRUE) {
    echo "Registro de calificación exitoso.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
