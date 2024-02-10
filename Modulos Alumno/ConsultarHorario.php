<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['Matricula'])) {
    // Redirigir a la página de inicio de sesión si no ha iniciado sesión
    header("Location: LogInAlumno.php");
    exit();
}

// Conexión a la base de datos (ajusta los valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "controlescolar";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener la información del alumno basada en el usuario autenticado
$usuario_id = $_SESSION['Matricula'];
$alumnoSql = "SELECT * FROM alumnos WHERE Matricula = $usuario_id"; // Ajusta la consulta según tu estructura de base de datos
$alumnoResult = $conn->query($alumnoSql);

// Consulta SQL para obtener todas las materias disponibles
$materiasSql = "SELECT DISTINCT NombreMateria FROM horario"; // Ajusta la consulta según tu estructura de base de datos
$materiasResult = $conn->query($materiasSql);

// Mostrar la información del alumno
if ($alumnoResult->num_rows > 0 && $materiasResult->num_rows > 0) {
    $alumnoRow = $alumnoResult->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Alumno</title>
    <link rel="stylesheet" href="../css/ConsultarHorario.css">
</head>
<body>
    <div id="contenedor">
        <div id="informacion-alumno">
            <h2>Información del Alumno</h2>
            <p>Nombre: <?php echo $alumnoRow["NombreCompleto"]; ?></p>
            <p>Semestre: <?php echo $alumnoRow["Semestre"]; ?></p>
            <p>Grupo: <?php echo $alumnoRow["Grupo"]; ?></p>
        </div>

        <div id="foto-alumno">
            <img src="../Imagenes/Persona.png" alt="Foto del alumno">
        </div>

        <div id="horario">
            <div class="materia">Materia</div>
            <div class="dia-semana">Lunes</div>
            <div class="dia-semana">Martes</div>
            <div class="dia-semana">Miércoles</div>
            <div class="dia-semana">Jueves</div>
            <div class="dia-semana">Viernes</div>
            <div class="dia-semana">Sábado</div>

            <?php
            // Mostrar todas las materias disponibles
            while ($materiaRow = $materiasResult->fetch_assoc()) {
                echo '<div class="materia">' . $materiaRow["NombreMateria"] . '</div>';

                // Consulta SQL para obtener los horarios de la materia actual
                $horariosMateriaSql = "SELECT * FROM horario WHERE NombreMateria = '" . $materiaRow["NombreMateria"] . "'";
                $horariosMateriaResult = $conn->query($horariosMateriaSql);

                if ($horariosMateriaResult->num_rows > 0) {
                    $horarioRow = $horariosMateriaResult->fetch_assoc(); // Tomar el primer registro encontrado

                    // Recorrer los días de la semana
                    $diasSemana = array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");
                    foreach ($diasSemana as $dia) {
                        echo '<div class="clase">' . $horarioRow[$dia] . '</div>'; // Mostrar la hora de la clase para este día
                    }
                } else {
                    // Si no se encontraron horarios para esta materia, mostrar espacios en blanco para cada día de la semana
                    for ($i = 0; $i < 6; $i++) {
                        echo '<div class="clase"></div>';
                    }
                }
            }
            ?>

        </div>
    </div>
</body>
</html>
<?php
} else {
    echo "No se encontraron resultados para el usuario autenticado.";
}

// Cerrar la conexión
$conn->close();
?>
