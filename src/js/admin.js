document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp() {
    buscarPorFecha();
    cambiarEstadoCita();
    manejarTabs();
    gestionarServicios();
    gestionarUsuarios();
}

function buscarPorFecha() {
    const fechaInput = document.querySelector('#fecha');
    if(fechaInput) {
        fechaInput.addEventListener('input', function(e) {
            const fechaSeleccionada = e.target.value;
            window.location = `?fecha=${fechaSeleccionada}`;
        });

        // Agregar evento al botón limpiar
        const btnLimpiar = document.querySelector('a[href="/admin"]');
        if(btnLimpiar) {
            btnLimpiar.addEventListener('click', function(e) {
                e.preventDefault();
                // Limpiar el input de fecha
                fechaInput.value = '';
                // Redirigir a admin sin parámetros
                window.location = '/admin';
            });
        }
    }
}

function cambiarEstadoCita() {
    const estados = document.querySelectorAll('.estado-cita');
    estados.forEach(estado => {
        estado.addEventListener('change', function(e) {
            const citaId = e.target.dataset.citaId;
            const nuevoEstado = e.target.value;
            const estadoBadge = e.target.closest('.bg-white').querySelector('.estado-badge');

            // Mostrar loading
            Swal.fire({
                title: 'Actualizando...',
                text: 'Por favor espere',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });

            const datos = new FormData();
            datos.append('id', citaId);
            datos.append('estado', nuevoEstado);

            try {
                fetch('/api/citas/estado', {
                    method: 'POST',
                    body: datos
                })
                .then(respuesta => respuesta.json())
                .then(resultado => {
                    if(resultado.tipo === 'exito') {
                        // Actualizar el badge de estado
                        const clases = {
                            'pendiente': 'bg-yellow-100 text-yellow-800',
                            'completada': 'bg-green-100 text-green-800',
                            'cancelada': 'bg-red-100 text-red-800'
                        };
                        
                        // Remover clases anteriores
                        estadoBadge.className = 'estado-badge px-3 py-1 rounded-full text-sm font-medium';
                        // Agregar nuevas clases
                        estadoBadge.classList.add(...clases[nuevoEstado].split(' '));
                        estadoBadge.textContent = nuevoEstado.charAt(0).toUpperCase() + nuevoEstado.slice(1);

                        Swal.fire({
                            icon: 'success',
                            title: 'Estado Actualizado',
                            text: 'El estado de la cita se actualizó correctamente',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al actualizar el estado'
                });
            }
        });
    });
}

function manejarTabs() {
    const tabs = document.querySelectorAll('.tab-btn');
    const contents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remover clases activas de todas las tabs
            tabs.forEach(t => {
                t.classList.remove('border-blue-500', 'text-blue-600');
                t.classList.add('border-transparent', 'text-gray-500');
            });

            // Ocultar todos los contenidos
            contents.forEach(content => {
                content.classList.add('hidden');
            });

            // Activar la tab seleccionada
            this.classList.remove('border-transparent', 'text-gray-500');
            this.classList.add('border-blue-500', 'text-blue-600');
            
            // Mostrar el contenido correspondiente
            const tabId = this.dataset.tab;
            const contenidoActivo = document.querySelector(`#${tabId}-tab`);
            if(contenidoActivo) {
                contenidoActivo.classList.remove('hidden');
            }
        });
    });
}

function gestionarServicios() {
    // Nuevo servicio
    const btnNuevoServicio = document.querySelector('#nuevo-servicio');
    if(btnNuevoServicio) {
        btnNuevoServicio.addEventListener('click', mostrarFormularioServicio);
    }

    // Editar servicio
    const btnsEditar = document.querySelectorAll('.editar-servicio');
    btnsEditar.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            editarServicio(id);
        });
    });

    // Eliminar servicio
    const btnsEliminar = document.querySelectorAll('.eliminar-servicio');
    btnsEliminar.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            confirmarEliminarServicio(id);
        });
    });
}

function mostrarFormularioServicio(servicio = {}) {
    Swal.fire({
        title: servicio.id ? 'Editar Servicio' : 'Nuevo Servicio',
        html: `
            <form id="formulario-servicio" class="space-y-4">
                <input type="hidden" name="id" value="${servicio.id || ''}">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nombre del Servicio</label>
                    <input type="text" name="nombre_servicio" 
                           class="mt-1 block w-full rounded-md border-gray-300" 
                           value="${servicio.nombre_servicio || ''}" 
                           required 
                           minlength="3"
                           
                           title="Solo se permiten letras y espacios">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Precio</label>
                    <input type="number" name="precio" 
                           class="mt-1 block w-full rounded-md border-gray-300" 
                           value="${servicio.precio || ''}" 
                           required 
                           min="3000"
                           max="100000"
                           step="1">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tiempo Estimado (minutos)</label>
                    <input type="number" name="tiempo_estimado" 
                           class="mt-1 block w-full rounded-md border-gray-300" 
                           value="${servicio.tiempo_estimado || ''}" 
                           required 
                           min="1"
                           step="1">
                </div>
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: servicio.id ? 'Actualizar' : 'Crear',
        cancelButtonText: 'Cancelar',
        preConfirm: () => {
            const form = document.getElementById('formulario-servicio');
            if(!form.checkValidity()) {
                form.reportValidity();
                return false;
            }
            const formData = new FormData(form);
            return guardarServicio(formData, servicio.id);
        }
    });
}

async function guardarServicio(formData, id) {
    try {
        const url = id ? '/api/servicios/actualizar' : '/api/servicios/crear';
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const resultado = await response.json();

        if(resultado.tipo === 'exito') {
            Swal.fire('¡Éxito!', resultado.mensaje, 'success');
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            Swal.fire('Error', resultado.mensaje, 'error');
        }
    } catch (error) {
        console.error(error);
        Swal.fire('Error', 'Hubo un error al procesar la solicitud', 'error');
    }
}

async function editarServicio(id) {
    try {
        const response = await fetch(`/api/servicios/${id}`);
        const servicio = await response.json();
        mostrarFormularioServicio(servicio);
    } catch (error) {
        console.error(error);
        Swal.fire('Error', 'No se pudo cargar el servicio', 'error');
    }
}

function confirmarEliminarServicio(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            eliminarServicio(id);
        }
    });
}

async function eliminarServicio(id) {
    try {
        const formData = new FormData();
        formData.append('id', id);

        const response = await fetch('/api/servicios/eliminar', {
            method: 'POST',
            body: formData
        });
        const resultado = await response.json();

        if(resultado.tipo === 'exito') {
            Swal.fire('¡Eliminado!', resultado.mensaje, 'success');
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            Swal.fire('Error', resultado.mensaje, 'error');
        }
    } catch (error) {
        console.error(error);
        Swal.fire('Error', 'Hubo un error al eliminar el servicio', 'error');
    }
}


