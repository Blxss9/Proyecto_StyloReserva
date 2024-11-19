let paso = 1;
const pasoInicial = 1;
const pasoFinal = 4;

const cita = {
    id: '',
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}

document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp() {
    mostrarSeccion(); // Muestra y oculta las secciones
    tabs(); // Cambia la sección cuando se presionen los tabs
    botonesPaginador(); // Agrega o quita los botones del paginador
    paginaSiguiente();
    paginaAnterior();
    
    consultarAPI(); // Consulta la API en el backend de PHP
    
    idCliente(); // Añade el id del cliente al objeto de cita
    nombreCliente(); // Añade el nombre del cliente al objeto de cita
    seleccionarFecha(); // Añade la fecha de la cita en el objeto
    seleccionarHora(); // Añade la hora de la cita en el objeto
    
    mostrarResumen(); // Muestra el resumen de la cita
}

async function consultarAPI() {
    try {
        const url = '/api/servicios';
        const respuesta = await fetch(url);
        const resultado = await respuesta.json();
        
        if(!resultado.error) {
            mostrarServicios(resultado);
        } else {
            console.error(resultado.error);
            mostrarAlerta('Error al cargar los servicios', 'error');
        }
        
    } catch (error) {
        console.error(error);
        mostrarAlerta('Error al cargar los servicios', 'error');
    }
}

function mostrarServicios(servicios) {
    const contenedorServicios = document.querySelector('#servicios');
    
    if(!contenedorServicios) {
        console.error('El contenedor de servicios no existe');
        return;
    }
    
    // Limpiar el HTML previo
    contenedorServicios.innerHTML = '';
    
    console.log('Servicios recibidos:', servicios); // Debug
    
    servicios.forEach(servicio => {
        const { id, nombre_servicio, precio } = servicio;

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;

        servicioDiv.innerHTML = `
            <p class="nombre-servicio">${nombre_servicio}</p>
            <p class="precio-servicio">$${precio}</p>
        `;

        servicioDiv.onclick = () => seleccionarServicio(servicio);

        contenedorServicios.appendChild(servicioDiv);
    });
}

function paginaSiguiente() {
    const btnSiguiente = document.querySelector('#siguiente');
    
    if(!btnSiguiente) return;
    
    btnSiguiente.addEventListener('click', () => {
        if(paso >= pasoFinal) return;
        
        let resultado = true;
        
        if(paso === 3) {
            resultado = validarResumen();
        } else if(paso === 2) {
            resultado = validarFecha();
        } else if(paso === 1) {
            resultado = validarServicios();
        }
        
        if(resultado) {
            paso++;
            mostrarSeccion();
            botonesPaginador();
        }
    });
}

function paginaAnterior() {
    const btnAnterior = document.querySelector('#anterior');
    
    if(!btnAnterior) return;
    
    btnAnterior.addEventListener('click', () => {
        if(paso <= pasoInicial) return;
        
        paso--;
        mostrarSeccion();
        botonesPaginador();
    });
}

function botonesPaginador() {
    const btnAnterior = document.querySelector('#anterior');
    const btnSiguiente = document.querySelector('#siguiente');
    
    if(!btnAnterior || !btnSiguiente) return;

    if(paso === 1) {
        btnAnterior.classList.add('opacity-50');
        btnAnterior.disabled = true;
    } else {
        btnAnterior.classList.remove('opacity-50');
        btnAnterior.disabled = false;
    }

    if(paso === 4) {
        btnSiguiente.classList.add('opacity-50');
        btnSiguiente.textContent = 'Confirmar';
        btnSiguiente.disabled = true;
    } else {
        btnSiguiente.classList.remove('opacity-50');
        btnSiguiente.disabled = false;
        btnSiguiente.textContent = 'Siguiente »';
    }
}

function mostrarSeccion() {
    // Ocultar la sección que tenga la clase de mostrar
    const seccionAnterior = document.querySelector('.seccion:not(.hidden)');
    if(seccionAnterior) {
        seccionAnterior.classList.add('hidden');
    }
    
    // Seleccionar la sección con el paso
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    if(seccion) {
        seccion.classList.remove('hidden');
    }
    
    // Quita la clase "actual" al tab anterior
    const tabAnterior = document.querySelector('.step-button.bg-blue-500');
    if(tabAnterior) {
        tabAnterior.classList.remove('bg-blue-500', 'text-white');
        tabAnterior.classList.add('bg-gray-300', 'text-gray-600');
    }
    
    // Resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    if(tab) {
        tab.classList.remove('bg-gray-300', 'text-gray-600');
        tab.classList.add('bg-blue-500', 'text-white');
    }
    
    // Actualizar la barra de progreso
    const progreso = document.querySelector('#progress');
    if(progreso) {
        progreso.style.width = `${(paso / pasoFinal) * 100}%`;
    }
}

