<?php
session_start();

// Verificar si el personal ha iniciado sesión
if (!isset($_SESSION['ID'])) {
    // Si no ha iniciado sesión, redirigirlo al formulario de inicio de sesión
    header("Location: ../Modulos Personal/LogInPersonal.php");
    exit;
}

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "controlescolar");

// Verificar conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Establecer el conjunto de caracteres a utf8mb4
mysqli_set_charset($conexion, "utf8mb4");

// Obtener el ID del personal de la sesión
$id_personal = $_SESSION['ID'];

// Consulta SQL para obtener el turno del personal
$consulta_turno = "SELECT Turno FROM personal WHERE ID = $id_personal";
$resultado_turno = mysqli_query($conexion, $consulta_turno);

// Verificar si se encontró el turno del personal
if (mysqli_num_rows($resultado_turno) == 1) {
    $fila_turno = mysqli_fetch_assoc($resultado_turno);
    $turno_personal = $fila_turno['Turno'];
} else {
    // Si no se encontró el turno del personal, mostrar un mensaje de error y terminar la ejecución
    echo "Error: No se encontró el turno del personal.";
    exit;
}

// Consulta SQL para obtener los grupos asociados al turno del personal
$consulta_grupos = "SELECT DISTINCT nombre_grupo FROM grupos WHERE turno = '$turno_personal'";
$resultado_grupos = mysqli_query($conexion, $consulta_grupos);

// Array para almacenar los nombres de los grupos
$grupos = array();

// Obtener nombres de grupos y guardarlos en el array
while ($fila_grupo = mysqli_fetch_assoc($resultado_grupos)) {
    $grupos[] = $fila_grupo['nombre_grupo'];
}

// Consulta SQL base
$consulta = "
    SELECT 
        a.Matricula, 
        a.NombreCompleto, 
        a.ApellidoPaterno, 
        a.ApellidoMaterno, 
        a.FechaNacimiento, 
        a.CorreoElectronico, 
        g.semestre AS Semestre, 
        g.nombre_grupo AS Grupo, 
        g.turno AS Turno, 
        g.periodo_escolar AS periodo_escolar, 
        a.CURP, 
        a.lugar_nacimiento,
        ia.Extras,
        ia.ExamenProfesional,
        ia.NumSeguroSocial,
        ia.NombrePadreTutor,
        ia.TelefonoPadre,
        ia.Domicilio,
        ia.Colonia,
        ia.Municipio,
        ia.TelefonoEmergencia,
        ia.TelefonoCasa,
        ia.TelefonoCelular,
        ia.CorreoJaliscoEdu,
        ia.CorreoPersonal,
        ia.ClaveCarrera,
        ia.ClaveInstitucion,
        ia.ClaveCentroTrabajo,
        ia.AcuerdoN,
        ia.Regular,
        ia.PlanEstudios,
        ia.TotalCreditos,
        ia.TotalHoras,
        ia.EstatusInactivo,
        ia.FechaIngreso,
        ia.Nacional,
        ia.Estado,
        ia.LocalidadAlumno,
        ia.MunicipioBachillerato,
        ia.ClaveBachillerato,
        ia.NombreBachillerato,
        ia.ValidadoCertificado,
        ia.FechaExpedicionBachillerato,
        ia.FolioBachillerato,
        ia.PromedioBachillerato,
        ia.PuntajeExamen,
        ia.Edad,
        ia.FichaExamen,
        ia.Talla,
        ia.Sexo,
        ia.Beca,
        ia.Pendientes,
        ia.KardexCalificacionAcceso,
        ia.Fotografia,
        ia.FechaNacimiento AS FechaNacimientoAdicional
    FROM 
        alumnos a
    LEFT JOIN 
        grupos g ON a.id_grupo = g.id_grupo
    LEFT JOIN 
        informacion_adicional_alumnos ia ON a.Matricula = ia.Matricula
    WHERE 
        g.semestre = '1'
";

// Aplicar filtro de grupo si se ha enviado en el formulario
if (isset($_GET['grupo']) && $_GET['grupo'] !== '') {
    $grupo_filtro = $_GET['grupo'];
    $consulta .= " AND g.nombre_grupo = '$grupo_filtro'";
}

// Aplicar filtro de matrícula si se ha enviado en el formulario
if (isset($_GET['matricula']) && $_GET['matricula'] !== '') {
    $matricula_filtro = $_GET['matricula'];
    $consulta .= " AND a.Matricula = '$matricula_filtro'";
}

// Ejecutar consulta SQL
$resultado = mysqli_query($conexion, $consulta);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado Alumnos</title>
    <link rel="stylesheet" href="../css/ListadoAlumnos.css">
