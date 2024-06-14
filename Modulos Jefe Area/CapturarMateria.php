<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Materia</title>
  <link rel="stylesheet" href="./CapturarMateria.css">
</head>
<body>
  <div class="form-container">
    <?php if (isset($_GET['message'])): ?>
      <div class="notification <?php echo $_GET['type']; ?>">
        <?php echo htmlspecialchars($_GET['message']); ?>
      </div>
    <?php endif; ?>
    <form id="materiaForm" action="../php/CapturarMateria.php" method="POST">
      <h2>Registro de Materia</h2>

      <label for="codigo_materia">Código de Materia:</label>
      <input type="text" id="codigo_materia" name="codigo_materia" required>

      <label for="nombre_materia">Nombre de Materia:</label>
      <input type="text" id="nombre_materia" name="nombre_materia" required>

      <label for="descripcion">Descripción:</label>
      <textarea id="descripcion" name="descripcion"></textarea>

      <label for="creditos">Créditos:</label>
      <input type="number" id="creditos" name="creditos">

      <button type="submit">Registrar</button>
    </form>
  </div>
</body>
</html>
