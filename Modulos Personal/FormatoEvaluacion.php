<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "controlescolar";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Establecer el conjunto de caracteres a utf8 para manejar los acentos correctamente
$conn->set_charset("utf8");

// Obtener grupos y materias para los selectores
$grupos_sql = "SELECT id_grupo, nombre_grupo, turno FROM grupos";
$materias_sql = "SELECT id_materia, nombre_materia FROM materias";

$grupos_result = $conn->query($grupos_sql);
$materias_result = $conn->query($materias_sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Tabla de Evaluaciones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
        }
        form {
            margin-bottom: 20px;
            text-align: center;
        }
        select, input[type="date"], input[type="submit"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 200px;
            margin-right: 10px;
            margin-bottom: 10px;
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .print-button {
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            margin: 20px auto;
        }
        .print-button:hover {
            background-color: #45a049;
        }
        @media print {
            body * {
                visibility: hidden;
            }
            .print-container, .print-container * {
                visibility: visible;
            }
            .print-container {
                position: absolute;
                left: 0;
                top: 0;
            }
            table {
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #000;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
        }
    </style>
</head>
<body>
    <h1>Generar Tabla de Evaluaciones</h1>
    <form method="POST" action="">
        <label for="grupo">Grupo:</label>
        <select name="grupo" id="grupo" required>
            <?php
            if ($grupos_result->num_rows > 0) {
                while($row = $grupos_result->fetch_assoc()) {
                    echo "<option value='" . $row["id_grupo"] . "' data-turno='" . $row["turno"] . "'>" . $row["nombre_grupo"] . "</option>";
                }
            }
            ?>
        </select>
        <label for="materia">Materia:</label>
        <select name="materia" id="materia" required>
            <?php
            if ($materias_result->num_rows > 0) {
                while($row = $materias_result->fetch_assoc()) {
                    echo "<option value='" . $row["id_materia"] . "'>" . $row["nombre_materia"] . "</option>";
                }
            }
            ?>
        </select>
        <label for="fecha_inicio">Fecha Inicio:</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" required>
        <label for="fecha_fin">Fecha Fin:</label>
        <input type="date" id="fecha_fin" name="fecha_fin" required>
        <input type="submit" value="Generar Tabla">
    </form>

    <div class="print-container" id="tabla-alumnos">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $grupo_id = $_POST["grupo"];
            $materia_id = $_POST["materia"];
            $fecha_inicio = $_POST["fecha_inicio"];
            $fecha_fin = $_POST["fecha_fin"];

            // Obtener información del grupo y la materia seleccionados
            $grupo_sql = "SELECT nombre_grupo, turno FROM grupos WHERE id_grupo = $grupo_id";
            $grupo_result = $conn->query($grupo_sql);
            $grupo_info = $grupo_result->fetch_assoc();

            $materia_sql = "SELECT nombre_materia FROM materias WHERE id_materia = $materia_id";
            $materia_result = $conn->query($materia_sql);
            $materia_info = $materia_result->fetch_assoc();

            // Mostrar información del grupo y la materia seleccionados
            echo "<h2>Grupo: " . htmlspecialchars($grupo_info['nombre_grupo']) . " (Turno: " . htmlspecialchars($grupo_info['turno']) . ")</h2>";
            echo "<h3>Materia: " . htmlspecialchars($materia_info['nombre_materia']) . "</h3>";
            echo "<h4>Período: " . htmlspecialchars($fecha_inicio) . " - " . htmlspecialchars($fecha_fin) . "</h4>";

            // Obtener alumnos para el grupo seleccionado
            $alumnos_sql = "SELECT Matricula, NombreCompleto FROM alumnos WHERE id_grupo = $grupo_id";
            $alumnos_result = $conn->query($alumnos_sql);

            if ($alumnos_result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Matrícula</th><th>Nombre Completo</th><th>Calificación</th><th>Asistencia</th></tr>";
                while($row = $alumnos_result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row["Matricula"]) . "</td>
                            <td>" . htmlspecialchars($row["NombreCompleto"]) . "</td>
                            <td contenteditable='true'></td>
                            <td contenteditable='true'></td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No se encontraron alumnos para el grupo seleccionado.</p>";
            }
        }
        ?>
    </div>
    <button class="print-button" onclick="window.print()">Imprimir Reporte</button>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
