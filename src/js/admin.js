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
        btnNuevoServicio.addEventListener('click', function() {
            mostrarFormularioServicio();
        });
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
            eliminarServicio(id);
        });
    });
}