function mostrarAlerta(mensaje, tipo) {
    if(typeof Swal === 'undefined') {
        console.error('SweetAlert2 no está cargado');
        alert(mensaje);
        return;
    }

    Swal.fire({
        icon: tipo,
        title: tipo === 'error' ? 'Error' : 'Éxito',
        text: mensaje
    });
}

function tabs() {
    const botones = document.querySelectorAll('.step-button');
    botones.forEach(boton => {
        boton.addEventListener('click', function(e) {
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();
            botonesPaginador();
        });
    });
}

function validarServicios() {
    if(cita.servicios.length === 0) {
        mostrarAlerta('Debes seleccionar al menos un servicio', 'error');
        return false;
    }
    return true;
}

function validarFecha() {
    const fecha = document.querySelector('#fecha').value;
    const hora = document.querySelector('#hora').value;
    
    if(fecha === '' || hora === '') {
        mostrarAlerta('Debes seleccionar fecha y hora', 'error');
        return false;
    }
    
    return true;
}

function validarResumen() {
    const elementos = Object.values(cita);
    if(elementos.includes('')) {
        mostrarAlerta('Faltan datos por confirmar', 'error');
        return false;
    }
    return true;
}

function seleccionarServicio(servicio) {
    const { id } = servicio;
    const { servicios } = cita;

    // Identificar el elemento clickeado
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);

    // Comprobar si un servicio ya fue agregado o quitarlo
    if(servicios.some(agregado => agregado.id === id)) {
        // Eliminarlo
        cita.servicios = servicios.filter(agregado => agregado.id !== id);
        divServicio.classList.remove('seleccionado');
    } else {
        // Agregarlo
        cita.servicios = [...servicios, servicio];
        divServicio.classList.add('seleccionado');
    }
}

// También necesitamos implementar las funciones de cliente
function idCliente() {
    const id = document.querySelector('#id').value;
    cita.id = id;
}

function nombreCliente() {
    const nombre = document.querySelector('#nombre').value;
    cita.nombre = nombre;
}

function seleccionarFecha() {
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function(e) {
        const dia = new Date(e.target.value).getUTCDay();
        
        if([6, 0].includes(dia)) {
            e.target.value = '';
            mostrarAlerta('Fines de semana no permitidos', 'error');
        } else {
            cita.fecha = e.target.value;
        }
    });
}

function seleccionarHora() {
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', function(e) {
        const horaCita = e.target.value;
        const hora = horaCita.split(":")[0];
        if(hora < 10 || hora > 18) {
            e.target.value = '';
            mostrarAlerta('Hora no válida', 'error');
        } else {
            cita.hora = e.target.value;
        }
    });
}

function mostrarResumen() {
    const resumen = document.querySelector('#resumen-cita');

    // Limpiar el contenido
    while(resumen.firstChild) {
        resumen.removeChild(resumen.firstChild);
    }

    if(Object.values(cita).includes('') || cita.servicios.length === 0) {
        return;
    }

    const { nombre, fecha, hora, servicios } = cita;

    // Heading para Servicios
    const headingServicios = document.createElement('H3');
    headingServicios.textContent = 'Resumen de Servicios';
    resumen.appendChild(headingServicios);

    // Iterando y mostrando los servicios
    servicios.forEach(servicio => {
        const { nombre, precio } = servicio;
        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('contenedor-servicio');

        const textoServicio = document.createElement('P');
        textoServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.innerHTML = `<span>Precio:</span> $${precio}`;

        contenedorServicio.appendChild(textoServicio);
        contenedorServicio.appendChild(precioServicio);

        resumen.appendChild(contenedorServicio);
    });

    // Heading para Cita
    const headingCita = document.createElement('H3');
    headingCita.textContent = 'Resumen de Cita';
    resumen.appendChild(headingCita);

    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;

    const fechaFormateada = new Date(fecha).toLocaleDateString('es-ES', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`;

    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora:</span> ${hora} Horas`;

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);
}

// ... Resto de las funciones existentes ...