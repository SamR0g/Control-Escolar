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
$sql = "SELECT NombreCompleto, ApellidoPaterno, ApellidoMaterno, Turno, CorreoElectronico,ID FROM coordinador WHERE ID = $id_alumno"; 

$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Mostrar datos obtenidos de la consulta
    while ($row = $result->fetch_assoc()) {
        $ID = $row["ID"];
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
    <title>coordinador Area</title>
    <link rel="stylesheet" href="../css/Panel.Alumno.css">
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
                <a href="https://sites.google.com/bycenj.edu.mx/bycenj/nosotros">Nosotros</a>
                <a href="https://sites.google.com/bycenj.edu.mx/bycenj/inicio">Blog</a>      
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
                <a href="./CrearCuenta.php">Crear Cuenta Alumno</a>
                <a href="./CrearCuentaPersonal.php">Crear Cuenta Personal</a>
                <a href="./CrearGrupo.php">Crear Grupo</a>
                <a href="./CrearHorario.php">Crear Horario</a>
                <a href="./CapturarMateria.php">Crear Materia</a>
                <a href="./CRUD.php">Listado Alumnos</a>
                <a href="./Grupos.php">Asignar Grupos</a>
                <a href="./CapturaCalificacion.php">Captura Calificaciones</a>
                <a href="../php/CerrarSesionJefe.php">Cerrar Sesion</a>
        </nav>
        <label for="btn-menu">✖️</label>
    </div>
</div>

<div class="container-info">
    <div class="panel">
        <div class="info">
            <h2>Información del Personal</h2>
            <p><strong>Nombre:</strong> <?php echo $nombre . ' ' . $apellidop . ' ' . $apellidom; ?></p>
            <p><strong>ID:</strong> <?php echo $ID; ?></p>
            
            <!-- Añade más datos según sea necesario -->
        </div>
    </div>
    <div class="panel">
        <div class="academic">
            <h2>Información Personal</h2>
            <p><strong>Turno:</strong> <?php echo $grupo; ?></p>
            <p><strong>Correo:</strong> <?php echo $turno; ?></p>
            <!-- Añade más datos según sea necesario -->
        </div>
    </div>
</div>
</body>
</html>