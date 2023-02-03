<?php
require './includes/funciones.php';
incluirTemplate('header');
?>
<main class="contenedor seccion contenido-centrado">
    <h1>Inicio de Sesión</h1>
    <form class="formulario">
        <legend>E-mail & Password</legend>

        <label for="email">E-mail</label>
        <input type="email" placeholder="Tu Email" id="email" />

        <label for="password">Password</label>
        <input type="password" placeholder="Tu Password" id="password" />

        </fieldset>
    </form>
    <input type="submit" value="Validar" class="boton-verde"></input>
</main>

<?php
incluirTemplate("footer");
?>