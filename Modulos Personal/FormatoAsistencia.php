<?php
$servername = "localhost"; // Cambiar si es necesario
$username = "root"; // Cambiar si es necesario
$password = ""; // Cambiar si es necesario
$dbname = "controlescolar"; // Cambiar al nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

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
    <title>Reporte de Alumnos</title>
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
        select, input[type="submit"] {
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
    <h1>Reporte de Alumnos</h1>
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
        <input type="submit" value="Filtrar Alumnos">
    </form>

    <div class="print-container" id="tabla-alumnos">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $grupo_id = $_POST["grupo"];
            $materia_id = $_POST["materia"];

            // Obtener información del grupo y la materia seleccionados
            $grupo_sql = "SELECT nombre_grupo, turno FROM grupos WHERE id_grupo = $grupo_id";
            $grupo_result = $conn->query($grupo_sql);
            $grupo_info = $grupo_result->fetch_assoc();

            $materia_sql = "SELECT nombre_materia FROM materias WHERE id_materia = $materia_id";
            $materia_result = $conn->query($materia_sql);
            $materia_info = $materia_result->fetch_assoc();

            // Obtener alumnos del grupo seleccionado
            $alumnos_sql = "SELECT Matricula, NombreCompleto FROM alumnos WHERE id_grupo = $grupo_id";
            $alumnos_result = $conn->query($alumnos_sql);

            if ($alumnos_result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Matrícula</th><th>Nombre Completo</th><th>Lunes</th><th>Martes</th><th>Miércoles</th><th>Jueves</th><th>Viernes</th><th>Sábado</th></tr>";
                while($row = $alumnos_result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row["Matricula"]) . "</td>
                            <td>" . htmlspecialchars($row["NombreCompleto"]) . "</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No se encontraron alumnos para el grupo y materia seleccionados.</p>";
            }
        }
        ?>
    </div>
    <button class="print-button" onclick="window.print()">Imprimir Reporte</button>
</body>
</html>
