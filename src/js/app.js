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
    
    servicios.forEach(servicio => {
        const { id, nombre_servicio, precio } = servicio;

        // Formatear el precio como número entero
        const precioFormateado = parseInt(precio).toLocaleString('es-CL');

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;

        servicioDiv.innerHTML = `
            <p class="nombre-servicio">${nombre_servicio}</p>
            <p class="precio-servicio">$${precioFormateado}</p>
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
        
        if(paso === 1) {
            // Validar que se haya seleccionado al menos un servicio
            if(!validarServicios()) return;
        }
        
        if(paso === 2) {
            // Validar que se haya seleccionado fecha y hora
            if(!validarFecha()) return;
        }
        
        paso++;
        mostrarSeccion();
        botonesPaginador();
        
        // Actualizar el resumen al cambiar de página
        mostrarResumen();
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
    
    if(fecha === '' || !cita.hora) {
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
    
    // Actualizar el resumen cada vez que se selecciona o deselecciona un servicio
    mostrarResumen();
}

// También necesitamos implementar las funciones de cliente
function idCliente() {
    // Verificar si el elemento existe antes de acceder a su valor
    const inputId = document.querySelector('#id');
    if(inputId) {
        cita.id = inputId.value;
    }
}

function nombreCliente() {
    // Verificar si el elemento existe antes de acceder a su valor
    const inputNombre = document.querySelector('#nombre');
    if(inputNombre) {
        cita.nombre = inputNombre.value;
    }
}

function seleccionarFecha() {
    const inputFecha = document.querySelector('#fecha');
    const horasDisponibles = document.querySelector('#horas-disponibles');
    
    if(!inputFecha || !horasDisponibles) {
        console.error('No se encontraron los elementos necesarios');
        return;
    }
    
    // Establecer la fecha mínima como hoy
    const hoy = new Date();
    const año = hoy.getFullYear();
    const mes = (hoy.getMonth() + 1).toString().padStart(2, '0');
    const dia = hoy.getDate().toString().padStart(2, '0');
    const fechaMinima = `${año}-${mes}-${dia}`;
    
    inputFecha.min = fechaMinima;
    
    inputFecha.addEventListener('input', function(e) {
        const fechaSeleccionada = new Date(e.target.value + 'T00:00:00');
        const fechaHoy = new Date(fechaMinima + 'T00:00:00');
        
        if(fechaSeleccionada < fechaHoy) {
            e.target.value = '';
            mostrarAlerta('No puedes seleccionar fechas pasadas', 'error');
            horasDisponibles.classList.add('hidden');
            cita.fecha = '';
            cita.hora = '';
        } else {
            const dia = fechaSeleccionada.getUTCDay();
            
            if([6, 0].includes(dia)) {
                e.target.value = '';
                mostrarAlerta('Fines de semana no permitidos', 'error');
                horasDisponibles.classList.add('hidden');
                cita.fecha = '';
                cita.hora = '';
            } else {
                cita.fecha = e.target.value;
                mostrarHorasDisponibles();
            }
        }
        // Actualizar el resumen cuando se selecciona una fecha
        mostrarResumen();
    });
}

function mostrarHorasDisponibles() {
    const horasDisponibles = document.querySelector('#horas-disponibles');
    
    if(!horasDisponibles) {
        console.error('No se encontró el contenedor de horas disponibles');
        return;
    }
    
    horasDisponibles.classList.remove('hidden');

    // Definir las horas disponibles por período
    const horas = {
        mañana: ['10:00', '10:50', '11:40'],
        tarde: ['12:30', '15:00', '15:50', '16:40', '17:30'],
        noche: ['18:20', '19:10']
    };

    // Limpiar contenedores
    ['mañana', 'tarde', 'noche'].forEach(periodo => {
        const contenedor = document.querySelector(`#horas-${periodo}`);
        if(!contenedor) {
            console.error(`No se encontró el contenedor para ${periodo}`);
            return;
        }
        
        contenedor.innerHTML = '';
        
        horas[periodo].forEach(hora => {
            const boton = document.createElement('BUTTON');
            boton.type = 'button';
            boton.classList.add('px-4', 'py-2', 'text-sm', 'border', 'rounded', 'hover:bg-blue-500', 'hover:text-white');
            
            if(cita.hora === hora) {
                boton.classList.add('bg-blue-500', 'text-white');
            }
            
            boton.textContent = hora;
            
            boton.onclick = function() {
                document.querySelectorAll('button[type="button"]').forEach(btn => {
                    btn.classList.remove('bg-blue-500', 'text-white');
                });
                
                this.classList.add('bg-blue-500', 'text-white');
                cita.hora = hora;
                
                // Actualizar el resumen cuando se selecciona una hora
                mostrarResumen();
            };
            
            contenedor.appendChild(boton);
        });
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

    // Verificar si hay servicios seleccionados y datos completos
    if(Object.values(cita).includes('') || cita.servicios.length === 0) {
        return;
    }

    const { nombre, fecha, hora, servicios } = cita;

    // Contenedor principal
    const contenedorResumen = document.createElement('DIV');
    contenedorResumen.classList.add('p-6', 'space-y-6');

    // Nombre del cliente
    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span class="font-bold">Nombre:</span> ${nombre}`;
    nombreCliente.classList.add('text-lg');

    // Contenedor de servicios
    const contenedorServicios = document.createElement('DIV');
    contenedorServicios.classList.add('space-y-3');

    // Título de servicios
    const tituloServicios = document.createElement('H3');
    tituloServicios.textContent = 'Servicios Seleccionados:';
    tituloServicios.classList.add('font-bold', 'text-lg', 'mb-3');
    contenedorServicios.appendChild(tituloServicios);

    // Iterando y mostrando los servicios
    servicios.forEach(servicio => {
        const { nombre_servicio, precio } = servicio;
        const servicioParrafo = document.createElement('P');
        // Formatear el precio en formato CLP
        const precioFormateado = new Intl.NumberFormat('es-CL', {
            style: 'currency',
            currency: 'CLP'
        }).format(precio);
        servicioParrafo.textContent = `${nombre_servicio} - ${precioFormateado}`;
        contenedorServicios.appendChild(servicioParrafo);
    });

    // Formatear la fecha
    const fechaObj = new Date(fecha);
    const opciones = { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric'
    };
    const fechaFormateada = fechaObj.toLocaleDateString('es-CL', opciones);
    // Capitalizar primera letra
    const fechaCapitalizada = fechaFormateada.charAt(0).toUpperCase() + fechaFormateada.slice(1);

    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span class="font-bold">Fecha:</span> ${fechaCapitalizada}`;
    fechaCita.classList.add('text-lg');

    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span class="font-bold">Hora:</span> ${hora} hrs`;
    horaCita.classList.add('text-lg');

    // Calcular y mostrar el total
    const total = servicios.reduce((total, servicio) => total + parseFloat(servicio.precio), 0);
    const totalFormateado = new Intl.NumberFormat('es-CL', {
        style: 'currency',
        currency: 'CLP'
    }).format(total);
    
    const totalParrafo = document.createElement('P');
    totalParrafo.innerHTML = `<span class="font-bold">Total:</span> ${totalFormateado}`;
    totalParrafo.classList.add('text-xl', 'mt-6');

    // Agregar al contenedor principal
    contenedorResumen.appendChild(nombreCliente);
    contenedorResumen.appendChild(contenedorServicios);
    contenedorResumen.appendChild(fechaCita);
    contenedorResumen.appendChild(horaCita);
    contenedorResumen.appendChild(totalParrafo);

    // Agregar al resumen
    resumen.appendChild(contenedorResumen);
}

// ... Resto de las funciones existentes ...