<?php
require __DIR__ . '/library/AltoRouter.php';
//=====================================
//   cors origin
//=====================================
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

$router = new AltoRouter();
$router->setBasePath('/productos');

//=============================
//     ROUTES
//=============================

$router->map('GET', '/',  function () {
    header('Content-Type: application/json');
    echo json_encode(array(
        'error' =>  FALSE,
        'message'=>  "Hola mundo",
        'developer' => "Duvan Rosero"
    ));
});

//===============================================

$router->map('GET', '/listar/[*:num]',  function ($num) {
    require __DIR__ . '/controller/listar.php';
});
$router->map('GET', '/listar',  function () {
    require __DIR__ . '/controller/listar.php';
});

$router->map('GET', '/ver/[i:num]',  function ($id) {
    require __DIR__ . '/controller/ver.php';
});

//===============================================

$router->map('DELETE', '/eliminar/[i:num]',  function ($id) {
    require __DIR__ . '/controller/eliminar.php';
});

//=================================================
$router->map('POST', '/guardar',  function () {
    require __DIR__ . '/controller/guardar.php';
});

//================================================

$router->map('POST', '/actualizar/[i:num]',  function ($id) {
    require __DIR__ . '/controller/actualizar.php';
});


$match = $router->match();
if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {

    header('Content-Type: application/json');
    echo json_encode(array(
        'error' =>  TRUE,
        'message'=>  "Ruta no encontrada"
    ));
}
