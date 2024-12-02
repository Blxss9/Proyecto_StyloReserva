<body class="bg-gray-900">
  
  <!-- Navbar -->
  <nav class="bg-black/40 fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20">
        <!-- Logo -->
        <div class="flex-shrink-0 flex items-center">
          <a href="/">
          <img src="/build/img/logo.svg" alt="logo_barberia" class="h-20">
          </a>

          <span class="ml-2 text-white text-xl font-bold">Elite Barbershop</span>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:block">
          <div class="m-2 flex items-center space-x-8 font-bold">
            <a href="/" class="text-white hover:text-amber-500 transition-colors">Inicio</a>
            <a href="#seccionServicios" class="text-white hover:text-amber-500 transition-colors">Servicios</a>
            <a href="#seccionNosotros" class="text-white hover:text-amber-500 transition-colors">Nosotros</a>
            <a href="#seccionContacto" class="text-white hover:text-amber-500 transition-colors">Contacto</a>
          </div>
        </div>
        
        <!-- Social Icons -->
        <div class="hidden md:flex items-center space-x-8 m-2">
          <a href="https://www.facebook.com/">
            <i class="fa-brands fa-facebook fa-xl text-white hover:text-blue-500"></i>
          </a>
          <a href="https://web.whatsapp.com/">
            <i class="fa-brands fa-whatsapp fa-xl text-white hover:text-green-400" ></i>
          </a>
          <a href="https://www.instagram.com/">
            <i class="fa-brands fa-instagram fa-xl text-white hover:text-pink-600"></i>
          </a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->


  <div class="relative min-h-screen">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat object-cover" style="background-image: url('/build/img/barberia1.jpg');">
      <div class="absolute inset-0 bg-black/60"></div>
    </div>

    <!-- Content -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-8 min-h-screen flex items-center">
      <!-- Botón de volver al inicio -->
    <button id="backToTop" class="fixed bottom-5 right-5 bg-amber-500 text-white p-3 rounded-full shadow-lg hover:bg-amber-600 transition-opacity duration-300 opacity-0 z-50">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    <!-- JavaScript para mostrar/ocultar y hacer scroll hacia arriba -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const backToTopButton = document.getElementById('backToTop');
            // Mostrar el botón cuando se desplaza hacia abajo
            window.addEventListener('scroll', () => {
                if (window.scrollY > 200) {
                    backToTopButton.classList.remove('opacity-0');
                    backToTopButton.classList.add('opacity-100');
                } else {
                    backToTopButton.classList.remove('opacity-100');
                    backToTopButton.classList.add('opacity-0');
                }
            });

            // Scroll hacia arriba al hacer clic en el botón
            backToTopButton.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });
    </script>

      <div class="w-full text-center mt-10 sm:text-left">
      <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 sm:mb-8">
            Estilo y <span class="text-amber-500">Elegancia</span>
        </h1>
        <p class="text-gray-300 text-base mt-8 sm:text-lg mb-8 sm:mb-10">
            El lugar donde tu estilo evoluciona. Con técnicas que unen lo clásico y lo contemporáneo, realizamos tu imagen a otro nivel.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 mt-12 mb-8 sm:mb-12">
          <a href="/login" class="bg-amber-500 text-black px-6 sm:px-8 py-3 rounded-full font-semibold hover:bg-amber-400 transition-colors duration-300 flex items-center justify-center">
            <i class="fa-solid fa-calendar-days mr-2"></i>
            Reservar Cita
          <a/>
          <button id="openModal" class="border-2 border-amber-500 text-white px-6 sm:px-8 py-3 rounded-full font-semibold hover:bg-amber-500/10 transition-colors duration-300 flex items-center justify-center">
            <i class="fa-regular fa-clock mr-2" style="color: #ffffff;"></i>
            Ver Horarios
          </button>
        </div>
        <!-- Modulo emergente horarios -->
        <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg w-full">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Horarios de Atención</h2>
                <ul class="text-gray-700">
                    <li>Lunes a Viernes: 9:00 AM - 8:00 PM</li>
                    <li>Sábado: Cerrado</li>
                    <li>Domingo: Cerrado</li>
                </ul>
                <button id="closeModal" class="mt-6 bg-amber-500 text-white px-4 py-2 rounded hover:bg-amber-600 transition-colors">Cerrar</button>
            </div>
        </div>


        <!-- JavaScript para controlar el modulo de horarios -->
        <script>
          const modal = document.getElementById('modal');
          const modalContent = document.getElementById('modalContent');
          const openModalBtn = document.getElementById('openModal');
          const closeModalBtn = document.getElementById('closeModal');

          openModalBtn.addEventListener('click', function() {
              modal.classList.remove('hidden');
          });

          closeModalBtn.addEventListener('click', function() {
              modal.classList.add('hidden');
          });

          // Cierra el modal al hacer clic fuera del contenido
          modal.addEventListener('click', function(event) {
              if (event.target === modal) {
                  modal.classList.add('hidden');
              }
          });
                    // Cierra el modal al hacer scroll
          window.addEventListener('scroll', function() {
              if (!modal.classList.contains('hidden')) {
                  modal.classList.add('hidden');
              }
          });
          </script>

        <div class="flex flex-col sm:flex-row items-center mt-16 justify-center sm:justify-start space-y-2 sm:space-y-0 sm:space-x-6">
          <div class="text-white">
            <p class="text-2xl sm:text-3xl font-bold">10+</p>
            <p class="text-xs sm:text-sm text-gray-400">Años de<br>Experiencia</p>
          </div>
          <div class="h-8 sm:h-12 w-px bg-amber-500"></div>
          <div class="text-white">
            <p class="text-2xl sm:text-3xl font-bold">5000+</p>
            <p class="text-xs sm:text-sm text-gray-400">Clientes<br>Satisfechos</p>
          </div>
          <div class="h-8 sm:h-12 w-px bg-amber-500"></div>
          <div class="text-white">
            <p class="text-2xl sm:text-3xl font-bold">4.9</p>
            <p class="text-xs sm:text-sm text-gray-400">Calificación<br>Promedio</p>
          </div>
        </div>
      

        



