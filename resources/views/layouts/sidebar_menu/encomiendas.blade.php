@if (auth()->user()->can('encomienda-listar') ||
        auth()->user()->can('encomienda-crear') )
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" style="background-color: #F5BAD1;">
    <div class="sidebar-heading">
        Gestión de Encomiendas
    </div>
@endif

@if (auth()->user()->can('encomienda-listar') ||
        auth()->user()->can('encomienda-crear'))
    @php
        if (isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['EncomiendaEnvio', 'EncomiendaDespacho'])) {
            $encomiendaActive = 'active';
            $encomiendaCollapsed = '';
            $encomiendaExpanded = 'true';
            $encomiendaShow = 'show';
        } else {
            $encomiendaActive = '';
            $encomiendaCollapsed = 'collapsed';
            $encomiendaExpanded = 'false';
            $encomiendaShow = '';
        }
    @endphp

    <li class="nav-item {{ $encomiendaActive }}">
        <a class="nav-link {{ $encomiendaCollapsed }}" href="#" data-toggle="collapse" data-target="#cEncomienda"
            aria-expanded="{{ $encomiendaExpanded }}" aria-controls="cEncomienda">
            <i class="fa-solid fa-boxes-packing"></i>
            <span>Encomiendas</span>
        </a>

        <div id="cEncomienda" class="collapse {{ $encomiendaShow }}" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                @can('encomienda-listar')
                    <a class="collapse-item {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['EncomiendaEnvio']) ? 'active' : '' }}"
                        href="{{ route('encomiendas.index') }}"><i class="fa-solid fa-file-import"></i> Envíos</a>

                    <a class="collapse-item {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['EncomiendaDespacho']) ? 'active' : '' }}"
                    href="{{ route('home') }}"><i class="fa-solid fa-file-export"></i> Despacho</a>
                @endcan

            </div>
        </div>
    </li>
@endif
