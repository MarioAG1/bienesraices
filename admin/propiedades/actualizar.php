<?php

//Verificar que este autenticado
require "../../includes/funciones.php";

$auth = estaAutenticado();

if(!$auth) {
    header("Location: /");
}

//Validar URL po ID valido
$id = $_GET["id"];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: /admin");
}

//Base de datos
require "../../includes/config/database.php";
$db = conectarDB();

//Consulta para obtener las propiedades 
$consulta = "SELECT * FROM propiedades WHERE id = {$id}";
$resultado = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($resultado);

// echo "<pre>";
// var_dump($propiedad);
// echo "</pre>";

//Consultar para obtener vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

//Arreglos con posibles mensajes de error
$errores = [];
$titulo = $propiedad["titulo"];
$precio = $propiedad["precio"];
$descripcion = $propiedad["descripcion"];
$habitaciones = $propiedad["habitaciones"];
$wc = $propiedad["wc"];
$estacionamiento = $propiedad["estacionamiento"];
$vendedorId = $propiedad["vendedorId"];
$imagenPropiedad = $propiedad["imagen"];

//Ejecutar despues 
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $titulo = mysqli_real_escape_string($db, $_POST["titulo"]);
    $precio = mysqli_real_escape_string($db, $_POST["precio"]);
    $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);
    $habitaciones = mysqli_real_escape_string($db, $_POST["habitaciones"]);
    $wc = mysqli_real_escape_string($db, $_POST["wc"]);
    $estacionamiento = mysqli_real_escape_string($db, $_POST["estacionamiento"]);
    $vendedorId = mysqli_real_escape_string($db, $_POST["vendedor"]);
    $creado = date("Y/m/d");

    //Asignar files para una variable
    $imagen = $_FILES["imagen"];

    if (!$titulo) {
        $errores[] = "Debes añadir un titulo";
    }
    if (!$precio) {
        $errores[] = "El Precio es Obligatorio";
    }
    if (strlen($descripcion) < 50) {
        $errores[] = "La descripcion es obligatoria y debe de tener al menos 50 caracteres";
    }
    if (!$wc) {
        $errores[] = "El Numero de wc es obligatorio";
    }
    if (!$estacionamiento) {
        $errores[] = "El Numero de estacionamiento es obligatorio";
    }
    if (!$vendedorId) {
        $errores[] = "Elige un vendedor";
    }

    //Validar que la imagen sea menor a 100KB maximo
    $medida = 1000 * 1000;
    if ($imagen["size"] > $medida) {
        $errores[] = "La imagen es muy grande";
    }

    // echo "<pre>";
    // var_dump($errores);
    // echo "</pre>";

    //Revisar que no existen errores en el arreglo
    if (empty($errores)) {

        //Crear carpeta
        $carpetaImagenes = "../../imagenes/";

        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        //Evitar que elimine la imagen si no has editado nada
        $nombreImagen = "";

        //SUBIDA DE ARCHIVOS

        if ($imagen["name"]) {
            //Eliminar imagen previa

            unlink($carpetaImagenes . $propiedad["imagen"]);

            //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //Subir imagen
            move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . $nombreImagen);
        } else {
            //Evitar que elimine la imagen si no has editado nada
            $nombreImagen = $propiedad["imagen"];
        }



        //MODIFICAR BASE DE DATOS
        $query = "UPDATE propiedades SET titulo = '{$titulo}', precio = {$precio}, imagen = '{$nombreImagen}', descripcion = '{$descripcion}', habitaciones = {$habitaciones},
        wc = {$wc}, estacionamiento = {$estacionamiento}, vendedorId = {$vendedorId} WHERE id = {$id}";

        //COMPROBAR QUE LA QUERY ES CORRECTA
        // echo $query;
        // exit;

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            //Redireccionar al usuario
            header("Location: /admin?resultado=2");
        }
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
        <fieldset>
            <legend>Informacion general</legend>
            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" min="1" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">
            <img src="/imagenes/<?php echo $imagenPropiedad ?>" class="imagen-actualizar">
            <label for=" descripcion">Descripcion:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>

        </fieldset>

        <fieldset>
            <legend>Informacion Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">
            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">
            <label for="estaciomamiento">Garage:</label>
            <input type="number" id="estaciomamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">

        </fieldset>
        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedor">
                <option value="">--Seleccione--</option>
                <?php while ($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                    <option <?php echo $vendedorId === $vendedor["id"] ? "selected" : ""; ?> value="<?php echo $vendedor["id"]; ?>"><?php echo $vendedor["nombre"] . " " . $vendedor["apellido"] ?></option>
                <?php endwhile; ?>
            </select>
        </fieldset>
        <input type="submit" value="Actualizar propiedad" class="boton-verde" />
    </form>

</main>

<?php
incluirTemplate("footer");
?>