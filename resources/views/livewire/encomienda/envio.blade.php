<div>
    @can('encomienda-crear')
        @include('encomienda.create')
        {{-- @include('cliente.modalSearch') --}}
    @endcan
    @can('encomienda-editar')
    @include('encomienda.changeState')
    {{-- @include('encomienda.update') --}}
    @endcan

    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        <strong>¡Ok!</strong> {{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
        <strong>¡Ups!</strong> revisa el formulario.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-12 margin-tb mb-2">
            @can('encomienda-crear')
            <div class=" float-start">
                <button type="button" class="btn btn-one" data-toggle="modal" data-target="#createOrdenModal">
                    <i class="fa-solid fa-square-plus fa-1x"> </i> Nueva orden de envío
                </button>
            </div>
            @endcan
            <div class="pull-right text-right">
                <input type="search" wire:model='search' class="form-control float-end w-25" placeholder="Buscar">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table id="myTable" class="table table-bordered mt-2">
            <thead class=" thead-dark">
                <tr>
                    <th class=" text-center">Cod.</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Remitente</th>
                    <th>Destinatario</th>
                    <th>Fecha recepción</th>
                    <th>Fecha entrega</th>
                    <th>Estado del pago</th>
                    <th class=" text-center">Estado</th>
                    <th class=" text-center">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataList as $value)
                <tr>
                    <td class=" text-center">{{ $value->id }}</td>
                    <td> <strong>{{ $value->sucursal_origen->ciudade->nombre}}</strong><br> <small>{{
                            $value->sucursal_origen->nombre}}</small></td>
                    <td> <strong>{{ $value->sucursal_destino->ciudade->nombre}}</strong><br> <small>{{
                            $value->sucursal_destino->nombre}}</small></td>
                    <td>{{ $value->cliente_remitente->nombre_completo()}}</td>
                    <td>{{ $value->cliente_destinatario->nombre_completo()}}</td>
                    <td>{{ $value->fecha_hora_recepcion}}</td>
                    <td>{{ $value->fecha_hora_entrega}}</td>
                    <td>{{ $value->pagado ? 'Pagado' : 'Por pagar'}}</td>
                    <td class=" text-center">
                        @if ($value->bitacora_encomiendas->isNotEmpty())
                        {{ $value->bitacora_encomiendas->last()->estados_encomienda->nombre}}
                        @else
                        Sin registros.
                        @endif
                    </td>
                    <td class=" text-center">
                        @can('encomienda-leer')
                        <a class="btn btn-info btn-sm" href="{{ route('encomiendas.show', $value->id) }}"
                            title="Ver Paciente"><i class="fa-solid fa-eye"></i></a>
                        @endcan


                        @can('encomienda-editar')
                        <button data-toggle="modal" data-target="#editStateOrdenModal" wire:click="editStateOrden({{ $value->id }})"
                            class="btn btn-secondary btn-sm" title="Editar"><i class="fa-solid fa-pen"></i></button>
                        @endcan

                        @can('encomienda-eliminar')
                        <button wire:click="delete({{ $value->id }})" class="btn btn-danger btn-sm" title="Eliminar"><i
                                class="fa-solid fa-trash"></i></button>
                        @endcan

                    </td>
                </tr>
                @empty
                <tr>
                    <td class="text-center" colspan="4">Sin registros</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        {{ $dataList->links() }}
    </div>
</div>
