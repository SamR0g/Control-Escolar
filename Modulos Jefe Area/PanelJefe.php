<?php
session_start();

// Verificar si el alumno ha iniciado sesión
if (!isset($_SESSION['ID'])) {
    // Si no ha iniciado sesión, redirigirlo al formulario de inicio de sesión
    header("Location: ../Modulos Jefe Area/LogInJefe.php");
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
$sql = "SELECT NombreCompleto, ApellidoPaterno, ApellidoMaterno, Turno, CorreoElectronico FROM coordinador WHERE ID = $id_alumno"; 

$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Mostrar datos obtenidos de la consulta
    while ($row = $result->fetch_assoc()) {
        $nombre = $row["NombreCompleto"];
        $apellidom = $row["ApellidoMaterno"];
        $apellidop = $row["ApellidoPaterno"];
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
    <title>Panel de Control Coordinador</title>
    <link rel="stylesheet" href="../css/Panel.Alumno.css">
</head>
<body>

<div class="menu" onclick="toggleMenu()">
    <img src="../Imagenes/LogoBycenj.png" alt="Menú"> <!-- Cambia "tu_imagen_del_menu.png" por la ruta de tu imagen -->
</div>
<div class="menu-options" id="menuOptions">
    <a href="../Modulos Personal/CapturaCalificaciones.php" class="menu-option">Captura de calificaciones</a>
    <a href="./Grupos.php" class="menu-option">Asignar grupos</a>
    <a href="./CrearHorario.php" class="menu-option">Crear Horario</a>
    <a href="./CRUD.php" class="menu-option">Listado Alumnos</a>
    <a href="./CrearCuentaPersonal.php" class="menu-option">Crear cuenta Personal</a>
    <a href="./CrearCuenta.php" class="menu-option">Crear cuenta alumno</a>
    <a href="../php/CerrarSesionJefe.php" class="menu-option">Cerrar sesion</a>
    <!-- Agrega más opciones según sea necesario -->
</div>

<div class="container">
    <div class="panel">
        <div class="info">
            <h2>Información del Coordinador</h2>
            <p><strong>Nombre:</strong> <?php echo $nombre . ' ' . $apellidop . ' ' . $apellidom; ?></p>
            
            <!-- Añade más datos según sea necesario -->
        </div>
    </div>
    <div class="panel">
        <div class="academic">
            <h2>Información Personal</h2>
            <p><strong>Correo:</strong> <?php echo $turno; ?></p>
            <!-- Añade más datos según sea necesario -->
        </div>
    </div>
</div>

<script src="../js/Menu.js"></script>
</body>
</html>
