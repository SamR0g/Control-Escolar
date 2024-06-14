<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "controlescolar";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$matricula = $_POST['Matricula'];
$numSeguroSocial = $_POST['NumSeguroSocial'];
$nombrePadreTutor = $_POST['NombrePadreTutor'];
$telefonoPadre = $_POST['TelefonoPadre'];
$domicilio = $_POST['Domicilio'];
$colonia = $_POST['Colonia'];
$municipio = $_POST['Municipio'];
$telefonoEmergencia = $_POST['TelefonoEmergencia'];
$telefonoCasa = $_POST['TelefonoCasa'];
$telefonoCelular = $_POST['TelefonoCelular'];
$correoPersonal = $_POST['CorreoPersonal'];
$nacional = $_POST['Nacional'];
$estado = $_POST['Estado'];
$localidadAlumno = $_POST['LocalidadAlumno'];
$talla = $_POST['Talla'];
$sexo = $_POST['Sexo'];
$fechaNacimiento = $_POST['FechaNacimiento'];
$fichaExamen = $_POST['FichaExamen'];
$puntajeExamen = $_POST['PuntajeExamen'];
$promedioBachillerato = $_POST['PromedioBachillerato'];
$folioBachillerato = $_POST['FolioBachillerato'];
$fechaExpedicionBachillerato = $_POST['FechaExpedicionBachillerato'];
$nombreBachillerato = $_POST['NombreBachillerato'];
$municipioBachillerato = $_POST['MunicipioBachillerato'];
$fechaIngreso = $_POST['FechaIngreso'];

$sql = "INSERT INTO informacion_adicional_alumnos 
        (Matricula, NumSeguroSocial, NombrePadreTutor, TelefonoPadre, Domicilio, Colonia, Municipio, TelefonoEmergencia, TelefonoCasa, TelefonoCelular, CorreoPersonal, Nacional, Estado, LocalidadAlumno, Talla, Sexo, FechaNacimiento)
        VALUES 
        ('$matricula', '$numSeguroSocial', '$nombrePadreTutor', '$telefonoPadre', '$domicilio', '$colonia', '$municipio', '$telefonoEmergencia', '$telefonoCasa', '$telefonoCelular', '$correoPersonal', '$nacional', '$estado', '$localidadAlumno', '$talla', '$sexo', '$fechaNacimiento')";

if ($conn->query($sql) === TRUE) {
    echo "Información guardada exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
