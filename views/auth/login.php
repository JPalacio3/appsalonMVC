<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia Sesión con tus datos</p>

<form class="formulario" method="POST" action="/">

    <div class="campo">
        <label for="email">Email:</label>
        <input type="email" id="email" placeholder="Tu Email" name="email" />
    </div>

    <div class="campo">
        <label for="password">Contraseña: </label>
        <input type="password" id="password" placeholder="Tu Contraseña" name="password" />
    </div>

    <input type="submit" class="boton" value="Iniciar Sesión">
</form>

<div class="acciones">

    <a href="/crear-cuenta">Regístrate con nosotros</a>
    <a href="/olvide">Olvidé mi contraseña</a>

</div>