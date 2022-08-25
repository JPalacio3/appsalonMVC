let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;


document.addEventListener('DOMContentLoaded',() => {
    iniciarApp();
})

function iniciarApp() {

    mostrarSeccion();  // Muestra el servicio activo la primera vez

    tabs(); // Cambia la sección cuando se presionen los tabs de navegación entre páginas.

    botonesPaginador(); // Agrega o quita los botones del paginador

    paginaSiguiente(); // Funcionalidad para el botón de página siguiente

    paginaAnterior(); // Funcionalidad para el botón de página anterior
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