<!-- Sección Nosotros -->
<section id="seccionNosotros" class="py-24 bg-gradient-to-br from-gray-900 to-black w-full mt-60 rounded-lg shadow-2xl">
    <div class="container mx-auto px-8 sm:px-10 lg:px-16">
        <!-- Título de la sección -->
        <div class="text-center mb-16">
            <h2 class="text-5xl font-bold text-amber-500 mb-4">Sobre Nosotros</h2>
            <p class="text-gray-300 text-xl">Tradición y excelencia en barbería desde 1998</p>
        </div>

        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <!-- Columna de imágenes -->
            <div class="relative w-full h-auto space-y-4 lg:space-y-8">
                <!-- Imagen principal -->
                <div class="relative overflow-hidden rounded-2xl shadow-2xl transform hover:scale-105 transition-transform duration-500">
                    <img src="/build/img/barberia2.jpg" alt="Barbería" class="w-full h-auto object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                </div>
                
                <!-- Grid de estadísticas -->
                <div class="grid grid-cols-3 gap-4 mt-8">
                    <div class="bg-gray-800/50 backdrop-blur-sm p-6 rounded-xl text-center transform hover:scale-105 transition-all duration-300">
                        <span class="text-amber-500 text-3xl font-bold block">25+</span>
                        <span class="text-gray-300 text-sm">Años de<br>Experiencia</span>
                    </div>
                    <div class="bg-gray-800/50 backdrop-blur-sm p-6 rounded-xl text-center transform hover:scale-105 transition-all duration-300">
                        <span class="text-amber-500 text-3xl font-bold block">5000+</span>
                        <span class="text-gray-300 text-sm">Clientes<br>Satisfechos</span>
                    </div>
                    <div class="bg-gray-800/50 backdrop-blur-sm p-6 rounded-xl text-center transform hover:scale-105 transition-all duration-300">
                        <span class="text-amber-500 text-3xl font-bold block">4.9</span>
                        <span class="text-gray-300 text-sm">Calificación<br>Promedio</span>
                    </div>
                </div>
            </div>

            <!-- Columna de texto -->
            <div class="flex flex-col space-y-8">
                <div class="space-y-6">
                    <!-- Misión -->
                    <div class="bg-gray-800/30 backdrop-blur-sm p-6 rounded-xl transform hover:scale-105 transition-all duration-300">
                        <h3 class="text-2xl font-bold text-amber-500 mb-4 flex items-center">
                            <i class="fa-solid fa-bullseye mr-3"></i>
                            Nuestra Misión
                        </h3>
                        <p class="text-gray-300 leading-relaxed">
                            Brindar servicios de barbería excepcionales que no solo mejoren la apariencia de nuestros clientes, sino que también eleven su confianza y bienestar personal.
                        </p>
                    </div>

                    <!-- Visión -->
                    <div class="bg-gray-800/30 backdrop-blur-sm p-6 rounded-xl transform hover:scale-105 transition-all duration-300">
                        <h3 class="text-2xl font-bold text-amber-500 mb-4 flex items-center">
                            <i class="fa-solid fa-eye mr-3"></i>
                            Nuestra Visión
                        </h3>
                        <p class="text-gray-300 leading-relaxed">
                            Ser reconocidos como la barbería líder en innovación y calidad, estableciendo nuevos estándares en el cuidado personal masculino.
                        </p>
                    </div>

                    <!-- Valores -->
                    <div class="bg-gray-800/30 backdrop-blur-sm p-6 rounded-xl transform hover:scale-105 transition-all duration-300">
                        <h3 class="text-2xl font-bold text-amber-500 mb-4 flex items-center">
                            <i class="fa-solid fa-star mr-3"></i>
                            Nuestros Valores
                        </h3>
                        <ul class="text-gray-300 grid grid-cols-2 gap-4">
                            <li class="flex items-center">
                                <i class="fa-solid fa-check text-amber-500 mr-2"></i>
                                Excelencia
                            </li>
                            <li class="flex items-center">
                                <i class="fa-solid fa-check text-amber-500 mr-2"></i>
                                Profesionalismo
                            </li>
                            <li class="flex items-center">
                                <i class="fa-solid fa-check text-amber-500 mr-2"></i>
                                Innovación
                            </li>
                            <li class="flex items-center">
                                <i class="fa-solid fa-check text-amber-500 mr-2"></i>
                                Compromiso
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Botón de acción -->
                <div class="text-center lg:text-left">
                    <a href="#seccionContacto" 
                       class="inline-flex items-center px-8 py-3 bg-amber-500 text-black rounded-full font-semibold hover:bg-amber-400 transition-colors duration-300 transform hover:scale-105">
                        <i class="fa-solid fa-calendar-check mr-2"></i>
                        Agenda tu Cita
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Script para animaciones -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    entry.target.classList.remove('opacity-0', 'translate-y-10');
                }
            });
        }, {
            threshold: 0.1
        });

        // Observar todos los elementos animables
        document.querySelectorAll('#seccionNosotros .transform').forEach(el => {
            el.classList.add('opacity-0', 'translate-y-10', 'transition-all', 'duration-700');
            observer.observe(el);
        });
    });
