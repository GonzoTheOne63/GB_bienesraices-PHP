<?php
// Importar la conexión
require 'includes/config/database.php';
$db = conectarDB();

// Consultar
$query = "SELECT * FROM  propiedades LIMIT ${limite}";

// Obtener el resultado
$resultado = mysqli_query($db, $query);

?>

<div class="contenedor-anuncios">
  <?php while ($propiedad = mysqli_fetch_assoc($resultado)) : ?>
    <div class="anuncio">

      <img loading="lazy" class="vista" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="anuncio">
      </picture>

      <div class="contenido-anuncio contenido-centrado">
        <h3><?php echo limitar_cadena($propiedad['titulo'], 40, "..."); ?></h3>
        <p class="parrafo"><?php echo limitar_cadena($propiedad['descripcion'], 65, "..."); ?></p>
        <p class="precio">$<?php echo $propiedad['precio']; ?></p>

        <ul class="iconos-caracteristicas">
          <li>
            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
            <p><?php echo $propiedad['wc']; ?></p>
          </li>
          <li>
            <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
            <p><?php echo $propiedad['estacionamiento']; ?></p>
          </li>
          <li>
            <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
            <p><?php echo $propiedad['habitaciones']; ?></p>
          </li>
        </ul>

        <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">
          Ver Propiedad
        </a>
      </div>
      <!--.contenido-anuncio-->
    </div>
  <?php endwhile; ?>
</div>
<!-- anuncio -->
<?php
// CERRAR LA CONEXIÓN A DB
mysqli_close($db);

?>