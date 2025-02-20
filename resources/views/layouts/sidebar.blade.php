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
            <li class="dropdown {{ request()->routeIs('mode_reglements.*')  || request()->routeIs('familles.*') ||  request()->routeIs('etats.*') || request()->routeIs('sousfamilles.*') || request()->routeIs('marques.*') || request()->routeIs('unites.*') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-solid fa-list"></i>
                    <span>Familles</span>
                </a>
                <!-- If one of the submenu items is active, we display the dropdown -->
                <ul class="dropdown-menu" style="{{ request()->routeIs('familles.*') || request()->routeIs('sousfamilles.*') ? 'display: block;' : '' }}">
                    <li>
                        <a class="nav-link {{ request()->routeIs('familles.index') ? 'active' : '' }}" href="{{ route('familles.index') }}">
                            Familles
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->routeIs('sousfamilles.index') ? 'active' : '' }}" href="{{ route('sousfamilles.index') }}">
                            Sous Familles
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->routeIs('marques.index') ? 'active' : '' }}" href="{{ route('marques.index') }}">
                            Marques
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->routeIs('unites.index') ? 'active' : '' }}" href="{{ route('unites.index') }}">
                            Unites
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->routeIs('etats.index') ? 'active' : '' }}" href="{{ route('etats.index') }}">
                            Etat
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->routeIs('mode_reglements.index') ? 'active' : '' }}" href="{{ route('mode_reglements.index') }}">
                            Mode Reglement
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
