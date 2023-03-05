<?php
require "includes/funciones.php";

incluirTemplate("header");

?>
<main class="contenedor seccion contenido-centrado">
  <h1>Guia para la decoracion de tu hogar</h1>
  <picture>
    <source srcset="build/img/destacada.webp" type="image/webp" />
    <source srcset="build/img/descatada.jpg" type="image/jpeg" />
    <img loading="lazy" src="build/img/destacada.jpg" alt="Imagen de la propiedad destacada" />
  </picture>
  <p class="informacion-meta">Escrito el <span>20/10/21</span> por <span>Admin</span></p>

  <div class="resumen-propiedad">
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum hic adipisci, pariatur minima, eos sequi libero
      delectus, laudantium exercitationem aut autem qui odio. Fugit corporis odit ipsam consequatur sint minima.
    </p>
  </div>
</main>


<?php
incluirTemplate("footer");
?>