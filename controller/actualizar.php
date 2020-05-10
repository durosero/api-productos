<?php
require('./config/database.php');
$db = new Database();


$sql = "UPDATE productos SET codigo='{$_POST['codigo']}', descripcion='{$_POST['descripcion']}', precio1='{$_POST['precio1']}' WHERE codigo='{$id}' ";

if ( $db->conexion->query($sql)) {

    header('Content-Type: application/json');
    echo json_encode(array(
        'error' => FALSE,
        'message' => "Producto actualizado... ({$db->conexion->affected_rows})"
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
