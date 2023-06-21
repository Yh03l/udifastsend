<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createOrdenModal" tabindex="-1" role="dialog" aria-labelledby="createOrdenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" style="max-width: 90%" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="text-uppercase modal-title text-one bold" id="createOrdenModalLabel">Crear orden de envío
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click.prevent="cancelOrdenModal()">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>

            <div class="modal-body mt-0">
                <form>
                    <div class="row">
                        <div class="col-12 col-md-2 col-lg-2">
                            <div wire:ignore.self class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <button class="nav-link {{ $TabOrigen ? 'active': '' }}" id="v-pills-origen-tab" data-toggle="pill" data-target="#v-pills-origen" type="button" role="tab" aria-controls="v-pills-origen" aria-selected="true" wire:click.prevent="openTab('TabOrigen')">Origen</button>
                                <button class="nav-link {{ $TabDestino ? 'active': '' }}" id="v-pills-destino-tab" data-toggle="pill" data-target="#v-pills-destino" type="button" role="tab" aria-controls="v-pills-destino" aria-selected="false" wire:click.prevent="openTab('TabDestino')">Destino</button>
                                <button class="nav-link {{ $TabRemitente ? 'active': '' }}" id="v-pills-home-tab" data-toggle="pill" data-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="false" wire:click.prevent="openTab('TabRemitente')">Remitente</button>
                                <button class="nav-link {{ $TabDestinatario ? 'active': '' }}" id="v-pills-profile-tab" data-toggle="pill" data-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false" wire:click.prevent="openTab('TabDestinatario')">Destinatario</button>
                                <button class="nav-link {{ $TabDetalleEncomienda ? 'active': '' }}" id="v-pills-messages-tab" data-toggle="pill" data-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false" wire:click.prevent="openTab('TabDetalleEncomienda')">Detalle encomienda</button>
                            </div>
                        </div>
                        <div class="col-12 col-md-10 col-lg-10">
                            <div class="tab-content" id="v-pills-tabContent">

                                <div class="tab-pane fade {{ $TabOrigen ? 'show active': '' }}" id="v-pills-origen" role="tabpanel" aria-labelledby="v-pills-origen-tab">
                                    <section>
                                        {{-- Origen-destino --}}
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="ciudad_origen"><strong>Origen:
                                                            <x-form.required />
                                                        </strong></label>
                                                    <select id="ciudad_origen" class="form-control form-select bg-light border-0 " wire:model='ciudad_origen'>
                                                        <option value="0">Seleccione</option>
                                                        @foreach ($listaCiudades as $ciudad)
                                                        <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('ciudad_origen')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="sucursal_origen"><strong>Sucursal:
                                                            <x-form.required />
                                                        </strong></label>
                                                    <select id="sucursal_origen" class="form-control form-select bg-light border-0 " wire:model='sucursal_origen'>
                                                        <option value="0">Seleccione</option>
                                                        @foreach ($listaSucursalOrigen as $sucursalO)
                                                        <option value="{{ $sucursalO->id }}">{{ $sucursalO->nombre }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('sucursal_origen')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>

                                <div class="tab-pane fade {{ $TabDestino ? 'show active': '' }}" id="v-pills-destino" role="tabpanel" aria-labelledby="v-pills-destino-tab">
                                    <section>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="ciudad_destino"><strong>Destino:
                                                            <x-form.required />
                                                        </strong></label>
                                                    <select id="ciudad_destino" class="form-control form-select bg-light border-0 " wire:model='ciudad_destino'>
                                                        <option value="0">Seleccione</option>
                                                        @foreach ($listaCiudades as $ciudadD)
                                                        <option value="{{ $ciudadD->id }}">{{ $ciudadD->nombre }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('ciudad_destino')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="sucursal_destino"><strong>Sucursal:
                                                            <x-form.required />
                                                        </strong></label>
                                                    <select id="sucursal_destino" class="form-control form-select bg-light border-0 " wire:model='sucursal_destino'>
                                                        <option value="0">Seleccione</option>
                                                        @foreach ($listaSucursalDestino as $sucursalD)
                                                        <option value="{{ $sucursalD->id }}">{{ $sucursalD->nombre }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('sucursal_destino')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>

                                <div class="tab-pane fade {{ $TabRemitente ? 'show active': '' }}" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                    {{-- Información del Remitente --}}
                                    <section>
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Carnet de Identidad:
                                                        <x-form.required />
                                                    </strong>
                                                    <div class="input-group mt-2">
                                                        <input type="number" min="1" class="form-control bg-light border-0 small" placeholder="Nro de C. I." aria-label="Search" aria-describedby="basic-addon2" wire:model='remitente_numero_identificacion' required>
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn btn-one" wire:click.prevent='buscarRemitentePorCI()'>
                                                                <i class="fas fa-search fa-sm"> Buscar</i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    @error('remitente_numero_identificacion')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-4">
                                                <div class="form-group">
                                                    <strong>Nombre(s)
                                                        <x-form.required />
                                                    </strong>
                                                    <input type="text" class="form-control bg-light border-0" wire:model="remitente_nombres" required>
                                                    @error('remitente_nombres')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <strong>Apellido Paterno
                                                        <x-form.required />
                                                    </strong>
                                                    <input type="text" class="form-control bg-light border-0" wire:model="remitente_apellido_paterno" required>
                                                    @error('remitente_apellido_paterno')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <strong>Apellido Materno</strong>
                                                    <input type="text" class="form-control bg-light border-0" wire:model="remitente_apellido_materno">
                                                    @error('remitente_apellido_materno')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-5 col-lg-6">
                                                <div class="form-group">
                                                    <strong>Celular
                                                        <x-form.required />
                                                    </strong>
                                                    <input type="text" class="form-control bg-light border-0" wire:model="remitente_celular" required>
                                                    @error('remitente_celular')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-7 col-lg-6">
                                                <div class="form-group">
                                                    <strong>Correo electrónico
                                                        <x-form.required />
                                                    </strong>
                                                    <input type="email" class="form-control bg-light border-0" wire:model="remitente_correo" required>
                                                    @error('remitente_correo')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>

                                <div class="tab-pane fade {{ $TabDestinatario ? 'show active': '' }}" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                    {{-- Información del Destinatario --}}
                                    <section>
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Carnet de Identidad:
                                                        <x-form.required />
                                                    </strong>
                                                    <div class="input-group mt-2">
                                                        <input type="number" min="1" class="form-control bg-light border-0 small" placeholder="Nro de C. I." aria-label="Search" aria-describedby="basic-addon2" wire:model='destinatario_numero_identificacion' required>
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn btn-one" wire:click.prevent='buscarDestinatarioPorCI()'>
                                                                <i class="fas fa-search fa-sm"> Buscar</i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    @error('destinatario_numero_identificacion')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-4">
                                                <div class="form-group">
                                                    <strong>Nombre(s)
                                                        <x-form.required />
                                                    </strong>
                                                    <input type="text" class="form-control bg-light border-0" wire:model="destinatario_nombres" required>
                                                    @error('destinatario_nombres')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <strong>Apellido Paterno
                                                        <x-form.required />
                                                    </strong>
                                                    <input type="text" class="form-control bg-light border-0" wire:model="destinatario_apellido_paterno" required>
                                                    @error('destinatario_apellido_paterno')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <strong>Apellido Materno</strong>
                                                    <input type="text" class="form-control bg-light border-0" wire:model="destinatario_apellido_materno">
                                                    @error('destinatario_apellido_materno')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-5 col-lg-4">
                                                <div class="form-group">
                                                    <strong>Celular
                                                        <x-form.required />
                                                    </strong>
                                                    <input type="text" class="form-control bg-light border-0" wire:model="destinatario_celular" required>
                                                    @error('destinatario_celular')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-7 col-lg-8">
                                                <div class="form-group">
                                                    <strong>Correo electrónico
                                                        <x-form.required />
                                                    </strong>
                                                    <input type="email" class="form-control bg-light border-0" wire:model="destinatario_correo" required>
                                                    @error('destinatario_correo')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>

                                <div class="tab-pane fade {{ $TabDetalleEncomienda ? 'show active': '' }}" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                    <section>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="tipo_envio"><strong>Tipo de envío:
                                                            <x-form.required />
                                                        </strong></label>
                                                    <select id="tipo_envio" class="form-control form-select bg-light border-0 " wire:model='tipo_envio'>
                                                        <option value="0">Seleccione</option>
                                                        @foreach ($listaTiposEnvio as $tipoenvio)
                                                        <option value="{{ $tipoenvio->id }}">{{ $tipoenvio->nombre }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('tipo_envio')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <strong>Detalle encomienda:
                                            <x-form.required />
                                        </strong>
                                        <div class="card mt-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-lg-6">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="tipo_encomienda"><strong>Tipo de encomienda <x-form.required /></strong></label>
                                                                    <select id="tipo_encomienda" class="form-control form-select bg-light border-0 " wire:model='tipo_encomienda'>
                                                                        <option value="0">Seleccione</option>
                                                                        @foreach ($listaTiposEncomienda as $tipoencomienda)
                                                                        <option value="{{ $tipoencomienda->id }}">{{
                                                                            $tipoencomienda->nombre }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('tipo_encomienda')
                                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group">
                                                                    <strong>Cantidad
                                                                        <x-form.required />
                                                                    </strong>
                                                                    <input type="number" min="1" class="form-control bg-light border-0" wire:model="encomienda_cantidad" required>
                                                                    @error('encomienda_cantidad')
                                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group">
                                                                    <strong>Peso en Kg
                                                                        <x-form.required />
                                                                    </strong>
                                                                    <input type="number" min="0" step="0.01" class="form-control bg-light border-0" wire:model="encomienda_peso" required>
                                                                    @error('encomienda_peso')
                                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group">
                                                                    <strong>Precio envío <br>(Bs)
                                                                        <x-form.required /></strong>
                                                                    <input type="text" class="form-control bg-light border-0" wire:model="encomienda_precio_envio" readonly>
                                                                    @error('encomienda_precio_envio')
                                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group">
                                                                    <strong>Recargo adicional <br>por volumen (Bs)</strong>
                                                                    <input type="number" min="0" step="0.01" class="form-control bg-light border-0" wire:model="encomienda_recargo_adicional_volumen">
                                                                    @error('encomienda_recargo_adicional_volumen')
                                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <strong>Contenido de la encomienda <x-form.required /></strong>
                                                                    <textarea wire:model="encomienda_contenido" cols="30" rows="10" class="form-control bg-light border-0"></textarea>
                                                                    @error('encomienda_contenido')
                                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <strong>Costo envío (Bs)
                                                                <x-form.required /></strong>
                                                            <input type="text" class="form-control bg-light border-0" wire:model="encomienda_costo_envio" readonly>
                                                            @error('encomienda_costo_envio')
                                                            <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 text-center">
                                                        <button wire:click.prevent="agregarDetalleEncomienda()" class="btn btn-success btn-sm"><i class="fa-solid fa-plus"></i> Agregar detalle</button>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="table-responsive text-xs">
                                                            <table class="table table-bordered mt-2 table-sm">
                                                                <thead class="thead-dark">
                                                                    <tr>
                                                                        <th>Tipo Contenido</th>
                                                                        <th>Contenido</th>
                                                                        <th class=" text-center">Cant.</th>
                                                                        <th>Peso</th>
                                                                        <th>Precio envío (Bs)</th>
                                                                        <th>Recargo adicional <br>por volumen (Bs)</th>
                                                                        <th>Costo envío (Bs)</th>
                                                                        <th class=" text-center">Opciones</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @forelse ($detallesEncomienda as $index => $detalle)
                                                                    <tr>
                                                                        <td>{{ $detalle['nombre_tipo_encomienda']}}</td>
                                                                        <td>{{ $detalle['contenido']}}</td>
                                                                        <td>{{ $detalle['cantidad']}}</td>
                                                                        <td>{{ $detalle['peso']}}</td>
                                                                        <td>{{ $detalle['precio_envio']}}</td>
                                                                        <td>{{ $detalle['recargo_adicional_volumen']}}</td>
                                                                        <td>{{ $detalle['costo_envio']}}</td>
                                                                        <td class="text-center">
                                                                            <button wire:click.prevent="eliminarDetalleEncomienda({{ $index }})" class="btn btn-danger btn-sm" title="Eliminar"><i class="fa-solid fa-trash"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                    @empty
                                                                    <tr>
                                                                        <td class="text-center" colspan="8">Sin registros</td>
                                                                    </tr>
                                                                    @endforelse
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancelOrdenModal()" class="btn btn-secondary close-btn" data-dismiss="modal">Cancelar</button>
                <button type="button" wire:click.prevent="storeOrdenModal()" class="btn btn-one close-modal w-50"><i class="fa-solid fa-floppy-disk"></i> Crear</button>
            </div>
        </div>
    </div>
</div>
