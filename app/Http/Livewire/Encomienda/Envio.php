<?php

namespace App\Http\Livewire\Encomienda;

use App\Models\BitacoraEncomienda;
use App\Models\Ciudade;
use App\Models\Cliente;
use App\Models\DetallesEncomienda;
use App\Models\Empleado;
use App\Models\Encomienda;
use App\Models\EstadosEncomienda;
use App\Models\Sucursale;
use App\Models\TiposEncomienda;
use App\Models\TiposEnvio;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Envio extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $updateMode = false;
    public $search = '';
    public $perPage = '25';

    public $TabOrigen = true;
    public $TabDestino = false;
    public $TabRemitente = false;
    public $TabDestinatario = false;
    public $TabDetalleEncomienda = false;


    public $detalle, $estado, $eliminado, $encomienda_id;

    public $ciudad_origen, $ciudad_destino;
    public $sucursal_origen, $sucursal_destino;

    public $listaTiposEncomienda = [], $listaSucursalOrigen = [], $listaSucursalDestino = [];

    public
        $remitente_id,
        $remitente_nombres,
        $remitente_apellido_paterno,
        $remitente_apellido_materno,
        $remitente_numero_identificacion,
        $remitente_correo,
        $remitente_celular;

    public
        $destinatario_id,
        $destinatario_nombres,
        $destinatario_apellido_paterno,
        $destinatario_apellido_materno,
        $destinatario_numero_identificacion,
        $destinatario_correo,
        $destinatario_celular;

    public $tipo_envio, $tarifa_total_envio = 0, $pagado = false;

    public
        $tipo_encomienda = 0,
        $tipo_encomienda_nombre = '',
        $encomienda_contenido = '',
        $encomienda_cantidad = 1,
        $encomienda_peso = 0,
        $encomienda_precio_envio = 0,
        $encomienda_recargo_adicional_volumen = 0,
        $encomienda_costo_envio = 0;

    public $detallesEncomienda = [];

    public $encomienda_ultima_bitacora_id, $encomienda_estado;

    public function render()
    {
        $this->listaTiposEncomienda = TiposEncomienda::obtenerDatosParaListado();
        $dataList = Encomienda::where('eliminado', 0)
            ->where(function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                    ->orWhere('observaciones', 'like', '%' . $this->search . '%');
            })->orderBy('id', 'DESC')->paginate($this->perPage);
        return view('livewire.encomienda.envio', [
            'dataList' => $dataList,
            'listaTiposEnvio' => TiposEnvio::obtenerDatosParaListado(),
            'listaTiposEncomienda' => $this->listaTiposEncomienda,
            'listaCiudades' => Ciudade::obtenerDatosParaListado(),
            'detallesEncomienda' => $this->detallesEncomienda,
            'listaEstadosEncomienda' => EstadosEncomienda::obtenerDatosParaListado(),
        ]);
    }

    public function openTab($nameTab)
    {
        $this->TabOrigen =  ($nameTab == 'TabOrigen') ? true : false;
        $this->TabDestino =  ($nameTab == 'TabDestino') ? true : false;
        $this->TabRemitente =  ($nameTab == 'TabRemitente') ? true : false;
        $this->TabDestinatario =  ($nameTab == 'TabDestinatario') ? true : false;
        $this->TabDetalleEncomienda =  ($nameTab == 'TabDetalleEncomienda') ? true : false;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    function cancelOrdenModal()
    {
    }

    function storeOrdenModal()
    {
        $validatedData = $this->validate([
            'ciudad_origen' => 'required|numeric|min:1',
            'ciudad_destino' => 'required|numeric|min:1',
            'sucursal_origen' => 'required|numeric|min:1',
            'sucursal_destino' => 'required|numeric|min:1',

            'remitente_numero_identificacion' => 'required|numeric|min:1',
            'remitente_nombres' => 'required|string',
            'remitente_apellido_paterno' => 'required|string',
            'remitente_apellido_materno' => 'nullable|string',
            'remitente_correo' => 'nullable|email',
            'remitente_celular' => 'required|numeric|min:1',

            'destinatario_numero_identificacion' => 'required|numeric|min:1',
            'destinatario_nombres' => 'required|string',
            'destinatario_apellido_paterno' => 'required|string',
            'destinatario_apellido_materno' => 'nullable|string',
            'destinatario_correo' => 'nullable|email',
            'destinatario_celular' => 'required|numeric|min:1',

            'tipo_envio' => 'required|numeric|min:1'
        ]);

        if (empty($this->detallesEncomienda)) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'Agregue la encomienda']);
            return;
        }

        //dd($this->detallesEncomienda);

        DB::beginTransaction();

        if (!$this->remitente_id) {
            $remitente = new Cliente();
            $remitente->nombres = $this->remitente_nombres;
            $remitente->apellido_paterno = $this->remitente_apellido_paterno;
            $remitente->apellido_materno = $this->remitente_apellido_materno ? $this->remitente_apellido_materno : '';
            $remitente->id_tipo_identificacion = 1;
            $remitente->numero_identificacion = $this->remitente_numero_identificacion;
            $remitente->correo = $this->remitente_correo;
            $remitente->cod_area = '591';
            $remitente->celular = $this->remitente_celular;
            $remitente->created_by_users_id = auth()->user()->id;
            $remitente->updated_by_users_id = auth()->user()->id;
            $remitente->eliminado = false;
            $remitente->save();

            $this->remitente_id = $remitente->id;
        }

        if (!$this->destinatario_id) {
            $destinatario = new Cliente();
            $destinatario->nombres = $this->destinatario_nombres;
            $destinatario->apellido_paterno = $this->destinatario_apellido_paterno;
            $destinatario->apellido_materno = $this->destinatario_apellido_materno ? $this->destinatario_apellido_materno : '';
            $destinatario->id_tipo_identificacion = 1;
            $destinatario->numero_identificacion = $this->destinatario_numero_identificacion;
            $destinatario->correo = $this->destinatario_correo ? $this->destinatario_correo : '';
            $destinatario->cod_area = '591';
            $destinatario->celular = $this->destinatario_celular;
            $destinatario->created_by_users_id = auth()->user()->id;
            $destinatario->updated_by_users_id = auth()->user()->id;
            $destinatario->eliminado = false;
            $destinatario->save();

            $this->destinatario_id = $destinatario->id;
        }

        $fecha_hora_recepcion = Carbon::now();

        $encomienda = new Encomienda();
        $encomienda->id_sucursal_origen = $this->sucursal_origen;
        $encomienda->id_sucursal_destino = $this->sucursal_destino;
        $encomienda->id_cliente_remitente = $this->remitente_id;
        $encomienda->id_cliente_destinatario = $this->destinatario_id;
        $encomienda->fecha_hora_recepcion = $fecha_hora_recepcion;
        $encomienda->id_empleado_recepcionista = Empleado::obtenerIdEmpleadoDeUsuario(auth()->user()->id);
        $encomienda->id_tipo_envio = $this->tipo_envio;
        $encomienda->tarifa_total_envio = $this->tarifa_total_envio;
        $encomienda->pagado = $this->pagado;
        $encomienda->created_by_users_id = auth()->user()->id;
        $encomienda->updated_by_users_id = auth()->user()->id;
        $encomienda->eliminado = false;
        $encomienda->observaciones = ' ';
        $encomienda->save();

        $this->tarifa_total_envio = 0;

        foreach ($this->detallesEncomienda as $item) {
            $detalle = new DetallesEncomienda();
            $detalle->id_encomienda = $encomienda->id;
            $detalle->id_tipo_encomienda = $item['id_tipo_encomienda'];
            $detalle->contenido = $item['contenido'];
            $detalle->cantidad = $item['cantidad'];
            $detalle->peso = $item['peso'];
            $detalle->precio_envio = $item['precio_envio'];
            $detalle->recargo_adicional_volumen = $item['recargo_adicional_volumen'];
            $detalle->costo_envio = number_format(($item['cantidad'] * $item['precio_envio']) + $item['recargo_adicional_volumen'], 2);
            $detalle->created_by_users_id = auth()->user()->id;
            $detalle->updated_by_users_id = auth()->user()->id;
            $detalle->eliminado = false;
            $detalle->save();

            $this->tarifa_total_envio = $this->tarifa_total_envio + $detalle->costo_envio;
        }

        $encomienda->tarifa_total_envio = $this->tarifa_total_envio;
        $encomienda->update();

        $bitacoraEncomienda = new BitacoraEncomienda();
        $bitacoraEncomienda->id_encomienda = $encomienda->id;
        $bitacoraEncomienda->id_estado_encomienda = 1;
        $bitacoraEncomienda->fecha_hora_registro = Carbon::now();
        $bitacoraEncomienda->created_by_users_id = auth()->user()->id;
        $bitacoraEncomienda->updated_by_users_id = auth()->user()->id;
        $bitacoraEncomienda->eliminado = false;
        $bitacoraEncomienda->save();

        DB::commit();

        session()->flash('message', 'Órden de encomienda registrada exitosamente.');

        $this->resetInputFieldsRemitente();
        $this->resetInputFieldsDestinatario();
        $this->limpiarFormularioDetalleEncomienda();

        $this->emit('modalStore');
    }



    function edit($id_encomienda = null)
    {
    }

    function delete($id_encomienda = null)
    {
    }

    public function updatedCiudadOrigen($value)
    {
        $this->sucursal_origen = 0;
        $this->listaSucursalOrigen = Sucursale::obtenerDatosParaListadoPorCiudad($value);
    }

    public function updatedCiudadDestino($value)
    {
        $this->sucursal_destino = 0;
        $this->listaSucursalDestino = Sucursale::obtenerDatosParaListadoPorCiudad($value);
    }

    public function updatedSucursalOrigen()
    {
        $this->calcularPrecioEnvio();
    }

    public function updatedSucursalDestino()
    {
        $this->calcularPrecioEnvio();
    }

    public function updatedTipoEncomienda($value)
    {
        $tipo_aux = TiposEncomienda::select('nombre')->where('id', $value)->first();
        if ($tipo_aux) {
            $this->tipo_encomienda_nombre = $tipo_aux->nombre;

            $this->calcularPrecioEnvio();
        }
    }

    private function resetInputFieldsRemitente()
    {
        $this->remitente_id = null;
        $this->remitente_nombres = null;
        $this->remitente_apellido_paterno = null;
        $this->remitente_apellido_materno = null;
        $this->remitente_correo = null;
        $this->remitente_celular = null;
    }

    private function resetInputFieldsDestinatario()
    {
        $this->destinatario_id = null;
        $this->destinatario_nombres = null;
        $this->destinatario_apellido_paterno = null;
        $this->destinatario_apellido_materno = null;
        $this->destinatario_correo = null;
        $this->destinatario_celular = null;
    }

    function buscarRemitentePorCI()
    {
        $validatedData = $this->validate([
            'remitente_numero_identificacion' => 'required|numeric|min:1',
        ]);

        $this->resetInputFieldsRemitente();

        $model = Cliente::where('numero_identificacion', $this->remitente_numero_identificacion)->where('eliminado', 0)->first();
        if ($model) {
            $this->remitente_id = $model->id;
            $this->remitente_nombres = $model->nombres;
            $this->remitente_apellido_paterno = $model->apellido_paterno;
            $this->remitente_apellido_materno = $model->apellido_materno;
            $this->remitente_correo = $model->correo;
            $this->remitente_celular = $model->celular;
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Cliente encontrado']);
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'No se encontró el cliente']);
        }
    }

    function buscarDestinatarioPorCI()
    {
        $validatedData = $this->validate([
            'destinatario_numero_identificacion' => 'required|numeric|min:1',
        ]);

        $this->resetInputFieldsDestinatario();

        $model = Cliente::where('numero_identificacion', $this->destinatario_numero_identificacion)->where('eliminado', 0)->first();
        if ($model) {
            $this->destinatario_id = $model->id;
            $this->destinatario_nombres = $model->nombres;
            $this->destinatario_apellido_paterno = $model->apellido_paterno;
            $this->destinatario_apellido_materno = $model->apellido_materno;
            $this->destinatario_correo = $model->correo;
            $this->destinatario_celular = $model->celular;
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Cliente encontrado']);
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'No se encontró el cliente']);
        }
    }

    public function agregarDetalleEncomienda()
    {
        $validatedData = $this->validate([
            'tipo_encomienda' => 'required|numeric|min:1',
            'encomienda_cantidad' => 'required|numeric|min:1',
            'encomienda_peso' => 'required|numeric|gt:0',
            'encomienda_recargo_adicional_volumen' => 'nullable|numeric|min:0',
            'encomienda_contenido' => 'required|string',
        ]);

        $this->detallesEncomienda[] = [
            'id_tipo_encomienda' => $this->tipo_encomienda,
            'nombre_tipo_encomienda' => $this->tipo_encomienda_nombre,
            'contenido' => $this->encomienda_contenido,
            'cantidad' => $this->encomienda_cantidad,
            'peso' => $this->encomienda_peso,
            'precio_envio' => $this->encomienda_precio_envio,
            'recargo_adicional_volumen' => (float)$this->encomienda_recargo_adicional_volumen,
            'costo_envio' => $this->encomienda_costo_envio,
        ];

        $this->limpiarFormularioDetalleEncomienda();
        //dd($this->detallesEncomienda);
    }

    public function eliminarDetalleEncomienda($index)
    {
        unset($this->detallesEncomienda[$index]);
        $this->detallesEncomienda = array_values($this->detallesEncomienda);
    }

    public function guardarDetallesEncomienda()
    {
        // Realiza la lógica necesaria para guardar los detalles en la base de datos
        // Puedes recorrer $this->detallesEncomienda y crear instancias de DetalleEncomienda
        // y guardarlos en la base de datos utilizando el modelo correspondiente

        // Después de guardar, puedes limpiar los detalles o realizar cualquier otra acción necesaria
        $this->detallesEncomienda = [];
    }

    public function updatedEncomiendaCantidad()
    {
        $this->calcularPrecioEnvio();
    }

    public function updatedEncomiendaPeso()
    {
        $this->calcularPrecioEnvio();
    }

    public function updatedEncomiendaRecargoAdicionalVolumen()
    {
        $this->calcularPrecioEnvio();
    }

    public function calcularPrecioEnvio()
    {
        if (!$this->sucursal_origen || !$this->sucursal_destino || !$this->tipo_envio || !$this->tipo_encomienda || !$this->encomienda_peso) {
            /* if (!$this->sucursal_origen) {
                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'Seleccione una sucursal de origen']);
            }
            if (!$this->sucursal_destino) {
                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'Seleccione una sucursal de destino']);
            }
            if (!$this->tipo_envio) {
                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'Seleccione un tipo de envío']);
            }
            if (!$this->tipo_encomienda) {
                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'Seleccione un tipo de encomienda']);
            } */
            $this->limpiarFormularioDetalleEncomienda();
            //$this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'Tarifa no configurada']);
            return;
        }

        $precio_unidad = DetallesEncomienda::obtenerPrecioEnvioPorUnidad($this->sucursal_origen, $this->sucursal_destino, $this->tipo_envio, $this->tipo_encomienda, $this->encomienda_peso);

        if (!$precio_unidad) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'Tarifa no configurada con los parámetros ingresados.']);
            return;
        }

        $this->encomienda_precio_envio = number_format(($precio_unidad * $this->encomienda_cantidad), 2);

        $this->encomienda_costo_envio = number_format($this->encomienda_precio_envio + (float)$this->encomienda_recargo_adicional_volumen, 2);
    }

    public function limpiarFormularioDetalleEncomienda()
    {
        $this->reset([
            'encomienda_contenido',
            'encomienda_cantidad',
            'encomienda_peso',
            'encomienda_precio_envio',
            'encomienda_recargo_adicional_volumen',
            'encomienda_costo_envio'
        ]);
    }

    public function cancelChangeStateOrdenModal()
    {
        $this->encomienda_ultima_bitacora_id = null;
        $this->encomienda_estado = null;
    }

    public function editStateOrden($id_encomienda)
    {
        $encomienda = Encomienda::find($id_encomienda);
        if ($encomienda) {
            $this->encomienda_id = $encomienda->id;
            $bitacora = $encomienda->bitacora_encomiendas->last();
            if ($bitacora) {
                $this->encomienda_estado = $bitacora->id_estado_encomienda;
            } else {
                $this->encomienda_estado = null;
            }
        }
    }

    public function updateStateOrdenModal()
    {
        $validatedData = $this->validate([
            'encomienda_estado' => 'required|numeric|min:1',
        ]);

        if (!$this->encomienda_id || !$this->encomienda_estado) {
            return;
        }

        $bitacoraEncomienda = new BitacoraEncomienda();
        $bitacoraEncomienda->id_encomienda = $this->encomienda_id;
        $bitacoraEncomienda->id_estado_encomienda = $this->encomienda_estado;
        $bitacoraEncomienda->fecha_hora_registro = Carbon::now();
        $bitacoraEncomienda->created_by_users_id = auth()->user()->id;
        $bitacoraEncomienda->updated_by_users_id = auth()->user()->id;
        $bitacoraEncomienda->eliminado = false;
        $bitacoraEncomienda->save();

        if ($this->encomienda_estado == 4) {
            $encomienda = Encomienda::find($this->encomienda_id);
            $encomienda->fecha_hora_entrega = Carbon::now();
            $encomienda->updated_by_users_id = auth()->user()->id;
            $encomienda->save();
        }

        session()->flash('message', 'Estado de Órden de encomienda actualizado exitosamente.');

        $this->encomienda_id = null;
        $this->encomienda_estado = null;

        $this->emit('modalStateUpdate');
    }
}
