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
$conn->set_charset("utf8");

// Obtener grupos
$sql_grupos = "SELECT DISTINCT g.id_grupo, g.nombre_grupo FROM alumnos a JOIN grupos g ON a.id_grupo = g.id_grupo";
$result_grupos = $conn->query($sql_grupos);

$grupos = array();
if ($result_grupos->num_rows > 0) {
    while ($row = $result_grupos->fetch_assoc()) {
        $grupos[] = $row;
    }
}

// Obtener materias
$sql_materias = "SELECT codigo_materia, nombre_materia FROM materias";
$result_materias = $conn->query($sql_materias);

$materias = array();
if ($result_materias->num_rows > 0) {
    while ($row = $result_materias->fetch_assoc()) {
        $materias[] = $row;
    }
}

// Obtener alumnos
$sql_alumnos = "SELECT a.Matricula, CONCAT(a.NombreCompleto, ' ', a.ApellidoPaterno, ' ', a.ApellidoMaterno) AS NombreCompleto, g.nombre_grupo 
                FROM alumnos a 
                JOIN grupos g ON a.id_grupo = g.id_grupo";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['matricula'])) {
        $matricula = $_POST['matricula'];
        $sql_alumnos .= " WHERE a.Matricula = '$matricula'";
    } elseif (isset($_POST['grupo'])) {
        $grupo_seleccionado = $_POST['grupo'];
        if ($grupo_seleccionado == "Todos") {
            // La consulta ya trae todos los alumnos por defecto
        } else {
            $sql_alumnos .= " WHERE g.id_grupo = '$grupo_seleccionado'";
        }
    }
}

$result_alumnos = $conn->query($sql_alumnos);

$alumnos = array();
if ($result_alumnos->num_rows > 0) {
    while ($row = $result_alumnos->fetch_assoc()) {
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
    <link rel="stylesheet" href="../css/styles1.css">
    <style>
        .notification {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid transparent;
            border-radius: 5px;
        }
        .success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .error {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
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
                        <option value="<?php echo $grupo['id_grupo']; ?>" <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['grupo']) && $_POST['grupo'] == $grupo['id_grupo']) echo "selected"; ?>><?php echo $grupo['nombre_grupo']; ?></option>
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
                        <th>Nombre Completo</th>
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
                            <td><?php echo $alumno['NombreCompleto']; ?></td>
                            <td><?php echo $alumno['nombre_grupo']; ?></td>
                            <?php foreach ($materias as $materia): ?>
                                <?php
                                    $id_materia = $materia['codigo_materia'];
                                    $matricula = $alumno['Matricula'];
                                    // Check if the grade already exists
                                    $conn = new mysqli($servername, $username, $password, $dbname);
                                    $sql_check = "SELECT * FROM calificaciones WHERE Matricula = '$matricula' AND id_materia = (SELECT id_materia FROM materias WHERE codigo_materia = '$id_materia')";
                                    $result_check = $conn->query($sql_check);
                                    $exists = ($result_check->num_rows > 0) ? true : false;
                                    $conn->close();
                                    $disabled = $exists ? 'disabled' : '';
                                ?>
                                <td><?php echo $materia['codigo_materia']; ?></td>
                                <td><input type="number" name="calificaciones[<?php echo $matricula; ?>][<?php echo $id_materia; ?>]" min="0" max="10" required <?php echo $disabled; ?>></td>
                                <td><input type="number" name="asistencias[<?php echo $matricula; ?>][<?php echo $id_materia; ?>]" min="0" max="100" required <?php echo $disabled; ?>></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" name="guardar">Guardar</button>
        </form>

        <?php
        if (isset($_POST['guardar'])) {
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            $conn->begin_transaction();

            $messages = array();

            try {
                foreach ($_POST['calificaciones'] as $matricula => $materias) {
                    foreach ($materias as $codigo_materia => $calificacion) {
                        // Check if the grade already exists
                        $sql_check = "SELECT * FROM calificaciones WHERE Matricula = '$matricula' AND id_materia = (SELECT id_materia FROM materias WHERE codigo_materia = '$codigo_materia')";
                        $result_check = $conn->query($sql_check);
                        
                        if ($result_check->num_rows > 0) {
                            $messages[] = "<div class='notification error'>Calificación para matrícula $matricula y materia $codigo_materia ya está registrada.</div>";
                        } else {
                            $asistencia = $_POST['asistencias'][$matricula][$codigo_materia];
                            $fecha_registro = date("Y-m-d");

                            $sql = "INSERT INTO calificaciones (Matricula, id_materia, calificacion, asistencia, fecha_registro) VALUES (?, (SELECT id_materia FROM materias WHERE codigo_materia = ?), ?, ?, ?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("issds", $matricula, $codigo_materia, $calificacion, $asistencia, $fecha_registro);
                            $stmt->execute();

                            $messages[] = "<div class='notification success'>Calificación para matrícula $matricula y materia $codigo_materia guardada correctamente.</div>";
                        }
                    }
                }

                $conn->commit();
            } catch (Exception $e) {
                $conn->rollback();
                $messages[] = "<div class='notification error'>Error al guardar las calificaciones y asistencias: " . $e->getMessage() . "</div>";
            }

            $conn->close();

            foreach ($messages as $message) {
                echo $message;
            }
        }
        ?>
    </div>
</body>
</html>
