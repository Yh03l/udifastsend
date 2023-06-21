<div class="modal fade" id="eliminarHCModal" tabindex="-1" role="dialog" aria-labelledby="eliminarHCModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="eliminarHCModalLabel">¿Desea eliminar esta Historia Clínica del paciente?
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="idHC" id="idHC" value="0">
                <span>Presiones "Sí" para confirmar.</span>
            </div>

            <div class="modal-footer">
                <button class="btn btn-one" type="button"
                    onclick="event.preventDefault(); document.getElementById('deleteHC-form').submit();"
                    id="mbtnQuitarMedicamentoReceta"> ¡Sí!
                    <form id="deleteHC-form" action="" method="POST"
                        style="display: none;">
                        @csrf
                        @method('DELETE')
                        <input id="id" name="id">
                    </form>
                </button>

                <button type="button" class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>

        </div>
    </div>
</div>
