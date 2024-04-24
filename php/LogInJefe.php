<?php

session_start();

include 'ConexionBase.php';

$id = $_POST['Matricula'];
$Password = $_POST['Password'];

// Obtener la contraseña almacenada desde la base de datos
$consulta = mysqli_query($con, "SELECT * FROM coordinador WHERE ID = $id");

if (mysqli_num_rows($consulta) > 0) {
    $fila = mysqli_fetch_assoc($consulta);
    $hashAlmacenado = $fila['Password'];

    // Verificar la contraseña
    if (password_verify($Password, $hashAlmacenado)) {
        $_SESSION['ID'] = $id;
        header("location: ../Modulos Jefe Area/PanelJefe.php");
        exit;
    } else {
        echo '
        <script>
            alert("Verifique los datos");
            window.location = "../Modulos Jefe Area/LogInJefe.php";
        </script>
        ';
        exit;
    }
} else {
    echo '
    <script>
        alert("Verifique los datos");
        window.location = "../Modulos Jefe Area/LogInJefe.php";
    </script>
    ';
    exit;
}
?>
