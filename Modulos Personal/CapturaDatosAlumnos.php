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

// Obtener materias
$sql_materias = "SELECT codigo_materia, nombre_materia FROM materias";
$result_materias = $conn->query($sql_materias);

$materias = array();
if ($result_materias) {
    if ($result_materias->num_rows > 0) {
        while ($row = $result_materias->fetch_assoc()) {
            $materias[] = $row;
        }
    }
} else {
    echo "Error en la consulta de materias: " . $conn->error;
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

// Obtener información adicional de alumnos
$informacion_adicional = array();
if (!empty($alumnos)) {
    $matriculas = array_map(function($alumno) { return $alumno['Matricula']; }, $alumnos);
    $matriculas_list = "'" . implode("','", $matriculas) . "'";
    $sql_info_adicional = "SELECT * FROM informacion_adicional_alumnos WHERE Matricula IN ($matriculas_list)";
    $result_info_adicional = $conn->query($sql_info_adicional);

    if ($result_info_adicional) {
        while ($row = $result_info_adicional->fetch_assoc()) {
            $informacion_adicional[$row['Matricula']] = $row;
        }
    } else {
        echo "Error en la consulta de información adicional: " . $conn->error;
    }
}

// Guardar información adicional
if (isset($_POST['guardar'])) {
    $conn->begin_transaction();

    $messages = array();
    try {
        foreach ($_POST['matriculas'] as $matricula) {
            $extras = $_POST['extras'][$matricula] ?? '';
            $examen_profesional = $_POST['examen_profesional'][$matricula] ?? '';
            $num_seguro_social = $_POST['num_seguro_social'][$matricula] ?? '';
            $nombre_padre_tutor = $_POST['nombre_padre_tutor'][$matricula] ?? '';
            $telefono_padre = $_POST['telefono_padre'][$matricula] ?? '';
            $domicilio = $_POST['domicilio'][$matricula] ?? '';
            $colonia = $_POST['colonia'][$matricula] ?? '';
            $municipio = $_POST['municipio'][$matricula] ?? '';
            $telefono_emergencia = $_POST['telefono_emergencia'][$matricula] ?? '';
            $telefono_casa = $_POST['telefono_casa'][$matricula] ?? '';
            $telefono_celular = $_POST['telefono_celular'][$matricula] ?? '';
            $correo_jalisco_edu = $_POST['correo_jalisco_edu'][$matricula] ?? '';
            $correo_personal = $_POST['correo_personal'][$matricula] ?? '';
            $clave_carrera = $_POST['clave_carrera'][$matricula] ?? '';
            $clave_institucion = $_POST['clave_institucion'][$matricula] ?? '';
            $clave_centro_trabajo = $_POST['clave_centro_trabajo'][$matricula] ?? '';
            $acuerdo_n = $_POST['acuerdo_n'][$matricula] ?? '';
            $regular = $_POST['regular'][$matricula] ?? '';
            $plan_estudios = $_POST['plan_estudios'][$matricula] ?? '';
            $total_creditos = $_POST['total_creditos'][$matricula] ?? '';
            $total_horas = $_POST['total_horas'][$matricula] ?? '';
            $estatus_inactivo = $_POST['estatus_inactivo'][$matricula] ?? '';
            $fecha_ingreso = $_POST['fecha_ingreso'][$matricula] ?? '';
            $nacional = $_POST['nacional'][$matricula] ?? '';
            $estado = $_POST['estado'][$matricula] ?? '';
            $localidad_alumno = $_POST['localidad_alumno'][$matricula] ?? '';
            $municipio_bachillerato = $_POST['municipio_bachillerato'][$matricula] ?? '';
            $clave_bachillerato = $_POST['clave_bachillerato'][$matricula] ?? '';
            $nombre_bachillerato = $_POST['nombre_bachillerato'][$matricula] ?? '';
            $validado_certificado = $_POST['validado_certificado'][$matricula] ?? '';
            $fecha_expedicion_bachillerato = $_POST['fecha_expedicion_bachillerato'][$matricula] ?? '';
            $folio_bachillerato = $_POST['folio_bachillerato'][$matricula] ?? '';
            $promedio_bachillerato = $_POST['promedio_bachillerato'][$matricula] ?? '';
            $puntaje_examen = $_POST['puntaje_examen'][$matricula] ?? '';
            $edad = $_POST['edad'][$matricula] ?? '';
            $ficha_examen = $_POST['ficha_examen'][$matricula] ?? '';
            $talla = $_POST['talla'][$matricula] ?? '';
            $sexo = $_POST['sexo'][$matricula] ?? '';
            $beca = $_POST['beca'][$matricula] ?? '';
            $pendientes = $_POST['pendientes'][$matricula] ?? '';
            $kardex_calificacion_acceso = $_POST['kardex_calificacion_acceso'][$matricula] ?? '';
            $documentos = $_POST['documentos'][$matricula] ?? '';
            $fotografia = $_POST['fotografia'][$matricula] ?? '';
            $fecha_nacimiento = $_POST['fecha_nacimiento'][$matricula] ?? '';

            $sql_insert = "
                INSERT INTO informacion_adicional_alumnos (
                    Matricula, Extras, ExamenProfesional, NumSeguroSocial, NombrePadreTutor, TelefonoPadre, Domicilio, Colonia, Municipio, TelefonoEmergencia, TelefonoCasa, TelefonoCelular, CorreoJaliscoEdu, CorreoPersonal, ClaveCarrera, ClaveInstitucion, ClaveCentroTrabajo, AcuerdoN, Regular, PlanEstudios, TotalCreditos, TotalHoras, EstatusInactivo, FechaIngreso, Nacional, Estado, LocalidadAlumno, MunicipioBachillerato, ClaveBachillerato, NombreBachillerato, ValidadoCertificado, FechaExpedicionBachillerato, FolioBachillerato, PromedioBachillerato, PuntajeExamen, Edad, FichaExamen, Talla, Sexo, Beca, Pendientes, KardexCalificacionAcceso, Documentos, Fotografia, FechaNacimiento
                ) VALUES (
                    '$matricula', '$extras', '$examen_profesional', '$num_seguro_social', '$nombre_padre_tutor', '$telefono_padre', '$domicilio', '$colonia', '$municipio', '$telefono_emergencia', '$telefono_casa', '$telefono_celular', '$correo_jalisco_edu', '$correo_personal', '$clave_carrera', '$clave_institucion', '$clave_centro_trabajo', '$acuerdo_n', '$regular', '$plan_estudios', '$total_creditos', '$total_horas', '$estatus_inactivo', '$fecha_ingreso', '$nacional', '$estado', '$localidad_alumno', '$municipio_bachillerato', '$clave_bachillerato', '$nombre_bachillerato', '$validado_certificado', '$fecha_expedicion_bachillerato', '$folio_bachillerato', '$promedio_bachillerato', '$puntaje_examen', '$edad', '$ficha_examen', '$talla', '$sexo', '$beca', '$pendientes', '$kardex_calificacion_acceso', '$documentos', '$fotografia', '$fecha_nacimiento'
                ) ON DUPLICATE KEY UPDATE
                    Extras='$extras', ExamenProfesional='$examen_profesional', NumSeguroSocial='$num_seguro_social', NombrePadreTutor='$nombre_padre_tutor', TelefonoPadre='$telefono_padre', Domicilio='$domicilio', Colonia='$colonia', Municipio='$municipio', TelefonoEmergencia='$telefono_emergencia', TelefonoCasa='$telefono_casa', TelefonoCelular='$telefono_celular', CorreoJaliscoEdu='$correo_jalisco_edu', CorreoPersonal='$correo_personal', ClaveCarrera='$clave_carrera', ClaveInstitucion='$clave_institucion', ClaveCentroTrabajo='$clave_centro_trabajo', AcuerdoN='$acuerdo_n', Regular='$regular', PlanEstudios='$plan_estudios', TotalCreditos='$total_creditos', TotalHoras='$total_horas', EstatusInactivo='$estatus_inactivo', FechaIngreso='$fecha_ingreso', Nacional='$nacional', Estado='$estado', LocalidadAlumno='$localidad_alumno', MunicipioBachillerato='$municipio_bachillerato', ClaveBachillerato='$clave_bachillerato', NombreBachillerato='$nombre_bachillerato', ValidadoCertificado='$validado_certificado', FechaExpedicionBachillerato='$fecha_expedicion_bachillerato', FolioBachillerato='$folio_bachillerato', PromedioBachillerato='$promedio_bachillerato', PuntajeExamen='$puntaje_examen', Edad='$edad', FichaExamen='$ficha_examen', Talla='$talla', Sexo='$sexo', Beca='$beca', Pendientes='$pendientes', KardexCalificacionAcceso='$kardex_calificacion_acceso', Documentos='$documentos', Fotografia='$fotografia', FechaNacimiento='$fecha_nacimiento'
            ";

            if (!$conn->query($sql_insert)) {
                throw new Exception("Error al guardar información adicional para $matricula: " . $conn->error);
            }
        }

        $conn->commit();
        $messages[] = "La información adicional se ha guardado correctamente.";
    } catch (Exception $e) {
        $conn->rollback();
        $messages[] = $e->getMessage();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Alumnos</title>
    <link rel="stylesheet" href="../css/InfoAlumno.css">
</head>
<body>
    <div class="container">
        <h1>Consulta de Alumnos</h1>
        <form method="post">
            <div class="form-group">
                <label for="matricula">Matrícula:</label>
                <input type="text" id="matricula" name="matricula" value="<?php echo isset($_POST['matricula']) ? htmlspecialchars($_POST['matricula']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="grupo">Grupo:</label>
                <select id="grupo" name="grupo">
                    <option value="">Seleccione un grupo</option>
                    <option value="Todos">Todos</option>
                    <?php foreach ($grupos as $grupo) : ?>
                        <option value="<?php echo $grupo['id_grupo']; ?>" <?php echo (isset($_POST['grupo']) && $_POST['grupo'] == $grupo['id_grupo']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($grupo['nombre_grupo']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit">Consultar</button>
        </form>
        <?php if (isset($alumnos) && !empty($alumnos)) : ?>
            <form method="post">
                <table>
                    <thead>
                        <tr>
                            <th>Matrícula</th>
                            <th>Nombre</th>
                            <th>Grupo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alumnos as $alumno) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($alumno['Matricula']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['nombre_alumno']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['nombre_grupo']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <hr>
                <h2>Información Adicional</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Matrícula</th>
                            <th>Extras</th>
                            <th>Examen Profesional</th>
                            <th>Num Seguro Social</th>
                            <th>Nombre Padre/Tutor</th>
                            <th>Teléfono Padre</th>
                            <th>Domicilio</th>
                            <th>Colonia</th>
                            <th>Municipio</th>
                            <th>Teléfono de Emergencia</th>
                            <th>Teléfono de Casa</th>
                            <th>Teléfono Celular</th>
                            <th>Correo Jalisco Edu</th>
                            <th>Correo Personal</th>
                            <th>Clave Carrera</th>
                            <th>Clave Institución</th>
                            <th>Clave Centro de Trabajo</th>
                            <th>Acuerdo N</th>
                            <th>Regular</th>
                            <th>Plan de Estudios</th>
                            <th>Total Créditos</th>
                            <th>Total Horas</th>
                            <th>Estatus Inactivo</th>
                            <th>Fecha de Ingreso</th>
                            <th>Nacional</th>
                            <th>Estado</th>
                            <th>Localidad</th>
                            <th>Municipio Bachillerato</th>
                            <th>Clave Bachillerato</th>
                            <th>Nombre Bachillerato</th>
                            <th>Validado Certificado</th>
                            <th>Fecha Expedición Bachillerato</th>
                            <th>Folio Bachillerato</th>
                            <th>Promedio Bachillerato</th>
                            <th>Puntaje Examen</th>
                            <th>Edad</th>
                            <th>Ficha Examen</th>
                            <th>Talla</th>
                            <th>Sexo</th>
                            <th>Beca</th>
                            <th>Pendientes</th>
                            <th>Kardex Calificación Acceso</th>
                            <th>Documentos</th>
                            <th>Fotografía</th>
                            <th>Fecha de Nacimiento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alumnos as $alumno) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($alumno['Matricula']); ?></td>
                                <td><input type="text" name="extras[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['Extras'] ?? ''); ?>"></td>
                                <td><input type="text" name="examen_profesional[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['ExamenProfesional'] ?? ''); ?>"></td>
                                <td><input type="text" name="num_seguro_social[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['NumSeguroSocial'] ?? ''); ?>"></td>
                                <td><input type="text" name="nombre_padre_tutor[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['NombrePadreTutor'] ?? ''); ?>"></td>
                                <td><input type="text" name="telefono_padre[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['TelefonoPadre'] ?? ''); ?>"></td>
                                <td><input type="text" name="domicilio[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['Domicilio'] ?? ''); ?>"></td>
                                <td><input type="text" name="colonia[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['Colonia'] ?? ''); ?>"></td>
                                <td><input type="text" name="municipio[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['Municipio'] ?? ''); ?>"></td>
                                <td><input type="text" name="telefono_emergencia[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['TelefonoEmergencia'] ?? ''); ?>"></td>
                                <td><input type="text" name="telefono_casa[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['TelefonoCasa'] ?? ''); ?>"></td>
                                <td><input type="text" name="telefono_celular[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['TelefonoCelular'] ?? ''); ?>"></td>
                                <td><input type="text" name="correo_jalisco_edu[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['CorreoJaliscoEdu'] ?? ''); ?>"></td>
                                <td><input type="text" name="correo_personal[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['CorreoPersonal'] ?? ''); ?>"></td>
                                <td><input type="text" name="clave_carrera[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['ClaveCarrera'] ?? ''); ?>"></td>
                                <td><input type="text" name="clave_institucion[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['ClaveInstitucion'] ?? ''); ?>"></td>
                                <td><input type="text" name="clave_centro_trabajo[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['ClaveCentroTrabajo'] ?? ''); ?>"></td>
                                <td><input type="text" name="acuerdo_n[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['AcuerdoN'] ?? ''); ?>"></td>
                                <td><input type="text" name="regular[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['Regular'] ?? ''); ?>"></td>
                                <td><input type="text" name="plan_estudios[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['PlanEstudios'] ?? ''); ?>"></td>
                                <td><input type="text" name="total_creditos[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['TotalCreditos'] ?? ''); ?>"></td>
                                <td><input type="text" name="total_horas[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['TotalHoras'] ?? ''); ?>"></td>
                                <td><input type="text" name="estatus_inactivo[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['EstatusInactivo'] ?? ''); ?>"></td>
                                <td><input type="text" name="fecha_ingreso[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['FechaIngreso'] ?? ''); ?>"></td>
                                <td><input type="text" name="nacional[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['Nacional'] ?? ''); ?>"></td>
                                <td><input type="text" name="estado[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['Estado'] ?? ''); ?>"></td>
                                <td><input type="text" name="localidad_alumno[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['LocalidadAlumno'] ?? ''); ?>"></td>
                                <td><input type="text" name="municipio_bachillerato[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['MunicipioBachillerato'] ?? ''); ?>"></td>
                                <td><input type="text" name="clave_bachillerato[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['ClaveBachillerato'] ?? ''); ?>"></td>
                                <td><input type="text" name="nombre_bachillerato[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['NombreBachillerato'] ?? ''); ?>"></td>
                                <td><input type="text" name="validado_certificado[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['ValidadoCertificado'] ?? ''); ?>"></td>
                                <td><input type="text" name="fecha_expedicion_bachillerato[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['FechaExpedicionBachillerato'] ?? ''); ?>"></td>
                                <td><input type="text" name="folio_bachillerato[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['FolioBachillerato'] ?? ''); ?>"></td>
                                <td><input type="text" name="promedio_bachillerato[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['PromedioBachillerato'] ?? ''); ?>"></td>
                                <td><input type="text" name="puntaje_examen[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['PuntajeExamen'] ?? ''); ?>"></td>
                                <td><input type="text" name="edad[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['Edad'] ?? ''); ?>"></td>
                                <td><input type="text" name="ficha_examen[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['FichaExamen'] ?? ''); ?>"></td>
                                <td><input type="text" name="talla[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['Talla'] ?? ''); ?>"></td>
                                <td><input type="text" name="sexo[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['Sexo'] ?? ''); ?>"></td>
                                <td><input type="text" name="beca[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['Beca'] ?? ''); ?>"></td>
                                <td><input type="text" name="pendientes[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['Pendientes'] ?? ''); ?>"></td>
                                <td><input type="text" name="kardex_calificacion_acceso[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['KardexCalificacionAcceso'] ?? ''); ?>"></td>
                                <td><input type="text" name="documentos[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['Documentos'] ?? ''); ?>"></td>
                                <td><input type="text" name="fotografia[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['Fotografia'] ?? ''); ?>"></td>
                                <td><input type="text" name="fecha_nacimiento[<?php echo htmlspecialchars($alumno['Matricula']); ?>]" value="<?php echo htmlspecialchars($informacion_adicional[$alumno['Matricula']]['FechaNacimiento'] ?? ''); ?>"></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="submit">Guardar Información Adicional</button>
            </form>
        <?php endif; ?>
        <?php if (!empty($messages)) : ?>
            <div class="messages">
                <?php foreach ($messages as $message) : ?>
                    <p><?php echo htmlspecialchars($message); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
