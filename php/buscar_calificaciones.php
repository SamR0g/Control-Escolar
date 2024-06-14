<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "controlescolar";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Falló la conexión: " . $conn->connect_error);
}

// Consulta SQL base para obtener las calificaciones de los alumnos
$sql = "SELECT alumnos.Matricula, alumnos.NombreCompleto, materias.nombre_materia, calificaciones.calificacion, calificaciones.asistencia
        FROM calificaciones
        INNER JOIN alumnos ON calificaciones.Matricula = alumnos.Matricula
        INNER JOIN materias ON calificaciones.id_materia = materias.id_materia";

// Aplicar filtro por grupo si se ha seleccionado un grupo
if(isset($_GET['grupo']) && $_GET['grupo'] != '') {
    $grupo = $_GET['grupo'];
    $sql .= " WHERE alumnos.id_grupo = $grupo";
}

// Aplicar filtro por materia si se ha seleccionado una materia
if(isset($_GET['materia']) && $_GET['materia'] != '') {
    $materia = $_GET['materia'];
    $sql .= " AND materias.id_materia = $materia";
}

$result = $conn->query($sql);

// Mostrar los datos en la tabla HTML
if ($result->num_rows > 0) {
    echo "<table id='calificacionesTable'>";
    echo "<tr><th>Matrícula</th><th>Nombre</th><th>Materia</th><th>Calificación</th><th>Asistencia</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["Matricula"] . "</td>";
        echo "<td>" . $row["NombreCompleto"] . "</td>";
        echo "<td>" . $row["nombre_materia"] . "</td>";
        echo "<td>" . $row["calificacion"] . "</td>";
        echo "<td>" . $row["asistencia"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 resultados";
}

// Cerrar conexión
$conn->close();
?>
