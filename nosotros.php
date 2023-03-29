<?php
require "includes/app.php";

incluirTemplate("header");

?>
<main class="contenedor seccion">
  <h1>Conoce sobre nosotros</h1>
  <div class="contenido-nosotros">
    <div class="imagen">
      <picture>
        <source srcset="build/img/nosotros.webp" type="image/webp" />
        <source srcset="build/img/nosotros.jpg" type="imagen/jpeg" />
        <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros" />
      </picture>
    </div>
    <div class="texto-nosotros">
      <blockquote>25 años de experiencia</blockquote>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit vel
        perferendis consequuntur magnam ipsum repudiandae molestias impedit,
        animi nam consequatur esse ab est harum nulla aliquam quo qui.
        Nobis, sint!
      </p>

      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quam atque
        magni deserunt at consectetur id harum exercitationem illum repellat
        omnis, provident ratione, consequatur, autem impedit. Minima
        cupiditate autem maiores magnam!
      </p>
    </div>
  </div>
</main>

<section class="contenedor seccion">
  <h1>Más Sobre Nosotros</h1>
  <div class="iconos-nosotros">
    <div class="icono">
      <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy" />
      <h3>Seguridad</h3>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus,
        quisquam eveniet sequi vitae accusamus, in error quibusdam sed
        recusandae assumenda minus fugit ut nostrum debitis tempora
        necessitatibus odio doloribus non?
      </p>
    </div>
    <div class="icono">
      <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy" />
      <h3>Precio</h3>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus,
        quisquam eveniet sequi vitae accusamus, in error quibusdam sed
        recusandae assumenda minus fugit ut nostrum debitis tempora
        necessitatibus odio doloribus non?
      </p>
    </div>
    <div class="icono">
      <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy" />
      <h3>Tiempo</h3>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus,
        quisquam eveniet sequi vitae accusamus, in error quibusdam sed
        recusandae assumenda minus fugit ut nostrum debitis tempora
        necessitatibus odio doloribus non?
      </p>
    </div>
  </div>
</section>


<?php
incluirTemplate("footer");
?>