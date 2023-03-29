<?php
require "includes/app.php";

incluirTemplate("header");

?>
<main class="contenedor seccion">
  <h1>Casas y Departamentos en venta</h1>
    <?php
      $limite = 4;
      include "includes/templates/anuncios.php";
    ?>

</main>


<?php
incluirTemplate("footer");
?>