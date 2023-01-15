<?php
// BASE de datos
require '../../includes/config/database.php';
$db = conectarDB();

// echo "<pre>";
//     var_dump($_GET); // INSEGURO, muestra los datos en la URL
// echo "</pre>";

// echo "<pre>";
//     var_dump($_SERVER["SERVER_SOFTWARE"]); // MUESTRA la información del servidor -> más el software de desarrollo
// echo "</pre>";

// echo "<pre>";
// var_dump($_SERVER["REQUEST_METHOD"]); // MUESTRA la información del servidor -> más el software de desarrollo
// echo "</pre>";

/* VALIDADOR array con mensajes de errores*/
$errores = [];

$titulo = '';
$precio = '';
// $imagen = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';

/* EJECUTAR el código después de que el usuario envía el formulario */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo "<pre>";
    // var_dump($_POST); // SEGURO, no muestra los datos
    // echo "</pre>";

    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    // $imagen = $_POST['imagen'];
    $descripcion = $_POST['descripcion'];
    $habitaciones = $_POST['habitaciones'];
    $wc = $_POST['wc'];
    $estacionamiento = $_POST['estacionamiento'];
    $vendedorId = $_POST['vendedor'];

    if (!$titulo) {
        $errores[] = "Añade el título de tu propiedad";
    }
    if (!$precio) {
        $errores[] = "Falta el precio";
    }
    if (strlen($descripcion) < 50) {
        $errores[] = "Dinos más sobre la propiedad, no menos de 50 caracteres";
    }
    if (!$habitaciones) {
        $errores[] = "El número de habitaciones es obligatorio";
    }
    if (!$wc) {
        $errores[] = "El número de baños es obligatorio";
    }
    if (!$estacionamiento) {
        $errores[] = "El número de estacionamientos es obligatorio";
    }
    if (!$vendedorId) {
        $errores[] = "Elige a tu vendedor";
    }
    // echo "<pre>";
    // var_dump($errores);
    // echo "</pre>";

    // exit;   // EVITA la ejecución del código

    /* REVISAR que el array de errores esté vacio */
    if (empty($errores)) {
        // GENERANDO variable para la inserción a la BD
        $query = " INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedorId) VALUES ( '$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$vendedorId' ) ";

        // echo $query;  // GENERA el query que puedo insertar a tableplus
        // GUARDAR en la BD
        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            echo "Inserción correcta";
        }
    }
}



require '../../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Crear Propiedad</h1>

    <a href="/admin/admin.php" 
        class="boton boton-verde">Clic Volver</a>

    <?php foreach ($errores as $error) : ?> <!-- foreach se ejecuta una vez por cada elemento -->
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <form action="/admin/propiedades/crear.php" 
        class="formulario" 
        method="POST">
        <!--  -->
        <fieldset>
            <legend>Información General</legend>
            <label for="titulo">Título:</label>
            <input type="text" 
            id="titulo" 
            name="titulo" 
            placeholder="Título de la Propiedad" 
            value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" 
            id="precio" 
            name="precio" 
            placeholder="Precio de la Propiedad" 
            value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label el>
            <input type="file" 
            id="imagen" 
            accept="image/jpeg, image/png">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" 
            name="descripcion" 
            placeholder="Tus Comentarios son de gran Valor"><?php echo $descripcion; ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la Propiedad</legend>
            <label for="habitaciones">Habitaciones:</label>
            <input type="number" 
            id="habitaciones" 
            name="habitaciones" 
            placeholder="Ej. 3" 
            value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños:</label>
            <input type="number" 
            id="wc" name="wc"
            placeholder="Ej. 3" 
            min="1" 
            max="10" 
            value="<?php echo $wc; ?>">

            <label for="estacionamiento">Estacionamientos:</label>
            <input type="number" 
            id="estacionamiento" 
            name="estacionamiento" 
            placeholder="Ej. 3" 
            min="1" 
            max="10" 
            value="<?php echo $estacionamiento; ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedor" id="">
                <option value="">-- Seleccione-- </option>
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