</script>

<!-- Sección de Precios -->
<section id="seccionPrecios" class="py-24 bg-gradient-to-br from-gray-900 to-black rounded-lg mt-12">
    <div class="container mx-auto px-8 sm:px-10 lg:px-16 text-center">
        <h2 class="text-5xl font-bold text-amber-500 mb-4 opacity-0 transform translate-y-4 transition-all duration-700" data-animate>Nuestros Precios</h2>
        <p class="text-gray-300 text-xl mb-16 opacity-0 transform translate-y-4 transition-all duration-700 delay-100" data-animate>Descubre nuestros servicios premium diseñados para ti</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Tarjeta de Servicio 1 -->
            <div class="relative group opacity-0 transform translate-y-8 transition-all duration-700 delay-200 hover:-translate-y-2" data-animate>
                <div class="absolute inset-0 bg-amber-500 rounded-lg blur opacity-0 group-hover:opacity-40 transition-all duration-500"></div>
                <div class="relative rounded-lg overflow-hidden backdrop-blur-sm bg-black/40 border border-gray-700 group-hover:border-amber-500 transition-all duration-500 ease-out transform">
                    <div class="p-8">
                        <div class="h-16 w-16 bg-amber-500/10 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-shower text-2xl text-amber-500"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-white mb-6">Lavado de Cabello</h3>
                        <ul class="space-y-4 mb-8">
                            <li id="precioLavado1" class="flex justify-between text-gray-300">
                                <span>Lavado Básico</span>
                                <span class="font-bold text-amber-500">$10.000</span>
                            </li>
                            <li id="precioLavado2" class="flex justify-between text-gray-300">
                                <span>Lavado y Masaje</span>
                                <span class="font-bold text-amber-500">$15.000</span>
                            </li>
                            <li id="precioLavado3" class="flex justify-between text-gray-300">
                                <span>Hidratante</span>
                                <span class="font-bold text-amber-500">$20.000</span>
                            </li>
                            <li id="precioLavado4" class="flex justify-between text-gray-300">
                                <span>Lavado y Estilo</span>
                                <span class="font-bold text-amber-500">$18.000</span>
                            </li>
                        </ul>
                        <a href="/login" class="inline-flex items-center justify-center w-full px-6 py-3 bg-amber-500 text-black rounded-full font-semibold hover:bg-amber-400 transition-colors group-hover:scale-105 duration-300">
                            <i class="fas fa-calendar-check mr-2"></i>
                            Agendar Cita
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Servicio 2 -->
            <div class="relative group opacity-0 transform translate-y-8 transition-all duration-700 delay-300 hover:-translate-y-2" data-animate>
                <div class="absolute inset-0 bg-amber-500 rounded-lg blur opacity-0 group-hover:opacity-40 transition-all duration-500"></div>
                <div class="relative rounded-lg overflow-hidden backdrop-blur-sm bg-black/40 border border-gray-700 group-hover:border-amber-500 transition-all duration-500 ease-out transform">
                    <div class="absolute top-0 right-0 bg-amber-500 text-black px-4 py-1 rounded-bl-lg font-semibold">
                        Más Popular
                    </div>
                    <div class="p-8">
                        <div class="h-16 w-16 bg-amber-500/10 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-cut text-2xl text-amber-500"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-white mb-6">Corte de Cabello</h3>
                        <ul class="space-y-4 mb-8">
                            <li id="precioCorte1" class="flex justify-between text-gray-300">
                                <span>Corte Clásico</span>
                                <span class="font-bold text-amber-500">$20.000</span>
                            </li>
                            <li id="precioCorte2" class="flex justify-between text-gray-300">
                                <span>Corte Moderno</span>
                                <span class="font-bold text-amber-500">$25.000</span>
                            </li>
                            <li id="precioCorte3" class="flex justify-between text-gray-300">
                                <span>Corte con Diseño</span>
                                <span class="font-bold text-amber-500">$30.000</span>
                            </li>
                            <li id="precioCorte4" class="flex justify-between text-gray-300">
                                <span>Recorte y Estilo</span>
                                <span class="font-bold text-amber-500">$22.000</span>
                            </li>
                        </ul>
                        <a href="/login" class="inline-flex items-center justify-center w-full px-6 py-3 bg-amber-500 text-black rounded-full font-semibold hover:bg-amber-400 transition-colors group-hover:scale-105 duration-300">
                            <i class="fas fa-calendar-check mr-2"></i>
                            Agendar Cita
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Servicio 3 -->
            <div class="relative group opacity-0 transform translate-y-8 transition-all duration-700 delay-400 hover:-translate-y-2" data-animate>
                <div class="absolute inset-0 bg-amber-500 rounded-lg blur opacity-0 group-hover:opacity-40 transition-all duration-500"></div>
                <div class="relative rounded-lg overflow-hidden backdrop-blur-sm bg-black/40 border border-gray-700 group-hover:border-amber-500 transition-all duration-500 ease-out transform">
                    <div class="p-8">
                        <div class="h-16 w-16 bg-amber-500/10 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fa-solid fa-wand-magic-sparkles text-2xl text-amber-500"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-white mb-6">Recorte de Barba</h3>
                        <ul class="space-y-4 mb-8">
                            <li id="precioBarba1" class="flex justify-between text-gray-300">
                                <span>Recorte Básico</span>
                                <span class="font-bold text-amber-500">$12.000</span>
                            </li>
                            <li id="precioBarba2" class="flex justify-between text-gray-300">
                                <span>Recorte Full</span>
                                <span class="font-bold text-amber-500">$15.000</span>
                            </li>
                            <li id="precioBarba3" class="flex justify-between text-gray-300">
                                <span>Afeitado Clásico</span>
                                <span class="font-bold text-amber-500">$18.000</span>
                            </li>
                            <li id="precioBarba4" class="flex justify-between text-gray-300">
                                <span>Estilo de Barba</span>
                                <span class="font-bold text-amber-500">$20.000</span>
                            </li>
                        </ul>
                        <a href="/login" class="inline-flex items-center justify-center w-full px-6 py-3 bg-amber-500 text-black rounded-full font-semibold hover:bg-amber-400 transition-colors group-hover:scale-105 duration-300">
                            <i class="fas fa-calendar-check mr-2"></i>
                            Agendar Cita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Script para las animaciones -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.remove('opacity-0', 'translate-y-4', 'translate-y-8');
                entry.target.classList.add('opacity-100', 'translate-y-0');
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    // Observar todos los elementos con data-animate
    document.querySelectorAll('[data-animate]').forEach(element => {
        observer.observe(element);
    });
});
</script>

