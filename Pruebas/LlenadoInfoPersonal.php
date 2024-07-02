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
if ($result_grupos) {
    if ($result_grupos->num_rows > 0) {
        while ($row = $result_grupos->fetch_assoc()) {
            $grupos[] = $row;
        }
    }
} else {
    echo "Error en la consulta de grupos: " . $conn->error;
}

// Obtener alumnos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['matricula'])) {
        $matricula = $_POST['matricula'];
        $sql_alumnos = "SELECT a.Matricula, CONCAT(a.NombreCompleto, ' ', a.ApellidoPaterno, ' ', a.ApellidoMaterno) AS nombre_alumno, g.nombre_grupo FROM alumnos a JOIN grupos g ON a.id_grupo = g.id_grupo WHERE a.Matricula = '$matricula'";
    } elseif (isset($_POST['grupo'])) {
        $grupo_seleccionado = $_POST['grupo'];
        if ($grupo_seleccionado == "Todos") {
            $sql_alumnos = "SELECT a.Matricula, CONCAT(a.NombreCompleto, ' ', a.ApellidoPaterno, ' ', a.ApellidoMaterno) AS nombre_alumno, g.nombre_grupo FROM alumnos a JOIN grupos g ON a.id_grupo = g.id_grupo";
        } else {
            $sql_alumnos = "SELECT a.Matricula, CONCAT(a.NombreCompleto, ' ', a.ApellidoPaterno, ' ', a.ApellidoMaterno) AS nombre_alumno, g.nombre_grupo FROM alumnos a JOIN grupos g ON a.id_grupo = g.id_grupo WHERE g.id_grupo = '$grupo_seleccionado'";
        }
    } else {
        $sql_alumnos = "SELECT a.Matricula, CONCAT(a.NombreCompleto, ' ', a.ApellidoPaterno, ' ', a.ApellidoMaterno) AS nombre_alumno, g.nombre_grupo FROM alumnos a JOIN grupos g ON a.id_grupo = g.id_grupo";
    }
} else {
    $sql_alumnos = "SELECT a.Matricula, CONCAT(a.NombreCompleto, ' ', a.ApellidoPaterno, ' ', a.ApellidoMaterno) AS nombre_alumno, g.nombre_grupo FROM alumnos a JOIN grupos g ON a.id_grupo = g.id_grupo";
}

$result_alumnos = $conn->query($sql_alumnos);

$alumnos = array();
if ($result_alumnos) {
    if ($result_alumnos->num_rows > 0) {
        while ($row = $result_alumnos->fetch_assoc()) {
            $alumnos[] = $row;
        }
    }
} else {
    echo "Error en la consulta de alumnos: " . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completar perfil alumno</title>
    <link rel="stylesheet" href="../css/styles.css">
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
        <h2>Completar perfil alumno</h2>
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
                        <th>Nombre del Alumno</th>
                        <th>Grupo</th>
                        <th>Examen profesional</th>
                        <th>Correo Jalisco Edu</th>
                        <th>Clave carrera</th>
                        <th>Clave institución</th>
                        <th>Clave del centro de trabajo</th>
                        <th>Acuerdo n</th>
                        <th>Regular</th>
                        <th>Plan de estudios</th>
                        <th>Total de créditos</th>
                        <th>Total de horas</th>
                        <th>Estatus</th>
                        <th>Validado certificado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alumnos as $alumno): ?>
                        <tr>
                            <td><?php echo $alumno['Matricula']; ?></td>
                            <td><?php echo $alumno['nombre_alumno']; ?></td>
                            <td><?php echo $alumno['nombre_grupo']; ?></td>
                            <td><input type="text" name="examen_profesional[<?php echo $alumno['Matricula']; ?>]"></td>
                            <td><input type="text" name="correo_jalisco[<?php echo $alumno['Matricula']; ?>]"></td>
                            <td><input type="text" name="clave_carrera[<?php echo $alumno['Matricula']; ?>]"></td>
                            <td><input type="text" name="clave_institucion[<?php echo $alumno['Matricula']; ?>]"></td>
                            <td><input type="text" name="clave_centro[<?php echo $alumno['Matricula']; ?>]"></td>
                            <td><input type="text" name="acuerdo_n[<?php echo $alumno['Matricula']; ?>]"></td>
                            <td><input type="text" name="regular[<?php echo $alumno['Matricula']; ?>]"></td>
                            <td><input type="text" name="plan_estudios[<?php echo $alumno['Matricula']; ?>]"></td>
                            <td><input type="text" name="total_creditos[<?php echo $alumno['Matricula']; ?>]"></td>
                            <td><input type="text" name="total_horas[<?php echo $alumno['Matricula']; ?>]"></td>
                            <td><input type="text" name="estatus[<?php echo $alumno['Matricula']; ?>]"></td>
                            <td><input type="text" name="validado_certificado[<?php echo $alumno['Matricula']; ?>]"></td>
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
                foreach ($_POST['examen_profesional'] as $matricula => $examen_profesional) {
                    // Verificar si se ha ingresado información para este alumno
                    if (!empty($examen_profesional) || !empty($_POST['correo_jalisco'][$matricula]) || !empty($_POST['clave_carrera'][$matricula]) || !empty($_POST['clave_institucion'][$matricula]) || !empty($_POST['clave_centro'][$matricula]) || !empty($_POST['acuerdo_n'][$matricula]) || !empty($_POST['regular'][$matricula]) || !empty($_POST['plan_estudios'][$matricula]) || !empty($_POST['total_creditos'][$matricula]) || !empty($_POST['total_horas'][$matricula]) || !empty($_POST['estatus'][$matricula]) || !empty($_POST['validado_certificado'][$matricula])) {
                        $correo_jalisco = $_POST['correo_jalisco'][$matricula];
                        $clave_carrera = $_POST['clave_carrera'][$matricula];
                        $clave_institucion = $_POST['clave_institucion'][$matricula];
                        $clave_centro = $_POST['clave_centro'][$matricula];
                        $acuerdo_n = $_POST['acuerdo_n'][$matricula];
                        $regular = $_POST['regular'][$matricula];
                        $plan_estudios = $_POST['plan_estudios'][$matricula];
                        $total_creditos = $_POST['total_creditos'][$matricula];
                        $total_horas = $_POST['total_horas'][$matricula];
                        $estatus = $_POST['estatus'][$matricula];
                        $validado_certificado = $_POST['validado_certificado'][$matricula];

                        $sql_update = "UPDATE alumnos SET Examen_profesional='$examen_profesional', Correo_Jalisco_Edu='$correo_jalisco', Clave_Carrera='$clave_carrera', Clave_Institucion='$clave_institucion', Clave_Centro='$clave_centro', Acuerdo_n='$acuerdo_n', Regular='$regular', Plan_de_Estudios='$plan_estudios', Total_Creditos='$total_creditos', Total_Horas='$total_horas', Estatus='$estatus', Validado_Certificado='$validado_certificado' WHERE Matricula='$matricula'";

                        if ($conn->query($sql_update) === TRUE) {
                            $messages[] = "Datos del alumno con matrícula $matricula actualizados correctamente.";
                        } else {
                            throw new Exception("Error al actualizar los datos del alumno con matrícula $matricula: " . $conn->error);
                        }
                    }
                }
                $conn->commit();
            } catch (Exception $e) {
                $conn->rollback();
                $messages[] = "Error: " . $e->getMessage();
            }

            $conn->close();
            foreach ($messages as $message) {
                echo '<div class="notification success">' . $message . '</div>';
            }
        }
        ?>
    </div>
</body>
</html>
