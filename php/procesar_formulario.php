<?php
// Verificar si se han enviado datos desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos (reemplaza 'localhost', 'usuario', 'contraseña' y 'basedatos' con los valores correspondientes)
    $conexion = new mysqli("localhost", "root", "", "controlescolar");

    // Verificar si la conexión fue exitosa
    if ($conexion->connect_error) {
        die("Error al conectar a la base de datos: " . $conexion->connect_error);
    }

    // Obtener los datos del formulario
    $nombreGrupo = $_POST["nombre_grupo"];
    $semestre = $_POST["semestre"];
    $turno = $_POST["turno"];
    $periodoEscolar = $_POST["periodo_escolar"];
    $aula = $_POST["aula"];

    // Verificar si ya existe un grupo con el mismo nombre, semestre, turno y aula
    $verificarGrupo = $conexion->prepare("SELECT nombre_grupo FROM grupos WHERE nombre_grupo = ? AND semestre = ? AND turno = ? AND aula = ?");
    $verificarGrupo->bind_param("sisi", $nombreGrupo, $semestre, $turno, $aula);
    $verificarGrupo->execute();
    $verificarGrupo->store_result();

    if ($verificarGrupo->num_rows > 0) {
        // Grupo ya registrado, enviar mensaje de error en formato JSON
        $mensaje = json_encode(array("error" => "Ya existe un grupo con el mismo nombre, semestre, turno y aula."));
        echo $mensaje;
        exit();
    }

    // Preparar la consulta SQL para insertar un nuevo registro en la tabla 'grupos'
    $consulta = $conexion->prepare("INSERT INTO grupos (nombre_grupo, semestre, turno, Aula, periodo_escolar) VALUES (?, ?, ?, ?, ?)");

    // Verificar si la preparación de la consulta fue exitosa
    if ($consulta === false) {
        die("Error al preparar la consulta: " . $conexion->error);
    }

    // Vincular parámetros a la consulta preparada
    $consulta->bind_param("sisss", $nombreGrupo, $semestre, $turno, $aula, $periodoEscolar);

    // Ejecutar la consulta
    $resultado = $consulta->execute();

    // Verificar si la ejecución de la consulta fue exitosa
    if ($resultado === false) {
        die("Error al ejecutar la consulta: " . $consulta->error);
    } else {
        // Redireccionar a la página de éxito con un mensaje
        $mensaje = json_encode(array("success" => "Nuevo grupo creado exitosamente."));
        echo $mensaje;
        exit();
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
} else {
    // Si no se han enviado datos mediante el método POST, redireccionar al formulario
    header("Location: ../Modulos Jefe Area/CrearGrupo.php");
    exit();
}
?>