<!-- Sección de Testimonios -->
<section id="testimonials" class="py-24 bg-gray-900 text-white mt-12 rounded-lg">
    <div class="container mx-auto px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-amber-500 mb-4">Testimonios</h2>
            <p class="text-gray-400 text-lg">Lo que dicen nuestros clientes sobre nosotros</p>
        </div>
        <!-- Contenedor del carrusel -->
        <div class="relative overflow-hidden rounded-lg shadow-lg">
            <div id="testimonialSlider" class="flex overflow-hidden scroll-smooth snap-x snap-mandatory">
                <!-- Tarjeta de testimonio -->
                <div class="flex-none w-full md:w-1/3 bg-gray-800 rounded-lg p-6 mx-2 snap-center testimonial-card">
                    <p class="text-gray-300 italic mb-4">"El mejor servicio que he recibido. Definitivamente volveré. El personal es muy profesional y atento."</p>
                    <h3 class="text-lg font-bold text-amber-500">John Doe</h3>
                </div>
                <div class="flex-none w-full md:w-1/3 bg-gray-800 rounded-lg p-6 mx-2 snap-center testimonial-card">
                    <p class="text-gray-300 italic mb-4">"Excelente ambiente y atención al detalle. Recomendado para cualquiera que busque un cambio de estilo."</p>
                    <h3 class="text-lg font-bold text-amber-500">Jane Smith</h3>
                </div>
                <div class="flex-none w-full md:w-1/3 bg-gray-800 rounded-lg p-6 mx-2 snap-center testimonial-card">
                    <p class="text-gray-300 italic mb-4">"Un lugar increíble, el servicio es de primera y los resultados siempre superan mis expectativas."</p>
                    <h3 class="text-lg font-bold text-amber-500">Alex Brown</h3>
                </div>
                <div class="flex-none w-full md:w-1/3 bg-gray-800 rounded-lg p-6 mx-2 snap-center testimonial-card">
                    <p class="text-gray-300 italic mb-4">"Un lugar increíble, el servicio es de primera y los resultados siempre superan mis expectativas."</p>
                    <h3 class="text-lg font-bold text-amber-500">Nicola Montero</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript para animación del carrusel -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('testimonialSlider');
    const testimonialCards = document.querySelectorAll('.testimonial-card');
    const cardWidth = testimonialCards[0].offsetWidth + 16; // Ajuste por margen/padding
    let currentPosition = 0;

    // Clonar los elementos para crear la ilusión de bucle infinito
    testimonialCards.forEach(card => {
        const clone = card.cloneNode(true);
        slider.appendChild(clone);
    });

    // Función para mover el carrusel de manera continua
    function animateSlider() {
        currentPosition += 0.8; // Velocidad de desplazamiento, ajustable
        slider.scrollLeft = currentPosition;

        // Clonar el primer elemento al final si se alcanza el último clon visible
        if (currentPosition >= slider.scrollWidth - slider.offsetWidth) {
            currentPosition = 0; // Reiniciar la posición al principio para mantener el desplazamiento continuo
        }

        requestAnimationFrame(animateSlider);
    }

    // Iniciar la animación
    animateSlider();
});
</script>



