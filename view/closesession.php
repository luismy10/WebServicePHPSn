<?php
//Reanudamos la sesión
session_start();

//Des-establecemos todas las sesiones
unset($_SESSION);

//Destruimos las sesiones
session_destroy();

//Redireccionamos a el index
header("Location: login.php");
die();