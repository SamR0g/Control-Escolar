<?php
session_start(); // Iniciar sesión

// Verificar si el usuario ha iniciado sesión
if(!isset($_SESSION['Matricula'])) {
    // Redirigir al usuario al formulario de inicio de sesión si no ha iniciado sesión
    header("Location: LoginAalumno.php");
    exit();
}

// Conexión a la base de datos
$servername = "localhost"; // Cambia esto si tu servidor de MySQL no está en localhost
$username = "root";
$password = "";
$database = "controlescolar";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener la matrícula del usuario desde la sesión
$matricula = $_SESSION['Matricula'];

// Consulta para obtener los datos del alumno
$sql = "SELECT NombreCompleto, Semestre FROM alumnos WHERE Matricula = '$matricula'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Obtener el nombre y el grado del alumno
    $row = $result->fetch_assoc();
    $nombre_alumno = $row['NombreCompleto'];
    $grado_alumno = $row['Semestre'];

    // Consulta para obtener las calificaciones del alumno
    $sql_calificaciones = "SELECT Materia, Calificacion, Asistencia FROM calificaciones1 WHERE Matricula = '$matricula'";
    $result_calificaciones = $conn->query($sql_calificaciones);
} else {
    // No se encontró al alumno, puedes redirigirlo o mostrar un mensaje de error
    echo "No se encontró al alumno.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Boleta de Calificaciones</title>
<link rel="stylesheet" href="../css/BoletaBuena.css">
</head>
<body>

<div class="container" id="printable">
    <div class="logo">
        <img src="../Imagenes/LogoBycenj.png" alt="Logo de la escuela">
    </div>
    <h1>Boleta de Calificaciones</h1>
    <h2>Información del Alumno</h2>
    <p><strong>Nombre:</strong> <?php echo $nombre_alumno; ?></p>
    <p><strong>Grado:</strong> <?php echo $grado_alumno; ?></p>
    <table>
        <thead>
            <tr>
                <th>Materia</th>
                <th>Calificación</th>
                <th class="percentage-column">Porcentaje de Asistencia</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result_calificaciones->num_rows > 0) {
                while ($row_calificaciones = $result_calificaciones->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row_calificaciones["Materia"] . "</td>
                            <td>" . $row_calificaciones["Calificacion"] . "</td>
                            <td class='percentage-column'><span>" . $row_calificaciones["Asistencia"] . "</span></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No se encontraron calificaciones</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="button-container">
        <button id="download-btn">Descargar</button>
        <button id="print-btn">Imprimir</button>
    </div>
</div>

<script src="../js/Boleta.js"></script>

</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>
