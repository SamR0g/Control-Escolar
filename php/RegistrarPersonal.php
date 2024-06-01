<?php
include 'ConexionBase.php';

$id = $_POST['ID'];
$nombre = $_POST['nombre'];
$apellidoPaterno = $_POST['apellidoPaterno'];
$apellidoMaterno = $_POST['apellidoMaterno'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hash de la contraseña

// Verificar si el ID ya existe
$verificarID = "SELECT ID FROM personal WHERE ID = '$id'";
$resultadoID = $con->query($verificarID);

// Verificar si el correo electrónico ya está registrado
$verificarCorreo = "SELECT CorreoElectronico FROM personal WHERE CorreoElectronico = '$email'";
$resultadoCorreo = $con->query($verificarCorreo);

if ($resultadoID->num_rows > 0) {
    // El ID ya existe, mostrar mensaje y redirigir con mensaje de error
    header("Location: ../Modulos Jefe Area/CrearCuentaPersonal.php?error=ID repetido. Favor de intentar con otro ID.");
    exit();
} elseif ($resultadoCorreo->num_rows > 0) {
    // El correo electrónico ya está registrado, mostrar mensaje y redirigir con mensaje de error
    header("Location: ../Modulos Jefe Area/CrearCuentaPersonal.php?error=Correo electrónico ya registrado. Favor de utilizar otro correo.");
    exit();
} else {
    // Preparar la consulta SQL
    $sql = "INSERT INTO personal (ID, NombreCompleto, ApellidoPaterno, ApellidoMaterno, CorreoElectronico, Password) 
            VALUES ('$id', '$nombre', '$apellidoPaterno', '$apellidoMaterno', '$email', '$password')";

    // Ejecutar la consulta
    if ($con->query($sql) === TRUE) {
        // Registro exitoso, redirigir con mensaje de éxito
        header("Location: ../Modulos Jefe Area/CrearCuentaPersonal.php?success=Registro exitoso.");
        exit();
    } else {
        // Error al registrar, redirigir con mensaje de error
        header("Location: ../Modulos Jefe Area/CrearCuentaPersonal.php?error=Error al registrar: " . $con->error);
        exit();
    }
}

// Cerrar la conexión
$con->close();
?>
