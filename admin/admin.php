<?php
/*  {IMPORTAR} la conexión */
require '../includes/config/database.php';
$db = conectarDB();

/*  {ESCRIBIR} el QUERY */
$query  = "SELECT * FROM propiedades";

/*  {CONSULTAR} la BD */
$resultadoConsulta = mysqli_query($db, $query);

// echo "<pre>";
// var_dump($_GET);
// echo "</pre>";
/* {MUESTRA} mensaje condicional */
$resultado = $_GET['resultado'] ?? null;
// exit;

/* {INCLUYE} en TEMPLATE */
require '../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <?php if (intval($resultado) === 1) : ?>
    <p class="alerta exito">Anuncio Creado Correctamente</p>
    <?php endif; ?>
    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo de la Propiedad</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>¿Qué desea hacer?</th>
            </tr>
        </thead>

        <tbody>
            <!-- {MOSTRAR} los resultados  -->
            <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
            <!-- ITERAR para traer los resultados -->
            <tr>
                <td><?php echo $propiedad['id']; ?></td>
                <td><?php echo $propiedad['titulo']; ?></td>
                <td><img src="/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla"></td>
                <td class="precio">$<?php echo number_format($propiedad['precio']); ?>
                <td>
                    <a href="#" class="boton-rojo-block">Eliminar</a>
                    <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>"
                        class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php
/* {CERRAR} la BD */
mysqli_close($db);

incluirTemplate("footer");
?>