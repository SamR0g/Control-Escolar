<?php
session_start(); // Iniciar sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['Matricula'])) {
    // Redirigir al usuario al formulario de inicio de sesión si no ha iniciado sesión
    header("Location: LogInAlumno.php");
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

// Configurar la codificación de caracteres para la conexión a la base de datos
$conn->set_charset("utf8");

// Obtener la matrícula del usuario desde la sesión
$matricula = $_SESSION['Matricula'];

// Variable para almacenar mensajes
$messages = [];

// Consulta para obtener los datos del alumno, el semestre y el grupo
$sql = "SELECT CONCAT(alumnos.NombreCompleto, ' ', alumnos.ApellidoPaterno, ' ', alumnos.ApellidoMaterno) AS NombreCompleto, alumnos.id_grupo, grupos.nombre_grupo, grupos.Semestre, grupos.Turno, alumnos.Foto
        FROM alumnos 
        JOIN grupos ON alumnos.id_grupo = grupos.id_grupo 
        WHERE alumnos.Matricula = '$matricula'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Obtener el nombre completo, grupo, semestre y turno del alumno
    $row = $result->fetch_assoc();
    $nombre_completo = $row['NombreCompleto'];
    $nombre_grupo = $row['nombre_grupo'];
    $grado_alumno = $row['Semestre'];
    $turno_alumno = $row['Turno'];
    $foto_base64 = base64_encode($row['Foto']);

    // Consulta para obtener las calificaciones del alumno junto con el nombre de las materias
    $sql_calificaciones = "SELECT materias.nombre_materia AS Materia, calificaciones.calificacion AS Calificacion, calificaciones.asistencia AS Asistencia 
                           FROM calificaciones 
                           JOIN materias ON calificaciones.id_materia = materias.id_materia 
                           WHERE calificaciones.Matricula = '$matricula'";
    $result_calificaciones = $conn->query($sql_calificaciones);

    if ($result_calificaciones->num_rows == 0) {
        $messages[] = "<div class='notification error'>No se encontraron calificaciones.</div>";
    }
} else {
    // No se encontró al alumno, puedes redirigirlo o mostrar un mensaje de error
    $messages[] = "<div class='notification error'>No se encontró al alumno.</div>";
}

// Cerramos la conexión después de usarla
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boleta de Calificaciones</title>
    <style>
        /* Estilo para evitar que la imagen se divida entre páginas */
        .foto-alumno {
            page-break-inside: avoid;
        }
        .notification {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid transparent;
            border-radius: 5px;
        }
        .success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .error {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
        .home-icon {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .home-icon img {
            width: 30px;
            height: 30px;
        }
    </style>
    <link rel="stylesheet" href="../css/Boletac.css"> <!-- Mantenemos el enlace al archivo CSS -->
</head>
<body>

<div class="container" id="printable">
    <a href="./PrincipalAlumno.php" class="home-icon">
        <img src="../Imagenes/Home.png" alt="Home">
    </a>
    <div class="logo">
        <img src="../Imagenes/LogoBycenj.png" alt="Logo de la escuela">
    </div>
    <h1>Boleta de Calificaciones</h1>
    <h2>Información del Alumno</h2>
    <div class="info-foto">
        <div class="info-alumno">
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($nombre_completo); ?></p>
            <p><strong>Grupo:</strong> <?php echo htmlspecialchars($nombre_grupo); ?></p>
            <p><strong>Grado:</strong> <?php echo htmlspecialchars($grado_alumno); ?></p>
            <p><strong>Turno:</strong> <?php echo htmlspecialchars($turno_alumno); ?></p>
        </div>
        <div class="foto-alumno">
            <img src="data:image/jpeg;base64,<?php echo $foto_base64; ?>" alt="Foto del alumno">
        </div>
    </div>
    <?php
    foreach ($messages as $message) {
        echo $message;
    }
    ?>
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
                            <td>" . htmlspecialchars($row_calificaciones["Materia"]) . "</td>
                            <td>" . htmlspecialchars($row_calificaciones["Calificacion"]) . "</td>
                            <td class='percentage-column'><span>" . htmlspecialchars($row_calificaciones["Asistencia"]) . "</span></td>
                          </tr>";
                }
            }
            ?>
        </tbody>
    </table>
    <div class="button-container">
        <button id="download-btn" onclick="downloadPDF()">Descargar</button>
        <button id="print-btn" onclick="printPage()">Imprimir</button>
    </div>
</div>

<script>
function printPage() {
    var printableArea = document.getElementById('printable').innerHTML;
    var originalDocument = document.body.innerHTML;
    document.body.innerHTML = printableArea;
    window.print();
    document.body.innerHTML = originalDocument;
}

function downloadPDF() {
    var printContents = document.getElementById('printable').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>

</body>
</html>
