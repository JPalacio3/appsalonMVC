<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina"> Llena el siguiente formulario para crear una cuenta</p>

<?php
include_once __DIR__ . "/../templates/alertas.php";
?>

<form class="formulario" action="/crear-cuenta" method="POST">

    <div class="campo">
        <label for="nombre">Nombre </label>
        <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre" value="<?php echo s($usuario->nombre); ?>">
    </div>

    <div class="campo">
        <label for="apellido">Apellido </label>
        <input type="text" id="apellido" name="apellido" placeholder="Tu Apellido"
            value="<?php echo s($usuario->apellido); ?>">
    </div>

    <div class="campo">
        <label for="telefono">Teléfono </label>
        <input type="tel" id="telefono" name="telefono" placeholder="Teléfono de Contacto"
            value="<?php echo s($usuario->telefono); ?>">
    </div>

    <div class="campo">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="Email de Contacto"
            value="<?php echo s($usuario->email); ?>">
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