<?php

//Incluye el header
require "includes/app.php";
// Importar la base de datos, DIR para ser relativo a donde este no al index que llama a anuncios
$db = conectarDB();

//Crear email y password 
$email = "correo@correo.com";
$password = "123456";
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

var_dump($passwordHash);



//query para crear cuenta
$query = "INSERT INTO usuarios (email,password) VALUES ('{$email}','{$passwordHash}');";

//Agregarlo a la base de datos
mysqli_query($db, $query);
//Cerramos la conexion
mysqli_close($db);
