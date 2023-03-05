<?php
require "includes/funciones.php";

incluirTemplate("header");

?>
<main class="contenedor seccion">
  <h1>Casas y Departamentos en venta</h1>
    <?php
      $limite = 6;
      include "includes/templates/anuncios.php";
    ?>

</main>


<?php
incluirTemplate("footer");
?>