<?php
session_start();

if (!isset($_SESSION['ID'])) {
    header("Location: ../Modulos Personal/LogInPersonal.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "controlescolar";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql_grupos = "SELECT DISTINCT id_grupo FROM alumnos";
$result_grupos = $conn->query($sql_grupos);

$grupos = array();
if ($result_grupos->num_rows > 0) {
    while($row = $result_grupos->fetch_assoc()) {
        $grupos[] = $row['id_grupo'];
    }
}

$sql_materias = "SELECT codigo_materia, nombre_materia FROM materias";
$result_materias = $conn->query($sql_materias);

$materias = array();
if ($result_materias->num_rows > 0) {
    while($row = $result_materias->fetch_assoc()) {
        $materias[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['matricula'])) {
        $matricula = $_POST['matricula'];
        $sql_alumnos = "SELECT Matricula, id_grupo FROM alumnos WHERE Matricula = '$matricula'";
    } elseif (isset($_POST['grupo'])) {
        $grupo_seleccionado = $_POST['grupo'];
        if ($grupo_seleccionado == "Todos") {
            $sql_alumnos = "SELECT Matricula, id_grupo FROM alumnos";
        } else {
            $sql_alumnos = "SELECT Matricula, id_grupo FROM alumnos WHERE id_grupo = '$grupo_seleccionado'";
        }
    } else {
        $sql_alumnos = "SELECT Matricula, id_grupo FROM alumnos";
    }
} else {
    $sql_alumnos = "SELECT Matricula, id_grupo FROM alumnos";
}

$result_alumnos = $conn->query($sql_alumnos);

$alumnos = array();
if ($result_alumnos->num_rows > 0) {
    while($row = $result_alumnos->fetch_assoc()) {
        $alumnos[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Calificaciones</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Registro de Calificaciones</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="matricula">Buscar por Matrícula:</label>
                <input type="text" name="matricula" id="matricula">
                <button type="submit">Buscar</button>
            </div>
            <div class="form-group">
                <label for="grupo">Filtrar por Grupo:</label>
                <select name="grupo" id="grupo">
                    <option value="Todos">Todos</option>
                    <?php foreach ($grupos as $grupo): ?>
                        <option value="<?php echo $grupo; ?>" <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['grupo']) && $_POST['grupo'] == $grupo) echo "selected"; ?>><?php echo $grupo; ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Mostrar</button>
            </div>
        </form>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <table>
                <thead>
                    <tr>
                        <th>Matrícula</th>
                        <th>Grupo</th>
                        <?php foreach ($materias as $materia): ?>
                            <th><?php echo $materia['nombre_materia']; ?> (Código: <?php echo $materia['codigo_materia']; ?>)</th>
                            <th>Calificación</th>
                            <th>Asistencia (%)</th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alumnos as $alumno): ?>
                        <tr>
                            <td><?php echo $alumno['Matricula']; ?></td>
                            <td><?php echo $alumno['id_grupo']; ?></td>
                            <?php foreach ($materias as $materia): ?>
                                <td><?php echo $materia['codigo_materia']; ?></td>
                                <td><input type="number" name="calificaciones[<?php echo $alumno['Matricula']; ?>][<?php echo $materia['codigo_materia']; ?>]" min="0" max="100" required></td>
                                <td><input type="number" name="asistencias[<?php echo $alumno['Matricula']; ?>][<?php echo $materia['codigo_materia']; ?>]" min="0" max="100" required></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" name="guardar">Guardar</button>
        </form>
    </div>
</body>
</html>

<?php
if (isset($_POST['guardar'])) {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $conn->begin_transaction();

    try {
        foreach ($_POST['calificaciones'] as $matricula => $materias) {
            foreach ($materias as $codigo_materia => $calificacion) {
                $asistencia = $_POST['asistencias'][$matricula][$codigo_materia];
                $fecha_registro = date("Y-m-d");

                $sql = "INSERT INTO calificaciones (Matricula, id_materia, calificacion, asistencia, fecha_registro) VALUES (?, (SELECT id_materia FROM materias WHERE codigo_materia = ?), ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("isdss", $matricula, $codigo_materia, $calificacion, $asistencia, $fecha_registro);
                $stmt->execute();
            }
        }

        $conn->commit();
        echo "Calificaciones y asistencias guardadas correctamente.";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error al guardar las calificaciones y asistencias: " . $e->getMessage();
    }

    $conn->close();
}
?>
