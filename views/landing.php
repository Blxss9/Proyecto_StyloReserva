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

          <span class="ml-2 text-white text-xl font-bold">Stylo Reserva</span>
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
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-12 min-h-screen flex items-center">
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
        <p class="text-gray-300 text-base mt-16 sm:text-lg mb-8 sm:mb-10">
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
                    <li>Sábado: 9:00 AM - 6:00 PM</li>
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
      

        <!-- Sección de Servicios -->
<section id="seccionServicios"  class="py-24 mt-64 bg-white w-full rounded-lg">
    <div class="container mx-auto px-8 sm:px-10 lg:px-16">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-amber-500 mb-4">Nuestros Servicios</h2>
            <p class="text-gray-600 text-lg">Conoce los servicios que ofrecemos para tu cuidado personal.</p>
        </div>
        <!-- Contenedor del slider con bordes curvos -->
        <div class="relative overflow-hidden rounded-lg shadow-lg flex justify-center">
            <div class="flex overflow-x-auto scroll-smooth snap-x snap-mandatory max-w-4xl" id="serviceSlider">
                <!-- Tarjeta de servicio -->
                <div class="flex-none w-80 bg-gray-100 rounded-lg shadow-lg p-6 m-2 snap-center service-card">
                    <div class="text-center mb-4">
                        <i class="fa-solid fa-cut text-amber-500 text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Tratamiento Capilar</h3>
                    <p class="text-gray-600 text-center">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                </div>
                <!-- Repite esta estructura para más servicios -->
                <div class="flex-none w-80 bg-gray-100 rounded-lg shadow-lg p-6 m-2 snap-center service-card">
                    <div class="text-center mb-4">
                        <i class="fa-solid fa-diamond text-amber-500 text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Coloración Capilar</h3>
                    <p class="text-gray-600 text-center">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                </div>
                <div class="flex-none w-80 bg-gray-100 rounded-lg shadow-lg p-6 m-2 snap-center service-card">
                    <div class="text-center mb-4">
                        <i class="fa-solid fa-diamond text-amber-500 text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Degradados</h3>
                    <p class="text-gray-600 text-center">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                </div>
                <div class="flex-none w-80 bg-gray-100 rounded-lg shadow-lg p-6 m-2 snap-center service-card">
                    <div class="text-center mb-4">
                        <i class="fa-solid fa-diamond text-amber-500 text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Corte barba</h3>
                    <p class="text-gray-600 text-center">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                </div>
                <div class="flex-none w-80 bg-gray-100 rounded-lg shadow-lg p-6 m-2 snap-center service-card">
                    <div class="text-center mb-4">
                        <i class="fa-solid fa-scissors text-amber-500 text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Corte de Cabello</h3>
                    <p class="text-gray-600 text-center">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                </div>
            </div>
            <!-- Flecha Izquierda -->
            <button id="prevSlide" class="absolute top-1/2 transform -translate-y-1/2 left-2 bg-gray-200 rounded-full p-2 shadow hover:bg-gray-300">
                <i class="fa-solid fa-chevron-left text-gray-600"></i>
            </button>
            <!-- Flecha Derecha -->
            <button id="nextSlide" class="absolute top-1/2 transform -translate-y-1/2 right-2 bg-gray-200 rounded-full p-2 shadow hover:bg-gray-300">
                <i class="fa-solid fa-chevron-right text-gray-600"></i>
            </button>
        </div>
    </div>
</section>

<!-- Estilos adicionales -->
<style>
    #serviceSlider::-webkit-scrollbar {
        display: none; /* Ocultar la barra de desplazamiento */
    }
</style>

<!-- Script para flechas de navegación en bucle -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('serviceSlider');
    const serviceCards = document.querySelectorAll('.service-card');
    const nextButton = document.getElementById('nextSlide');
    const prevButton = document.getElementById('prevSlide');
    let currentIndex = 0;
    const cardWidth = serviceCards[0].offsetWidth + 16; // Ajuste por margen/padding

    // Función para mover el slider
    function moveSlider(index) {
        slider.scrollTo({
            left: index * cardWidth,
            behavior: 'smooth'
        });
    }

    // Navegación con botones
    nextButton.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % serviceCards.length;
        moveSlider(currentIndex);
    });

    prevButton.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + serviceCards.length) % serviceCards.length;
        moveSlider(currentIndex);
    });

    // Animación automática
    setInterval(() => {
        currentIndex = (currentIndex + 1) % serviceCards.length;
        moveSlider(currentIndex);
    }, 3000); // Intervalo de 3 segundos para la animación automática
});

