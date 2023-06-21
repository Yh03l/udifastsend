@extends('layouts.app')

@section('title')
    Usuario - Editar
@endsection

@section('page_title')
    Editar Usuario
@endsection

@section('page_description')
@endsection

@section('content')

    <x-btn.back route="{{ route('users.index') }}" />


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>¡Ups!</strong> Algo anda mal.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id]]) !!}
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
                <div class="input-group mb-3">
                    {!! Form::password('password', [
                        'id' => 'password',
                        'placeholder' => '',
                        'class' => 'form-control',
                        'aria-label' => 'Contraseña',
                        'aria-describedby' => 'btnpass',
                    ]) !!}
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="btnpass" onclick="mostrarClave();"><i
                                class="fa-solid fa-eye-slash"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Confirmar Contraseña:</strong>
                <div class="input-group mb-3">
                    {!! Form::password('confirm-password', [
                        'id' => 'confirm-password',
                        'placeholder' => '',
                        'class' => 'form-control',
                        'aria-label' => 'Contraseña Confirmar',
                        'aria-describedby' => 'btnpassconfirm',
                    ]) !!}
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="btnpassconfirm"
                            onclick="mostrarClaveConfirm();"><i class="fa-solid fa-eye-slash"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Rol:</strong>
                {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control', 'multiple']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="state" name="state"
                    {{ $user->state == '1' ? 'checked' : '' }}>
                <strong class="form-check-label" for="state">Habilitado</strong>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-one btn-lg w-50"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </div>

    </div>
    {!! Form::close() !!}

@endsection

@push('scripts_add')
    <script>
        function mostrarClave() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
                $('#btnpass').empty().append('<i class="fa-solid fa-eye-slash"></i>');
            } else {
                x.type = "password";
                $('#btnpass').empty().append('<i class="fa-solid fa-eye"></i>');
            }
        }

        function mostrarClaveConfirm() {
            var x = document.getElementById("confirm-password");
            if (x.type === "password") {
                x.type = "text";
                $('#btnpassconfirm').empty().append('<i class="fa-solid fa-eye-slash"></i>');
            } else {
                x.type = "password";
                $('#btnpassconfirm').empty().append('<i class="fa-solid fa-eye"></i>');
            }
        }
    </script>
@endpush
