@extends('layouts.app')

@section('title')
    Gestión de Usuarios
@endsection

@section('page_title')
    Gestión de Usuarios
@endsection

@section('content')
    @can('usuario-crear')
        <div class="row">
            <div class="col-lg-12 margin-tb mb-2">
                <div class="pull-right">
                    <a class="btn btn-one" href="{{ route('users.create') }}"> Crear nuevo Usuario </a>
                </div>
            </div>
        </div>
    @endcan



    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <div class="card shadow">
        <div class="card-body">
            <table id="myTable" class="table table-bordered table-hover table-responsive-sm">
                <thead class=" thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nombre</th>
                        <th>E-mail</th>
                        <th>Roles</th>
                        <th>Estado</th>
                        <th width="280px">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $user)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if (!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $v)
                                        <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td>{{ $user->state == 1 ? 'Habilitado' : 'Deshabilitado' }}</td>
                            <td>
                                @can('usuario-leer')
                                <a class="btn btn-info" href="{{ route('users.show', $user->id) }}" title="Detalle"><i
                                    class="fa-regular fa-eye"></i></a>
                                @endcan

                                @can('usuario-editar')
                                    <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}" title="Editar"><i
                                            class="fa-solid fa-pen"></i></a>
                                @endcan

                                @can('usuario-eliminar')
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                                    <button type="submit" class="btn btn-danger" title="Eliminar"><i
                                            class="fa-solid fa-trash"></i></button>
                                    {!! Form::close() !!}
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('estilos')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            TableDatatablesRowreorder.init();
        });
        var TableDatatablesRowreorder = function() {

            var initTable1 = function() {
                var table = $('#myTable');

                var oTable = table.dataTable({

                    "responsive": true,

                    // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                    "language": {
                        sProcessing: "Procesando...",
                        sLengthMenu: "Mostrar _MENU_ registros",
                        sZeroRecords: "No se encontraron resultados",
                        sEmptyTable: "Ningún dato disponible en esta tabla",
                        sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
                        sInfoPostFix: "",
                        sSearch: "Buscar:",
                        sUrl: "",
                        sInfoThousands: ",",
                        sLoadingRecords: "Cargando...",
                        oPaginate: {
                            sFirst: "Primero",
                            sLast: "Último",
                            sNext: "Siguiente",
                            sPrevious: "Anterior"
                        },
                        oAria: {
                            sSortAscending: ": Activar para ordenar la columna de manera ascendente",
                            sSortDescending: ": Activar para ordenar la columna de manera descendente"
                        }
                    },


                    // Or you can use remote translation file
                    //"language": {
                    //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                    //},

                    // setup buttons extentension: http://datatables.net/extensions/buttons/
                    /* buttons: [{
                            extend: 'print',
                            name: 'Imprimir',
                            className: 'btn secondary btn-outline',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'pdf',
                            name: 'PDF',
                            className: 'btn red btn-outline',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'excel',
                            name: 'EXCEL',
                            className: 'btn green btn-outline ',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        }
                    ], */
                    /* columnDefs: [{
                            orderable: false,
                            targets: [6]
                        },
                        {
                            targets: [5],
                            orderable: true,
                            render: function(data, type, row) {
                                let dato = '';
                                switch (data) {
                                    case '1':
                                        dato = "Visible en App";
                                        break;
                                    case '2':
                                        dato = "No visible";
                                        break;

                                    default:
                                        dato = '';
                                        break;
                                }
                                return dato;
                            }
                        }
                    ], */
                    // setup rowreorder extension: http://datatables.net/extensions/rowreorder/

                    "order": [
                        [0, 'desc']
                    ],

                    "lengthMenu": [
                        [5, 10, 15, 20, 50, 100, -1],
                        [5, 10, 15, 20, 50, 100, "Todos"] // change per page values here
                    ],
                    // set the initial value
                    "pageLength": 10,

                    "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

                    // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                    // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
                    // So when dropdowns used the scrollable div should be removed.
                    //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

                    "initComplete": function(settings, json) {
                        $('#ContenedorLista').removeAttr('hidden');
                    }
                });
            }

            return {
                //main function to initiate the module
                init: function() {
                    if (!$().dataTable) {
                        return;
                    }
                    initTable1();
                }
            };

        }();
    </script>
@endsection
