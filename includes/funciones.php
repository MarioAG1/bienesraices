<?php

require "app.php";

//Añadir los diferentes partes de la web

function incluirTemplate(string $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/{$nombre}.php";
}

//Verificar que este autenticado

function estaAutenticado(): bool
{
    session_start();
    $auth = $_SESSION["login"];

    if ($auth) {
        return true;
    }
    return false;
}
