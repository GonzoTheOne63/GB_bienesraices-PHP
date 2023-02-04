<?php
// LLAMAR a la base de datos
require 'includes/config/database.php';
$db = conectarDB();

$errores = [];

// AUTENTICAR el usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (!$email) {
        $errores[] = "El email es obligatorio o no es correcto";
    }

    if (!$password) {
        $errores[] = "El password obligatorio o no es correcto";
    }

    if (empty($errores)) {
        
    }
}

// INCLUYE el header
require './includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Inicio de Sesión</h1>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <form method="POST" class="formulario">
        <fieldset>
            <legend>E-mail & Password</legend>

            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Tu Email" id="email" required />

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Tu Password" id="password" required />

        </fieldset>

        <input type="submit" value="Validar" class="boton-verde"></input>
    </form>
</main>

<?php
incluirTemplate("footer");
?>