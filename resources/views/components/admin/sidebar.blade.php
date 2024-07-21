<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.index')}}" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Panel</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-header">GENERAL</li>
                <li class="nav-item">
                    <a href="{{route('admin.languages.index')}}"
                       class="nav-link @if(request()->routeIs('admin.languages.index')) active @endif">
                        <i class="fas fa-language nav-icon"></i>
                        <p>Languages</p>
                    </a>
                </li>
                <li class="nav-header">SITE</li>
                <li class="nav-item">
                    <a href="{{route('admin.menus.index')}}"
                       class="nav-link @if(request()->routeIs('admin.menus.index')) active @endif">
                        <i class="fas fa-list-alt nav-icon"></i>
                        <p>Menus</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.pages.index')}}"
                       class="nav-link @if(request()->routeIs('admin.pages.index')) active @endif">
                        <i class="fas fa-list nav-icon"></i>
                        <p>Pages</p>
                    </a>
                </li>
                <li class="nav-header">TEMPLATES</li>
                <li class="nav-item">
                    <a href="{{route('admin.fieldTypes.index')}}"
                       class="nav-link @if(request()->routeIs('admin.fieldTypes.index')) active @endif">
                        <i class="fas fa-tag nav-icon"></i>
                        <p>Field Types</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.templates.index')}}"
                       class="nav-link @if(request()->routeIs('admin.templates.index')) active @endif">
                        <i class="fas fa-code nav-icon"></i>
                        <p>Templates</p>
                    </a>
                </li>
                <li class="nav-header">SYSTEM</li>
                <li class="nav-item">
                    <a href="{{route('admin.history.index')}}"
                       class="nav-link @if(request()->routeIs('admin.history.index')) active @endif">
                        <i class="fas fa-clock nav-icon"></i>
                        <p>History</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
