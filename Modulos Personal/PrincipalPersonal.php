<?php
session_start();

// Verificar si el alumno ha iniciado sesión
if (!isset($_SESSION['ID'])) {
    // Si no ha iniciado sesión, redirigirlo al formulario de inicio de sesión
    header("Location: ../Modulos Personal/LogInPersonal.php");
    exit;
}

// Establecer conexión con la base de datos
$conn = new mysqli("localhost", "root", "", "controlescolar");

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del alumno actualmente autenticado
$id_alumno = $_SESSION['ID'];

// Consulta SQL para obtener la información del alumno
$sql = "SELECT NombreCompleto, ApellidoPaterno, ApellidoMaterno, Turno, CorreoElectronico FROM personal WHERE ID = $id_alumno"; 

$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Mostrar datos obtenidos de la consulta
    while ($row = $result->fetch_assoc()) {
        $nombre = $row["NombreCompleto"];
        $edad = $row["ApellidoMaterno"];
        $semestre = $row["ApellidoPaterno"];
        $grupo = $row["Turno"];
        $turno = $row["CorreoElectronico"];
    }
} else {
    echo "No se encontraron resultados.";
}

// Cerrar conexión con la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control Personal</title>
    <link rel="stylesheet" href="../css/Panel.Alumno.css">
</head>
<body>

<div class="menu" onclick="toggleMenu()">
    <img src="../Imagenes/LogoBycenj.png" alt="Menú"> <!-- Cambia "tu_imagen_del_menu.png" por la ruta de tu imagen -->
</div>
<div class="menu-options" id="menuOptions">
    <a href="./CapturaCalificaciones.php" class="menu-option">Captura de calificaciones</a>
    <a href="./constancia.html" class="menu-option">Constancia</a>
    <a href="./ListadoAlumno.php" class="menu-option">Listado Alumnos</a>
    <a href="../php/CerrarSesionPersonal.php" class="menu-option">Cerrar sesion</a>
    <!-- Agrega más opciones según sea necesario -->
</div>

<div class="container">
    <div class="panel">
        <div class="info">
            <h2>Información del Alumno</h2>
            <p><strong>Nombre:</strong> <?php echo $nombre; ?></p>
            <p><strong>Apellidos:</strong> <?php echo $edad; ?></p>
            <!-- Añade más datos según sea necesario -->
        </div>
    </div>
    <div class="panel">
        <div class="academic">
            <h2>Información Académica</h2>
            <p><strong>Turno:</strong> <?php echo $turno; ?></p>
            <!-- Añade más datos según sea necesario -->
        </div>
    </div>
</div>

<script src="../js/Menu.js"></script>
</body>
</html>
