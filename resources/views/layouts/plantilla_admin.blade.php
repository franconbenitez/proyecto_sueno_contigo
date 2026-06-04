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
<body>

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

            {{-- Usuario --}}
            <ul class="navbar-nav ms-auto align-items-center">

                @auth
                    <li class="nav-item me-3">
                        <span class="admin-usuario">
                            <i class="bi bi-person-circle"></i>
                            {{ Auth::user()->nombre }}
                        </span>
                    </li>
                @endauth

                <li class="nav-item">
                    <a href="/" class="btn-admin-tienda">
                        Ver tienda
                    </a>
                </li>

            </ul>

        </div>

    </nav>

    {{-- ==========================================
         NAVBAR MOBILE
         ========================================== --}}
    <nav class="navbar navbar-dark d-flex d-lg-none justify-content-between align-items-center px-3"
         id="navbar-admin-mobile">

        <button class="btn-icono-nav"
                data-bs-toggle="offcanvas"
                data-bs-target="#menuAdmin">
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
         MENÚ MOBILE
         ========================================== --}}
    <div class="offcanvas offcanvas-start" id="menuAdmin">

        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-white">
                Administración
            </h5>

            <button type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="offcanvas">
            </button>
        </div>

        <div class="offcanvas-body">

            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link-lateral" href="/admin">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link-lateral" href="#">
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
                    <a class="nav-link-lateral" href="#">
                        Pedidos
                    </a>
                </li>

            </ul>

            <div class="mt-auto pt-4">

                <hr class="border-white opacity-25">

                <a href="/" class="nav-link-lateral-login">
                    <i class="bi bi-shop me-2"></i>
                    Ver tienda
                </a>

            </div>

        </div>

    </div>

    {{-- CONTENIDO --}}
    <main class="container py-5">
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