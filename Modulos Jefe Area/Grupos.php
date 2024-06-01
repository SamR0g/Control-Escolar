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

        // Crear conexión a la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Verificar conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Establecer codificación UTF-8
        $conn->set_charset("utf8mb4");

        // Si se hace clic en el botón de realizar sorteo
        if (isset($_POST['sorteo'])) {
            // Realizar el sorteo
            $sql_grupos = "SELECT id_grupo FROM grupos";
            $result_grupos = $conn->query($sql_grupos);
            $grupos = array();
            if ($result_grupos->num_rows > 0) {
                while($row = $result_grupos->fetch_assoc()) {
                    $grupos[] = $row['id_grupo'];
                }
            }
            $sql_alumnos = "SELECT Matricula FROM alumnos ORDER BY RAND()";
            $result_alumnos = $conn->query($sql_alumnos);
            $i = 0;
            while ($row = $result_alumnos->fetch_assoc()) {
                $grupo_aleatorio = $grupos[$i % count($grupos)];
                $matricula = $row['Matricula'];
                $sql_update = "UPDATE alumnos SET id_grupo='$grupo_aleatorio' WHERE Matricula='$matricula'";
                $conn->query($sql_update);
                $i++;
            }
            echo "<p style='text-align:center;'>Sorteo realizado correctamente.</p>";
        }

        // Consulta SQL para obtener los datos de los alumnos
        $sql = "SELECT alumnos.Matricula, CONCAT(alumnos.NombreCompleto, ' ', alumnos.ApellidoPaterno, ' ', alumnos.ApellidoMaterno) AS NombreCompleto, alumnos.id_grupo, grupos.Turno FROM alumnos INNER JOIN grupos ON alumnos.id_grupo = grupos.id_grupo";
        $result = $conn->query($sql);

        // Verificar si se obtuvieron resultados
        if ($result->num_rows > 0) {
            // Mostrar los datos de los alumnos en la tabla
            while($row = $result->fetch_assoc()) { 
                echo "<tr>";
                echo "<td>".$row['Matricula']."</td>";
                echo "<td>".$row['NombreCompleto']."</td>";
                echo "<td>".$row['id_grupo']."</td>";
                echo "<td>".$row['Turno']."</td>"; // Mostrar el turno registrado en la base de datos
                // Calcular los cupos disponibles
                $grupo_actual = $row['id_grupo'];
                $sql_cupos = "SELECT COUNT(*) AS total FROM alumnos WHERE id_grupo='$grupo_actual'";
                $result_cupos = $conn->query($sql_cupos);
                $cupos_ocupados = $result_cupos->fetch_assoc()['total'];
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
