<h1 class="nombre-pagina"> Recupera tu Contraseña</h1>
<p class="descripcion-pagina">Escribe tu nueva contraseña, a continuación:</p>


<?php
// alertas
include_once __DIR__ . '/../templates/alertas.php';

?>

<?php if ($error) return;  ?>

<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Nueva contraseña:</label>
        <input type="password" id="password" name="password" placeholder="Escribe tu nueva contraseña" />

    </div>
    <input type="submit" id="password" class="boton" value="Guardar Nueva Contraseña">

</form>

<div class="acciones">
    <a href="/">INICIAR SESIÓN</a>
    <a href="/crear-cuenta">Regístrate con nosotros</a>
</div>