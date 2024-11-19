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
                <span class="ml-3 text-2xl font-bold text-amber-500">StyloReserva</span>
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
            © 2024 StyloReserva. Todos los derechos reservados.
        </p>
    </div>
  </footer>
</body>
