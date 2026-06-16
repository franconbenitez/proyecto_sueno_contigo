<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Sueño Contigo</title>

    <link rel="icon" type="image/png" href="{{ asset('imagenes/logolila.png') }}">

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    {{-- CSS general --}}
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

    {{-- CSS admin --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="d-flex flex-column min-vh-100">

    {{-- ==========================================
         NAVBAR ADMIN DESKTOP
         ========================================== --}}
    <nav class="navbar navbar-expand-lg navbar-dark d-none d-lg-flex" id="navbar-admin">

        <div class="container-fluid px-4">

            {{-- Logo --}}
            <a class="navbar-brand" href="/">
                <img src="{{ asset('imagenes/logoblanco.png') }}"
                     alt="Sueño Contigo"
                     style="height:40px;">
            </a>

            {{-- Menú --}}
            <ul class="navbar-nav mx-auto mb-0">

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/admin') }}">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('productos.index') }}">
                        Productos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('usuarios.index') }}">
                        Usuarios
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('consultas.index') }}">
                        Consultas
                    </a>
                </li>

                <li class="nav-item">
                <a class="nav-link nav-link-admin {{ Request::is('pedidos*') ? 'active' : '' }}" href="{{ url('/pedidos') }}">
                    Pedidos
                </a>
            </li>

            </ul>

            {{-- Usuario y Botones --}}
            <ul class="navbar-nav ms-auto align-items-center">

                @auth
                    <li class="nav-item me-3">
                        <span class="admin-usuario text-white">
                            <i class="bi bi-person-circle"></i>
                            {{ Auth::user()->nombre }}
                        </span>
                    </li>
                @endauth

                {{-- Contenedor para los dos botones --}}
                <li class="nav-item d-flex align-items-center gap-2">
                    <a href="/" class="btn-admin-tienda">
                        Ver tienda
                    </a>
                    
                    @auth
                    <form action="/logout" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-light rounded-pill px-3" style="border-width: 1.5px;" title="Cerrar Sesión">
                            <i class="bi bi-box-arrow-right"></i>
                        </button>
                    </form>
                    @endauth
                </li>

            </ul>

        </div>

    </nav>

    {{-- ==========================================
         NAVBAR MOBILE
         ========================================== --}}
    <nav class="navbar navbar-dark d-flex d-lg-none justify-content-between align-items-center px-3"
         id="navbar-mobile">

        <button class="btn-icono-nav"
                data-bs-toggle="offcanvas"
                data-bs-target="#menuLateral"> {{-- AQUÍ SE CORRIGIÓ EL ID OBJETIVO --}}
            <i class="bi bi-list fs-4"></i>
        </button>

        <a class="navbar-brand mb-0" href="/">
            <img src="{{ asset('imagenes/logoblanco.png') }}"
                 alt="Logo"
                 style="height:30px;">
        </a>

        <span class="text-white">
            <i class="bi bi-shield-lock"></i>
        </span>

    </nav>

    {{-- ==========================================
         MENÚ MOBILE (Offcanvas)
         ========================================== --}}
    {{-- AQUÍ SE CORRIGIÓ EL ID PARA TOMAR TUS ESTILOS LILAS --}}
    <div class="offcanvas offcanvas-start" id="menuLateral">

        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-white">
                Administración
            </h5>

            <button type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="offcanvas">
            </button>
        </div>

        <div class="offcanvas-body d-flex flex-column">

            <ul class="navbar-nav flex-column gap-1 mb-3">

                <li class="nav-item">
                    <a class="nav-link-lateral" href="/admin">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link-lateral" href="{{ route('productos.index') }}">
                        Productos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link-lateral" href="{{ route('usuarios.index') }}">
                        Usuarios
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link-lateral" href="{{ route('consultas.index') }}">
                        Consultas
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link-lateral" href="{{ url('/pedidos') }}">
                        Pedidos
                    </a>
                </li>

            </ul>

            {{-- Botones Inferiores Mobile --}}
            <div class="mt-auto pt-4">

                <hr class="border-white opacity-25">

                <a href="/" class="nav-link-lateral-login d-block mb-3">
                    <i class="bi bi-shop me-2"></i>
                    Ver tienda
                </a>

                @auth
                <form action="/logout" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="nav-link-lateral-login w-100 text-start bg-transparent border-0 d-block text-danger">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        Cerrar sesión
                    </button>
                </form>
                @endauth

            </div>

        </div>

    </div>

    {{-- CONTENIDO --}}
    <main class="container py-5 flex-grow-1">
        @yield('contenido_admin')
    </main>

    {{-- ==========================================
         FOOTER ADMIN
         ========================================== --}}
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
                        <li class="mb-2"><a href="/" class="text-white-50 text-decoration-none small hover-link">Inicio (Tienda)</a></li>
                        <li class="mb-2"><a href="/catalogo/productos" class="text-white-50 text-decoration-none small hover-link">Catálogo</a></li>
                        <li class="mb-2"><a href="/contacto" class="text-white-50 text-decoration-none small hover-link">Contacto</a></li>
                        <li class="mb-2"><a href="/admin" class="text-white-50 text-decoration-none small hover-link">Volver al Dashboard</a></li>
                    </ul>
                </div>

                {{-- Columna 3: Información de Contacto --}}
                <div class="col-12 col-sm-6 col-md-2 text-center text-md-start">
                    <h5 class="fw-bold mb-3" style="font-size: 1.1rem;">Contacto</h5>
                    <ul class="list-unstyled mb-0 small text-white-50">
                        <li class="mb-2">
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

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>