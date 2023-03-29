<?php

//Verificar que este autenticado
require "../../includes/app.php";


use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();



//Validar URL po ID valido
$id = $_GET["id"];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: /admin");
}

//Base de datos
$db = conectarDB();

//Obtener los datos de la propiedad
$propiedad = Propiedad::find($id);

//Consultar para obtener vendedores
$vendedores = Vendedor::all();

//Arreglos con posibles mensajes de error
$errores = Propiedad::getErrores();

//Ejecutar despues 
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //Asignar los atributos
    $args = $_POST["propiedad"];
    $propiedad->sincronizar($args);
    $errores = $propiedad->validar();

    //Generar un nombre unico
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    //Setear la imagen
    //Realizar un resize a la imagen con Intervention
    if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
        $image = Image::make($_FILES["propiedad"]["tmp_name"]["imagen"])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
    }

    //Revisar que no existen errores en el arreglo
    if (empty($errores)) {
        //Almacenar imagen, en caso de no poner ninguna imagen
        if ($_FILES['propiedad']['tmp_name']['imagen']) {
            $image->save(CARPETA_IMAGENES . $nombreImagen);
        }
        $propiedad->guardar();
    }
}


incluirTemplate("header");
?>

<main class="contenedor seccion">
    <h1>Actualizar</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>



    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include "../../includes/templates/formulario_propiedades.php"; ?>
        <input type="submit" value="Actualizar propiedad" class="boton-verde" />
    </form>

</main>

<?php
incluirTemplate("footer");
?>