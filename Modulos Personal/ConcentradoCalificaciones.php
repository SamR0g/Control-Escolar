<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concentrado de Calificaciones</title>
    <link rel="stylesheet" href="../css/Concentrado.css">
</head>
<body>
    <div class="container">
        <h1>Concentrado de Calificaciones</h1>
        <div class="filters">
            <input type="text" id="matriculaInput" placeholder="Buscar por matrícula">
            <select id="grupoSelect">
                <option value="">Filtrar por grupo</option>
                <!-- Aquí puedes cargar dinámicamente los grupos desde la base de datos -->
            </select>
            <button onclick="buscarCalificaciones()">Buscar</button>
        </div>
        <!-- Aquí va la tabla de calificaciones -->
        <?php
        // Conexión a la base de datos
        $servername = "localhost"; // Nombre del servidor
        $username = "root"; // Nombre de usuario de la base de datos
        $password = ""; // Contraseña de la base de datos
        $database = "controlescolar"; // Nombre de la base de datos

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $database);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Falló la conexión: " . $conn->connect_error);
        }

        // Consulta SQL para obtener las calificaciones de los alumnos
        $sql = "SELECT alumnos.Matricula, alumnos.NombreCompleto, materias.nombre_materia, calificaciones.calificacion, calificaciones.asistencia
                FROM calificaciones
                INNER JOIN alumnos ON calificaciones.Matricula = alumnos.Matricula
                INNER JOIN materias ON calificaciones.id_materia = materias.id_materia";

        $result = $conn->query($sql);

        // Mostrar los datos en la tabla HTML
        if ($result->num_rows > 0) {
            echo "<table id='calificacionesTable'>";
            echo "<tr><th>Matrícula</th><th>Nombre</th><th>Materia</th><th>Calificación</th><th>Asistencia</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["Matricula"] . "</td>";
                echo "<td>" . $row["NombreCompleto"] . "</td>";
                echo "<td>" . $row["nombre_materia"] . "</td>";
                echo "<td>" . $row["calificacion"] . "</td>";
                echo "<td>" . $row["asistencia"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 resultados";
        }

        // Cerrar conexión
        $conn->close();
        ?>
        <div class="buttons">
            <button onclick="imprimirTabla()">Imprimir</button>
            <button onclick="exportarAExcel()">Exportar a Excel</button>
        </div>
    </div>

    <script src="../js/Concentrado.js"></script>
</body>
</html>
