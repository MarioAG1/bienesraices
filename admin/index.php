<?php

//Verificar que este autenticado
require "../includes/app.php";

estaAutenticado();

use App\Propiedad;
use App\Vendedor;

//Implementar metodo para obtener todas las propiedades
$propiedades = Propiedad::all();
$vendedores = Vendedor::all();

//Muestra mensaje condicional
$resultado = $_GET["resultado"] ?? null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    // var_dump($id);
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {
        $propiedad = Propiedad::find($id);

        $propiedad->eliminar();
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
    <h2>Propiedades</h2>
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
            <?php foreach ($propiedades as $propiedad) : ?>
                <tr>
                    <td class="id-tabla"><?php echo $propiedad->id ?></td>
                    <td class="titulo-tabla"><?php echo $propiedad->titulo ?></td>
                    <td class="imagen-tabla"><img src="/imagenes/<?php echo $propiedad->imagen ?>"></td>
                    <td class="precio-tabla">$<?php echo $propiedad->precio ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-naranja-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h2>Vendedores</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendedores as $vendedor) : ?>
                <tr>
                    <td class="id-tabla"><?php echo $vendedor->id ?></td>
                    <td class="titulo-tabla"><?php echo $vendedor->nombre ?></td>
                    <td class="titulo-tabla"><?php echo $vendedor->apellido ?></td>
                    <td class="titulo-tabla"><?php echo $vendedor->telefono ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="admin/propiedades/actualizar.php?id=<?php echo $vendedor->id; ?>" class="boton-naranja-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</main>

<?php

incluirTemplate("footer");
?>