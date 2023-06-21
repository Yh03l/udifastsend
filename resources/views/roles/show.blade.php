@extends('layouts.app')

@section('title')
    Rol - Detalle
@endsection

@section('page_title')
    Detalle del Rol
@endsection

@section('page_description')
@endsection

@section('content')

    <x-btn.back route="{{ route('roles.index') }}" />

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre: </strong>
                <h2>{{ $role->name }}</h2>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permisos:</strong>
                @if (!empty($rolePermissions))
                    @php
                        $nombreAnterior = '';
                    @endphp
                    @foreach ($rolePermissions as $v)
                        @php
                            $aux = explode('-', $v->name);
                            if ($nombreAnterior != strtoupper($aux[0])) {
                                $nombreAnterior = strtoupper($aux[0]);
                                echo '<br><br><strong class="mt-2">' . $nombreAnterior . '</strong><br>';
                            }
                        @endphp
                        <label class="label label-success">{{ $v->name }},</label>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