</head>
<body>
    <h2>Lista de Alumnos de Primer Semestre</h2>

    <!-- Formulario de filtros -->
    <form method="GET">
        <label for="grupo">Filtrar por Grupo:</label>
        <select name="grupo" id="grupo">
            <option value="">Todos</option>
            <?php
            // Mostrar opciones de grupos
            foreach ($grupos as $grupo) {
                echo "<option value='$grupo'>$grupo</option>";
            }
            ?>
        </select>

        <label for="matricula">Buscar por Matrícula:</label>
        <input type="text" name="matricula" id="matricula" placeholder="Ingrese matrícula">

        <button type="submit">Filtrar</button>
    </form>
    
    <!-- Tabla de alumnos -->
    <table>
        <tr>
            <th>Matrícula</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Fecha Nacimiento</th>
            <th>Correo Electrónico</th>
            <th>Semestre</th>
            <th>Grupo</th>
            <th>Turno</th>
            <th>Periodo Escolar</th>
            <th>CURP</th>
            <th>Lugar Nacimiento</th>
            <th>Extras</th>
            <th>Examen Profesional</th>
            <th>Num SeguroSocial</th>
            <th>Nombre Padre/Tutor</th>
            <th>Telefono Padre</th>
            <th>Domicilio</th>
            <th>Colonia</th>
            <th>Municipio</th>
            <th>Tel Emergencia</th>
            <th>Tel Casa</th>
            <th>Tel Celular</th>
            <th>Correo JaliscoEdu</th>
            <th>Correo Personal</th>
            <th>Clave Carrera</th>
            <th>Clave Institucion</th>
            <th>Clave Centro Trabajo</th>
            <th>AcuerdoN</th>
            <th>Regular</th>
            <th>Plan Estudios</th>
            <th>Total Creditos</th>
            <th>Total Horas</th>
            <th>Estatus Inactivo</th>
            <th>Fecha Ingreso</th>
            <th>Nacional</th>
            <th>Estado</th>
            <th>Localidad Alumno</th>
            <th>Municipio Bachillerato</th>
            <th>Clave Bachillerato</th>
            <th>Nombre Bachillerato</th>
            <th>Validado Certificado</th>
            <th>Fecha Expedicion Bachillerato</th>
            <th>Folio Bachillerato</th>
            <th>Promedio Bachillerato</th>
            <th>Puntaje Examen</th>
            <th>Edad</th>
            <th>Ficha Examen</th>
            <th>Talla</th>
            <th>Sexo</th>
            <th>Beca</th>
            <th>Pendientes</th>
            <th>Kardex Calificacion Acceso</th>
            <th>Fotografia</th>
            <th>Fecha de nacimiento</th>
            <th>Acciones</th>
        </tr>
        <?php
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
                echo "<td>" . (isset($fila['Semestre']) ? $fila['Semestre'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['Grupo']) ? $fila['Grupo'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['Turno']) ? $fila['Turno'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['periodo_escolar']) ? $fila['periodo_escolar'] : 'N/A') . "</td>";
                echo "<td>" . $fila['CURP'] . "</td>";
                echo "<td>" . $fila['lugar_nacimiento'] . "</td>";
                echo "<td>" . (isset($fila['Extras']) ? $fila['Extras'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['ExamenProfesional']) ? $fila['ExamenProfesional'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['NumSeguroSocial']) ? $fila['NumSeguroSocial'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['NombrePadreTutor']) ? $fila['NombrePadreTutor'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['TelefonoPadre']) ? $fila['TelefonoPadre'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['Domicilio']) ? $fila['Domicilio'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['Colonia']) ? $fila['Colonia'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['Municipio']) ? $fila['Municipio'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['TelTelefonoEmergencia']) ? $fila['TelefonoEmergencia'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['TelefonoCasa']) ? $fila['TelefonoCasa'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['TelefonoCelular']) ? $fila['TelefonoCelular'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['CorreoJaliscoEdu']) ? $fila['CorreoJaliscoEdu'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['CorreoPersonal']) ? $fila['CorreoPersonal'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['ClaveCarrera']) ? $fila['ClaveCarrera'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['ClaveInstitucion']) ? $fila['ClaveInstitucion'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['ClaveCentroTrabajo']) ? $fila['ClaveCentroTrabajo'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['AcuerdoN']) ? $fila['AcuerdoN'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['Regular']) ? $fila['Regular'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['PlanEstudios']) ? $fila['PlanEstudios'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['TotalCreditos']) ? $fila['TotalCreditos'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['TotalHoras']) ? $fila['TotalHoras'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['EstatusInactivo']) ? $fila['EstatusInactivo'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['FechaIngreso']) ? $fila['FechaIngreso'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['Nacional']) ? $fila['Nacional'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['Estado']) ? $fila['Estado'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['LocalidadAlumno']) ? $fila['LocalidadAlumno'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['MunicipioBachillerato']) ? $fila['MunicipioBachillerato'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['ClaveBachillerato']) ? $fila['ClaveBachillerato'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['NombreBachillerato']) ? $fila['NombreBachillerato'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['ValidadoCertificado']) ? $fila['ValidadoCertificado'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['FechaExpedicionBachillerato']) ? $fila['FechaExpedicionBachillerato'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['FolioBachillerato']) ? $fila['FolioBachillerato'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['PromedioBachillerato']) ? $fila['PromedioBachillerato'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['PuntajeExamen']) ? $fila['PuntajeExamen'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['Edad']) ? $fila['Edad'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['FichaExamen']) ? $fila['FichaExamen'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['Talla']) ? $fila['Talla'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['Sexo']) ? $fila['Sexo'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['Beca']) ? $fila['Beca'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['Pendientes']) ? $fila['Pendientes'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['KardexCalificacionAcceso']) ? $fila['KardexCalificacionAcceso'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['Fotografia']) ? $fila['Fotografia'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['FechaNacimiento']) ? $fila['FechaNacimiento'] : 'N/A') . "</td>";
                echo "<td>";
                echo "<div class='btn-group'>";
                echo "<a class='edit-btn' href='./Editar.php?matricula=" . $fila['Matricula'] . "'>Editar</a>";
                echo "<a class='delete-btn' href='./Archivar.php?matricula=" . $fila['Matricula'] . "'>Archivar</a>";
                echo "</div>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='13'>No se encontraron alumnos que cumplan con los filtros seleccionados.</td></tr>";
        }

        // Cerrar conexión
        mysqli_close($conexion);
        ?>
    </table>
</body>
</html>
