<?php
require "includes/app.php";

incluirTemplate("header", $inicio = true);

?>
<main class="contenedor seccion">
  <h1>Más sobre nosotros</h1>
  <div class="iconos-nosotros">
    <div class="icono">
      <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy" />
      <h3>Seguridad</h3>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, quisquam eveniet sequi vitae accusamus, in
        error quibusdam sed recusandae assumenda minus fugit ut nostrum debitis tempora necessitatibus odio
        doloribus non?
      </p>
    </div>
    <div class="icono">
      <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy" />
      <h3>Precio</h3>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, quisquam eveniet sequi vitae accusamus, in
        error quibusdam sed recusandae assumenda minus fugit ut nostrum debitis tempora necessitatibus odio
        doloribus non?
      </p>
    </div>
    <div class="icono">
      <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy" />
      <h3>Tiempo</h3>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, quisquam eveniet sequi vitae accusamus, in
        error quibusdam sed recusandae assumenda minus fugit ut nostrum debitis tempora necessitatibus odio
        doloribus non?
      </p>
    </div>
  </div>
</main>

<section class="contenedor seccion">
  <h2>Casas y Departamentos en venta</h2>
  <?php
    $limite = 3;
    include "includes/templates/anuncios.php"; 
  ?>
  <div class="alinear-derecha">
    <a href="anuncios.html" class="boton-verde">Ver todas</a>
  </div>
</section>
<section class="imagen-contacto">
  <h2>Encuenta la casa de tus sueños</h2>
  <p>Llena el formulario de contacto y un asesor se pondra en contacto contigo</p>
  <a href="contacto.php" class="boton-naranja">Contactanos</a>
</section>
<div class="contenedor seccion seccion-inferior">
  <section class="blog">
    <h3>Nuestro blog</h3>
    <article class="entrada-blog">
      <div class="imagen">
        <picture>
          <source srcset="build/img/blog1.webp" type="image/webp" />
          <source srcset="build/img/blog1.jpg" type="image/jpeg" />
          <img loading="lazy" src="build/img/blog1.jpg" alt="Texto entrada blog" />
        </picture>
      </div>
      <div class="texto-entrada">
        <a href="entrada.html">
          <h4>Terraza en el techo de tu casa</h4>
          <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
          <p>
            Consejos para contruir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero
          </p>
        </a>
      </div>
    </article>
    <article class="entrada-blog">
      <div class="imagen">
        <picture>
          <source srcset="build/img/blog2.webp" type="image/webp" />
          <source srcset="build/img/blog2.jpg" type="image/jpeg" />
          <img loading="lazy" src="build/img/blog2.jpg" alt="Texto entrada blog" />
        </picture>
      </div>
      <div class="texto-entrada">
        <a href="entrada.html">
          <h4>Guia para la decoracion de tu hogar</h4>
          <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
          <p>
            Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vista a
            tu espacio
          </p>
        </a>
      </div>
    </article>
  </section>
  <section class="testimoniales">
    <h3>Testimoniales</h3>
    <div class="testimonial">
      <blockquote>
        El personal se comportó de una excelente forma, muy buena atencion y la casa que me ofrecieron cumple con
        todas mis expecativas.
      </blockquote>
      <p>-Mario Álvarez González</p>
    </div>
  </section>
</div>

<?php
incluirTemplate("footer");
?>