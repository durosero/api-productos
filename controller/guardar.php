<?php
require('./config/database.php');
$db = new Database();


$sql = "INSERT INTO productos (codigo,descripcion,precio1) VALUES('{$_POST['codigo']}', '{$_POST['descripcion']}','{$_POST['precio1']}' ) ;";

if ( $db->conexion->query($sql)) {

    header('Content-Type: application/json');
    echo json_encode(array(
        'error' => FALSE,
        'message' => "Producto guardado... ({$db->conexion->affected_rows})"
    ));
} else {
    header('Content-Type: application/json');
    echo json_encode(array(
        'error' =>  TRUE,
        'message'=>  $db->conexion->error
    ));
}
$db->conexion->close();