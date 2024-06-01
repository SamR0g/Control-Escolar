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
$resultadoMatricula = $con->query($verificarMatricula);

// Verificar si el correo electrónico ya está registrado
$verificarCorreo = "SELECT CorreoElectronico FROM alumnos WHERE CorreoElectronico = '$email'";
$resultadoCorreo = $con->query($verificarCorreo);

if ($resultadoMatricula->num_rows > 0) {
    // La matrícula ya existe, mostrar mensaje y redirigir con mensaje de error
    header("Location: ../Modulos Jefe Area/CrearCuenta.php?error=Matrícula repetida. Favor de intentar con otra matrícula.");
    exit();
} elseif ($resultadoCorreo->num_rows > 0) {
    // El correo electrónico ya está registrado, mostrar mensaje y redirigir con mensaje de error
    header("Location: ../Modulos Jefe Area/CrearCuenta.php?error=Correo electrónico ya registrado. Favor de utilizar otro correo.");
    exit();
} else {
    // Preparar la consulta SQL
    $sql = "INSERT INTO alumnos (Matricula, NombreCompleto, ApellidoPaterno, ApellidoMaterno, CorreoElectronico, Password) 
            VALUES ('$matricula', '$nombre', '$apellidoPaterno', '$apellidoMaterno', '$email', '$password')";

    // Ejecutar la consulta
    if ($con->query($sql) === TRUE) {
        // Registro exitoso, redirigir con mensaje de éxito
        header("Location: ../Modulos Jefe Area/CrearCuenta.php?success=Registro exitoso.");
        exit();
    } else {
        // Error al registrar, redirigir con mensaje de error
        header("Location: ../Modulos Jefe Area/CrearCuenta.php?error=Error al registrar: " . $con->error);
        exit();
    }
}

// Cerrar la conexión
$con->close();
?>
