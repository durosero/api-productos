<?php

require('./config/database.php');
$db = new Database();

$sql = "SELECT * FROM productos WHERE id='{$id}' OR codigo='{$id}' ";

if ($resultado = $db->conexion->query($sql)) {
    $datos = array();
    if($fila = $resultado->fetch_object()) {
        $datos= $fila;
    }
    $resultado->close();
    header('Content-Type: application/json');
    echo json_encode($datos);
} else {
    header('Content-Type: application/json');
    echo json_encode(array(
        'error' =>  TRUE,
        'message'=>  $db->conexion->error
    ));
}
$db->conexion->close();
