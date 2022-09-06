let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}

document.addEventListener('DOMContentLoaded',() => {
    iniciarApp();
})

function iniciarApp() {

    mostrarSeccion();  // Muestra el servicio activo la primera vez

    tabs(); // Cambia la sección cuando se presionen los tabs de navegación entre páginas.

    botonesPaginador(); // Agrega o quita los botones del paginador

    paginaSiguiente(); // Funcionalidad para el botón de página siguiente

    paginaAnterior(); // Funcionalidad para el botón de página anterior

    consultarAPI(); // Consulta la API en el backend de PHP

    nombreCliente(); // Añade el nombre del cliente al objeto de cita
    seleccionarFecha(); // Añade la fecha de la cita al objeto de cita
    seleccionarHora(); // Añade la hora al objeto de la cita

}


function mostrarSeccion() {

    // Ocultar la sección que tenga la clase de mostrar al pasar a otra sección
    const seccionAnterior = document.querySelector('.mostrar');

    // Comprueba que la primera vez no exista la clase mostrar
    if (seccionAnterior) { seccionAnterior.classList.remove('mostrar'); }


    // Mostrar la sección con el paso
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector); // `` template string se logra con Alt + 96
    seccion.classList.add('mostrar');

    // Quita la clase de actual al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if (tabAnterior) { tabAnterior.classList.remove('actual'); }

    // Resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');

}


function tabs() {

    const botones = document.querySelectorAll('.tabs button');

    botones.forEach(boton => {
        boton.addEventListener('click',(e) => {
            // console.log( parseInt(e.target.dataset.paso) );
            // ↑ Por medio de este código se puede acceder a atributos personalizados que se crean en HTML
            paso = parseInt(e.target.dataset.paso);

            mostrarSeccion();
            botonesPaginador();
        })
    });
}

function botonesPaginador() {
    // Botón de página siguiente
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

    if (paso === 1) {
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');

    } else if (paso === 3) {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');
    } else {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion();
}


function paginaAnterior() {
    const paginaAnterior = document.querySelector('#anterior');

    paginaAnterior.addEventListener('click',() => {
        if (paso <= pasoInicial) return;
        paso--;

        botonesPaginador();
    })
}


function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');

    paginaSiguiente.addEventListener('click',() => {
        if (paso >= pasoFinal) return;
        paso++;

        botonesPaginador();
    })
}


// Función para iniciar la Api que muestra los resultados de la BD
async function consultarAPI() {

    try {
        const url = 'http://localhost:6969/api/servicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);
    } catch (error) {
        console.log(error);
    }
}

function mostrarServicios(servicios) {
    servicios.forEach(servicio => {
        const { id,nombre,precio } = servicio;

        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precioServicio');
        precioServicio.textContent = `$ ${precio}`;

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;
        servicioDiv.onclick = function () {
            seleccionarServicio(servicio);
        }

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        // Mostrar la información en el HTML con los elementos creados a partir de JS
        document.querySelector('#servicios').appendChild(servicioDiv);

    });
}

function seleccionarServicio(servicio) {
    const { id } = servicio;
    const { servicios } = cita;

    //Identificar el elemento al que se le da click
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);

    // Comprobar si un servicio ya fue agregado
    if (servicios.some(agregado => agregado.id === id)) {

        // Si fue seleccionado previamente, y se vuelve a dar cli9ck en él, significa que lo queremos quitar
        cita.servicios = servicios.filter(agregado => agregado.id !== id);
        divServicio.classList.remove('seleccionado');

    } else {
        // Agregarlo como un nuevo servicio seleccionado
        cita.servicios = [...servicios,servicio];
        divServicio.classList.add('seleccionado');
    }
}

function nombreCliente() {
    //Acceder al valor del nombre del atributo en html, lo que en JS es un objeto
    cita.nombre = document.querySelector('#nombre').value;

}

function seleccionarFecha() {
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input',(e) => {

        // Prevenir que se escoja una fecha de sábado o Domingo
        const dia = new Date(e.target.value).getUTCDay();

        // Validar que no sea en sábado o domingo, el 0 corresponde al día domingo en calendario, y el 6 corresponde al sábado
        if ([6,0].includes(dia)) {
            e.target.value = '';
            mostrarAlerta('Fines de Semana NO Permitidos','error');
        } else {
            cita.fecha = e.target.value;
        }
    });
}


function seleccionarHora() {
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input',function (e) {

        const horaCita = e.target.value;
        const hora = horaCita.split(":")[0];

        if (hora < 10 || hora > 18) {
            e.target.value = '';
            // Si es una nhora entre las 18 hrs y las 10 hrs, no es una hora válida para seleccionar la cita
            mostrarAlerta('Nuestros Horarios son de 10:00am hasta las 07:00 pm: Hora No válida, seleccione una hora entre las 10:00Hrs y las 18:00Hrs','error');
        } else {
            cita.hora = e.target.value;
        }
    })
}


function mostrarAlerta(mensaje,tipo) {

    // Prevenir que se generen varias alertas de la misma, en caso de que ya exista una en pantalla
    const alertaPrevia = document.querySelector('.alerta');
    if (alertaPrevia) return;

    // Crea un div con una alerta informando que los días seleccionados en la función anterior NO se puede seleccionar porque no hay servicio
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const formulario = document.querySelector('.formulario');
    formulario.appendChild(alerta);

    // Remover la alerta después de 3 segundos
    setTimeout(() => {
        alerta.remove();
    },5000);
}

