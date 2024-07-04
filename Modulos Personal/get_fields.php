<?php
$mysqli = new mysqli('localhost', 'root', '', 'controlescolar');
if ($mysqli->connect_error) {
    die('Error de conexión: ' . $mysqli->connect_error);
}

$tables = json_decode($_GET['tables'], true);
$fields = [];

foreach ($tables as $table) {
    $query = "SHOW COLUMNS FROM $table";
    $result = $mysqli->query($query);

    while ($row = $result->fetch_assoc()) {
        $fields[$row['Field']] = $table;
    }
}

echo json_encode(['fields' => array_keys($fields)]);
?>
