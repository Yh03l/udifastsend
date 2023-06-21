@extends('layouts.app')

@section('title')
    Usuario - Crear Usuario
@endsection

@section('page_title')
    Crear nuevo Usuario
@endsection

@section('content')

    <x-btn.back route="{{ route('users.index') }}" />

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



    {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                {!! Form::text('name', null, ['placeholder' => '', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>E-mail:</strong>
                {!! Form::text('email', null, ['placeholder' => '', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Contraseña:</strong>
                {!! Form::text('password', $random_password, ['placeholder' => '', 'class' => 'form-control']) !!}
            </div>
        </div>
        {{-- <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Confirmar Contraseña:</strong>
                {!! Form::password('confirm-password', ['placeholder' => '', 'class' => 'form-control']) !!}
            </div>
        </div> --}}
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Rol:</strong>
                {!! Form::select('roles[]', $roles, [], ['class' => 'form-control', 'multiple']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="state" name="state">
                <strong class="form-check-label" for="state">Habilitado</strong>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-one btn-lg w-50"><i class="fa-solid fa-floppy-disk"></i> Crear</button>
        </div>

    </div>
    {!! Form::close() !!}

@endsection
