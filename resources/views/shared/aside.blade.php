<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('home') }}">
                <i class="bi bi-grid-fill"></i>
                <span>Panel</span>
            </a>
        </li>

        <!-- Enlace al módulo de usuarios -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('usuarios.index') }}">
                <i class="bi bi-people-fill"></i>
                <span>Usuarios</span>
            </a>
        </li>
    </ul>
</aside>