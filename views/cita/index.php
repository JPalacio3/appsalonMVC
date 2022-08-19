<h1 class="nombre-pagina"> Crear Nueva Cita</h1>
<p class="descripcion-pagina">Elige tus servicios a continuación</p>

<div id="app">

    <nav class="tabs">
        <button class="actual" type="buttom" data-paso="1">Servicios</button>
        <button type="buttom" data-paso="2">Tus Datos y Cita</button>
        <button type="buttom" data-paso="3">Resumen</button>

    </nav>


    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>

    <div id="paso-2" class="seccion">
        <h2>Tus Datos y Cita</h2>
        <p class="text-center">Coloca tus datos y la fecha para tu cita</p>


        <form class="formulario" action="">
            <div class="campo">
                <label for="nombre">Nombre: </label>
                <input type="text" id="nombre" v-model="nombre" placeholder="Nombre" value="<?php echo $nombre  ?>"
                    disabled>
            </div>

            <div class="campo">
                <label for="fecha">Fecha: </label>
                <input type="date" id="fecha" v-model="fecha">
            </div>

            <div class="campo">
                <label for="hora">Hora: </label>
                <input type="time" id="hora" v-model="hora">
            </div>


        </form>


    </div>

    <div id="paso-3" class="seccion">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la información sea correcta</p>
    </div>






</div>