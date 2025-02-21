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
                    <i data-feather="monitor"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- For the Widgets dropdown -->
          
            <li class="dropdown {{ request()->routeIs('mode_reglements.index') ? 'active' : '' }}">
                <a href="{{ route('mode_reglements.index') }}" class="nav-link">
                    <i data-feather="shopping-bag"></i>
                    <span>Mode regelement</span>
                </a>
            </li>
            <li class="dropdown {{ request()->routeIs('etats.index') ? 'active' : '' }}">
                <a href="{{ route('etats.index') }}" class="nav-link">
                    <i data-feather="shopping-bag"></i>
                    <span>Etats</span>
                </a>
            </li>
            <li class="dropdown {{ request()->routeIs('unites.index') ? 'active' : '' }}">
                <a href="{{ route('unites.index') }}" class="nav-link">
                    <i data-feather="shopping-bag"></i>
                    <span>Unites</span>
                </a>
            </li>
            <li class="dropdown {{ request()->routeIs('marques.index') ? 'active' : '' }}">
                <a href="{{ route('marques.index') }}" class="nav-link">
                    <i data-feather="shopping-bag"></i>
                    <span>Marques</span>
                </a>
            </li>
            <li class="dropdown {{ request()->routeIs('sousfamilles.index') ? 'active' : '' }}">
                <a href="{{ route('sousfamilles.index') }}" class="nav-link">
                    <i data-feather="shopping-bag"></i>
                    <span>Sous Familles</span>
                </a>
            </li>
            <li class="dropdown {{ request()->routeIs('familles.index') ? 'active' : '' }}">
                <a href="{{ route('familles.index') }}" class="nav-link">
                    <i data-feather="shopping-bag"></i>
                    <span>Familles</span>
                </a>
            </li>
            <li class="dropdown {{ request()->routeIs('produits.index') ? 'active' : '' }}">
                <a href="{{ route('produits.index') }}" class="nav-link">
                    <i data-feather="shopping-bag"></i>
                    <span>Products</span>
                </a>
            </li>
        </ul>
       
        
    </aside>
</div>
