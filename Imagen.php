<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "controlescolar";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener la matrícula del alumno cuya imagen quieres mostrar
$matricula = 19011308; // Matricula específica

// Consulta SQL para recuperar la imagen del alumno
$sql = "SELECT Foto FROM alumnos WHERE Matricula = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $matricula);
$stmt->execute();
$stmt->bind_result($foto);
$stmt->fetch();
$stmt->close();
$conn->close();

if ($foto) {
    // Mostrar la imagen
    header("Content-type: image/jpeg");
    echo $foto;
} else {
    echo "No se encontró la imagen.";
}
?>
