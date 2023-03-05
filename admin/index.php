<?php

//Verificar que este autenticado
require "../includes/funciones.php";

$auth = estaAutenticado();

if(!$auth) {
    header("Location: /");
}

//Importar la conexion
require "../includes/config/database.php";

$db = conectarDB();
//Escribir el query
$query = "SELECT * FROM propiedades";

//Consultar la BD
$resultadoConsulta = mysqli_query($db, $query);

//Muestra mensaje condicional
$resultado = $_GET["resultado"] ?? null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    // var_dump($id);
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if ($id) {

        //Eliminar el archivo
        $query = "SELECT imagen FROM propiedades WHERE id = {$id}";

        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);

        unlink("../imagenes/" . $propiedad["imagen"]);

        //Eliminar Propiedad
        $query = "DELETE FROM propiedades where id = {$id}";
        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            header("Location:/admin?resultado=3");
        }
    }
}


//Incluye un template
incluirTemplate("header");
?>

<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <?php if (intval($resultado) === 1) : ?>
        <p class="alerta exito">Anuncio creado correctamente</p>
    <?php elseif (intval($resultado) === 2) : ?>
        <p class="alerta exito">Anuncio actualizado correctamente</p>
    <?php elseif (intval($resultado) === 3) : ?>
        <p class="alerta exito">Anuncio eliminado correctamente</p>
    <?php endif; ?>
    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
                <tr>
                    <td class="id-tabla"><?php echo $propiedad["id"] ?></td>
                    <td class="titulo-tabla"><?php echo $propiedad["titulo"] ?></td>
                    <td class="imagen-tabla"><img src="/imagenes/<?php echo $propiedad["imagen"] ?>"></td>
                    <td class="precio-tabla">$<?php echo $propiedad["precio"] ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad["id"]; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="admin/propiedades/actualizar.php?id=<?php echo $propiedad["id"]; ?>" class="boton-naranja-block">Actualizar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php

//Cerrar la conexion
mysqli_close($db);
incluirTemplate("footer");
?>