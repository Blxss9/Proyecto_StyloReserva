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

function cargarDatosGuardados() {
    const citaGuardada = localStorage.getItem('cita');
    const pasoGuardado = localStorage.getItem('paso');
    
    if (citaGuardada) {
        const citaObj = JSON.parse(citaGuardada);
        Object.assign(cita, citaObj);
    }
    
    if (pasoGuardado) {
        paso = parseInt(pasoGuardado);
        mostrarSeccion();
        mostrarResumen();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    cargarDatosGuardados();
    iniciarApp();
});

function iniciarApp() {
    mostrarSeccion();
    tabs();
    botonesPaginador();
    paginaSiguiente();
    paginaAnterior();
    
    consultarAPI();
    
    idCliente();
    nombreCliente();
    seleccionarFecha();
    seleccionarHora();
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
        const { id, nombre_servicio, precio, tiempo_estimado } = servicio;
        const precioFormateado = parseInt(precio).toLocaleString('es-CL');
        const tiempoFormateado = formatearTiempo(parseInt(tiempo_estimado));

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;

        // Verificar si el servicio está en la cita guardada
        const estaSeleccionado = cita.servicios.some(servicioGuardado => servicioGuardado.id === id);
        if (estaSeleccionado) {
            servicioDiv.classList.add('seleccionado');
        }

        servicioDiv.innerHTML = `
            <p class="nombre-servicio">${nombre_servicio}</p>
            <p class="precio-servicio">$${precioFormateado}</p>
            <p class="tiempo-servicio text-sm text-gray-600">Duración: ${tiempoFormateado}</p>
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
        // Ocultar el botón anterior en el paso 1
        btnAnterior.classList.add('hidden');
    } else {
        btnAnterior.classList.remove('hidden');
        btnAnterior.classList.remove('opacity-50');
        btnAnterior.disabled = false;
    }

    if(paso === 4) {
        // Ocultar el botón siguiente en el paso 4
        btnSiguiente.classList.add('hidden');
    } else {
        btnSiguiente.classList.remove('hidden');
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
    
    localStorage.setItem('paso', paso);
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
            const pasoSeleccionado = parseInt(e.target.dataset.paso);
            
            // Si intenta retroceder, permitirlo
            if (pasoSeleccionado < paso) {
                paso = pasoSeleccionado;
                mostrarSeccion();
                botonesPaginador();
                return;
            }

            // Validaciones para avanzar
            if (paso === 1 && !validarServicios()) {
                return;
            }

            if (paso === 2 && !validarFecha()) {
                return;
            }

            // Si todas las validaciones pasan, permitir el cambio
            if (pasoSeleccionado - paso === 1) {
                paso = pasoSeleccionado;
                mostrarSeccion();
                botonesPaginador();
            } else {
                // Si intenta saltar más de una sección, mostrar alerta
                mostrarAlerta('Por favor, complete los pasos en orden', 'error');
            }
        });
    });
}

function actualizarBotonConfirmar() {
    const metodoPagoSeleccionado = document.querySelector('input[name="payment-method"]:checked');
    const botonConfirmar = document.getElementById('confirmar-pago');
    
    botonConfirmar.disabled = !metodoPagoSeleccionado;

    // Actualizar visual de las opciones seleccionadas
    document.querySelectorAll('.payment-option').forEach(option => {
        const check = option.querySelector('.payment-check');
        if (option.querySelector('input').checked) {
            check.classList.add('opacity-100');
            option.querySelector('label').classList.add('border-blue-500');
        } else {
            check.classList.remove('opacity-100');
            option.querySelector('label').classList.remove('border-blue-500');
        }
    });

    // Agregar el evento click al botón de confirmar
    botonConfirmar.onclick = async () => {
        // Deshabilitar el botón inmediatamente
        botonConfirmar.disabled = true;
        botonConfirmar.textContent = 'Procesando...';
        
        // Deshabilitar las opciones de pago
        document.querySelectorAll('input[name="payment-method"]').forEach(input => {
            input.disabled = true;
        });

        const metodoPago = document.querySelector('input[name="payment-method"]:checked').value;
        
        if (metodoPago === 'local') {
            try {
                // Mostrar modal de confirmación con SweetAlert2
                const resultado = await Swal.fire({
                    title: '¿Confirmar cita?',
                    html: `
                        <p class="mb-4">Has seleccionado pago en establecimiento.</p>
                        <p class="text-sm text-gray-600">
                            Recuerda que deberás realizar el pago al momento de llegar a tu cita.
                        </p>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, agendar',
                    cancelButtonText: 'Cancelar',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                });

                if (resultado.isConfirmed) {
                    // Preparar los datos para enviar
                    const datos = new FormData();
                    datos.append('fecha', cita.fecha);
                    datos.append('hora', cita.hora);
                    datos.append('usuarioId', cita.id);
                    datos.append('servicios', cita.servicios.map(servicio => servicio.id));
                    datos.append('pago', metodoPago);
                    datos.append('estado', 'pendiente');

                    // Realizar la petición para guardar la cita
                    const url = '/api/citas';
                    const respuesta = await fetch(url, {
                        method: 'POST',
                        body: datos
                    });
                    const resultado = await respuesta.json();

                    if(resultado.resultado) {
                        // Limpiar el LocalStorage inmediatamente
                        localStorage.removeItem('cita');
                        localStorage.removeItem('paso');

                        Swal.fire({
                            icon: 'success',
                            title: '¡Cita Confirmada!',
                            text: 'Tu cita ha sido agendada correctamente',
                            confirmButtonText: 'OK',
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then(() => {
                            window.location.href = '/';
                        });
                    }
                } else {
                    // Si el usuario cancela, reactivar el botón y las opciones
                    botonConfirmar.disabled = false;
                    botonConfirmar.textContent = 'Confirmar Cita';
                    document.querySelectorAll('input[name="payment-method"]').forEach(input => {
                        input.disabled = false;
                    });
                }
            } catch (error) {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al guardar la cita',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then(() => {
                    // Reactivar el botón y las opciones en caso de error
                    botonConfirmar.disabled = false;
                    botonConfirmar.textContent = 'Confirmar Cita';
                    document.querySelectorAll('input[name="payment-method"]').forEach(input => {
                        input.disabled = false;
                    });
                });
            }
        } else if (metodoPago === 'paypal') {
            // Lógica para PayPal
            document.querySelector('#paypal-button-container').classList.remove('hidden');
        }
    };
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
    
    localStorage.setItem('cita', JSON.stringify(cita));
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
    
    if(!inputFecha || !horasDisponibles) return;
    
    // Establecer la fecha mínima como hoy
    const hoy = new Date();
    const año = hoy.getFullYear();
    const mes = (hoy.getMonth() + 1).toString().padStart(2, '0');
    const dia = hoy.getDate().toString().padStart(2, '0');
    const fechaMinima = `${año}-${mes}-${dia}`;
    
    inputFecha.min = fechaMinima;
    
    // Si hay una fecha guardada, establecerla
    if(cita.fecha) {
        inputFecha.value = cita.fecha;
        mostrarHorasDisponibles();
    }
    
    inputFecha.addEventListener('input', function(e) {
        const [añoSel, mesSel, diaSel] = e.target.value.split('-');
        const fechaSeleccionada = new Date(añoSel, mesSel - 1, diaSel);
        const fechaHoy = new Date(año, mes - 1, dia);
        
        if(fechaSeleccionada < fechaHoy) {
            e.target.value = '';
            mostrarAlerta('No puedes seleccionar fechas pasadas', 'error');
            horasDisponibles.classList.add('hidden');
            cita.fecha = '';
            cita.hora = '';
        } else {
            const dia = fechaSeleccionada.getDay();
            
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
        mostrarResumen();
        localStorage.setItem('cita', JSON.stringify(cita));
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
                
                localStorage.setItem('cita', JSON.stringify(cita));
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

function formatearTiempo(minutos) {
    const horas = Math.floor(minutos / 60);
    const minutosRestantes = minutos % 60;
    
    let resultado = '';
    
    if (horas > 0) {
        resultado += `${horas} ${horas === 1 ? 'hora' : 'horas'}`;
    }
    
    if (minutosRestantes > 0) {
        if (horas > 0) resultado += ' y ';
        resultado += `${minutosRestantes} ${minutosRestantes === 1 ? 'minuto' : 'minutos'}`;
    }
    
    return resultado || '0 minutos';
}

function mostrarResumen() {
    const resumen = document.querySelector('#resumen-cita');

    if(!resumen) return;

    // Limpiar el contenido
    while(resumen.firstChild) {
        resumen.removeChild(resumen.firstChild);
    }

    // Verificar si hay servicios seleccionados y datos completos
    if(Object.values(cita).includes('') || cita.servicios.length === 0) {
        const mensajeError = document.createElement('P');
        mensajeError.classList.add('text-center', 'text-gray-600', 'mt-5');
        mensajeError.textContent = 'Faltan datos por completar';
        resumen.appendChild(mensajeError);
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

    // Variables para calcular totales
    let tiempoTotal = 0;
    let precioTotal = 0;

    // Iterando y mostrando los servicios
    servicios.forEach(servicio => {
        const { nombre_servicio, precio, tiempo_estimado } = servicio;
        const servicioParrafo = document.createElement('P');
        
        // Sumar al tiempo total
        tiempoTotal += parseInt(tiempo_estimado);
        // Sumar al precio total
        precioTotal += parseFloat(precio);
        
        // Formatear el precio en formato CLP
        const precioFormateado = new Intl.NumberFormat('es-CL', {
            style: 'currency',
            currency: 'CLP'
        }).format(precio);
        
        // Formatear el tiempo estimado
        const tiempoFormateado = formatearTiempo(parseInt(tiempo_estimado));
        
        servicioParrafo.textContent = `${nombre_servicio} - ${precioFormateado} (${tiempoFormateado})`;
        contenedorServicios.appendChild(servicioParrafo);
    });

    // Agregar tiempo total estimado con formato
    const tiempoTotalParrafo = document.createElement('P');
    const tiempoTotalFormateado = formatearTiempo(tiempoTotal);
    tiempoTotalParrafo.innerHTML = `<span class="font-bold">Tiempo Total Estimado:</span> ${tiempoTotalFormateado}`;
    tiempoTotalParrafo.classList.add('bg-blue-50', 'rounded-lg', 'text-lg', 'mt-4');

    // Modificar la parte de formateo de fecha
    const [año, mes, dia] = fecha.split('-');
    
    // Crear la fecha sin UTC
    const fechaObj = new Date(año, mes - 1, dia);
    
    const opciones = { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric'
    };
    
    const fechaFormateada = fechaObj.toLocaleDateString('es-CL', opciones);
    const fechaCapitalizada = fechaFormateada.charAt(0).toUpperCase() + fechaFormateada.slice(1);

    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span class="font-bold">Fecha:</span> ${fechaCapitalizada}`;
    fechaCita.classList.add('text-lg');

    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span class="font-bold">Hora:</span> ${hora} hrs`;
    horaCita.classList.add('text-lg');

    // Calcular y mostrar el total
    const totalFormateado = new Intl.NumberFormat('es-CL', {
        style: 'currency',
        currency: 'CLP'
    }).format(precioTotal);
    
    const totalParrafo = document.createElement('P');
    totalParrafo.innerHTML = `<span class="font-bold">Total a Pagar:</span> ${totalFormateado}`;
    totalParrafo.classList.add('bg-gray-100', 'p-4', 'rounded-lg', 'text-lg', 'mt-6', 'text-center');

    // Agregar al contenedor principal
    contenedorResumen.appendChild(nombreCliente);
    contenedorResumen.appendChild(contenedorServicios);
    contenedorResumen.appendChild(tiempoTotalParrafo);
    contenedorResumen.appendChild(fechaCita);
    contenedorResumen.appendChild(horaCita);
    contenedorResumen.appendChild(totalParrafo);

    // Agregar al resumen
    resumen.appendChild(contenedorResumen);

    // Habilitar el botón de confirmar si estamos en el paso 3
    if(paso === 3) {
        const btnSiguiente = document.querySelector('#siguiente');
        if(btnSiguiente) {
            btnSiguiente.classList.remove('opacity-50');
            btnSiguiente.disabled = false;
        }
    }
}

// ... Resto de las funciones existentes ...