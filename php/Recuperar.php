<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'ruta/a/PHPMailer/src/Exception.php';
require 'ruta/a/PHPMailer/src/PHPMailer.php';
require 'ruta/a/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["CorreoElectronico"];

    // Establecer la conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "controlescolar";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Obtener la contraseña encriptada desde la base de datos
    $sql = "SELECT Password FROM alumnos WHERE CorreoElectronico = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Usuario encontrado, obtener la contraseña almacenada
        $row = $result->fetch_assoc();
        $storedPasswordHash = $row["Password"];

        // Generar una nueva contraseña y su hash
        $newPassword = generateRandomPassword();
        $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);

        // Actualizar la contraseña en la base de datos
        $sqlUpdate = "UPDATE alumnos SET password = ? WHERE CorreoElectronico = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("ss", $newPasswordHash, $email);
        $stmtUpdate->execute();

        // Enviar la nueva contraseña por correo electrónico
        sendEmail($email, $newPassword);

        echo "Se ha enviado una nueva contraseña a tu correo electrónico.";
    } else {
        echo "No se encontró un usuario con ese correo electrónico.";
    }

    // Cerrar la conexión
    $stmt->close();
    $stmtUpdate->close();
    $conn->close();
}

function generateRandomPassword() {
    $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = "";
    for ($i = 0; $i < 8; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

function sendEmail($recipient, $newPassword) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.bycenj.edu.mx';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'alan.fuentes@bycenj.edu.mx';  // Tu dirección de correo electrónico de Gmail
        $mail->Password   = 'Aalan611@';  // Tu contraseña de Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('alan.fuentes@bycenj.edu.mx', 'Alan Fuentes');
        $mail->addAddress($recipient, 'Destinatario');
        $mail->Subject = 'Recuperación de Contraseña';
        $mail->Body    = 'Tu nueva contraseña es: ' . $newPassword;


        // Enviar el correo
        $mail->send();
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
}
?>