<!-- Sección de Contacto -->
<section id="seccionContacto" class="text-gray-900 body-font relative rounded-lg ">
<div class="absolute inset-0 bg-gray-100 rounded-lg" bis_skin_checked="1">
    <iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" title="map" scrolling="no" src="https://maps.google.com/maps?width=100%&height=600&hl=en&q=INACAP+Puente+Alto+(My%20Business%20Name)&ie=UTF8&t=&z=14&iwloc=B&output=embed" style="filter: grayscale(1) contrast(1.2) opacity(0.6);"></iframe>
  </div>
  <div class="container px-5 py-24 mx-auto flex mt-12 rounded-lg" bis_skin_checked="1">
    <div class="lg:w-1/3 md:w-1/2 bg-white rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0 relative z-10 shadow-md" bis_skin_checked="1">
      <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">Contactanos!</h2>
      <p class="leading-relaxed mb-5 text-gray-600">Post-ironic portland shabby chic echo park, banjo fashion axe</p>
      <div class="relative mb-4" bis_skin_checked="1">
        <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
        <input type="email" id="email" name="email" class="w-full bg-white rounded border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
      </div>
      <div class="relative mb-4" bis_skin_checked="1">
        <label for="message" class="leading-7 text-sm text-gray-600">Mensaje</label>
        <textarea id="message" name="message" class="w-full bg-white rounded border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
      </div>
      <button class="text-white bg-yellow-500 border-0 py-2 px-6 focus:outline-none hover:bg-yellow-600 rounded text-lg">Enviar</button>
      <p class="text-xs text-gray-500 mt-3">Chicharrones blog helvetica normcore iceland tousled brook viral artisan.</p>
    </div>
  </div>
