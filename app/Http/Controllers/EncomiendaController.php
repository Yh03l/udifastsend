<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EncomiendaController extends Controller
{
    public static $mSelected = 'Encomiendas';

    function __construct()
    {
        $this->middleware('permission:encomienda-listar|encomienda-crear|encomienda-leer|encomienda-editar|encomienda-eliminar', ['only' => ['index', 'show']]);
        $this->middleware('permission:encomienda-crear', ['only' => ['create', 'store']]);
        $this->middleware('permission:encomienda-leer', ['only' => ['show']]);
        $this->middleware('permission:encomienda-editar', ['only' => ['edit', 'update']]);
        $this->middleware('permission:encomienda-eliminar', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('encomienda.index', with([
            'mSelected' => self::$mSelected,
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
