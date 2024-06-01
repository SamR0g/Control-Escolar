<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // Cambiar por el nombre de usuario de tu base de datos
$password = ""; // Cambiar por la contraseña de tu base de datos
$dbname = "controlescolar"; // Cambiar por el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener las calificaciones de los alumnos
$sql = "SELECT calificaciones1.Matricula, alumnos.NombreCompleto, calificaciones1.Materia, calificaciones1.Calificacion, calificaciones1.Asistencia 
        FROM calificaciones1
        INNER JOIN alumnos ON calificaciones1.Matricula = alumnos.Matricula";
$result = $conn->query($sql);

// Mostrar los resultados en la tabla
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["Matricula"] . "</td><td>" . $row["NombreCompleto"] . "</td><td>" . $row["Materia"] . "</td><td>" . $row["Calificacion"] . "</td><td>" . $row["Asistencia"] . "</td></tr>";
    }
} else {
    echo "No hay datos disponibles";
}

$conn->close();
?>
