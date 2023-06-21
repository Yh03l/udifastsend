<!-- Modal -->
<div wire:ignore.self class="modal fade" id="editStateOrdenModal" tabindex="-1" role="dialog"
    aria-labelledby="editStateOrdenModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 90%" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="text-uppercase modal-title text-one bold" id="editStateOrdenModalLabel">Actualizar estado de
                    orden de envío
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    wire:click.prevent="cancelChangeStateOrdenModal()">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>

            <div class="modal-body mt-0">
                <form>
                    <div class="row">
                        <div class="col-12">
                            <section>
                                {{-- Estados --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="encomienda_estado"><strong>Estado:
                                                    <x-form.required />
                                                </strong></label>
                                            <select id="encomienda_estado"
                                                class="form-control form-select bg-light border-0 "
                                                wire:model='encomienda_estado'>
                                                <option value="0">Seleccione</option>
                                                @foreach ($listaEstadosEncomienda as $estado)
                                                    @if ($estado->id >= $encomienda_estado)
                                                    <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('encomienda_estado')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancelChangeStateOrdenModal()"
                    class="btn btn-secondary close-btn" data-dismiss="modal">Cancelar</button>
                <button type="button" wire:click.prevent="updateStateOrdenModal()"
                    class="btn btn-one close-modal w-50"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
            </div>
        </div>
    </div>
</div>
