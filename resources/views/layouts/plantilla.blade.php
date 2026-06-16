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

    {{-- CSS personalizado con anti-caché --}}
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}?v={{ time() }}">
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
                @auth

                <li class="nav-item dropdown">
                    <a class="btn-icono-nav dropdown-toggle usuario-logueado"
                    href="#"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">

                        <i class="bi bi-person-circle"></i>

                        <span class="nombre-usuario-navbar">
                            {{ Auth::user()->nombre }}
                        </span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                        
                        <li>
                            <span class="dropdown-item-text text-muted small">
                                {{ Auth::user()->email }}
                            </span>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        {{-- ==============================================
                             VALIDACIÓN ESCRITORIO: BOTÓN ADMIN
                             ============================================== --}}
                        @if(Auth::user()->perfil_id == 1)
                        <li>
                            <a class="dropdown-item fw-bold" href="/admin" style="color: #5d4d7a;">
                                <i class="bi bi-shield-lock me-2"></i> Panel de Admin
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        @endif

                        <li>
                            <a class="dropdown-item" href="/profile">
                                <i class="bi bi-person me-2"></i>
                                Gestionar Perfil
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="/mis-pedidos">
                                <i class="bi bi-bag me-2"></i>
                                Mis Pedidos
                            </a>
                        </li>

                        {{-- NUEVO BOTÓN: MIS CONSULTAS (ESCRITORIO) --}}
                        <li>
                            <a class="dropdown-item" href="/mis-consultas">
                                <i class="bi bi-chat-dots me-2"></i>
                                Mis Consultas
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
                                </button>
                            </form>
                        </li>

                    </ul>
                </li>

                @else

                <li class="nav-item">
                    <a class="btn-icono-nav" href="/login">
                        <i class="bi bi-person-circle"></i>
                    </a>
                </li>

                @endauth

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
                <img src="{{ asset('imagenes/logoblanco.png') }}" alt="Logo" style="height: 30px; width:auto;">
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
                {{-- Catálogo Colapsable en Mobile --}}
                <div class="nav-item mb-2">
                    <a class="nav-link d-flex justify-content-between align-items-center text-white" 
                    data-bs-toggle="collapse" 
                    href="#collapseCatalogo" 
                    role="button" 
                    aria-expanded="false" 
                    aria-controls="collapseCatalogo"
                    id="btnCatalogoMobile">
                        Catálogo
                        <i class="bi bi-chevron-down flechita-catalogo"></i>
                    </a>
                    
                    <div class="collapse" id="collapseCatalogo">
                        <ul class="list-unstyled ps-4 mt-2">
                            <li class="mb-2"><a class="nav-link py-1 text-white opacity-75" href="/catalogo/productos">Ver todo</a></li>
                            <li class="mb-2"><a class="nav-link py-1 text-white opacity-75" href="/catalogo/pijamas">Pijamas</a></li>
                            <li class="mb-2"><a class="nav-link py-1 text-white opacity-75" href="/catalogo/lenceria">Lencería</a></li>
                            <li class="mb-2"><a class="nav-link py-1 text-white opacity-75" href="/catalogo/pantuflas">Pantuflas</a></li>
                            <li class="mb-2"><a class="nav-link py-1 text-white opacity-75" href="/catalogo/batas">Batas</a></li>
                        </ul>
                    </div>
                </div>
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
                @auth

                <div class="usuario-mobile-logueado">

                    <div class="mb-3 text-white">
                        <i class="bi bi-person-circle me-2"></i>
                        {{ Auth::user()->nombre }}
                    </div>

                    {{-- ==============================================
                         VALIDACIÓN CELULARES: BOTÓN ADMIN
                         ============================================== --}}
                    @if(Auth::user()->perfil_id == 1)
                    <a href="/admin" class="btn-menu-usuario" style="background-color: rgba(93, 77, 122, 0.4) !important;">
                        <i class="bi bi-shield-lock me-2"></i>
                        Panel de Admin
                    </a>
                    @endif

                    <a href="/profile" class="btn-menu-usuario">
                        <i class="bi bi-person-gear me-2"></i>
                        Gestionar Perfil
                    </a>

                    <a href="/mis-pedidos" class="btn-menu-usuario">
                        <i class="bi bi-bag-heart me-2"></i>
                        Mis Pedidos
                    </a>

                    {{-- NUEVO BOTÓN: MIS CONSULTAS (MÓVIL) --}}
                    <a href="/mis-consultas" class="btn-menu-usuario">
                        <i class="bi bi-chat-dots me-2"></i>
                        Mis Consultas
                    </a>

                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="btn-cerrar-mobile text-danger mt-2">
                            <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
                        </button>
                    </form>

                </div>

                @else

                <a class="nav-link-lateral-login" href="/login">
                    <i class="bi bi-person-circle me-2"></i> Mi cuenta
                </a>

                @endauth
            </div>

        </div>
    </div>


    {{-- CONTENIDO DE CADA PÁGINA --}}
    @yield('contenido')

