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
        
        // Preparar la declaración SQL para verificar si ya existe un registro con los mismos valores
        $check_stmt = $conn->prepare("SELECT id_horario FROM horario WHERE id_materia = ? AND id_grupo = ? AND docente = ? AND (Lunes = ? OR Martes = ? OR Miércoles = ? OR Jueves = ? OR Viernes = ? OR Sábado = ?)");
        $check_stmt->bind_param("iiisssssss", $materia_id, $grupo_id, $docente, $lunes, $martes, $miercoles, $jueves, $viernes, $sabado);

        // Preparar la declaración SQL para insertar datos
        $stmt = $conn->prepare("INSERT INTO horario (Semestre, NombreMateria, Grupo, Lunes, Martes, Miércoles, Jueves, Viernes, Sábado, Docente) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssssss", $semestre, $nombre_materia, $grupo, $lunes, $martes, $miercoles, $jueves, $viernes, $sabado, $docente);

        // Vincular parámetros y ejecutar la declaración para cada materia
        $semestres = $_POST['semestre'];
        $materias = $_POST['nombre_materia'];
        $grupos = $_POST['grupo'];
        $docentes = $_POST['docente'];
        $lunes = $_POST['lunes'];
        $martes = $_POST['martes'];
        $miercoles = $_POST['miercoles'];
        $jueves = $_POST['jueves'];
        $viernes = $_POST['viernes'];
        $sabado = $_POST['sabado'];

        for ($i = 0; $i < count($semestres); $i++) {
            // Obtener los ID de la materia y el grupo
            $materia_id = $materias[$i];
            $grupo_id = $grupos[$i];
            $docente = $docentes[$i];
            $lunes = $lunes[$i];
            $martes = $martes[$i];
            $miercoles = $miercoles[$i];
            $jueves = $jueves[$i];
            $viernes = $viernes[$i];
            $sabado = $sabado[$i];
            $semestre = $semestres[$i];
            $nombre_materia = $materias[$i];
            $grupo = $grupos[$i];

            // Imprimir valores para depuración
            echo "Materia ID: $materia_id, Grupo ID: $grupo_id, Docente: $docente, Lunes: $lunes, Martes: $martes, Miércoles: $miercoles, Jueves: $jueves, Viernes: $viernes, Sábado: $sabado<br>";

            // Ejecutar la consulta para verificar la existencia de registros duplicados
            $check_stmt->execute();
            $check_stmt->store_result();

            // Verificar si se encontraron registros
            if ($check_stmt->num_rows > 0) {
                // Si se encontró al menos un registro, mostrar un mensaje de error
                echo "<script>alert('Ya existe un horario registrado para la misma materia, grupo, docente y horario.');
                window.location.href = '../Modulos Jefe Area/CrearHorario.php';</script>";
                exit(); // Salir del script para evitar la inserción del registro duplicado
            }

            // Si no se encontraron registros duplicados, continuar con la inserción del nuevo registro
            $stmt->execute();
        }
        
        // Cerrar las declaraciones y la conexión
        $stmt->close();
        $check_stmt->close();
        $conn->close();
        
        // Mostrar notificación utilizando JavaScript
        echo "<script>alert('Datos de materias registrados correctamente.');
        window.location.href = '../Modulos Jefe Area/CrearHorario.php';</script>";
    } else {
        echo "Error: No se recibieron todos los datos necesarios.";
    }
} else {
    echo "Error: No se recibieron datos del formulario.";
}
?>
