<?php

namespace App\Http\Livewire\Cliente;

use App\Models\Cliente;
use Livewire\Component;
use Livewire\WithPagination;

class Busqueda extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $updateMode = false;
    public $cliente_a_buscar_id, $cliente_a_buscar = '', $cliente_a_buscar_nombre;
    public $cliente_a_buscar_remitente = true;

    public function render()
    {
        $cliente_listado = [];
        if (strlen($this->cliente_a_buscar) >= 2) {
            $cliente_listado = Cliente::buscarCliente($this->cliente_a_buscar);
        }

        return view('livewire.cliente.busqueda', [
            'cliente_listado' => $cliente_listado
        ]);
    }

    public function cancelSearchCliente()
    {
        $this->cliente_a_buscar_id = null;
        $this->cliente_a_buscar = '';
        $this->cliente_a_buscar_nombre = '';
        $this->cliente_a_buscar_remitente = true;
    }

    public function seleccionarCliente($seleccionado_cliente_id, $seleccionado_cliente_nombre)
    {
        $this->cliente_a_buscar_id = $seleccionado_cliente_id;
        $this->cliente_a_buscar_nombre = $seleccionado_cliente_nombre;
        $this->emit('saludModalSearchcliente');
    }
}
