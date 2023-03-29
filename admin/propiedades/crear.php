<?php

//Authenticacion del usuario
require "../../includes/app.php";

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();

//Consultar para obtener vendedores
$vendedores = Vendedor::all();


$errores = Propiedad::getErrores();
//Ejecutar despues 
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //Crear una nueva instancia
    $propiedad = new Propiedad($_POST["propiedad"]);

    //SUBIDA DE ARCHIVOS

    //Generar un nombre unico
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    //Setear la imagen
    //Realizar un resize a la imagen con Intervention
    if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
        $image = Image::make($_FILES["propiedad"]["tmp_name"]["imagen"])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
    }

    //Validar
    $errores = $propiedad->validar();

    //Revisar que no existen errores en el arreglo
    if (empty($errores)) {

        //Crear la carpeta para subir imagenes
        if (!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);
        }

        //Guarda la imagen al servidor
        $image->save(CARPETA_IMAGENES . $nombreImagen);

        //Guardar en la base de datos
        $resultado = $propiedad->guardar();
    }
}


incluirTemplate("header");
?>

<main class="contenedor seccion">
    <h1>Crear</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>



    <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        <?php include "../../includes/templates/formulario_propiedades.php" ?>
        <input type="submit" value="Crear propiedad" class="boton-verde" />
    </form>

</main>

<?php
incluirTemplate("footer");
?>