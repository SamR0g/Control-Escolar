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
            <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="matricula" id="matriculaInput" placeholder="Buscar por matrícula">
                <select name="grupo" id="grupoSelect">
                    <option value="">Filtrar por grupo</option>
                    <?php
                    // Conexión a la base de datos
                    $servername = "localhost"; // Nombre del servidor
                    $username = "root"; // Nombre de usuario de la base de datos
                    $password = ""; // Contraseña de la base de datos
                    $database = "controlescolar"; // Nombre de la base de datos

                    // Crear conexión
                    $conn = new mysqli($servername, $username, $password, $database);

                    // Consulta SQL para obtener los grupos desde la base de datos
                    $sql_grupos = "SELECT id_grupo, nombre_grupo FROM grupos";
                    $result_grupos = $conn->query($sql_grupos);
                    if ($result_grupos->num_rows > 0) {
                        while($row_grupo = $result_grupos->fetch_assoc()) {
                            echo "<option value='" . $row_grupo["id_grupo"] . "'>" . $row_grupo["nombre_grupo"] . "</option>";
                        }
                    }
                    ?>
                </select>
                <select name="materia" id="materiaSelect">
                    <option value="">Filtrar por materia</option>
                    <?php
                    // Consulta SQL para obtener las materias desde la base de datos
                    $sql_materias = "SELECT id_materia, nombre_materia FROM materias";
                    $result_materias = $conn->query($sql_materias);
                    if ($result_materias->num_rows > 0) {
                        while($row_materia = $result_materias->fetch_assoc()) {
                            echo "<option value='" . $row_materia["id_materia"] . "'>" . $row_materia["nombre_materia"] . "</option>";
                        }
                    }
                    ?>
                </select>
                <button type="submit">Buscar</button>
            </form>
        </div>
        <!-- Aquí va la tabla de calificaciones -->
        <?php
        // Obtener los parámetros de filtrado
        $matricula = isset($_GET['matricula']) ? $_GET['matricula'] : '';
        $grupo = isset($_GET['grupo']) ? $_GET['grupo'] : '';
        $materia = isset($_GET['materia']) ? $_GET['materia'] : '';

        // Consulta SQL base para obtener las calificaciones de los alumnos
        $sql = "SELECT alumnos.Matricula, alumnos.NombreCompleto, materias.nombre_materia, calificaciones.calificacion, calificaciones.asistencia
                FROM calificaciones
                INNER JOIN alumnos ON calificaciones.Matricula = alumnos.Matricula
                INNER JOIN materias ON calificaciones.id_materia = materias.id_materia";

        // Aplicar filtro por grupo si se ha seleccionado un grupo
        if($grupo != '') {
            $sql .= " WHERE alumnos.id_grupo = $grupo";
        }

        // Aplicar filtro por materia si se ha seleccionado una materia
        if($materia != '') {
            $sql .= " AND materias.id_materia = $materia";
        }

        // Aplicar filtro por matricula si se ha ingresado una matrícula
        if($matricula != '') {
            $sql .= " AND alumnos.Matricula = '$matricula'";
        }

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <script>
        function imprimirTabla() {
            window.print();
        }

        function exportarAExcel() {
            var table = document.getElementById('calificacionesTable');
            var wb = XLSX.utils.table_to_book(table, {sheet:"Sheet JS"});
            XLSX.writeFile(wb, 'calificaciones.xlsx');
        }
    </script>
</body>
</html>
