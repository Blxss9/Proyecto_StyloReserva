<!-- HEADER LANDING -->
<nav class="bg-black/20 fixed w-full z-20 top-0 start-0">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="build/img/logo.svg" class="h-20 w-20" alt="Elite BarberShop Logo" />
      <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Elite BarberShop</span>
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-white rounded-lg md:hidden hover:bg-black/10 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
      </svg>
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 bg-black/90 border border-gray-700 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-transparent">
        <li>
          <a href="#" class="block py-2 px-3 text-white rounded md:p-0 hover:text-blue-500 font-bold" aria-current="page">Inicio</a>
        </li>
        <li>
          <a href="#" class="block py-2 px-3 text-white rounded md:p-0 hover:text-blue-500 font-bold">Servicios</a>
        </li>
        <li>
          <a href="#" class="block py-2 px-3 text-white rounded md:p-0 hover:text-blue-500 font-bold">Nosotros</a>
        </li>
        <li>
          <a href="#" class="block py-2 px-3 text-white rounded md:p-0 hover:text-blue-500 font-bold">Contacto</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- HERO SECTION -->
<section class="relative bg-cover bg-center min-h-screen" style="background-image: url('https://barberiacapital.mx/cdn/shop/articles/Barberia_2018_Monterrey_003.jpg?v=1672800428&width=2048');">
  <!-- Overlay -->
  <div class="absolute inset-0 bg-black opacity-50"></div>

  <!-- Hero Content -->
  <div class="relative z-10 flex flex-col items-center justify-center text-center text-white min-h-screen p-6">
    <h1 class="text-4xl md:text-6xl font-bold mb-4">Bienvenido a Elite BarberShop</h1>
    <p class="text-lg md:text-2xl mb-6">Donde tu estilo es nuestra prioridad</p>
    <a href="#" class="bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded-lg py-3 px-8">Agendar Cita</a>
  </div>
</section>
<!-- SERVICES SECTION -->
<section class="py-16 bg-gray-100">
  <div class="max-w-screen-xl mx-auto px-4 text-center">
    <h2 class="text-3xl md:text-5xl font-bold text-gray-800 mb-8">Nuestros Servicios</h2>
    <p class="text-lg md:text-xl text-gray-600 mb-12">Descubre nuestros servicios de alta calidad para realzar tu estilo personal.</p>

    <div class="grid gap-8 md:grid-cols-3">
      <!-- Service 1 -->
      <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <div class="flex items-center justify-center mb-4">
          <img src="https://img.icons8.com/ios-glyphs/50/000000/barbershop.png" alt="Corte de Cabello" class="h-12 w-12"/>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Corte de Cabello</h3>
        <p class="text-gray-600">Cortes modernos y clásicos para todos los estilos, hechos por nuestros barberos expertos.</p>
      </div>

      <!-- Service 2 -->
      <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <div class="flex items-center justify-center mb-4">
          <img src="https://img.icons8.com/ios-glyphs/50/000000/razor.png" alt="Afeitado Clásico" class="h-12 w-12"/>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Afeitado Clásico</h3>
        <p class="text-gray-600">Experimenta un afeitado de calidad con toallas calientes y productos de alta gama.</p>
      </div>

      <!-- Service 3 -->
      <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <div class="flex items-center justify-center mb-4">
          <img src="https://img.icons8.com/ios-glyphs/50/000000/hair-brush.png" alt="Estilizado" class="h-12 w-12"/>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Estilizado</h3>
        <p class="text-gray-600">Peinados personalizados y asesoría para un look perfecto para cualquier ocasión.</p>
      </div>
    </div>
  </div>
</section>

