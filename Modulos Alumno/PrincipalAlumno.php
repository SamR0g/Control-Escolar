<?php
session_start();

if (!isset($_SESSION['Matricula'])) {
    echo '
    <script>
    alert("Por favor debes iniciar sesión");
    window.location="LogInAlumno.php";
    </script>
    ';

    session_destroy();
    die();
}

include('../php/ConexionBase.php');

$user_id = $_SESSION['Matricula'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/PrincipalAlumno.css"> <!-- Asegúrate de incluir tus estilos aquí -->
    
    <title>Panel Alumno</title>
</head>

<body>

    <div id="bienvenida">
        <h1>Bienvenido</h1>
    </div>

    <div id="menu-container">
         <div id="circulo-menu" onclick="toggleMenu()">
             <img src="../Imagenes/LogoBycenj.png" alt="Menú">
          </div>
         <div id="menu">
             <a href="PrincipalAlumno.html">
          <div>Inicio</div>
             </a>
             <a href="ConsultarHorario.php">
         <div>Consulta Horario</div>
             </a>
             <a href="Kardex.html">
         <div>Consulta Kardex</div>
             </a>
             <a href="Boleta.html">
         <div>Consulta Boleta</div>
             </a>
             <a href="../php/CerrarSesionAlumno.php">
         <div>Cerrar Sesion</div>
             </a>
         </div>
  </div>

    <div class="container">
        <div class="usuario-ficha">
            <?php
            $user_id = $_SESSION['Matricula'];
            $sql = "SELECT * FROM alumnos WHERE Matricula = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();

            $result = $stmt->get_result();
            $datos = $result->fetch_assoc();
            $stmt->close();

            if ($datos) {
                echo 'Nombre: ' . $datos['NombreCompleto'] . PHP_EOL;
                echo 'Apellido Paterno: ' . $datos['ApellidoPaterno'] . PHP_EOL;
                echo 'Apellido Materno: ' . $datos['ApellidoMaterno'] . PHP_EOL;
                echo 'Correo Electrónico: ' . $datos['CorreoElectronico'] . PHP_EOL;
                echo 'Semestre: ' . $datos['Semestre'] . PHP_EOL;
                echo 'Grupo: ' . $datos['Grupo'] . PHP_EOL;
            } else {
                echo 'Usuario no encontrado.';
            }
            ?>
        </div>

        <div class="additional-container">
            <!-- Aquí puedes agregar más información o elementos según sea necesario -->
        </div>

    </div>

    <script>
        function toggleMenu() {
            var menu = document.getElementById('menu');
            menu.classList.toggle('active');
        }
    </script>
</body>

</html>