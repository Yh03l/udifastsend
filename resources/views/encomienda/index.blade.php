@extends('layouts.app')

@section('title', 'Encomiendas')

@section('page_title', 'Encomiendas')

@section('content')
    <div class="card shadow">
        <div class="card-body">
            @livewire('encomienda.envio')
        </div>
    </div>
@endsection

@push('scripts_add')
    <script>
        window.addEventListener('alert', event => {
            toastr[event.detail.type](event.detail.message,
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
        });

        window.livewire.on('modalStore', () => {
            $('#createOrdenModal').modal('hide');
        });

        window.livewire.on('modalStateUpdate', () => {
            $('#editStateOrdenModal').modal('hide');
        });
    </script>
@endpush
