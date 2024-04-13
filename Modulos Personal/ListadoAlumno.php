<?php
session_start();

// Verificar si el alumno ha iniciado sesión
if (!isset($_SESSION['ID'])) {
    // Si no ha iniciado sesión, redirigirlo al formulario de inicio de sesión
    header("Location: ../Modulos Personal/LogInPersonal.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Alumnos</title>
    <link rel="stylesheet" href="../css/ListadoAlumnos.css">
</head>
<body>
    <h2>Lista de Alumnos de Primer Semestre</h2>
    
    <!-- Formulario para agregar nuevo alumno -->
    <div id="agregarAlumnoForm" style="display: none;">
        <h3>Agregar Nuevo Alumno</h3>
        <form id="formAgregarAlumno" method="POST" action="../php/CrearAlumno.php">
            <table>
                <tr>
                    <td><label for="matricula">Matrícula:</label></td>
                    <td><input type="text" id="matricula" name="matricula" required></td>
                </tr>
                <tr>
                    <td><label for="nombreCompleto">Nombre Completo:</label></td>
                    <td><input type="text" id="nombreCompleto" name="nombreCompleto" required></td>
                </tr>
                <tr>
                    <td><label for="apellidoPaterno">Apellido Paterno:</label></td>
                    <td><input type="text" id="apellidoPaterno" name="apellidoPaterno" required></td>
                </tr>
                <tr>
                    <td><label for="apellidoMaterno">Apellido Materno:</label></td>
                    <td><input type="text" id="apellidoMaterno" name="apellidoMaterno" required></td>
                </tr>
                <tr>
                    <td><label for="fechaNacimiento">Fecha de Nacimiento:</label></td>
                    <td><input type="date" id="fechaNacimiento" name="fechaNacimiento" required></td>
                </tr>
                <tr>
                    <td><label for="correoElectronico">Correo Electrónico:</label></td>
                    <td><input type="email" id="correoElectronico" name="correoElectronico" required></td>
                </tr>
                <tr>
                    <td><label for="semestre">Semestre:</label></td>
                    <td><input type="number" id="semestre" name="semestre" required></td>
                </tr>
                <tr>
                    <td><label for="grupo">Grupo:</label></td>
                    <td><input type="text" id="grupo" name="grupo" required></td>
                </tr>
                <tr>
                    <td><label for="edad">Edad:</label></td>
                    <td><input type="number" id="edad" name="edad" required></td>
                </tr>
                <tr>
                    <td><label for="turno">Turno:</label></td>
                    <td><input type="text" id="turno" name="turno" required></td>
                </tr>
                <tr>
                    <td><label for="periodoEscolar">Periodo Escolar:</label></td>
                    <td><input type="text" id="periodoEscolar" name="periodoEscolar" required></td>
                </tr>
                <tr>
                    <td><label for="curp">CURP:</label></td>
                    <td><input type="text" id="curp" name="curp" required></td>
                </tr>
                <tr>
                    <td><label for="lugarNacimiento">Lugar de Nacimiento:</label></td>
                    <td><input type="text" id="lugarNacimiento" name="lugarNacimiento" required></td>
                </tr>
            </table>
            <button type="submit">Agregar Alumno</button>
        </form>
    </div>

    <!-- Botón para mostrar/ocultar formulario -->
    <button id="showFormBtn" class="add-btn">Agregar Nuevo Alumno</button>

    <!-- Tabla de alumnos -->
    <table>
        <tr>
            <th>Matricula</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Fecha Nacimiento</th>
            <th>Correo Electronico</th>
            <th>Semestre</th>
            <th>Grupo</th>
            <th>Edad</th>
            <th>Turno</th>
            <th>periodo escolar</th>
            <th>CURP</th>
            <th>Lugar Nacimiento</th>
            <th>Acciones</th>
        </tr>
        <?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "controlescolar");
// Verificar conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consulta SQL para obtener todos los alumnos de primer semestre
$consulta = "SELECT * FROM alumnos WHERE Semestre = 1";
$resultado = mysqli_query($conexion, $consulta);

// Mostrar resultados en la tabla
if (mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td>" . $fila['Matricula'] . "</td>";
        echo "<td>" . $fila['NombreCompleto'] . "</td>";
        echo "<td>" . $fila['ApellidoPaterno'] . "</td>";
        echo "<td>" . $fila['ApellidoMaterno'] . "</td>";
        echo "<td>" . $fila['FechaNacimiento'] . "</td>";
        echo "<td>" . $fila['CorreoElectronico'] . "</td>";
        echo "<td>" . $fila['Semestre'] . "</td>";
        echo "<td>" . $fila['Grupo'] . "</td>";
        echo "<td>" . $fila['Edad'] . "</td>";
        echo "<td>" . $fila['Turno'] . "</td>";
        echo "<td>" . $fila['periodo_escolar'] . "</td>";
        echo "<td>" . $fila['CURP'] . "</td>";
        echo "<td>" . $fila['lugar_nacimiento'] . "</td>";
        echo "<td>";
        echo "<div class='btn-group'>";
        echo "<a class='edit-btn' href='./EditarAlumno.php?matricula=" . $fila['Matricula'] . "'>Editar</a>";
        echo "<a class='delete-btn' href='./Eliminar.php?matricula=" . $fila['Matricula'] . "'>Eliminar</a>";
        echo "</div>";
        echo "</td>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='14'>No se encontraron alumnos de primer semestre.</td></tr>";
}

// Cerrar conexión
mysqli_close($conexion);
?>
    </table>

    <!-- Script para mostrar/ocultar formulario -->
    <script>
        document.getElementById('showFormBtn').addEventListener('click', function() {
            var form = document.getElementById('agregarAlumnoForm');
            if (form.style.display === 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        });
    </script>
</body>
</html>
