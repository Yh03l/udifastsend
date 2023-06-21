@if (auth()->user()->can('salud_paciente-listar') )
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" style="background-color: #F5BAD1;">
    <div class="sidebar-heading">
        Salud
    </div>
@endif

@if (auth()->user()->can('salud_paciente-listar') )
    @php
        if (isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['SaludPacientes', 'SaludCitas', 'SaludCalendario'])) {
            $saludActive = 'active';
            $saludCollapsed = '';
            $saludExpanded = 'true';
            $saludShow = 'show';
        } else {
            $saludActive = '';
            $saludCollapsed = 'collapsed';
            $saludExpanded = 'false';
            $saludShow = '';
        }
    @endphp

    <li class="nav-item {{ $saludActive }}">
        <a class="nav-link {{ $saludCollapsed }}" href="#" data-toggle="collapse" data-target="#cSaludClinica"
            aria-expanded="{{ $saludExpanded }}" aria-controls="cSaludClinica">
            <i class="fa-solid fa-hospital"></i>
            <span>Clínica</span>
        </a>

        <div id="cSaludClinica" class="collapse {{ $saludShow }}" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                @can('salud_paciente-listar')
                    <a class="collapse-item {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['SaludPacientes']) ? 'active' : '' }}"
                        href="{{ route('pacientes.index') }}"><i class="fa-solid fa-hospital-user"></i> Pacientes</a>
                @endcan

                @can('salud_paciente-listar')
                    <a class="collapse-item {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['SaludCitas']) ? 'active' : '' }}"
                        href="{{ route('citas.index') }}"><i class="fa-solid fa-calendar-plus"></i> Gestión de Citas</a>
                @endcan

                @can('salud_paciente-listar')
                    <a class="collapse-item {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['SaludCalendario']) ? 'active' : '' }}"
                        href="{{ route('citas.calendario') }}"><i class="fa-solid fa-calendar-days"></i> Calendario de Citas</a>
                @endcan

            </div>
        </div>
    </li>
@endif
