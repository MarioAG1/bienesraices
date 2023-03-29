<?php
// Importar la base de datos, DIR para ser relativo a donde este no al index que llama a anuncios

$db = conectarDB();

// Consultar la base de datos
$query = "SELECT * FROM propiedades LIMIT {$limite}";

// Obtener resultados
$resultado = mysqli_query($db, $query);


?>




<div class="contenedor-anuncios">
    <?php while ($propiedad = mysqli_fetch_assoc($resultado)) : ?>
        <div class="anuncio">

            <img loading="lazy" src="/imagenes/<?php echo $propiedad["imagen"] ?>" alt="Primer anuncio" />

            <div class="contenido-anuncio">
                <h3><?php echo $propiedad["titulo"] ?></h3>
                <p><?php echo $propiedad["descripcion"] ?>Casa de lujo en excelente vista, acabados de lujo</p>
                <p class="precio">$<?php echo $propiedad["precio"] ?></p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono webp" />
                        <p><?php echo $propiedad["wc"] ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono webp" />
                        <p><?php echo $propiedad["estacionamiento"] ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono webp" />
                        <p><?php echo $propiedad["habitaciones"] ?></p>
                    </li>
                </ul>
                <a href="anuncio.php?id=<?php echo $propiedad["id"]; ?>" class="boton-naranja-block">
                    <p>Ver propiedad</p>
                </a>
            </div>
            <!--.contenido-anuncio-->
        </div>
    <?php endwhile ?>
</div>

<?php
//Cerrar la conexion
mysqli_close($db);
?>