@extends('layouts.app')

@section('title')
    Rol - Editar
@endsection

@section('page_title')
    Editar Rol
@endsection

@section('page_description')
@endsection

@section('content')

    <x-btn.back route="{{ route('roles.index') }}" />

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Ups!</strong> Algo anda mal.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permisos:</strong>
                <br />
                <div class="row">
                    @php
                        $nombreAnterior = '';
                    @endphp
                    <div>
                        <div>
                            <div>
                                @foreach ($permission as $value)
                                    @php
                                        $aux = explode('-', $value->name);
                                        if ($nombreAnterior != strtoupper($aux[0])) {
                                            $nombreAnterior = strtoupper($aux[0]);
                                            echo '</div></div></div><div class="col-12 col-sm-6 col-md-3 mt-4"><div class="card"><div class="card-body"><h5 class="card-title">' . $nombreAnterior . '</h5>';
                                        }
                                    @endphp
                                    <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                                        {{ $value->name }}</label>
                                    <br />
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-one btn-lg w-50"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </div>

    </div>
    {!! Form::close() !!}


@endsection
