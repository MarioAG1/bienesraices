<?php
ini_set('display_errors', 1);

require "funciones.php";
require "config/database.php";
require __DIR__ . "/../vendor/autoload.php";

//Conectar a la base de datos
$db = conectarDB();

use App\ActiveRecord;

ActiveRecord::setDb($db);

