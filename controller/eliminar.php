<?php
require('./config/database.php');
$db = new Database();


$sql = "DELETE FROM productos WHERE codigo='{$id}' ";

if ( $db->conexion->query($sql)) {

    header('Content-Type: application/json');
    echo json_encode(array(
        'error' => FALSE,
        'message' => "Producto eliminado... ({$db->conexion->affected_rows})"
    ));
} else {
    header('Content-Type: application/json');
    echo json_encode(array(
        'error' =>  TRUE,
        'message'=>  $db->conexion->error,
        'sql' => $sql
    ));
}
$db->conexion->close();
