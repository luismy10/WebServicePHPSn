<?php

//error_reporting(0);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');

require './LoginADO.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $usuario = $_GET['Usuario'];
    $clave = $_GET['Clave'];

      $result = LoginADO::Login($usuario, $clave);
      
    if (is_object($result)) {
        echo json_encode(array(
            "estado" => 1,
            "empleado" => $result
        ));
    } else if ($result == false) {
        echo json_encode(array(
            "estado" => 2,
            "message" => "Usuario o contraseña incorrecta."
        ));
    } else {
        echo json_encode(array(
            "estado" => 0,
            "message" => $result
        ));
    }
    exit();
}
