<?php

// echo "<pre>";
// var_dump($_GET);
// echo "</pre>";
$resultado = $_GET['resultado'] ?? null;
// exit;

require '../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Administrador de Propiedades</h1>
    <?php if (intval($resultado) === 1) : ?>
    <p class="alerta exito">Anuncio Creado Correctamente</p>
    <?php endif; ?>
    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
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
            <tr>
                <td>1</td>
                <td>Casa en la playa</td>
                <td> <img src="/imagenes/1a325d92b810ebb8eae05df8b21b3c81.jpg" class="imagen-tabla">
                <td class="costo">$1200000</td>
                <td>
                    <a href="#" class="boton-rojo-block">Eliminar</a>
                    <a href="#" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
        </tbody>
    </table>
</main>

<?php
incluirTemplate("footer");
?>