<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sueño Contigo</title>
    <link rel="icon" type="image/png" href="{{ asset('imagenes/logolila.png') }}">

    {{-- Bootstrap CSS local --}}
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">

    {{-- Íconos de Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    {{-- CSS personalizado --}}
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>

    {{-- ================================================
         NAVBAR ESCRITORIO (visible solo en pantallas grandes)
         ================================================ --}}
    <nav class="navbar navbar-expand-lg navbar-dark d-none d-lg-flex" id="navbar-principal">
        <div class="container-fluid px-4">

            {{-- Logo a la izquierda --}}
            <a class="navbar-brand" href="/">
                <img src="{{ asset ('imagenes/logoblanco.png') }}" alt="Logo Sueño Contigo" style="height: 40px; ">
            </a>

            {{-- Links del centro --}}
            <ul class="navbar-nav mx-auto mb-0">
                <li class="nav-item">
                    <a class="nav-link" href="/">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Catálogo
                    </a>
                    <ul class="dropdown-menu border-0 shadow-sm">
                        {{-- NUEVA OPCIÓN --}}
                        <li><a class="dropdown-item fw-bold" href="/catalogo/productos">Ver todo</a></li>
                        <li><hr class="dropdown-divider"></li>
                        
                        <li><a class="dropdown-item" href="/catalogo/pijamas">Pijamas</a></li>
                        <li><a class="dropdown-item" href="/catalogo/lenceria">Lencería</a></li>
                        <li><a class="dropdown-item" href="/catalogo/pantuflas">Pantuflas</a></li>
                        <li><a class="dropdown-item" href="/catalogo/batas">Batas</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/quienes-somos">Quiénes somos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/informacion">Información</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/comercializacion">Comercialización</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/terminos">Términos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contacto">Contacto</a>
                </li>
            </ul>

            {{-- Íconos a la derecha --}}
            <ul class="navbar-nav ms-auto mb-0 align-items-center gap-1">

                {{-- Buscador --}}
                <li class="nav-item buscador-item">
                    <button class="btn-icono-nav" onclick="toggleBuscador()">
                        <i class="bi bi-search"></i>
                    </button>
                    {{-- Barra desplegable escritorio --}}
                    <div class="buscador-desplegable" id="buscadorEscritorio">
                        <input type="text"
                               class="form-control form-control-sm buscador-input"
                               placeholder="¿Qué estás buscando?">
                    </div>
                </li>

                {{-- Login --}}
                <li class="nav-item">
                    <a class="btn-icono-nav" href="/login">
                        <i class="bi bi-person-circle"></i>
                    </a>
                </li>

                {{-- Carrito --}}
                <li class="nav-item">
                    <a class="btn-icono-nav position-relative" href="/carrito">
                        <i class="bi bi-bag-heart"></i>
                        {{-- Badge con contador dinámico --}}
                        @if(session('carrito') && count(session('carrito')) > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                {{ count(session('carrito')) }}
                                <span class="visually-hidden">productos en carrito</span>
                            </span>
                        @endif
                    </a>
                </li>

            </ul>
        </div>
    </nav>


    {{-- ================================================
         NAVBAR MOBILE (visible solo en pantallas pequeñas)
         ================================================ --}}
    <nav class="navbar navbar-dark d-flex d-lg-none justify-content-between align-items-center px-3"
         id="navbar-mobile">

        {{-- Botón hamburguesa izquierda --}}
        <button class="btn-icono-nav"
                data-bs-toggle="offcanvas"
                data-bs-target="#menuLateral">
            <i class="bi bi-list fs-4"></i>
        </button>

        {{-- Logo centrado --}}
        <a class="navbar-brand mb-0 brand-mobile" href="/">
            <img src="{{ asset('imagenes/logoblanco.png') }}" alt="Logo Sueño Contigo" style="height: 30px; width: auto;">
        </a>

        {{-- Solo carrito a la derecha --}}
        <a class="btn-icono-nav position-relative" href="/carrito">
            <i class="bi bi-bag-heart"></i>

            @if(session('carrito') && count(session('carrito')) > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.55rem;">
                    {{ count(session('carrito')) }}
                </span>
            @endif
        </a>

    </nav>


    {{-- ================================================
         MENÚ LATERAL MOBILE (offcanvas)
         ================================================ --}}
    <div class="offcanvas offcanvas-start" id="menuLateral">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="menuLateralLabel">
                <img src="{{ ('imagenes/logoblanco.png') }}" alt="Logo" style="height: 30px; width:auto;">
            </h5>
            <button type="button" class="btn-close btn-close-white"
                    data-bs-dismiss="offcanvas"></button>
        </div>

        <div class="offcanvas-body d-flex flex-column">

            {{-- Links de navegación --}}
            <ul class="navbar-nav flex-column gap-1 mb-3">
                <li class="nav-item">
                    <a class="nav-link-lateral" href="/">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-lateral" href="/catalogo/productos">Catálogo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-lateral" href="/quienes-somos">Quiénes somos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-lateral" href="/informacion">Información</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-lateral" href="/comercializacion">Comercialización</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-lateral" href="/terminos">Términos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-lateral" href="/contacto">Contacto</a>
                </li>
            </ul>

            {{-- Buscador dentro del menú lateral --}}
            <div class="buscador-lateral mt-2 mb-3">
                <div class="input-group">
                    <span class="input-group-text buscador-lateral-icono">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text"
                           class="form-control buscador-input"
                           placeholder="¿Qué estás buscando?">
                </div>
            </div>

            {{-- Espaciador que empuja el login hacia abajo --}}
            <div class="mt-auto">
                <hr class="border-white opacity-25">
                <a class="nav-link-lateral-login" href="/login">
                    <i class="bi bi-person-circle me-2"></i> Mi cuenta
                </a>
            </div>

        </div>
    </div>


    {{-- CONTENIDO DE CADA PÁGINA --}}
    @yield('contenido')

{{-- ================================================
         FOOTER
         ================================================ --}}
    <footer class="footer-principal text-center py-4 mt-5">
        
        {{-- Aquí reemplazamos el texto por tu logo --}}
        <div class="footer-logo-container mb-3">
            <img src="{{ asset('imagenes/logoblanco.png') }}" alt="Sueño Contigo" style="height: 50px; width: auto;">
        </div>

        <div class="footer-redes">
            <a href="https://wa.me/543795340652" target="_blank" aria-label="WhatsApp">
                <i class="bi bi-whatsapp"></i>
            </a>

            <a href="https://www.instagram.com/suenio.contigo" target="_blank" aria-label="Instagram">
                <i class="bi bi-instagram"></i>
            </a>

            <a href="mailto:sueniaconmigopijamas@gmail.com" aria-label="Correo electrónico">
                <i class="bi bi-envelope-fill"></i>
            </a>
        </div>

        <p class="footer-copy mb-0">© 2026 Todos los derechos reservados</p>
    </footer>


    {{-- Bootstrap JS local --}}
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- Script buscador --}}
    <script>
        function toggleBuscador() {
            // Solo maneja el buscador de escritorio
            const buscador = document.getElementById('buscadorEscritorio');
            if (buscador) {
                buscador.classList.toggle('activo');
                // Si se abrió, pone el foco en el input automáticamente
                if (buscador.classList.contains('activo')) {
                    buscador.querySelector('input').focus();
                }
            }
        }

        // Cierra el buscador si el usuario hace clic fuera de él
        document.addEventListener('click', function(e) {
            const buscador = document.getElementById('buscadorEscritorio');
            const btnLupa = document.querySelector('.buscador-item');
            if (buscador && btnLupa && !btnLupa.contains(e.target)) {
                buscador.classList.remove('activo');
            }
        });
    </script>

</body>
</html>