<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administración de Servicios</p>

<?php
include_once __DIR__ . '/../templates/barra.php';
?>

<div class="campo">
    <label for="nombre">Nombre : </label>
    <input type="text" name="nombre" id="nombre" placeholder="Nombre del servicio"
        value="<?php echo $servicio->nombre; ?>" />
</div>

<div class="campo">
    <label for="precio">Precio : </label>
    <input type="nomber" name="precio" id="precio" placeholder="Precio del servicio"
        value="<?php echo $servicio->precio; ?>" />
</div>