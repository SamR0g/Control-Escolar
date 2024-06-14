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

// Establecer el conjunto de caracteres a utf8 para manejar los acentos correctamente
$conn->set_charset("utf8");

// Consulta SQL para obtener la información del alumno
$usuario_id = $_SESSION['Matricula'];
$alumnoSql = "SELECT CONCAT(alumnos.NombreCompleto, ' ', alumnos.ApellidoPaterno, ' ', alumnos.ApellidoMaterno) AS NombreCompleto, 
                     alumnos.id_grupo, grupos.semestre, grupos.nombre_grupo, grupos.turno, grupos.Aula 
              FROM alumnos 
              INNER JOIN grupos ON alumnos.id_grupo = grupos.id_grupo
              WHERE alumnos.Matricula = ?";
$stmt = $conn->prepare($alumnoSql);
$stmt->bind_param("s", $usuario_id);
$stmt->execute();
$alumnoResult = $stmt->get_result();
$alumnoRow = $alumnoResult->fetch_assoc();

// Consulta SQL para obtener los horarios del alumno
$horarioSql = "SELECT materias.nombre_materia, horario.docente, horario.Lunes, horario.Martes, horario.Miércoles, horario.Jueves, horario.Viernes, horario.Sábado 
               FROM horario 
               INNER JOIN materias ON horario.id_materia = materias.id_materia
               WHERE horario.id_grupo = ?";
$stmt = $conn->prepare($horarioSql);
$stmt->bind_param("i", $alumnoRow['id_grupo']);
$stmt->execute();
$horarioResult = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Alumno</title>
    <link rel="stylesheet" href="./Horario.css">
</head>
<body>
    
    <div id="contenedor">
        <div id="informacion-alumno">
            <div id="foto-alumno">
                <img src="../php/foto.php" alt="Foto del alumno">
            </div>
            <div id="datos-alumno">
                <h2>Información del Alumno</h2>
                <p>Nombre: <?php echo htmlspecialchars($alumnoRow["NombreCompleto"]); ?></p>
                <p>Semestre: <?php echo htmlspecialchars($alumnoRow["semestre"]); ?>  <?php echo htmlspecialchars($alumnoRow["nombre_grupo"]); ?></p>
                <p>Turno: <?php echo htmlspecialchars($alumnoRow["turno"]); ?></p>
                <p>Aula: <?php echo htmlspecialchars($alumnoRow["Aula"]); ?></p>
            </div>
        </div>

        <div id="horario">
            <div class="header">Materia</div>
            <div class="header">Docente</div>
            <div class="header">Lunes</div>
            <div class="header">Martes</div>
            <div class="header">Miércoles</div>
            <div class="header">Jueves</div>
            <div class="header">Viernes</div>
            <div class="header">Sábado</div>

            <?php
            // Mostrar los horarios
            if ($horarioResult->num_rows > 0) {
                while ($horarioRow = $horarioResult->fetch_assoc()) {
                    echo '<div class="materia">' . htmlspecialchars($horarioRow["nombre_materia"]) . '</div>';
                    echo '<div class="docente">' . htmlspecialchars($horarioRow["docente"]) . '</div>';
                    echo '<div class="clase">' . htmlspecialchars($horarioRow["Lunes"]) . '</div>';
                    echo '<div class="clase">' . htmlspecialchars($horarioRow["Martes"]) . '</div>';
                    echo '<div class="clase">' . htmlspecialchars($horarioRow["Miércoles"]) . '</div>';
                    echo '<div class="clase">' . htmlspecialchars($horarioRow["Jueves"]) . '</div>';
                    echo '<div class="clase">' . htmlspecialchars($horarioRow["Viernes"]) . '</div>';
                    echo '<div class="clase">' . htmlspecialchars($horarioRow["Sábado"]) . '</div>';
                }
            } else {
                echo '<div class="materia">No se encontraron horarios para mostrar</div>';
                echo '<div class="docente"></div>';
                for ($i = 0; $i < 6; $i++) {
                    echo '<div class="clase"></div>';
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
