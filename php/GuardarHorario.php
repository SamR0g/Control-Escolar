<?php
// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibieron datos de las materias
    if (isset($_POST['semestre']) && isset($_POST['nombre_materia']) && isset($_POST['grupo']) && isset($_POST['docente'])) {
        // Conectar a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "controlescolar";

        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error al conectar con la base de datos: " . $conn->connect_error);
        }
        
        // Preparar la declaración SQL para insertar datos
        $stmt = $conn->prepare("INSERT INTO horario (Semestre, NombreMateria, Grupo, Lunes, Martes, Miercoles, Jueves, Viernes, Sabado, Docente) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        // Vincular parámetros y ejecutar la declaración para cada materia
        $semestres = $_POST['semestre'];
        $materias = $_POST['nombre_materia'];
        $grupos = $_POST['grupo'];
        $lunes = $_POST['lunes'];
        $martes = $_POST['martes'];
        $miercoles = $_POST['miercoles'];
        $jueves = $_POST['jueves'];
        $viernes = $_POST['viernes'];
        $sabado = $_POST['sabado'];
        $docentes = $_POST['docente'];

        for ($i = 0; $i < count($semestres); $i++) {
            $stmt->bind_param("isssssssss", $semestres[$i], $materias[$i], $grupos[$i], $lunes[$i], $martes[$i], $miercoles[$i], $jueves[$i], $viernes[$i], $sabado[$i], $docentes[$i]);
            $stmt->execute();
        }
        
        echo "Datos de materias registrados correctamente.";
        
        // Cerrar la declaración y la conexión
        $stmt->close();
        $conn->close();
    } else {
        echo "Error: No se recibieron todos los datos necesarios.";
    }
} else {
    echo "Error: No se recibieron datos del formulario.";
}
?>
