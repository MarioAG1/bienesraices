<?php

define("TEMPLATES_URL", __DIR__ . "/templates");
define("FUNCIONES_URL", __DIR__ . "funciones.php");
define("CARPETA_IMAGENES", __DIR__ . "/../imagenes/");



//Añadir los diferentes partes de la web

function incluirTemplate(string $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/{$nombre}.php";
}

//Verificar que este autenticado

function estaAutenticado()
{
    session_start();

    if (!$_SESSION["login"]) {
        header("Location: /");
    }
    }

function debugear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;

};

//Escapar HTML
function sanitizar($html){
    $sanitizar = htmlspecialchars($html);
    return $sanitizar;
}
