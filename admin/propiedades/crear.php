<?php
require '../../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Crear Propiedad</h1>
    <a href="/admin/admin.php" class="boton boton-verde">Clic Volver</a>
    <form action="" class="formulario">
        <fieldset>
            <legend>Información General</legend>
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" placeholder="Título de la Propiedad">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" placeholder="Precio de la Propiedad">

            <label for="imagen">Imagen:</label el>
            <input type="file" id="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" placeholder="Tus Comentarios son de gran Valor"></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la Propiedad</legend>
            <label for="habitaciones">Habitaciones:</label>
            <input type="text" id="habitaciones" placeholder="Título de la Propiedad">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" placeholder="Ej.: 3" min="1" max="10">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" placeholder="Ej.: 3" min="1" max="10">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            <select name="" id="">
                <option value="1">Goin</option>
                <option value="2">Maggy</option>
            </select>
        </fieldset>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate("footer");
?>