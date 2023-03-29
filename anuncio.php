<?php

$id = $_GET["id"];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
  header("Location: /");
}

require "includes/app.php";

// Importar la base de datos
$db = conectarDB();

// Consultar la base de datos
$query = "SELECT * FROM propiedades WHERE id = {$id}";

// Obtener resultados
$resultado = mysqli_query($db, $query);

//Comprobar si existe, pero resultado es un objeto y se hace asi
if ($resultado->num_rows === 0) {
  header("Location: /");
}
$propiedad = mysqli_fetch_assoc($resultado);




incluirTemplate("header");

?>
<main class="contenedor seccion contenido-centrado">
  <h1><?php echo $propiedad["titulo"]; ?></h1>
  <!-- <picture>
    <source srcset="build/img/destacada.webp" type="image/webp" />
    <source srcset="build/img/descatada.jpg" type="image/jpeg" />
    <img loading="lazy" src="build/img/destacada.jpg" alt="Imagen de la propiedad destacada" />
  </picture> -->
  <img loading="lazy" src="/imagenes/<?php echo $propiedad["imagen"]; ?>" alt="Imagen de la propiedad destacada" />

  <div class="resumen-propiedad">
    <p class="precio">$<?php echo $propiedad["precio"]; ?></p>
    <ul class="iconos-caracteristicas">
      <li>
        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono webp" />
        <p><?php echo $propiedad["wc"]; ?></p>
      </li>
      <li>
        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono webp" />
        <p><?php echo $propiedad["estacionamiento"]; ?></p>
      </li>
      <li>
        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono webp" />
        <p><?php echo $propiedad["habitaciones"]; ?></p>
      </li>
    </ul>
    <p>
      <?php echo $propiedad["descripcion"]; ?>
    </p>
  </div>
</main>

<?php
mysqli_close($db);
incluirTemplate("footer");
?>