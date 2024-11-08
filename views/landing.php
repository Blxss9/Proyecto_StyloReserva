<body class="bg-gray-900 text-white">

  <!-- Navbar -->
  <nav class="bg-black/90 fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20">
        <!-- Logo -->
        <div class="flex-shrink-0 flex items-center">
          <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5V19.5M4.5 12H19.5" />
          </svg>
          <span class="ml-2 text-white text-xl font-bold">Barbería Elite</span>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:block">
          <div class="ml-10 flex items-center space-x-8">
            <a href="#" class="text-white hover:text-amber-500 transition-colors">Inicio</a>
            <a href="#" class="text-white hover:text-amber-500 transition-colors">Servicios</a>
            <a href="#" class="text-white hover:text-amber-500 transition-colors">Nosotros</a>
            <a href="#" class="text-white hover:text-amber-500 transition-colors">Contacto</a>
          </div>
        </div>

        <!-- Social Icons -->
        <div class="hidden md:flex items-center space-x-4">
          <a href="#" class="text-white hover:text-blue-500 transition-colors">
            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
          </a>
          <!-- Add other social icons as needed -->
        </div>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <div class="relative min-h-screen">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('https://images.unsplash.com/photo-1503951914875-452162b0f3f1?auto=format&fit=crop&q=80');">
      <div class="absolute inset-0 bg-black/60"></div>
    </div>

    <!-- Content -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-12 min-h-screen flex items-center">
      <div class="max-w-2xl">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
          Estilo y Elegancia para el<br>
          <span class="text-amber-500">Caballero Moderno</span>
        </h1>
        <p class="text-gray-300 text-lg mb-8">
          Expertos en cortes clásicos y modernos. Nuestra barbería combina técnicas tradicionales con las últimas tendencias para crear tu estilo perfecto.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 mb-12">
          <button class="bg-amber-500 text-black px-8 py-3 rounded-full font-semibold hover:bg-amber-400 transition-colors duration-300 flex items-center justify-center">
            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m0 0h8m-8 4h8M6 11V7m12 4V7m0 4h.01M6 15V11m0 0h12m-6 8V11m6 0h-.01" />
            </svg>
            Reservar Cita
          </button>
          <button class="border-2 border-amber-500 text-white px-8 py-3 rounded-full font-semibold hover:bg-amber-500/10 transition-colors duration-300 flex items-center justify-center">
            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c0-1.105 1.121-2 2.5-2h3c1.38 0 2.5.895 2.5 2v3c0 1.105-.895 2-2 2s-2.5-.895-2.5-2v-1.5" />
            </svg>
            Ver Horarios
          </button>
        </div>

        <div class="flex items-center space-x-6">
          <div class="text-white">
            <p class="text-3xl font-bold">10+</p>
            <p class="text-sm text-gray-400">Años de<br>Experiencia</p>
          </div>
          <div class="h-12 w-px bg-gray-700"></div>
          <div class="text-white">
            <p class="text-3xl font-bold">5000+</p>
            <p class="text-sm text-gray-400">Clientes<br>Satisfechos</p>
          </div>
          <div class="h-12 w-px bg-gray-700"></div>
          <div class="text-white">
            <p class="text-3xl font-bold">4.9</p>
            <p class="text-sm text-gray-400">Calificación<br>Promedio</p>
          </div>
        </div>
      </div>
    </div>
  </div>