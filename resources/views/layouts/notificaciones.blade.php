@if ($notificaciones)
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fa-solid fa-bell"></i>
            <!-- Counter - Messages -->
            @if (count($notificaciones) > 0)
                <span class="badge badge-danger badge-counter">{{ count($notificaciones) }}</span>
            @endif
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="messagesDropdown" style="height: 300px; overflow: auto;">
            <h6 class="dropdown-header">
                Centro de Notificaciones
            </h6>

            @if (count($notificaciones) > 0)
                @foreach ($notificaciones as $notificacion)
                    <a class="dropdown-item d-flex align-items-center"
                        href="{{ config('app.url')}}/notificacion/{{ base64_encode($notificacion->id . '_' . $notificacion->id_contenido . '_1_' . Session::get('session_code')) }}">
                        <div class="font-weight-bold">
                            <div class="">{{ $notificacion->titulo }}</div>
                            <div class="small text-gray-500">{{ $notificacion->mensaje }}</div>
                        </div>
                    </a>
                @endforeach
            @else
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="font-weight-bold">
                        <div class="text-truncate">Sin notificaciones</div>
                    </div>
                </a>
            @endif

        </div>
    </li>
@else
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fa-regular fa-bell"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">
                Centro de Notificaciones
            </h6>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="font-weight-bold">
                    <div class="text-truncate">Sin notificaciones</div>
                </div>
            </a>
        </div>
    </li>
@endif
