<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina"> Llena el siguiente formulario para crear una cuenta</p>

<form class="formulario" action="/crear-cuenta" method="POST">

    <div class="campo">
        <label for="nombre">Nombre </label>
        <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre">
    </div>

    <div class="campo">
        <label for="apellido">Apellido </label>
        <input type="text" id="apellido" name="apellido" placeholder="Tu Apellido">
    </div>

    <div class="campo">
        <label for="telefono">Teléfono </label>
        <input type="tel" id="telefono" name="telefono" placeholder="Teléfono de Contacto">
    </div>

    <div class="campo">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="Email de Contacto">
    </div>

    <div class="campo">
        <label for="password"> Contraseña </label>
        <input type="password" id="password" name="password" placeholder="Escribe una Contraseña Segura">
    </div>

    <input class="boton" type="submit" value="Crear Cuenta">

</form>

<div class="acciones">

    <a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
    <a href="/olvide">Olvidé mi contraseña</a>

</div>