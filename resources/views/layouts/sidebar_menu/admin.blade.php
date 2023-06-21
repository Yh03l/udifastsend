@if (auth()->user()->can('rol-listar') ||
        auth()->user()->can('usuario-listar'))
    <hr class="sidebar-divider d-none d-md-block" style="background-color: #F5BAD1;">
    <!-- Administración -->
    <div class="sidebar-heading">
        Administración
    </div>

    <li
        class="nav-item {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['Roles', 'Users']) ? 'active' : '' }}">
        <a class="nav-link {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['Roles', 'Users']) ? '' : 'collapsed' }} "
            href="#" data-toggle="collapse" data-target="#cSeguridad"
            aria-expanded="{{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['Roles', 'Users']) ? 'true' : 'false' }}"
            aria-controls="cSeguridad">
            <i class="fas fa-fw fa-key"></i>
            <span>Seguridad</span>
        </a>

        <div id="cSeguridad"
            class="collapse {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['Roles', 'Users']) ? 'show' : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                @can('rol-listar')
                    <a class="collapse-item {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['Roles']) ? 'active' : '' }}"
                        href="{{ route('roles.index') }}"><i class="fa-solid fa-user-lock"></i> Roles</a>
                @endcan

                @can('usuario-listar')
                    <a class="collapse-item {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['Users']) ? 'active' : '' }}"
                        href="{{ route('users.index') }}"><i class="fas fa-fw fa-users"></i> Usuarios</a>
                @endcan
            </div>
        </div>
    </li>
@endif
