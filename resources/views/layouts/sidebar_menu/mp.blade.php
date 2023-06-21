@if (auth()->user()->can('mp_producto-listar') ||
        auth()->user()->can('mp_producto-crear') ||
        auth()->user()->can('mp_tratamiento-listar'))
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" style="background-color: #F5BAD1;">
    <div class="sidebar-heading">
        Market Place
    </div>
@endif

@if (auth()->user()->can('mp_producto-listar') ||
        auth()->user()->can('mp_producto-crear') ||
        auth()->user()->can('mp_tratamiento-listar'))
    @php
        if (isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['MpProducto', 'MpImportProducto', 'MpTiposTratamiento', 'MpTratamiento', 'MpFAQTratamiento'])) {
            $marketPlaceActive = 'active';
            $marketPlaceCollapsed = '';
            $marketPlaceExpanded = 'true';
            $marketPlaceShow = 'show';
        } else {
            $marketPlaceActive = '';
            $marketPlaceCollapsed = 'collapsed';
            $marketPlaceExpanded = 'false';
            $marketPlaceShow = '';
        }
    @endphp

    <li class="nav-item {{ $marketPlaceActive }}">
        <a class="nav-link {{ $marketPlaceCollapsed }}" href="#" data-toggle="collapse" data-target="#cMpProducto"
            aria-expanded="{{ $marketPlaceExpanded }}" aria-controls="cMpProducto">
            <i class="fa-solid fa-store"></i>
            <span>E-commerce</span>
        </a>

        <div id="cMpProducto" class="collapse {{ $marketPlaceShow }}" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                @can('mp_producto-listar')
                    <a class="collapse-item {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['MpProducto']) ? 'active' : '' }}"
                        href="{{ route('productos.index') }}"><i class="fa-solid fa-boxes-packing"></i> Productos</a>
                @endcan

                @can('mp_producto-crear')
                    <a class="collapse-item {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['MpImportProducto']) ? 'active' : '' }}"
                        href="{{ route('productos.importarProductos') }}"><i class="fa-solid fa-boxes-packing"></i> Importar
                        Productos</a>
                @endcan

                @can('mp_tratamiento-listar')
                    <a class="collapse-item {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['MpTiposTratamiento']) ? 'active' : '' }}"
                        href="{{ route('tratamientos_tipos.index') }}"><i class="fa-solid fa-hand-holding-medical"></i>
                        Tratamiento Tipos</a>
                @endcan

                @can('mp_tratamiento-listar')
                    <a class="collapse-item {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['MpTratamiento', 'MpFAQTratamiento']) ? 'active' : '' }}"
                        href="{{ route('tratamientos.index') }}"><i class="fa-solid fa-hand-holding-medical"></i>
                        Tratamientos</a>
                @endcan

            </div>
        </div>
    </li>
@endif
