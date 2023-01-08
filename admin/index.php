<?php

// Proteger las URL
require '../includes/funciones.php';
$auth = estaAutenticado();

if (!$auth) {
  header('Location: /');
}


// Importar la base de datos
require '../includes/config/database.php';
$db = conectarDB();

// Escribir el query (cada consulta individual a la base de datos)
$query = "SELECT * FROM propiedades";

// Para Hacer la Consulta a la base de datos
$resultadoConsulta = mysqli_query($db, $query);

// Para mostrar el mensaje condicional
$resultado = $_GET['resultado'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $id = filter_var($id, FILTER_VALIDATE_INT);
  if ($id) {
    // Eliminar el archivo (la imagen)
    $query = "SELECT imagen FROM propiedades WHERE id = ${id}";
    $resultado = mysqli_query($db, $query);
    $propiedad = mysqli_fetch_assoc($resultado);
    unlink('../../imagenes/' . $propiedad['imagen']);

    // Eliminar la propiedad
    $query = "DELETE FROM propiedades WHERE id = ${id}";
    //echo $query; // Para validar en el navegador
    $resultado = mysqli_query($db, $query);
    if ($resultado) {
      header('Location: /admin?resultado=3');
    }
  }

  var_dump($id);  // Sirve para validar o comprobar así evito "INDEFINED"
}

// Para incluir un template (la parte visual de la página)
incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
  <h1>Administrador de Bienes Raices</h1>
  <?php if (intval($resultado)  === 1) : ?>
    <p class="alerta exito">La Propiedad Se Registró Correctamente</p>
  <?php elseif (intval($resultado)  === 2) : ?>
    <p class="alerta exito">La Propiedad Se Actualizó Correctamente</p>
  <?php elseif (intval($resultado)  === 3) : ?>
    <p class="alerta exito">La Propiedad Se Eliminó Correctamente</p>
  <?php endif; ?>

  <a href="/admin/propiedades/crear.php" class="boton-verde">Nueva Propiedad</a>

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
      <!-- Para mostrar los resultados  -->
      <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
        <tr>
          <td><?php echo $propiedad['id']; ?></td>
          <td><?php echo $propiedad['titulo']; ?></td>
          <td><img src="/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla"> </td>
          <td class="precio"> $ <?php echo $propiedad['precio']; ?></td>
          <td>
            <form method="POST" class="w-100">
              <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
              <input type="submit" class="boton-rojo-block" value="Eliminar">
            </form>

            <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>
          </td>
        </tr>
      <?php endwhile ?>
    </tbody>
  </table>
</main>

<?php

// Cerrar la conexión a la base de datos
mysqli_close($db);
incluirTemplate('footer');
?>