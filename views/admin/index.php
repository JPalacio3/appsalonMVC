<h1 class="nombre-pagina">Panel de Administración</h1>

<div class="barra">
    <p>Hola <?php echo $nombre ?? ''; ?></p>
</div>

<h2>Buscar citas</h2>
<div class="busqueda">
    <form action="" class="formulario">
        <div class="campo">
            <label for="fecha">Fecha: </label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>" />
        </div>
    </form>
</div>

<?php
if (count($citas) == 0) {
    echo "<h3> No hay citas en esta fecha</h3>";
}
?>

<div id="citas-admin">

    <ul class="citas">
        <?php
        $idCita = null;
        foreach ($citas as $key => $cita) {
            //debuguear($key);

            if ($idCita !== $cita->id) {
                $total = 0;
        ?>
        <li>
            <p> ID : <span><?php echo $cita->id; ?></span></p>
            <p> Hora : <span><?php echo $cita->hora; ?></span></p>
            <p> Cliente : <span><?php echo $cita->cliente; ?></span></p>
            <p> Email : <span><?php echo $cita->email; ?></span></p>
            <p> Teléfono : <span><?php echo $cita->telefono; ?></span></p>

            <h3>Servicios</h3>

            <?php
                $idCita = $cita->id;
            } // Fin de if
            // Devolver el valor total de los servicios
            $total += $cita->precio;
                ?>

            <p class="servicio"> <?php echo $cita->servicio . " -> $ " . $cita->precio; ?></p>
            <?php
                $actual = $cita->id;
                $proximo = $citas[$key + 1]->id ?? 0;

                if (esUltimo($actual, $proximo)) { ?>
            <p class="total"> Total : <span> $ <?php echo $total; ?> </span>
            </p>

            <!-- eliminar una cta -->
            <form action="/api/eliminar" method="POST">
                <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                <input type="submit" class="boton-eliminar" name="" id="" value="Eliminar">

            </form>




            <?php } ?>
            <?php } // Fin de ForEach
            ?>
    </ul>
</div>


<?php $script = "<script src='build/js/buscador.js'></script>"; ?>

<?php include_once __DIR__ . '/../templates/barra.php'; ?>