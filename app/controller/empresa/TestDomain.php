<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo json_encode(array(
        "estado" => 1,
        "mensaje" => 'Conexión exitosa'
    ));
}