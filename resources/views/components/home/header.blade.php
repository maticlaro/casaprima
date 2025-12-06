<header class="relative mb-8">
    <div class="header-top">
        <div class="container mx-auto lg:flex lg:items-center lg:justify-between">
            <div class="header-top__left">
                <ul class="header-top__left--socials">
                    <li>
                        <a href="#"><img src="{{ asset('images/icon-insta.svg') }}" alt="Instagram Casaprima"></a>
                    </li>
                    <li>
                        <a href="#"><img src="{{ asset('images/icon-face.svg') }}" alt="Facebook Casaprima"></a>
                    </li>
                    <li>
                        <a href="#"><img src="{{ asset('images/icon-tik-tok.svg') }}" alt="Tik Tok Casaprima"></a>
                    </li>
                </ul>
                <ul class="header-top__left--phone">
                    <li>
                        <a href="#">
                            <img src="{{ asset('images/icon-wtsp.svg') }}" alt="Whatsapp Casaprima">
                            <span class="ml-2 text-sm text-[#1C2B4B] font-medium">+56 9 1234 5678</span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img src="{{ asset('images/icon-phone.svg') }}" alt="Whatsapp Casaprima">
                            <span class="ml-2 text-sm text-[#1C2B4B] font-medium">+56 9 1234 5678</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="header-top__right">
                <ul>
                    <li>
                        <a href="/admin">
                            <img src="{{ asset('images/icon-log-in.svg') }}" alt="Iniciar Sesión Casaprima">
                            <span class="ml-2 text-sm text-[#ffffff] font-medium">Iniciar Sesión</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin">
                            <img src="{{ asset('images/icon-user.svg') }}" alt="Crear Cuenta Casaprima">
                            <span class="ml-2 text-sm text-[#ffffff] font-medium">Crear Cuenta</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container middle-header mx-auto lg:flex lg:items-center lg:justify-between">
        <!-- Logo -->
        <div class="flex items-center justify-between">
          <a class="flex items-center" href="/">
              <img src="{{ asset('images/main_logo.svg') }}" alt="Casaprima Logo"
                class="mx-1 object-cover object-center"
                style="height:69px; width:255px; border-radius:0; overflow:hidden;">
          </a>
        </div>
        <div class="search-form">            
            <input 
                type="text" 
                id="service-search" 
                placeholder="Busca el servicio que necesitas" 
                class="border rounded-full px-15 py-3 w-full focus:outline-none focus:ring-2 focus:ring-primary transition duration-200 text-lg"
                oninput="filterServices()"
            >
            <button type="submit">
                <img src="{{ asset('images/icon-search.svg') }}" alt="">
            </button>                            
        </div>        
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
                <!-- <a href="/admin" class="border border-[#1C2B4B] text-[#1C2B4B] px-4 py-2 rounded-md font-medium hover:bg-[#1C2B4B] hover:text-white transition">Acceso Clientes</a>
                <a href="/admin" class="border border-[#1C2B4B] text-[#1C2B4B] px-4 py-2 rounded-md font-medium hover:bg-[#1C2B4B] hover:text-white transition">Registrarme</a> -->
            @endauth
            
            <a href="/servicios" class="btn-agenda">Agenda tu Servicio <img src="{{ asset('images/icon-calendar.svg') }}" alt=""></a>
        </div>
        
    </div>
    <div class="bottom-nav">
        <div class="container">
            <!-- Mobile Nav Toggle -->
            <div class="md:hidden flex items-center">
                <button x-data="{ open: false }" @click="open = !open" class="focus:outline-none">
                    <svg class="w-7 h-7 text-[#B28A5B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <!-- Navigation -->
            <nav class="hidden md:flex space-x-8 flex-1 justify-center">
                <a href="/servicios">Servicios</a>
                <a href="#como-funciona">Cómo Funciona</a>                
                <a href="#nosotros">Nosotros</a>
                <a href="#blog">Blog</a>
            </nav>
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
