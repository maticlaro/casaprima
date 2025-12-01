<header class="relative border-b-2 border-[#e3e3e0] mb-8">
    <div class="container  mx-auto lg:flex lg:items-center lg:justify-between">
        <!-- Logo -->
        <div class="flex items-center justify-between">
          <a class="flex items-center" href="/">
              <img src="{{ asset('images/logo_left-icon.png') }}" alt="Casaprima Logo"
                class="mx-1 object-cover object-center"
                style="height:170px; width:495px; border-radius:0; overflow:hidden;">
          </a>
        </div>
        <!-- Navigation -->
        <nav class="hidden md:flex space-x-8 flex-1 justify-center">
            <a href="/servicios" class="text-[#333333] font-medium hover:text-[#B28A5B] transition">Servicios</a>
            <a href="#como-funciona" class="text-[#333333] font-medium hover:text-[#B28A5B] transition">Cómo Funciona</a>
            <a href="#planes" class="text-[#333333] font-medium hover:text-[#B28A5B] transition">Planes Anuales</a>
            <a href="#nosotros" class="text-[#333333] font-medium hover:text-[#B28A5B] transition">Nosotros</a>
            <a href="#blog" class="text-[#333333] font-medium hover:text-[#B28A5B] transition">Blog</a>
        </nav>
        <!-- Actions -->
        <div class="hidden md:flex flex items-center space-x-3">
            @auth
                <a href="/admin" class="bg-[#B28A5B] text-white px-4 py-2 rounded-md font-medium shadow hover:bg-[#a07a4e] transition">Mi Portal</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="border border-[#1C2B4B] text-[#1C2B4B] px-4 py-2 rounded-md font-medium hover:bg-[#1C2B4B] hover:text-white transition">
                        Cerrar Sesión
                    </button>
                </form>
            @else
                <a href="/admin" class="border border-[#1C2B4B] text-[#1C2B4B] px-4 py-2 rounded-md font-medium hover:bg-[#1C2B4B] hover:text-white transition">Acceso Clientes</a>
                <a href="/admin" class="border border-[#1C2B4B] text-[#1C2B4B] px-4 py-2 rounded-md font-medium hover:bg-[#1C2B4B] hover:text-white transition">Registrarme</a>
            @endauth
            
            <a href="/servicios" class="bg-[#B28A5B] text-white px-4 py-2 rounded-md font-medium shadow hover:bg-[#a07a4e] transition">Agendar Servicio</a>
        </div>
        <!-- Mobile Nav Toggle -->
        <div class="md:hidden flex items-center">
            <button x-data="{ open: false }" @click="open = !open" class="focus:outline-none">
                <svg class="w-7 h-7 text-[#B28A5B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
    <!-- Mobile Menu (hidden by default) -->
    <div class="md:hidden" x-show="open" x-transition>
        <nav class="px-4 pt-2 pb-4 space-y-2 bg-[#FAF8F5] border-t border-[#e3e3e0]">
            <a href="#servicios" class="block text-[#333333] font-medium py-2">Servicios</a>
            <a href="#como-funciona" class="block text-[#333333] font-medium py-2">Cómo Funciona</a>
            <a href="#planes" class="block text-[#333333] font-medium py-2">Planes Anuales</a>
            <a href="#nosotros" class="block text-[#333333] font-medium py-2">Nosotros</a>
            <a href="#blog" class="block text-[#333333] font-medium py-2">Blog</a>
            <a href="/login" class="block border border-[#1C2B4B] text-[#1C2B4B] px-4 py-2 rounded-md font-medium mt-2">Acceso Clientes</a>
            <a href="#agendar" class="block bg-[#B28A5B] text-white px-4 py-2 rounded-md font-medium mt-2">Agendar Servicio</a>
        </nav>
    </div>
</header>
