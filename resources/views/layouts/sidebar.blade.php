<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="{{ asset('kaiadmin/assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand"
                    class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item {{ $activeMenu == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ url('/') }}" class="nav-link">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item {{ $activeMenu == 'base' ? 'active' : '' }}">
                    <a href="{{ url('/') }}" class="nav-link">
                        <i class="fas fa-layer-group"></i>
                        <p>Base</p>
                    </a>
                </li>
                <li class="nav-item {{ $activeMenu == 'avatars' ? 'active' : '' }}">
                    <a href="components/avatars.html" class="nav-link">
                        <span class="sub-item">Avatars</span>
                    </a>
                </li>
                <li class="nav-item {{ $activeMenu == 'buttons' ? 'active' : '' }}">
                    <a href="components/buttons.html" class="nav-link">
                        <span class="sub-item">Buttons</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
