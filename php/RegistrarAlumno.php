<?php
include 'ConexionBase.php';

$matricula = $_POST['matricula'];
$nombre = $_POST['nombre'];
$apellidoPaterno = $_POST['apellidoPaterno'];
$apellidoMaterno = $_POST['apellidoMaterno'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hash de la contraseña

// Verificar si la matrícula ya existe
$verificarMatricula = "SELECT Matricula FROM alumnos WHERE Matricula = '$matricula'";
$resultado = $con->query($verificarMatricula);

if ($resultado->num_rows > 0) {
    // La matrícula ya existe, mostrar mensaje y salir
    echo "Matrícula repetida. Favor de intentar con otra matrícula.";
} else {
    // Preparar la consulta SQL
    $sql = "INSERT INTO alumnos (Matricula, NombreCompleto, ApellidoPaterno, ApellidoMaterno, CorreoElectronico, Password) 
            VALUES ('$matricula', '$nombre', '$apellidoPaterno', '$apellidoMaterno', '$email', '$password')";

    // Ejecutar la consulta
    if ($con->query($sql) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error al registrar: " . $con->error;
    }
}

// Cerrar la conexión
$con->close();
?>
