@if (auth()->user()->can('video-listar') ||
        auth()->user()->can('frase-listar') ||
        auth()->user()->can('redessociales-listar') ||
        auth()->user()->can('testimonios-listar') ||
        auth()->user()->can('diagnostico-listar') ||
        auth()->user()->can('biografia-listar') ||
        auth()->user()->can('salud_tratamiento-listar') ||
        auth()->user()->can('cms_inicio-listar') ||
        auth()->user()->can('cms_conoce_mas-listar'))
    <hr class="sidebar-divider d-none d-md-block" style="background-color: #F5BAD1;">
    <!-- Administración -->
    <div class="sidebar-heading">
        CMS
    </div>
@endif

@if (auth()->user()->can('video-listar') ||
        auth()->user()->can('frase-listar') ||
        auth()->user()->can('redessociales-listar') ||
        auth()->user()->can('testimonios-listar') ||
        auth()->user()->can('diagnostico-listar') ||
        auth()->user()->can('biografia-listar') ||
        auth()->user()->can('salud_tratamiento-listar'))
    @php
        if (isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['Video', 'Quote', 'RRSS', 'Testimony', 'Diagnosis', 'Biography', 'SaludTratamiento', 'SaludFAQTratamiento'])) {
            $contenidoActive = 'active';
            $contenidoCollapsed = '';
            $contenidoExpanded = 'true';
            $contenidoShow = 'show';
        } else {
            $contenidoActive = '';
            $contenidoCollapsed = 'collapsed';
            $contenidoExpanded = 'false';
            $contenidoShow = '';
        }
    @endphp
    <li class="nav-item {{ $contenidoActive }}">
        <a class="nav-link {{ $contenidoCollapsed }} " href="#" data-toggle="collapse" data-target="#cContenido"
            aria-expanded="{{ $contenidoExpanded }}" aria-controls="cContenido">
            <i class="fa-solid fa-list-check"></i>
            <span>Contenido</span>
        </a>

        <div id="cContenido" class="collapse {{ $contenidoShow }}" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                @can('video-listar')
                    <a class="collapse-item {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['Video']) ? 'active' : '' }}"
                        href="{{ route('video.index') }}"><i class="fa-brands fa-youtube"></i> Video</a>
                @endcan

                @can('frase-listar')
                    <a class="collapse-item {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['Quote']) ? 'active' : '' }}"
                        href="{{ route('frase.index') }}"><i class="fa-solid fa-quote-right"></i> Frase</a>
                @endcan

                {{-- @can('redessociales-listar')
                    <a class="collapse-item {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['RRSS']) ? 'active' : '' }}"
                        href="{{ route('rrss.index') }}"><i class="fa-solid fa-rss"></i> Redes Sociales</a>
                @endcan --}}

                @can('testimonios-listar')
                    <a class="collapse-item {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['Testimony']) ? 'active' : '' }}"
                        href="{{ route('testimonio.index') }}"><i class="fa-regular fa-comment-dots"></i> Testimonios</a>
                @endcan

                @can('diagnostico-listar')
                    <a class="collapse-item {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['Diagnosis']) ? 'active' : '' }}"
                        href="{{ route('autodiagnostico.index') }}"><i class="fa-solid fa-stethoscope"></i>
                        Autodiagnóstico</a>
                @endcan

                @can('biografia-listar')
                    <a class="collapse-item {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['Biography']) ? 'active' : '' }}"
                        href="{{ route('biography.index') }}"><i class="fa-solid fa-user-doctor"></i> Biografía</a>
                @endcan

                @can('salud_tratamiento-listar')
                    <a class="collapse-item {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['SaludTratamiento', 'SaludFAQTratamiento']) ? 'active' : '' }}"
                        href="{{ route('tratamientos.index') }}"><i class="fa-solid fa-hand-holding-medical"></i>
                        Tratamientos</a>
                @endcan

            </div>
        </div>
    </li>
@endif

@if (auth()->user()->can('cms_inicio-listar') ||
        auth()->user()->can('cms_conoce_mas-listar'))
    @php
        if (isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['CMS_Page_Inicio', 'CMS_Page_ConoceMas'])) {
            $cmsConoceMasActive = 'active';
            $cmsConoceMasCollapsed = '';
            $cmsConoceMasExpanded = 'true';
            $cmsConoceMasShow = 'show';
        } else {
            $cmsConoceMasActive = '';
            $cmsConoceMasCollapsed = 'collapsed';
            $cmsConoceMasExpanded = 'false';
            $cmsConoceMasShow = '';
        }
    @endphp
    <li class="nav-item {{ $cmsConoceMasActive }}">
        <a class="nav-link {{ $cmsConoceMasCollapsed }}" href="#" data-toggle="collapse"
            data-target="#cConoceMas" aria-expanded="{{ $cmsConoceMasExpanded }}" aria-controls="cConoceMas">
            <i class="fa-solid fa-laptop"></i>
            <span>Página Web</span>
        </a>

        <div id="cConoceMas" class="collapse {{ $cmsConoceMasShow }}" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                @can('cms_inicio-listar')
                    <a class="collapse-item {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['CMS_Page_Inicio']) ? 'active' : '' }}"
                        href="{{ route('inicio.index') }}"><i class="fa-solid fa-house"></i> Inicio</a>
                @endcan

                @can('cms_conoce_mas-listar')
                    <a class="collapse-item {{ isset($mSelected) && Illuminate\Support\Str::contains($mSelected, ['CMS_Page_ConoceMas']) ? 'active' : '' }}"
                        href="{{ route('conoceMas.index') }}"><i class="fa-solid fa-desktop"></i> Conoce más!</a>
                @endcan

            </div>
        </div>
    </li>
@endif
