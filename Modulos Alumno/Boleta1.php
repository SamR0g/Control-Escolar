<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boleta de Calificaciones</title>
    <link rel="stylesheet" href="../css/boletaPrueba.css">
</head>
<body>
    <div class="container">
        <h2>Boleta de Calificaciones</h2>
        <div class="student-info">
            <?php include '../php/BoletaPrueba.php'; ?>
        </div>
        <div class="button-container">
            <button onclick="descargarBoleta()">Descargar</button>
            <button onclick="imprimirBoleta()">Imprimir</button>
        </div>
    </div>

    <script>
        function descargarBoleta() {
            // Código para descargar la boleta
            window.print();
        }

        function imprimirBoleta() {
            // Código para imprimir la boleta
            window.print();
        }
    </script>
</body>
</html>