</script>



<!-- Sección Nosotros -->
<section id="seccionNosotros" class="py-24 bg-gray-100 w-full mt-12 rounded-lg shadow-lg">
    <div class="container mx-auto px-8 sm:px-10 lg:px-16">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <!-- Imagen con overlay de video -->
            <div class="relative w-full h-auto flex justify-center lg:justify-start">
                <img src="/build/img/barberia2.jpg" alt="Barbería" class="rounded-lg shadow-lg w-3/4 lg:w-full">
            </div>
            <!-- Texto -->
            <div class="flex flex-col justify-center">
                <h2 class="text-4xl font-bold text-amber-500 mb-6">Sobre Nosotros</h2>
                <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                    En Barbería Elite, llevamos 25 años perfeccionando el arte del cuidado masculino. Nuestro compromiso es ofrecer un servicio de excelencia que combine tradición y modernidad, asegurando que cada cliente viva una experiencia única.
                </p>
                <a href="#contact" class="bg-amber-500 text-white py-3 px-8 rounded-full font-semibold hover:bg-amber-600 transition-colors">Contáctanos</a>
            </div>
        </div>
    </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const seccionNosotros = document.getElementById('seccionNosotros');
        
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                  seccionNosotros.classList.remove('opacity-0', 'translate-y-10');
                  seccionNosotros.classList.add('opacity-100', 'translate-y-0');
                }
            });
        }, {
            threshold: 0.1 // Se activa cuando el 10% de la sección es visible
        });

        observer.observe(seccionNosotros);
    });
</script>

<!-- Sección de Precios -->
<section id="seccionPrecios" class="py-24 bg-white rounded-lg mt-12">
    <div class="container mx-auto px-8 sm:px-10 lg:px-16 text-center">
        <h2 class="text-4xl font-bold text-amber-600 mb-4">Nuestros Precios</h2>
        <p class="text-gray-600 text-lg mb-12">Descubre nuestros servicios y tarifas exclusivas para ...</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <!-- Tarjeta de Servicio 1 -->
            <div class="relative rounded-lg shadow-lg overflow-hidden bg-cover bg-center p-6" style="background-image: url('/build/img/hair-wash.jpg');">
                <div class="absolute inset-0 bg-black opacity-70"></div>
                <div class="relative z-10 text-center text-white">
                    <h3 class="text-3xl font-bold mb-4">Lavado de Cabello</h3>
                    <hr class="border-gray-500 mb-4">
                    <ul class="space-y-2 mb-6">
                        <li id="precioLavado1" class="flex justify-between"><span>Lavado Básico</span><span>$10</span></li>
                        <li id="precioLavado2" class="flex justify-between"><span>Lavado y Masaje</span><span>$15</span></li>
                        <li id="precioLavado3" class="flex justify-between"><span>Hidratante </span><span>$20</span></li>
                        <li id="precioLavado4" class="flex justify-between"><span>Lavado y Estilo</span><span>$18</span></li>
                    </ul>
                    <a href="/login" class="bg-amber-600 text-black px-6 py-2 rounded-full font-semibold hover:bg-amber-700 transition-colors">Agendar Cita</a>
                </div>
            </div>

            <!-- Tarjeta de Servicio 2 -->
            <div class="relative rounded-lg shadow-lg overflow-hidden bg-cover bg-center p-6" style="background-image: url('/build/img/hair-cutting.jpg');">
                <div class="absolute inset-0 bg-black opacity-70"></div>
                <div class="relative z-10 text-center text-white">
                    <h3 class="text-3xl font-bold mb-4">Corte de Cabello</h3>
                    <hr class="border-gray-500 mb-4">
                    <ul class="space-y-2 mb-6">
                        <li id="precioCorte1" class="flex justify-between"><span>Corte Clásico</span><span>$20</span></li>
                        <li id="precioCorte2" class="flex justify-between"><span>Corte Moderno</span><span>$25</span></li>
                        <li id="precioCorte3" class="flex justify-between"><span>Corte con Diseño</span><span>$30</span></li>
                        <li id="precioCorte4" class="flex justify-between"><span>Recorte y Estilo</span><span>$22</span></li>
                    </ul>
                    <a href="/login" class="bg-amber-600 text-black px-6 py-2 rounded-full font-semibold hover:bg-amber-700 transition-colors">Agendar Cita</a>
                </div>
            </div>

            <!-- Tarjeta de Servicio 3 -->
            <div class="relative rounded-lg shadow-lg overflow-hidden bg-cover bg-center p-6" style="background-image: url('/build/img/hair-trimming.jpg');">
                <div class="absolute inset-0 bg-black opacity-70"></div>
                <div class="relative z-10 text-center text-white">
                    <h3 class="text-3xl font-bold mb-4">Recorte de Barba</h3>
                    <hr class="border-gray-500 mb-4">
                    <ul class="space-y-2 mb-6">
                        <li id="precioBarba1" class="flex justify-between"><span>Recorte Básico</span><span>$12</span></li>
                        <li id="precioBarba2" class="flex justify-between"><span>Recorte Full</span><span>$15</span></li>
                        <li id="precioBarba3" class="flex justify-between"><span>Afeitado Clásico</span><span>$18</span></li>
                        <li id="precioBarba4" class="flex justify-between"><span>Estilo de Barba</span><span>$20</span></li>
                    </ul>
                    <a href="/login" class="bg-amber-600 text-black px-6 py-2 rounded-full font-semibold hover:bg-amber-700 transition-colors">Agendar Cita</a>
                </div>
            </div>
        </div>
    </div>
