<ul class="navbar-nav bg-white sidebar sidebar-light accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ config('app.url') }}">
        <div class="sidebar-brand-icon p-1">
            <img src="{{ asset('img/logo.png') }}" height="32px" title="Medicinets">
        </div>
        {{-- <div class="sidebar-brand-text p-1">
            <img src="{{ asset('img/medicinets.png') }}" height="auto" title="Medicinets" class=" w-100 responsive">
        </div> --}}
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" style="background-color: #F5BAD1;">

    <!-- Nav Item - Dashboard -->
    <li
        class="nav-item {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['Home']) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>{{ auth()->user()->roles->pluck("name")->first()}}</span></a>
    </li>

    {{-- <!-- Divider -->
    <hr class="sidebar-divider" style="background-color: #F5BAD1;"> --}}

    {{-- @can('rol-listar')
        <!-- Nav Item - Perfil -->
        <li class="nav-item  {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['Home']) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fa-solid fa-user-doctor fa-1x"></i>
                <span>Perfil</span>
            </a>
        </li>
    @endcan --}}

    @include('layouts.sidebar_menu.encomiendas')

    @include('layouts.sidebar_menu.admin')

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" style="background-color: #F5BAD1;">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
