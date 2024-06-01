<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_materia = $_POST["nombre_materia"];
    $id_grupo = $_POST["grupo"];
    $docente = $_POST["docente"];
    $lunes = $_POST["Lunes"];
    $martes = $_POST["Martes"];
    $miercoles = $_POST["Miercoles"];
    $jueves = $_POST["Jueves"];
    $viernes = $_POST["Viernes"];
    $sabado = $_POST["Sabado"];

    // Si el campo del docente está vacío, mostrar un mensaje de error
    if (empty($docente)) {
        $mensaje = "Error: El campo del docente es obligatorio.";
    } else {
        // Conexión a la base de datos
        $conexion = mysqli_connect("localhost", "root", "", "controlescolar");

        // Verificar la conexión
        if (mysqli_connect_errno()) {
            $mensaje = "Fallo al conectar a MySQL: " . mysqli_connect_error();
        } else {
            // Establecer el conjunto de caracteres a UTF-8
            mysqli_set_charset($conexion, "utf8");

            // Consultar horarios existentes para el mismo grupo
            $query = "SELECT * FROM horario WHERE id_grupo = '$id_grupo'";
            $resultado = mysqli_query($conexion, $query);

            $conflicto = false;

            // Verificar cada día por conflictos
            while ($fila = mysqli_fetch_assoc($resultado)) {
                if (($lunes != '' && $fila['Lunes'] != '' && $lunes == $fila['Lunes']) ||
                    ($martes != '' && $fila['Martes'] != '' && $martes == $fila['Martes']) ||
                    ($miercoles != '' && $fila['Miércoles'] != '' && $miercoles == $fila['Miércoles']) ||
                    ($jueves != '' && $fila['Jueves'] != '' && $jueves == $fila['Jueves']) ||
                    ($viernes != '' && $fila['Viernes'] != '' && $viernes == $fila['Viernes']) ||
                    ($sabado != '' && $fila['Sábado'] != '' && $sabado == $fila['Sábado'])) {
                    $conflicto = true;
                    break;
                }
            }

            if ($conflicto) {
                $mensaje = "Error: Este horario cruza con otro horario existente para el mismo grupo.";
            } else {
                // Preparar la consulta para insertar el horario en la tabla horario
                $query = "INSERT INTO horario (id_materia, id_grupo, docente, Lunes, Martes, Miércoles, Jueves, Viernes, Sábado)
                          VALUES ('$id_materia', '$id_grupo', '$docente', '$lunes', '$martes', '$miercoles', '$jueves', '$viernes', '$sabado')";

                // Ejecutar la consulta
                if (mysqli_query($conexion, $query)) {
                    $mensaje = "Horario guardado correctamente.";
                } else {
                    $mensaje = "Error al guardar el horario: " . mysqli_error($conexion);
                }
            }

            // Cerrar la conexión
            mysqli_close($conexion);
        }
    }

    // Mostrar notificación
    echo "<script>alert('$mensaje'); window.location.href = '../Modulos Jefe Area/CrearHorario.php';</script>";
} else {
    // Si no se ha enviado el formulario, redireccionar al formulario
    header("Location: ../Modulos Jefe Area/CrearHorario.php");
    exit();
}
?>