</section>


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
  <div class="absolute inset-0 bg-gray-300 rounded-lg" bis_skin_checked="1">
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

  <footer>
    <div class="px-4 pt-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8">
    <div class="grid gap-10 row-gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
      <div class="sm:col-span-2">
        <a href="/" aria-label="Go home" title="Company" class="inline-flex items-center">
          <svg class="w-8 text-deep-purple-accent-400" viewBox="0 0 24 24" stroke-linejoin="round" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" stroke="currentColor" fill="none">
            <rect x="3" y="1" width="7" height="12"></rect>
            <rect x="3" y="17" width="7" height="6"></rect>
            <rect x="14" y="1" width="7" height="6"></rect>
            <rect x="14" y="11" width="7" height="12"></rect>
          </svg>
          <span class="ml-2 text-xl font-bold tracking-wide text-cyan-700 uppercase">StyloReserva</span>
        </a>
        <div class="mt-6 lg:max-w-sm">
          <p class="text-sm text-slate-100">
            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.
          </p>
          <p class="mt-4 text-sm text-slate-100">
            Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
          </p>
        </div>
      </div>
      <div class="space-y-2 text-sm">
        <p class="text-base font-bold tracking-wide text-slate-100">Contacts</p>
        <div class="flex">
          <p class="mr-1 text-slate-100">Teléfono:</p>
          <a href=" tel: 850-123-5021 "  aria-label="Our phone" title="Our phone" class="text-violet-50 hover:text-violet-400">850-123-5021</a>
        </div>
        <div class="flex">
          <p class="mr-1 text-slate-100">Email:</p>
          <a href=" mailto:info@lorem.mail" aria-label="Our email" title="Our email" class="text-violet-50 hover:text-violet-400">info@lorem.mail</a>
        </div>
        <div class="flex">
          <p class="mr-1 text-slate-100">Dirección:</p>
          <a href="https://www.google.com/maps/place/INACAP+Puente+Alto/@-33.5857476,-70.5836709,17z/data=!3m1!4b1!4m6!3m5!1s0x9662d718a032972d:0x45da5699698e2261!8m2!3d-33.5857476!4d-70.5811013!16s%2Fg%2F11bw6199yw?entry=ttu&g_ep=EgoyMDI0MTEwNi4wIKXMDSoASAFQAw%3D%3D" target="_blank" rel="noopener noreferrer" aria-label="Our address" title="Our address" class="text-violet-50 hover:text-violet-400">
          Av. Concha y Toro 2730, 8150215 Puente Alto.
          </a>
        </div>
      </div>
      <div>
        <span class="text-base font-bold tracking-wide text-slate-100">Social</span>
        <div class="flex items-center mt-1 space-x-3">
          <a href="/" class="text-slate-100 hover:text-sky-400 ">
            <svg viewBox="0 0 24 24" fill="currentColor" class="h-5">
              <path
                d="M24,4.6c-0.9,0.4-1.8,0.7-2.8,0.8c1-0.6,1.8-1.6,2.2-2.7c-1,0.6-2,1-3.1,1.2c-0.9-1-2.2-1.6-3.6-1.6 c-2.7,0-4.9,2.2-4.9,4.9c0,0.4,0,0.8,0.1,1.1C7.7,8.1,4.1,6.1,1.7,3.1C1.2,3.9,1,4.7,1,5.6c0,1.7,0.9,3.2,2.2,4.1 C2.4,9.7,1.6,9.5,1,9.1c0,0,0,0,0,0.1c0,2.4,1.7,4.4,3.9,4.8c-0.4,0.1-0.8,0.2-1.3,0.2c-0.3,0-0.6,0-0.9-0.1c0.6,2,2.4,3.4,4.6,3.4 c-1.7,1.3-3.8,2.1-6.1,2.1c-0.4,0-0.8,0-1.2-0.1c2.2,1.4,4.8,2.2,7.5,2.2c9.1,0,14-7.5,14-14c0-0.2,0-0.4,0-0.6 C22.5,6.4,23.3,5.5,24,4.6z"
              ></path>
            </svg>
          </a>
          <a href="/" class="text-slate-100 hover:text-fuchsia-600">
            <svg viewBox="0 0 30 30" fill="currentColor" class="h-6">
              <circle cx="15" cy="15" r="4"></circle>
              <path
                d="M19.999,3h-10C6.14,3,3,6.141,3,10.001v10C3,23.86,6.141,27,10.001,27h10C23.86,27,27,23.859,27,19.999v-10   C27,6.14,23.859,3,19.999,3z M15,21c-3.309,0-6-2.691-6-6s2.691-6,6-6s6,2.691,6,6S18.309,21,15,21z M22,9c-0.552,0-1-0.448-1-1   c0-0.552,0.448-1,1-1s1,0.448,1,1C23,8.552,22.552,9,22,9z"
              ></path>
            </svg>
          </a>
          <a href="/" class="text-slate-100 hover:text-blue-600 ">
            <svg viewBox="0 0 24 24" fill="currentColor" class="h-5">
              <path
                d="M22,0H2C0.895,0,0,0.895,0,2v20c0,1.105,0.895,2,2,2h11v-9h-3v-4h3V8.413c0-3.1,1.893-4.788,4.659-4.788 c1.325,0,2.463,0.099,2.795,0.143v3.24l-1.918,0.001c-1.504,0-1.795,0.715-1.795,1.763V11h4.44l-1,4h-3.44v9H22c1.105,0,2-0.895,2-2 V2C24,0.895,23.105,0,22,0z"
              ></path>
            </svg>
          </a>
        </div>
        <p class="mt-4 text-sm text-slate-100">
          Bacon ipsum dolor amet short ribs pig sausage prosciutto chicken spare ribs salami.
        </p>
      </div>
    </div>
    <div class="flex flex-col-reverse justify-between pt-5 pb-10 border-t lg:flex-row">
      <p class="text-sm text-slate-100">
        © Copyright 2024 StyloReserva Inc. All rights reserved.
      </p>
      <ul class="flex flex-col mb-3 space-y-2 lg:mb-0 sm:space-y-0 sm:space-x-5 sm:flex-row">
        <li>
          <a href="/" class="text-sm text-slate-100 transition-colors duration-300 hover:text-deep-purple-accent-400">F.A.Q</a>
        </li>
        <li>
          <a href="/" class="text-sm text-slate-100 transition-colors duration-300 hover:text-deep-purple-accent-400">Privacy Policy</a>
        </li>
        <li>
          <a href="/" class="text-sm text-slate-100 transition-colors duration-300 hover:text-deep-purple-accent-400">Terms &amp; Conditions</a>
        </li>
      </ul>
    </div>
    </div>
  </footer>
</body>