</section>

      </div>
    </div>
  </div>

  <footer class="bg-gray-900 text-white pt-12 pb-8 px-4 relative mt-20">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
        <!-- Sección Logo y Descripción -->
        <div class="lg:col-span-2">
            <div class="flex items-center mb-6">
                <img src="/build/img/logo.svg" alt="logo_barberia" class="h-12">
                <span class="ml-3 text-2xl font-bold text-amber-500">Elite Barbershop</span>
            </div>
            <p class="text-gray-400 mb-6">
                Expertos en el arte del cuidado masculino. Ofrecemos servicios de primera calidad para que luzcas tu mejor versión.
            </p>
            <div class="flex space-x-4">
                <a href="/" class="bg-white/10 hover:bg-amber-500 p-2 rounded-full transition-colors duration-300">
                    <i class="fa-brands fa-whatsapp text-xl"></i>
                </a>
                <a href="/" class="bg-white/10 hover:bg-amber-500 p-2 rounded-full transition-colors duration-300">
                    <i class="fa-brands fa-instagram text-xl"></i>
                </a>
                <a href="/" class="bg-white/10 hover:bg-amber-500 p-2 rounded-full transition-colors duration-300">
                    <i class="fa-brands fa-facebook text-xl"></i>
                </a>
            </div>
        </div>

        <!-- Sección Contacto -->
        <div>
            <h3 class="text-lg font-bold text-amber-500 mb-6">Contacto</h3>
            <ul class="space-y-4">
                <li class="flex items-center">
                    <i class="fa-solid fa-phone text-amber-500 mr-3"></i>
                    <a href="tel:850-123-5021" class="text-gray-400 hover:text-amber-500 transition-colors">
                        850-123-5021
                    </a>
                </li>
                <li class="flex items-center">
                    <i class="fa-solid fa-envelope text-amber-500 mr-3"></i>
                    <a href="mailto:info@styloreserva.com" class="text-gray-400 hover:text-amber-500 transition-colors">
                        info@styloreserva.com
                    </a>
                </li>
                <li class="flex items-start">
                    <i class="fa-solid fa-location-dot text-amber-500 mr-3 mt-1"></i>
                    <a href="https://goo.gl/maps/..." target="_blank" class="text-gray-400 hover:text-amber-500 transition-colors">
                        Av. Concha y Toro 2730,<br>8150215 Puente Alto
                    </a>
                </li>
            </ul>
        </div>

        <!-- Sección Enlaces Rápidos -->
        <div>
            <h3 class="text-lg font-bold text-amber-500 mb-6">Enlaces Rápidos</h3>
            <ul class="space-y-4">
                <li>
                    <a href="/" class="text-gray-400 hover:text-amber-500 transition-colors flex items-center">
                        <i class="fa-solid fa-chevron-right text-xs mr-2"></i>
                        Servicios
                    </a>
                </li>
                <li>
                    <a href="/" class="text-gray-400 hover:text-amber-500 transition-colors flex items-center">
                        <i class="fa-solid fa-chevron-right text-xs mr-2"></i>
                        Reservar Cita
                    </a>
                </li>
                <li>
                    <a href="/" class="text-gray-400 hover:text-amber-500 transition-colors flex items-center">
                        <i class="fa-solid fa-chevron-right text-xs mr-2"></i>
                        Política de Privacidad
                    </a>
                </li>
                <li>
                    <a href="/" class="text-gray-400 hover:text-amber-500 transition-colors flex items-center">
                        <i class="fa-solid fa-chevron-right text-xs mr-2"></i>
                        Términos y Condiciones
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Línea divisoria -->
    <div class="max-w-7xl mx-auto border-t border-gray-800 mt-12 pt-8">
        <p class="text-center text-gray-400 text-sm">
            © 2024 Elite Barbershop. Todos los derechos reservados.
        </p>
    </div>
  </footer>
</body>
