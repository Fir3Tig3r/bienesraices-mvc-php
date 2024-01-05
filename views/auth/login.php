<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesion</h1>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario" action="/public/login">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" placeholder="Tu Email">

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Tu Password">
        </fieldset>

        <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
    </form>
</main>