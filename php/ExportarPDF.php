<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "controlescolar");

// Verificar conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Establecer el conjunto de caracteres a utf8mb4
mysqli_set_charset($conexion, "utf8mb4");

// Consulta SQL para obtener los datos de los alumnos
$consulta = "SELECT * FROM alumnos";
$resultado = mysqli_query($conexion, $consulta);

// Crear el archivo PDF
header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=reporte_alumnos.pdf");

// Iniciar el PDF
echo "<h1>Reporte de Alumnos</h1>";

// Crear la tabla HTML
echo "<table border='1'>";
echo "<tr>
        <th>Matrícula</th>
        <th>Nombre Completo</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Fecha Nacimiento</th>
        <th>Correo Electrónico</th>
      </tr>";

// Llenar la tabla con los datos de los alumnos
while ($fila = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    echo "<td>" . $fila['Matricula'] . "</td>";
    echo "<td>" . $fila['NombreCompleto'] . "</td>";
    echo "<td>" . $fila['ApellidoPaterno'] . "</td>";
    echo "<td>" . $fila['ApellidoMaterno'] . "</td>";
    echo "<td>" . $fila['FechaNacimiento'] . "</td>";
    echo "<td>" . $fila['CorreoElectronico'] . "</td>";
    echo "</tr>";
}

echo "</table>";

// Cerrar conexión
mysqli_close($conexion);
?>
