<?php
include 'ConexionBase.php';

$matricula = $_POST['matricula'];
$nombre = $_POST['nombre'];
$apellidoPaterno = $_POST['apellidoPaterno'];
$apellidoMaterno = $_POST['apellidoMaterno'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hash de la contraseña

// Verificar si la matrícula ya existe
$verificarMatricula = "SELECT ID FROM personal WHERE ID = '$matricula'";
$resultado = $con->query($verificarMatricula);

if ($resultado->num_rows > 0) {
    // La matrícula ya existe, mostrar mensaje y salir
    echo "ID repetida. Favor de intentar con otra matrícula.";
} else {
    // Preparar la consulta SQL
    $sql = "INSERT INTO personal (ID, NombreCompleto, ApellidoPaterno, ApellidoMaterno, CorreoElectronico, Password) 
            VALUES ('$matricula', '$nombre', '$apellidoPaterno', '$apellidoMaterno', '$email', '$password')";

    // Ejecutar la consulta
    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Registro exitoso.');
        window.location.href = '../Modulos Personal/CrearCuentaPersonal.php';</script>";    } else {
        echo "Error al registrar: " . $con->error;
    }
}

// Cerrar la conexiónsss
$con->close();
?>
