<?php

// Proteger las URL
require '../../includes/funciones.php';
$auth = estaAutenticado();

if (!$auth) {
  header('Location: /');
}

// Base de datos
require '../../includes/config/database.php';
$db = conectarDB();

//  Consulta para obtener los nombres de los vendedores
$consulta = "SELECT * FROM vendedores";
$res = mysqli_query($db, $consulta);

// Arreglo para validar que no existan aceldas vacias del formulario
$errores = [];

// Aquí vamos a revisar que el array,arreglo esté vacio
$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';

// Este código se ejecuta después que el usuario llena y envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  /* echo "<pre>";
  var_dump($_POST);
  echo "</pre>";

  /* echo "<pre>";
  var_dump($_FILES);
  echo "</pre>"; 
  exit; */

  echo "<pre>";
  var_dump($_FILES);
  echo "</pre>";

  $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
  $precio = mysqli_real_escape_string($db, $_POST['precio']);
  $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
  $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
  $wc = mysqli_real_escape_string($db, $_POST['wc']);
  $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
  $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
  $creado = date('Y/m/d');

  // Aquí se van asignar los files a una variable
  $imagen = $_FILES['imagen'];

  if (!$titulo) {
    $errores[]  = "Coloca un título, por favor";
  }

  if (!$precio) {
    $errores[]  = "Por favor, coloca un precio";
  }

  if (strlen($descripcion) < 50) {
    $errores[]  = "Su descripción es muy importante, use al menos 50 carácteres";
  }

  if (!$habitaciones) {
    $errores[]  = "La cantidad de habitaciones es obligatoria";
  }

  if (!$wc) {
    $errores[]  = "Es obligatorio el número de baños";
  }

  if (!$estacionamiento) {
    $errores[]  = "El número de estacionamientos es obligatorio";
  }

  if (!$vendedorId) {
    $errores[]  = "Seleccione a su vendedor";
  }

  if (!$imagen['name'] || $imagen['error']) {
    $errores[] = "La imagen es bligatoria";
  }
  // Validar el tamaño de la imagen (ej. 100 kb máximo)
  if ($imagen['size'] > 1000 * 1000) $errores[] = "La imagen es muy pesada";


  if (empty($errores)) {
    /* SUBIDA DE ACHIVOS AL SERVIDOR */

    // Crear Carpeta
    $carpetaImagenes = '../../imagenes/';
    if (!is_dir($carpetaImagenes)) {
      mkdir($carpetaImagenes);
    }
    // Generando el nombre único
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    // Subir la imagen a la carpeta temporal
    move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

    /* exit; */

    // Aquí insertamos a la base de datos 
    $query = " INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedorId) VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorId')";

    // echo $query;

    $resultado = mysqli_query($db, $query); {
      if ($resultado) {
        /* echo "Insertado Correctamente"; */

        // REDIRECCIONAR AL USUARIO PARA NO DUPLICAR LOS DATOS
        header('Location: /admin?resultado=1');
      }
    }
  }
}

incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
  <h1>Crear</h1>

  <a href="/admin" class="boton-verde">Volver</a>


  <?php foreach ($errores as $error) : ?>
    <div class="alerta error">
      <?php echo $error; ?>
    </div>
  <?php endforeach; ?>

  <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
    <fieldset>
      <legend>Información General</legend>

      <label for="habitaciones">Título:</label>
      <input type="text" id="titulo" name="titulo" placeholder="Título de la Propiedad." value="<?php echo $titulo; ?>">

      <label for="precio">Precio:</label>
      <input type="number" id="precio" name="precio" placeholder="Precio de la Propiedad." value="<?php echo $precio; ?>">

      <label for=" imagen">Imagen:</label>
      <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

      <label for="descripcion">Descripción:</label>
      <textarea name="descripcion" id="descripcion" placeholder="Lo que nos digas ayudará en tu venta"><?php echo $descripcion; ?></textarea>

    </fieldset>

    <fieldset>
      <legend>Información de la Propiedad</legend>

      <label for=" habitaciones">Habitaciones:</label>
      <input type="number" id="habitaciones" name='habitaciones' placeholder="Ej. 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

      <label for="wc">Baños:</label>
      <input type="number" id="wc" name='wc' placeholder="Ej. 3" min="1" max="9" value="<?php echo $wc; ?>">

      <label for="estacionamiento">Estacionamiento:</label>
      <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej. 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">
    </fieldset>

    <fieldset>
      <legend>Vendedor</legend>
      <select name="vendedor">
        <option value="">-- Seleccione --</option>
        <?php while ($vendedor = mysqli_fetch_assoc($res)) : ?>
          <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>">
            <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?> </option>
        <?php endwhile; ?>
      </select>
    </fieldset>

    <input type="submit" value="Crear Propiedad" class="boton boton-verde">

  </form>

</main>


<?php
incluirTemplate('footer');
