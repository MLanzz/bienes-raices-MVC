<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar sesión</h1>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach ?>

    <form class="formulario" method="POST" action="/login">
        <fieldset>
            <legend>
                Email y Password
            </legend>

            <label for="email">E-mail</label>
            <input type="email" name="email" value="" id="email" placeholder="Tu email">

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Tu password">
        </fieldset>

        <input type="submit" class="boton-verde" value="Iniciar sesión">
    </form>

</main>