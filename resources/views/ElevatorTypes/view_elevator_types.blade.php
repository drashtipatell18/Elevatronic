@extends('layouts.main')
@section('content')
    <style>
        .dt-head-center {
            text-align: center;
        }
    </style>
    <div class="w-100 contenido">
        <div class="container-fluid container-mod">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="titulo">
                        <h4>Tipos de ascensor</h4>
                        <span>Tipos de ascensor</span>
                    </div>
                </div>
                <div class="col-md-6 mb-4 text-right">
                    <button type="button" class="btn-primario w-auto pl-3 pr-3" data-toggle="modal"
                        data-target="#tiposAscensores">
                        + Crear Nuevo
                    </button>
                </div>
                <div class="col-md-12">
                    <div class="box-contenido">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="buscador">
                                    <div class="form-group position-relative">
                                        <label for="customSearchBox"><i class="fal fa-search"></i></label>
                                        <input type="text" id="customSearchBox" placeholder="Buscar" class="w-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 text-right">
                                <!-- Botón de exportación con menú desplegable de Bootstrap 4 -->
                                <div class="dropdown">
                                    <button class="btn-gris" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <img src="
                                        {{ asset('img/iconos/export.svg') }}"
                                            alt="icono" class="mr-2"> Exportar Datos <i
                                            class="iconoir-nav-arrow-down"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <button class="dropdown-item" id="export_excel">Excel</button>
                                        <button class="dropdown-item" id="export_pdf">PDF</button>
                                        <button class="dropdown-item" id="export_copy">Copiar</button>
                                        <button class="dropdown-item" id="export_print">Imprimir</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 tbl table-responsive">
                                <table id="TiposAscensores" class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th align="center" class="text-center">NOMBRE DE TIPO</th>
                                            <th align="right" class="text-right">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($elevator_types as $index => $elevator_type)
                                            <tr class="td-head-center">
                                                <td>{{ $index + 1 }}</td>
                                                <td align="center">
                                                    <a href="{{ route('details.elevatortypes', $elevator_type->id) }}"
                                                        class="text-blue">
                                                        {{ $elevator_type->nombre_de_tipo_de_ascensor }}
                                                    </a>
                                                </td>
                                                <td align="right">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn-action dropdown-toggle"
                                                            data-toggle="dropdown">
                                                            Acción <i class="fas fa-chevron-down"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                                href="{{ route('details.elevatortypes', $elevator_type->id) }}">Ver
                                                                detalles</a>
                                                            <a class="dropdown-item edit-elevator-type" href="#"
                                                                data-elevator-type="{{ json_encode($elevator_type) }}"
                                                                data-toggle="modal"
                                                                data-target="#editartiposAscensores">Editar</a>
                                                            <a class="dropdown-item" href="" data-toggle="modal"
                                                                data-target="#modalEliminar{{ $elevator_type->id }}">Eliminar</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Crear Tipo de Ascensor-->
                <div class="modal left fade" id="tiposAscensores" tabindex="-1" role="dialog"
                    aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-family-Outfit-SemiBold">Crear Tipo de Ascensor</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form action="{{ route('insert.elevatortypes') }}" method="POST" class="formulario-modal"
                                id="createelevatorForm">
                                @csrf
                                <div class="modal-body body_modal">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="form-group">
                                                <label for="nombreAscensor">Nombre de Tipo de Ascensor</label>
                                                <input type="text" placeholder="Nombre de Tipo de Ascensor"
                                                    name="nombre_de_tipo_de_ascensor" id="nombreAscensor"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                                    <button type="submit" class="btn-gris btn-red mr-2">Guardar Cambios</button>
                                    <button type="submit" class="btn-gris btn-border"
                                        data-dismiss="modal">Cancelar</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- Modal editar Tipo de Ascensor-->
                <div class="modal left fade" id="editartiposAscensores" tabindex="-1" role="dialog"
                    aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-family-Outfit-SemiBold">Editar Tipo
                                    de Ascensor</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @isset($elevator_type)
                                <form action="" method="POST" class="formulario-modal" id="editelevatorForm">
                                    @csrf
                                    <div class="modal-body body_modal">
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="form-group">
                                                    <label for="nombreAscensor">Nombre de Tipo de
                                                        Ascensor</label>
                                                    <input type="text" placeholder="Nombre de Tipo de Ascensor"
                                                        name="nombre_de_tipo_de_ascensor" id="edit-nombre_de_tipo_de_ascensor"
                                                        value="" class="form-control">
                                                    @error('nombre_de_tipo_de_ascensor')
                                                        <span class="invalid-feedback" style="color: red">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                                        <button type="submit" class="btn-gris btn-red mr-2">Actualizar
                                            cambios</button>
                                        <button type="submit" class="btn-gris btn-border"
                                            data-dismiss="modal">Cancelar</button>
                                    </div>
                                </form>
                            @endisset
                        </div>
                    </div>
                </div>

                <!-- Modal Eliminar-->
                <div class="modal fade" id="modalEliminar{{ $elevator_type->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content border-radius-12">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div class="box1">
                                            <img src="{{ asset('img/iconos/trash.svg') }}" alt="trash"
                                                width="76">
                                            <p class="mt-3 mb-0">
                                                ¿Seguro que quieres eliminar <span id="item-name"></span>?
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer align-items-center justify-content-center">
                                @isset($elevator_type)
                                    <form id="delete-form" action="{{ route('destroy.elevatortypes', $elevator_type->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-gris btn-red">Sí</button>
                                        <button type="button" class="btn-gris btn-border" data-dismiss="modal">No</button>
                                    </form>
                                @endisset

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#TiposAscensores').DataTable({
                responsive: true,
                dom: 'tp',
                pageLength: 20, // Establece el número de registros por página a 8
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Reistros",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total registros)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Registros",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                },
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excluye la última columna
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excluye la última columna
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excluye la última columna
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excluye la última columna
                        },
                        customize: function(doc) {
                            doc.content[1].table.widths = Array(doc.content[1].table.body[0]
                                .length + 1).join('*').split('');
                            var columnCount = doc.content[1].table.body[0].length;
                            doc.content[1].table.body.forEach(function(row) {
                                row[0].alignment =
                                    'center'; // Center align the first column
                                row[columnCount - 1].alignment =
                                    'center'; // Center align the last column
                            });
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excluye la última columna
                        }
                    }
                    // 'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            // Mover el contenedor de búsqueda (filtro) a la izquierda
            $("#miTabla_filter").css('float', 'left');

            // Manejadores para los botones de exportación personalizados
            $("#export_excel").on("click", function() {
                table.button('.buttons-csv').trigger();
            });
            $("#export_pdf").on("click", function() {
                table.button('.buttons-pdf').trigger();
            });
            $("#export_copy").on("click", function() {
                table.button('.buttons-copy').trigger();
            });
            $("#export_print").on("click", function() {
                table.button('.buttons-print').trigger();
            });
            $('#customSearchBox').keyup(function() {
                table.search($(this).val()).draw();
            });
            setTimeout(function() {
                $(".alert-success").fadeOut(1000);
            }, 1000);
            setTimeout(function() {
                $(".alert-danger").fadeOut(1000);
            }, 1000);
            $('#createelevatorForm').validate({
                rules: {
                    nombre_de_tipo_de_ascensor: 'required'
                },
                messages: {
                    nombre_de_tipo_de_ascensor: 'Por favor, ingresa el nombre de tipo de ascensor'
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                }
            });

            $('#editartiposAscensores').on('shown.bs.modal', function() {
                const formId = $(this).find('form').attr('id');
                $('#' + formId).validate({
                    rules: {
                        nombre_de_tipo_de_ascensor: 'required'
                    },
                    messages: {
                        nombre_de_tipo_de_ascensor: 'Por favor, ingresa el nombre de tipo de ascensor'
                    },
                    errorElement: 'span',
                    errorPlacement: function(error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass('is-invalid').removeClass('is-valid');
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).removeClass('is-invalid').addClass('is-valid');
                    }
                });
            });

            $('.edit-elevator-type').on('click', function() {
                var elevator_type = $(this).data('elevator-type');

                $('#edit-nombre_de_tipo_de_ascensor').val(elevator_type.nombre_de_tipo_de_ascensor);
                $('#editelevatorForm').attr('action', '/tipos/de/ascensor/actualizar/' + elevator_type.id);
            });

            $('#tiposAscensores').on('hidden.bs.modal', function() {
                var form = $('#createelevatorForm');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            });
            $('#editartiposAscensores').on('hidden.bs.modal', function() {
                var form = $('#editelevatorForm');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            });
        });
    </script>
@endpush
