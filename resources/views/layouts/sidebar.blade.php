<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">
                <img alt="image" src="assets/img/logo.png" class="header-logo" />
                <span class="logo-name">Otika</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i data-feather="home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="dropdown {{ request()->routeIs('mode_reglements.index') ? 'active' : '' }}">
                <a href="{{ route('mode_reglements.index') }}" class="nav-link">
                    <i data-feather="credit-card"></i>
                    <span>Mode Reglement</span>
                </a>
            </li>
            <li class="dropdown {{ request()->routeIs('etats.index') ? 'active' : '' }}">
                <a href="{{ route('etats.index') }}" class="nav-link">
                    <i data-feather="bar-chart-2"></i>
                    <span>Etats</span>
                </a>
            </li>
            <li class="dropdown {{ request()->routeIs('unites.index') ? 'active' : '' }}">
                <a href="{{ route('unites.index') }}" class="nav-link">
                    <i data-feather="grid"></i>
                    <span>Unites</span>
                </a>
            </li>
            <li class="dropdown {{ request()->routeIs('marques.index') ? 'active' : '' }}">
                <a href="{{ route('marques.index') }}" class="nav-link">
                    <i data-feather="tag"></i>
                    <span>Marques</span>
                </a>
            </li>
            <li class="dropdown {{ request()->routeIs('sousfamilles.index') ? 'active' : '' }}">
                <a href="{{ route('sousfamilles.index') }}" class="nav-link">
                    <i data-feather="list"></i>
                    <span>Sous Familles</span>
                </a>
            </li>
            <li class="dropdown {{ request()->routeIs('familles.index') ? 'active' : '' }}">
                <a href="{{ route('familles.index') }}" class="nav-link">
                    <i data-feather="folder"></i>
                    <span>Familles</span>
                </a>
            </li>
            <li class="dropdown {{ request()->routeIs('produits.index') ? 'active' : '' }}">
                <a href="{{ route('produits.index') }}" class="nav-link">
                    <i data-feather="shopping-bag"></i>
                    <span>Products</span>
                </a>
            </li>
            <li class="dropdown {{ request()->routeIs('commandes.index') ? 'active' : '' }}">
                <a href="{{ route('commandes.index') }}" class="nav-link">
                    <i data-feather="shopping-cart"></i>
                    <span>Commandes</span>
                </a>
            </li>
        </ul>
        
       
        
    </aside>
</div>
