<?php
require('./config/database.php');
$db = new Database();

if ($_POST['imagen']=="") {
    $sql = "UPDATE productos SET codigo='{$_POST['codigo']}', descripcion='{$_POST['descripcion']}', precio1='{$_POST['precio1']}'  WHERE id='{$id}' ";

} else {
    $imagen = "'https://".$_SERVER['SERVER_NAME']. "/productos/file/" . $db->conexion->real_escape_string($_POST['imagen']) . "'";
    $sql = "UPDATE productos SET codigo='{$_POST['codigo']}', descripcion='{$_POST['descripcion']}', precio1='{$_POST['precio1']}', imagen={$imagen} WHERE id='{$id}' ";

}



if ( $db->conexion->query($sql)) {
    $path_img = "./data/img/";
    $path_temp = "./data/temp/" . $_POST['imagen'];
    $new_temp = $path_img . $_POST['imagen'];

    //si la carpeta no existe la creamos
    if (!file_exists($path_img)) {
        error_reporting(E_ERROR);
        mkdir($path_img, 0777, true);
        chmod($path_img, 0777);
        error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    }

    rename($path_temp, $new_temp);

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
