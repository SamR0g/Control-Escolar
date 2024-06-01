<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['Matricula'])) {
    // Redirigir a la página de inicio de sesión si no ha iniciado sesión
    header("Location: LogInAlumno.php");
    exit();
}

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

// Obtener la matrícula del alumno autenticado
$matricula = $_SESSION['Matricula'];

// Consulta SQL para recuperar la foto del alumno
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
