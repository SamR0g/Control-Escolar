<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "controlescolar";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $matricula = $_POST['matricula'];
    $examen_profesional = $_POST['ExamenProfesional'];
    $correo_jalisco = $_POST['CorreoJaliscoEdu'];
    $clave_carrera = $_POST['ClaveCarrera'];
    $clave_institucion = $_POST['ClaveInstitucion'];
    $clave_centro_trabajo = $_POST['ClaveCentroTrabajo'];
    $acuerdo_n = $_POST['AcuerdoN'];
    $regular = $_POST['Regular'];
    $plan_estudios = $_POST['PlanEstudios'];
    $total_creditos = $_POST['TotalCreditos'];
    $total_horas = $_POST['TotalHoras'];
    $estatus_inactivo = $_POST['EstatusInactivo'];
    $validado_certificado = $_POST['ValidadoCertificado'];

    // Insertar datos en la base de datos
    $sql = "INSERT INTO informacion_adicional_alumnos (Matricula, ExamenProfesional, CorreoJaliscoEdu, ClaveCarrera, ClaveInstitucion, ClaveCentroTrabajo, AcuerdoN, Regular, PlanEstudios, TotalCreditos, TotalHoras, EstatusInactivo, ValidadoCertificado) VALUES ('$matricula', '$examen_profesional', '$correo_jalisco', '$clave_carrera', '$clave_institucion', '$clave_centro_trabajo', '$acuerdo_n', '$regular', '$plan_estudios', '$total_creditos', '$total_horas', '$estatus_inactivo', '$validado_certificado')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registro exitoso.');
        window.location.href = 'ruta_a_tu_formulario.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>