{{-- ================================================
         FOOTER
         ================================================ --}}
    <footer class="text-white py-5 mt-auto" style="background-color: #5d4d7a;">
        <div class="container">
            <div class="row g-4">
                
                {{-- Columna 1: Logo y Redes --}}
                <div class="col-12 col-md-4 text-center text-md-start">
                    <img src="{{ asset('imagenes/logoblanco.png') }}" alt="Sueño Contigo" style="height: 50px; width: auto;" class="mb-3">
                    <p class="small text-white-50">
                        Prendas pensadas para tu comodidad y descanso. Calidad premium en pijamas, batas, lencería y pantuflas. 🌸
                    </p>
                    <div class="d-flex gap-3 mt-3 justify-content-center justify-content-md-start">
                        <a href="https://www.instagram.com/suenio.contigo" target="_blank" class="text-white text-decoration-none fs-5">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://wa.me/543795340652" target="_blank" class="text-white text-decoration-none fs-5">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>
                </div>

                {{-- Columna 2: Enlaces Rápidos --}}
                <div class="col-12 col-sm-6 col-md-3 text-center text-md-start">
                    <h5 class="fw-bold mb-3" style="font-size: 1.1rem;">Navegación</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="/" class="text-white-50 text-decoration-none small hover-link">Inicio</a></li>
                        <li class="mb-2"><a href="/catalogo/productos" class="text-white-50 text-decoration-none small hover-link">Catálogo</a></li>
                        <li class="mb-2"><a href="/contacto" class="text-white-50 text-decoration-none small hover-link">Contacto</a></li>
                        <li class="mb-2"><a href="/terminos" class="text-white-50 text-decoration-none small hover-link">Términos y Condiciones</a></li>
                    </ul>
                </div>

                {{-- Columna 3: Información de Contacto --}}
                <div class="col-12 col-sm-6 col-md-2 text-center text-md-start">
                    <h5 class="fw-bold mb-3" style="font-size: 1.1rem;">Contacto</h5>
                    <ul class="list-unstyled mb-0 small text-white-50">
                        <li class="mb-2">
                            {{-- ¡Dirección actualizada acá! --}}
                            <i class="bi bi-geo-alt-fill me-2 text-white"></i> 25 de Mayo 1853
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-whatsapp me-2 text-white"></i> 3795 340652
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-envelope-fill me-2 text-white"></i> 
                            <span style="font-size: 0.85rem;">sueniaconmigopijamas@gmail.com</span>
                        </li>
                    </ul>
                </div>

                {{-- Columna 4: El Mapa Mágico --}}
                <div class="col-12 col-md-3">
                    <h5 class="fw-bold mb-3 text-center text-md-start" style="font-size: 1.1rem;">Ubicación</h5>
                    <div class="ratio ratio-4x3 shadow-sm overflow-hidden rounded-3" style="max-height: 150px;">
                        {{-- ¡Mapa actualizado a Edificio Sunset 2 / 25 de Mayo 1853! --}}
                        <iframe 
                            src="https://maps.google.com/maps?q=25+de+Mayo+1853,+Corrientes,+Argentina&t=&z=16&ie=UTF8&iwloc=&output=embed" 
                            class="w-100 h-100 border-0" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

            </div>

            <hr class="mt-4 mb-3 opacity-25 bg-white">

            {{-- Copyright --}}
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0 small text-white-50">© {{ date('Y') }} Sueño Contigo. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
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