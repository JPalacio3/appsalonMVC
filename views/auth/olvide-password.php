<h1 class="nombre-pagina">Olvidé mi Password</h1>
<p class="descripcion-pagina"> Reestablece tu password escribiendo tu email a continuación</p>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>


<form class="formulario" action="/olvide" method="POST">
    <div class="campo">
        <label for="email"> E mail: </label>
        <input type="email" id="email" name="email" placeholder="Tu Email" />
    </div>

    <input type="submit" class="boton" value="Enviar Instrucciones">
</form>

<div class="acciones">
    <a href="/">INICIAR SESIÓN</a>
    <a href="/crear-cuenta">Regístrate con nosotros</a>
</div>