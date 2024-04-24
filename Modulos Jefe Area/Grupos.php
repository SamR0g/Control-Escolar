<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sorteo de Grupos y Turnos para Alumnos</title>
  <style>
    /* Estilos CSS */
    body {
      font-family: Arial, sans-serif;
    }

    h1 {
      text-align: center;
    }

    table {
      margin: 20px auto;
      border-collapse: collapse;
      width: 80%;
    }

    th, td {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
    }

    /* Estilos para los botones */
    .boton {
      display: inline-block;
      padding: 10px 20px;
      margin: 10px;
      font-size: 16px;
      cursor: pointer;
      text-decoration: none;
      border: none;
      border-radius: 5px;
      background-color: #007bff;
      color: #fff;
    }

    .boton:hover {
      background-color: #0056b3;
    }

    .boton-guardar {
      background-color: #28a745;
    }

    .boton-guardar:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>
  <h1>Sorteo de Grupos y Turnos para Alumnos</h1>
  <div id="alumnos">
    <table>
      <thead>
        <tr>
          <th>Matrícula</th>
          <th>Nombre Completo</th>
          <th>Grupo</th>
          <th>Turno</th>
          <th>Cupos Disponibles</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Configuración de la conexión a la base de datos
        $servername = "localhost"; // Cambia esto por tu servidor MySQL
        $username = "root"; // Cambia esto por tu nombre de usuario de MySQL
        $password = ""; // Cambia esto por tu contraseña de MySQL
        $dbname = "controlescolar"; // Cambia esto por el nombre de tu base de datos

        // Conexión a la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
        // Si se hace clic en el botón de realizar sorteo
        if (isset($_POST['sorteo'])) {
            // Realizar el sorteo
            $grupos = range('A', 'J');
            $grupos_asignados = array();
            // Inicializar el contador para cada grupo
            foreach ($grupos as $grupo) {
                $grupos_asignados[$grupo] = 0;
            }
            shuffle($grupos);
            $sql = "SELECT Matricula FROM alumnos ORDER BY RAND()";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                $grupo_aleatorio = array_shift($grupos);
                if (!$grupo_aleatorio) {
                    break; // Si se agotan los grupos, salir del bucle
                }
                $matricula = $row['Matricula'];
                $sql_update = "UPDATE alumnos SET Grupo='$grupo_aleatorio' WHERE Matricula='$matricula'";
                $conn->query($sql_update);
                // Incrementar el contador del grupo asignado
                $grupos_asignados[$grupo_aleatorio]++;
            }
            echo "<p style='text-align:center;'>Sorteo realizado correctamente.</p>";
        }

        // Consulta SQL para obtener los datos de los alumnos
        $sql = "SELECT Matricula, CONCAT(NombreCompleto, ' ', ApellidoPaterno, ' ', ApellidoMaterno) AS NombreCompleto, Grupo FROM alumnos";
        $result = $conn->query($sql);

        // Verificar si se obtuvieron resultados
        if ($result->num_rows > 0) {
            // Mostrar los datos de los alumnos en la tabla
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['Matricula']."</td>";
                echo "<td>".$row['NombreCompleto']."</td>";
                echo "<td>".$row['Grupo']."</td>";
                echo "<td>".($row['Matricula'] % 2 == 0 ? 'Mañana' : 'Tarde')."</td>";
                // Calcular los cupos disponibles
                $grupo_actual = $row['Grupo'];
                $cupos_ocupados = $grupos_asignados[$grupo_actual] ?? 0;
                $cupos_disponibles = 30 - $cupos_ocupados;
                echo "<td>".$cupos_disponibles."</td>";
                echo "</tr>";
            }
        } else {
            echo "No se encontraron alumnos en la base de datos.";
        }

        // Cerrar la conexión a la base de datos
        $conn->close();
        ?>
      </tbody>
    </table>
  </div>
  
  <!-- Botón para realizar el sorteo -->
  <form action="" method="post" style="text-align: center;">
    <input type="submit" class="boton" name="sorteo" value="Realizar Sorteo">
  </form>

</body>
</html>