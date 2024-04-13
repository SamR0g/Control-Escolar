<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['Matricula'])) {
    header("Location: ../Modulos Alumnos/login.php"); // Redirigir al usuario al formulario de inicio de sesión si no ha iniciado sesión
    exit;
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

// Obtener la identificación del usuario que inició sesión
$user_id = $_SESSION['Matricula'];

// Consulta SQL para obtener la información del alumno que inició sesión
$sql = "SELECT * FROM alumnos WHERE Matricula = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Mostrar la información del alumno en la boleta
    echo "<div class='container'>";
    echo "<h2>Boleta de Calificaciones de " . $row['NombreCompleto'] . "</h2>";

    // Consulta SQL para obtener las calificaciones del alumno
    $sql_calificaciones = "SELECT * FROM calificaciones1 WHERE Matricula = '" . $row['Matricula'] . "'";
    $result_calificaciones = $conn->query($sql_calificaciones);

    if ($result_calificaciones->num_rows > 0) {
        echo "<div class='student-info'>";
        echo "<table>";
        echo "<tr><th>Nombre Materia</th><th>Calificación</th><th>Asistencia</th></tr>";
        while ($row_calificaciones = $result_calificaciones->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row_calificaciones["Materia"] . "</td>";
            echo "<td>" . $row_calificaciones["Calificacion"] . "</td>";
            echo "<td>" . $row_calificaciones["Asistencia"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p>No hay calificaciones registradas para este alumno.</p>";
    }
    echo "</div>";
} else {
    echo "<p>No se encontró información de alumno para el usuario actual.</p>";
}

$conn->close();
?>
