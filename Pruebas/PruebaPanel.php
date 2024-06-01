<?php
session_start();

// Verificar si el alumno ha iniciado sesión
if (!isset($_SESSION['Matricula'])) {
    // Si no ha iniciado sesión, redirigirlo al formulario de inicio de sesión
    header("Location: ../Modulos Alumno/LogInAlumno.php");
    exit;
}

// Establecer conexión con la base de datos
$conn = new mysqli("localhost", "root", "", "controlescolar");

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del alumno actualmente autenticado
$id_alumno = $_SESSION['Matricula'];

// Consulta SQL para obtener la información del alumno
$sql = "SELECT NombreCompleto, Edad,CorreoElectronico,CURP,Matricula,ApellidoPaterno,ApellidoMaterno FROM alumnos WHERE Matricula = $id_alumno"; 

$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Mostrar datos obtenidos de la consulta
    while ($row = $result->fetch_assoc()) {
        $nombre = $row["NombreCompleto"];
        $edad = $row["Edad"];
        //$semestre = $row["Semestre"];
        //$grupo = $row["Grupo"];
        //$turno = $row["Turno"];
        $correo=$row["CorreoElectronico"];
        $matricula=$row["Matricula"];
        $CURP=$row["CURP"];
        $apellidop=$row["ApellidoPaterno"];
        $apellidom=$row["ApellidoMaterno"];
        //$Gen=$row["periodo_escolar"];
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
    <title>Menú Lateral con Css</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header class="header">
        <div class="container">
        <div class="btn-menu">
            <label for="btn-menu">☰</label>
        </div>
            <div class="logo">
            </div>
            <nav class="menu">
                <a href="#">Inicio</a>
                <a href="#">Nosotros</a>
                <a href="#">Blog</a>
                <a href="#">Contacto</a>
            </nav>
        </div>
    </header>
    <div class="capa"></div>
<!--  --------------->
<input type="checkbox" id="btn-menu">
<div class="container-menu">
    <div class="cont-menu">
        <nav>
            <a href="#">Portafolio</a>
            <a href="#">Servicios</a>
            <a href="#">Suscribirse</a>
            <a href="#">Facebook</a>
            <a href="#">Youtube</a>
            <a href="#">Instagram</a>
        </nav>
        <label for="btn-menu">✖️</label>
    </div>
</div>

<div class="container-info">
    <div class="panel">
        <div class="info">
            <h2>Información del Alumno</h2>
            <p><strong>Nombre:</strong> <?php echo $nombre . ' ' . $apellidop . ' ' . $apellidom; ?></p>
            <p><strong>CURP:</strong> <?php echo $CURP; ?></p>
            <p><strong>Matricula:</strong> <?php echo $matricula; ?></p>
            <p><strong>Edad:</strong> <?php echo $edad; ?> años</p>
            
            <!-- Añade más datos según sea necesario -->
        </div>
    </div>
    <div class="panel">
        <div class="academic">
            <h2>Información Académica</h2>
            <!-- <p><strong>Semestre:</strong> <?php echo $semestre; ?></p>
            <p><strong>Grupo:</strong> <?php echo $grupo; ?></p>
            <p><strong>Turno:</strong> <?php echo $turno; ?></p>
            <p><strong>Generacion:</strong> <?php echo $Gen; ?></p>
            -->
            <p><strong>Correo:</strong> <?php echo $correo; ?></p>
            <!-- Añade más datos según sea necesario -->
        </div>
    </div>
</div>
</body>
</html>