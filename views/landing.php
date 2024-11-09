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

          <span class="ml-2 text-white text-xl font-bold">Barbería Elite</span>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:block">
          <div class="m-2 flex items-center space-x-8 font-bold">
            <a href="#" class="text-white hover:text-amber-500 transition-colors">Inicio</a>
            <a href="#" class="text-white hover:text-amber-500 transition-colors">Servicios</a>
            <a href="#" class="text-white hover:text-amber-500 transition-colors">Nosotros</a>
            <a href="#" class="text-white hover:text-amber-500 transition-colors">Contacto</a>
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
      <div class="max-w-2xl text-center sm:text-left">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 sm:mb-6">
          Estilo y<br>
          <span class="text-amber-500">Elegancia</span>
        </h1>
        <p class="text-gray-300 text-base sm:text-lg mb-6 sm:mb-8">
        El lugar donde tu estilo evoluciona. Con técnicas que unen lo clásico y lo contemporáneo, realzamos tu imagen a otro nivel.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 mb-8 sm:mb-12">
          <button class="bg-amber-500 text-black px-6 sm:px-8 py-3 rounded-full font-semibold hover:bg-amber-400 transition-colors duration-300 flex items-center justify-center">
            <i class="fa-solid fa-calendar-days mr-2"></i>
            Reservar Cita
          </button>
          <button class="border-2 border-amber-500 text-white px-6 sm:px-8 py-3 rounded-full font-semibold hover:bg-amber-500/10 transition-colors duration-300 flex items-center justify-center">
            <i class="fa-regular fa-clock mr-2" style="color: #ffffff;"></i>
            Ver Horarios
          </button>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-center sm:justify-start space-y-2 sm:space-y-0 sm:space-x-6">
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
      </div>
    </div>
  </div>
</body>
