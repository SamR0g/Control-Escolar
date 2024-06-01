<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear Nuevo Grupo</title>
  <link rel="stylesheet" href="../css/CrearGrupo.css">
  <style>
    /* Estilos para la notificación */
    .notification {
      text-align: center; /* Alineación del texto al centro */
      padding: 10px; /* Espaciado interno */
      margin-bottom: 20px; /* Margen inferior */
      display: none; /* Ocultar inicialmente */
    }

    /* Estilos para notificación de éxito */
    .notification-success {
      background-color: #4CAF50; /* Color de fondo verde */
      color: white; /* Color de texto blanco */
    }

    /* Estilos para notificación de error */
    .notification-error {
      background-color: #f44336; /* Color de fondo rojo */
      color: white; /* Color de texto blanco */
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Crear Nuevo Grupo</h2>
    <!-- Contenedor para mostrar notificaciones -->
    <div id="notification"></div>
    <!-- Formulario para crear un nuevo grupo -->
    <form action="../php/procesar_formulario.php" method="POST" id="formularioGrupo">
      <div class="form-group">
        <label for="nombre_grupo">Nombre del Grupo:</label>
        <input type="text" id="nombre_grupo" name="nombre_grupo" required>
      </div>
      <div class="form-group">
        <label for="semestre">Semestre:</label>
        <input type="number" id="semestre" name="semestre" min="1" required>
      </div>
      <div class="form-group">
        <label for="turno">Turno:</label>
        <select id="turno" name="turno" required>
          <option value="">Seleccionar</option>
          <option value="Mañana">Mañana</option>
          <option value="Tarde">Tarde</option>
          <option value="Noche">Noche</option>
        </select>
      </div>
      <div class="form-group">
        <label for="periodo_escolar">Periodo Escolar:</label>
        <input type="text" id="periodo_escolar" name="periodo_escolar" required>
      </div>
      <button type="submit">Crear Grupo</button>
    </form>
  </div>

  <script>
    document.getElementById("formularioGrupo").addEventListener("submit", function(event) {
      event.preventDefault(); // Evitar que se envíe el formulario de forma convencional

      // Obtener el formulario y sus datos
      var form = event.target;
      var formData = new FormData(form);

      // Realizar la solicitud AJAX
      var xhr = new XMLHttpRequest();
      xhr.open(form.method, form.action, true);
      xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            // Analizar la respuesta JSON
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              mostrarNotificacion(response.success, "notification-success");
            } else if (response.error) {
              mostrarNotificacion(response.error, "notification-error");
            }
          } else {
            console.error("Error al procesar la solicitud.");
          }
        }
      };
      xhr.send(formData);
    });

    function mostrarNotificacion(mensaje, tipo) {
      var notification = document.getElementById("notification");
      notification.innerHTML = mensaje;
      notification.style.display = "block";
      notification.className = "notification " + tipo; // Agregar la clase de notificación al contenedor
      setTimeout(function() {
        notification.style.display = "none"; // Ocultar la notificación después de unos segundos
      }, 3000);
    }
  </script>
</body>
</html>
