<?php



$path_temp = "./data/temp";
//si la carpeta no existe la creamos
if (!file_exists($path_temp)) {
    error_reporting(E_ERROR);
    mkdir($path_temp, 0777, true);
    chmod($path_temp, 0777);    
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
}

$response = array();
//validamos que no este vacio
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {

    // get details of the uploaded file
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $newFileName = str_replace('.', '', 'img_' . uniqid()).".".$fileExtension;

    //validamos lis tipos de archivo permitidos
    $allowedfileExtensions = array('jpg', 'gif', 'png');
    if (in_array($fileExtension, $allowedfileExtensions)) {

        $dest_path = $path_temp ."/". $newFileName;
        
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            
            chmod($dest_path, 0750);
            $response = array(
                'message'=> "Archivo cargado exitosamente",
                'error'=> FALSE,
                'data' => array(
                    'name' => $newFileName,
                    'size' => $fileSize,
                    'type' => $fileType
                )
            );
        } else {
            $response = array(
                'message'=> "Error al mover el archivo",
                'error'=> TRUE
            );
        }

    } else {
        $response = array(
            'message'=> "Tipo de archivo no soportado",
            'error'=> TRUE
        );
    }
} else {
    $response = array(
        'message'=> "Error al cargar el archivo",
        'error'=> TRUE
    );
}


header('Content-Type: application/json');
echo json_encode($response);
