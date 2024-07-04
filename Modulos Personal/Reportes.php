<?php
require('../libs/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Reporte Personalizado', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function ChapterTitle($label)
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, $label, 0, 1, 'L');
        $this->Ln(4);
    }

    function ChapterBody($body)
    {
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(0, 10, $body);
        $this->Ln();
    }

    function PrintChapter($title, $body)
    {
        $this->AddPage();
        $this->ChapterTitle($title);
        $this->ChapterBody($body);
    }
}

// Conexión a la base de datos
$mysqli = new mysqli('localhost', 'root', '', 'controlescolar');
if ($mysqli->connect_error) {
    die('Error de conexión: ' . $mysqli->connect_error);
}

// Función para generar el reporte en PDF
function generarPDF($data, $fields) {
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $content = '';

    foreach ($data as $row) {
        foreach ($fields as $field) {
            $content .= "$field: {$row[$field]}\n";
        }
        $content .= "\n";
    }

    $pdf->PrintChapter('Datos Seleccionados', $content);
    $pdf->Output();
}

// Función para generar el reporte en Excel
function generarExcel($data, $fields) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="reporte.csv"');

    $output = fopen('php://output', 'w');
    fputcsv($output, $fields);

    foreach ($data as $row) {
        $rowData = [];
        foreach ($fields as $field) {
            $rowData[] = $row[$field];
        }
        fputcsv($output, $rowData);
    }

    fclose($output);
}

// Manejo del formulario de generación de reportes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipoReporte = $_POST['tipo_reporte'];
    $tables = $_POST['tables'];
    $fields = $_POST['fields'];
    
    $queryParts = [];
    foreach ($tables as $table) {
        $queryParts[] = "SELECT " . implode(", ", $fields) . " FROM $table";
    }
    $query = implode(" UNION ALL ", $queryParts);
    
    $result = $mysqli->query($query);
    $data = $result->fetch_all(MYSQLI_ASSOC);

    if ($tipoReporte === 'pdf') {
        generarPDF($data, $fields);
    } elseif ($tipoReporte === 'excel') {
        generarExcel($data, $fields);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar Reporte</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 20px;
        }
        h1 {
            color: #444;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: auto;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        select, input[type="checkbox"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        select, input[type="checkbox"] {
            box-sizing: border-box;
        }
        .checkbox-group {
            margin-bottom: 20px;
        }
        .checkbox-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .checkbox-group input[type="checkbox"] {
            margin-right: 10px;
        }
        .checkbox-group div {
            margin-bottom: 10px;
        }
        .checkbox-group div input[type="checkbox"] {
            margin-right: 5px;
        }
        input[type="submit"] {
            background-color: #5cb85c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
    <h1>Generar Reporte</h1>
    <form method="post" action="">
        <label for="tables">Seleccionar Tablas:</label>
        <select name="tables[]" id="tables" multiple required>
            <option value="alumnos">Alumnos</option>
            <option value="grupos">Grupos</option>
            <option value="materias">Materias</option>
            <option value="calificaciones">Calificaciones</option>
            <option value="informacion_adicional_alumnos">Información Adicional</option>
        </select>
        <br><br>
        <div class="checkbox-group">
            <label>Seleccionar Campos:</label>
            <div id="fields-container"></div>
        </div>
        <label for="tipo_reporte">Tipo de Reporte:</label>
        <select name="tipo_reporte" id="tipo_reporte" required>
            <option value="pdf">PDF</option>
            <option value="excel">Excel</option>
        </select>
        <br><br>
        <input type="submit" value="Generar Reporte">
    </form>

    <script>
        document.getElementById('tables').addEventListener('change', function() {
            const tables = Array.from(this.selectedOptions).map(option => option.value);
            const fieldsContainer = document.getElementById('fields-container');
            fieldsContainer.innerHTML = '';

            if (tables.length > 0) {
                fetch('get_fields.php?tables=' + JSON.stringify(tables))
                    .then(response => response.json())
                    .then(data => {
                        data.fields.forEach(field => {
                            const checkbox = document.createElement('input');
                            checkbox.type = 'checkbox';
                            checkbox.name = 'fields[]';
                            checkbox.value = field;
                            checkbox.id = field;

                            const label = document.createElement('label');
                            label.htmlFor = field;
                            label.textContent = field;

                            fieldsContainer.appendChild(checkbox);
                            fieldsContainer.appendChild(label);
                            fieldsContainer.appendChild(document.createElement('br'));
                        });
                    });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('tables').dispatchEvent(new Event('change'));
        });
    </script>
</body>
</html>
