<?php
session_start();

// Verificar si el alumno ha iniciado sesión
if (!isset($_SESSION['ID'])) {
    // Si no ha iniciado sesión, redirigirlo al formulario de inicio de sesión
    header("Location: ../Modulos Jefe Area/LogInJefe.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Alumnos</title>
    <link rel="stylesheet" href="../css/CRUDAlumno.css">
    <style>
        /* Estilos adicionales para el formulario de filtrado */
        #filterForm {
            margin-bottom: 20px;
        }

        #filterForm form {
            display: flex;
            flex-wrap: wrap;
        }

        #filterForm label,
        #filterForm input,
        #filterForm select {
            margin: 5px;
        }

        #filterForm button {
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <h2>Lista de Alumnos de Primer Semestre</h2>

    <!-- Formulario de filtrado -->
    <div id="filterForm">
        <form method="GET">
            <label for="grupo">Grupo:</label>
            <select name="grupo" id="grupo">
                <option value="">Todos</option>
                <!-- Opciones de grupos obtenidas desde la base de datos -->
                <?php
                // Obtener grupos desde la base de datos
                $conexion = mysqli_connect("localhost", "root", "", "controlescolar");
                if ($conexion) {
                    $query = "SELECT DISTINCT nombre_grupo FROM grupos";
                    $result = mysqli_query($conexion, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['nombre_grupo'] . "'>" . $row['nombre_grupo'] . "</option>";
                        }
                        mysqli_free_result($result);
                    }
                    mysqli_close($conexion);
                }
                ?>
            </select>

            <label for="turno">Turno:</label>
            <select name="turno" id="turno">
                <option value="">Todos</option>
                <!-- Opciones de turnos obtenidas desde la base de datos -->
                <?php
                // Obtener turnos desde la base de datos
                $conexion = mysqli_connect("localhost", "root", "", "controlescolar");
                if ($conexion) {
                    $query = "SELECT DISTINCT turno FROM grupos";
                    $result = mysqli_query($conexion, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['turno'] . "'>" . $row['turno'] . "</option>";
                        }
                        mysqli_free_result($result);
                    }
                    mysqli_close($conexion);
                }
                ?>
            </select>

            <label for="matricula">Matrícula:</label>
            <input type="text" name="matricula" id="matricula">

            <button type="submit">Filtrar</button>
        </form>
    </div>

    <!-- Botón para redirigir al formulario existente -->
    <button id="redirectFormBtn" class="add-btn" onclick="window.location.href='./CrearCuenta.php';">Agregar Nuevo Alumno</button>

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
        // Conexión a la base de datos
        $conexion = mysqli_connect("localhost", "root", "", "controlescolar");
        // Verificar conexión
        if (!$conexion) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        // Establecer el conjunto de caracteres a utf8mb4
        mysqli_set_charset($conexion, "utf8mb4");

        // Consulta SQL para obtener todos los alumnos de primer semestre con filtros
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
            WHERE 1
        ";

        // Variables para los filtros
        $filtros = array();

        // Aplicar filtro de grupo si se selecciona
        if (!empty($_GET['grupo'])) {
            $consulta .= " AND g.nombre_grupo = ?";
            $filtros[] = $_GET['grupo'];
        }

        // Aplicar filtro de turno si se selecciona
        if (!empty($_GET['turno'])) {
            $consulta .= " AND g.turno = ?";
            $filtros[] = $_GET['turno'];
        }

        // Aplicar filtro de matrícula si se proporciona
        if (!empty($_GET['matricula'])) {
            $consulta .= " AND a.Matricula = ?";
            $filtros[] = $_GET['matricula'];
        }

        // Preparar la consulta
        $stmt = mysqli_prepare($conexion, $consulta);

        // Vincular parámetros si hay filtros
        if (!empty($filtros)) {
            mysqli_stmt_bind_param($stmt, str_repeat('s', count($filtros)), ...$filtros);
        }

        // Ejecutar la consulta
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

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