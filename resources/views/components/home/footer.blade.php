<footer class="w-full bg-[#0D0D0D] text-white py-10 mt-auto">
    <div class="container mx-auto lg:flex lg:items-center lg:justify-between">
        <div class="flex flex-col items-center md:items-start">
            <img src="{{ asset('images/logo-footer.svg') }}" alt="">
            <ul class="social-links">
                <li>Siguenos en:</li>
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
        </div>
        <div class="flex center-message">
           <h3>“Un servicio premium, pensado para dueños exigentes que valoran la tranquilidad, la transparencia y el cuidado profesional de su hogar.”</h3>
           <ul class="center-message--buttons">
                <li>
                    <a href="/servicios" class="btn-crear-cuenta">Crear Cuenta <img src="{{ asset('images/icon-crear-cuenta.svg') }}" alt=""></a>  
                </li>
                <li>
                    <a href="/servicios" class="btn-agenda">Agenda tu Servicio <img src="{{ asset('images/icon-calendar.svg') }}" alt=""></a>
                </li>
           </ul>              
        </div>
        <div class="flex nav-footer">
            <nav>
                <a href="">Servicios</a>
                <a href="">Cómo Funciona</a>
                <a href="">Nosotros</a>
                <a href="">Blog</a>
            </nav>
            <nav>
                <a href="">Términos y Condiciones</a>
                <a href="">Políticas de Privacidad</a>
                <a href="">Preguntes Frecuentes</a>
                <a href="">Servicio al Cliente</a>
            </nav>
        </div>
    </div>
    <div class="bottom-footer mt-8 text-center text-xs text-[#FFFFFF]">
        &copy; {{ date('Y') }} CASAPRIMA. Todos los derechos reservados.
    </div>
</footer>
