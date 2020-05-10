<?php

require('./config/database.php');
$db = new Database();
$numero = 10;
if (isset($num)) {
    $numero = $num;
}

$sql = "SELECT * FROM productos limit {$numero} ";

if ($resultado = $db->conexion->query($sql)) {
    $datos = array();
    while ($fila = $resultado->fetch_object()) {
        $datos[] = $fila;
    }
    $resultado->close();
    header('Content-Type: application/json');
    echo json_encode($datos);
} else {
    header('Content-Type: application/json');
    echo json_encode(array(
        'error' =>  TRUE,
        'message' =>  $db->conexion->error
    ));
}
$db->conexion->close();
