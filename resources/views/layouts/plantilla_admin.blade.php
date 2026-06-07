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

    {{-- FOOTER --}}
    <footer class="footer-principal text-center py-4 mt-5">

        <div class="footer-logo-container mb-3">
            <img src="{{ asset('imagenes/logoblanco.png') }}"
                 alt="Sueño Contigo"
                 style="height:50px;">
        </div>

        <div class="footer-redes">
            <a href="https://wa.me/543795340652" target="_blank">
                <i class="bi bi-whatsapp"></i>
            </a>

            <a href="https://www.instagram.com/suenio.contigo" target="_blank">
                <i class="bi bi-instagram"></i>
            </a>

            <a href="mailto:sueniaconmigopijamas@gmail.com">
                <i class="bi bi-envelope-fill"></i>
            </a>
        </div>

        <p class="footer-copy mb-0">
            © 2026 Todos los derechos reservados
        </p>

    </footer>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>