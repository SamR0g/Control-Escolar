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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardar'])) {
    $conn->begin_transaction();

    $messages = array();

    try {
        foreach ($_POST as $key => $value) {
            if (strpos($key, '[') !== false) {
                $matricula = explode('[', $key)[1];
                $matricula = explode(']', $matricula)[0];
                $field = explode('[', $key)[0];

                if ($field === 'extras' || $field === 'examen_profesional' || $field === 'correo_jalisco_edu' || $field === 'clave_carrera' || $field === 'clave_institucion' || $field === 'clave_centro_trabajo' || $field === 'acuerdo_n' || $field === 'regular' || $field === 'plan_estudios' || $field === 'total_creditos' || $field === 'total_horas' || $field === 'estatus_inactivo' || $field === 'validado_certificado' || $field === 'beca' || $field === 'pendientes' || $field === 'kardex_calificacion_acceso') {
                    $value = $conn->real_escape_string($value);
                    $sql_update = "UPDATE informacion_adicional_alumnos SET $field = '$value' WHERE Matricula = '$matricula'";
                    if (!$conn->query($sql_update)) {
                        throw new Exception("Error al actualizar $field para matrícula $matricula: " . $conn->error);
                    }
                }
            }
        }

        $conn->commit();
        $status = "success";
    } catch (Exception $e) {
        $conn->rollback();
        $status = "error";
    }

    $conn->close();
    header("Location: ../Pruebas/CapturaDatosAlumnos.php?status=$status");
    exit;
}
