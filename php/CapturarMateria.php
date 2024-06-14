<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "controlescolar";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $codigo_materia = $_POST['codigo_materia'];
  $nombre_materia = $_POST['nombre_materia'];
  $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : NULL;
  $creditos = isset($_POST['creditos']) ? $_POST['creditos'] : NULL;

  // Verificar si el código de materia ya existe
  $sql = "SELECT * FROM materias WHERE codigo_materia = '$codigo_materia'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $message = "El código de materia ya existe.";
    $type = "error";
  } else {
    // Insertar datos
    $sql = "INSERT INTO materias (codigo_materia, nombre_materia, descripcion, creditos)
            VALUES ('$codigo_materia', '$nombre_materia', '$descripcion', '$creditos')";

    if ($conn->query($sql) === TRUE) {
      $message = "Materia registrada exitosamente";
      $type = "success";
    } else {
      $message = "Error: " . $sql . "<br>" . $conn->error;
      $type = "error";
    }
  }
  $conn->close();
  header("Location: ../Modulos Jefe Area/CapturarMateria.php?message=" . urlencode($message) . "&type=" . $type);
  exit();
}
?>
