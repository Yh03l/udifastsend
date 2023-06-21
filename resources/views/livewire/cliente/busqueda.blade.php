<!-- Modal -->
<div wire:ignore.self class="modal fade" id="clienteBusquedaModal" tabindex="-1" role="dialog"
    aria-labelledby="clienteBusquedaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <x-form.titlemodal titulo="Buscar Cliente" />

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>

            <div class="modal-body mt-0">
                <form>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <input type="search" class="form-control bg-light border-0 small"
                                    placeholder="Ingrese 2 o más caracteres para iniciar la búsqueda"
                                    wire:model='cliente_a_buscar'>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered mt-2 table-sm">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class=" text-center">Cod.</th>
                                            <th>Cliente</th>
                                            <th>Número Identificación</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($cliente_listado as $resultado)
                                        <tr>
                                            <td>{{ $resultado->id }}</td>
                                            <td>{{ $resultado->nombre_completo }}</td>
                                            <td>{{ $resultado->numero_identificacion }}</td>
                                            <td>
                                                <button type="button" class="btn btn-one"
                                                    wire:click='seleccionarCliente({{ $resultado->id }}, "{{ $resultado->nombre_completo }}")'>Seleccionar</button>
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
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
