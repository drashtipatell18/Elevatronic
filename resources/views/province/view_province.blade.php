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
                        <h4>Provincias</h4>
                        <span>Provincias</span>
                    </div>
                </div>
                <div class="col-md-6 mb-4 text-right">
                    <button type="button" class="btn-primario w-auto pl-3 pr-3" data-toggle="modal"
                        data-target="#createprovincias">
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
                                        <img src="{{ asset('img/iconos/export.svg') }}" alt="icono" class="mr-2">
                                        Exportar Datos <i class="iconoir-nav-arrow-down"></i>
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
                                <table id="TiposAscensores" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th class="text-center">NOMBRE DE PROVINCIA</th>
                                            <th align="right" class="text-right">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($provinces as $index => $province)
                                            <tr class="td-head-center">
                                                <td>{{ $index + 1 }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('view.province', $province->id) }}" class="text-blue">
                                                        {{ $province->provincia }}
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
                                                                href="{{ route('view.province', $province->id) }}">Ver
                                                                detalles</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('edit.province', $province->id) }}"
                                                                data-toggle="modal"
                                                                data-target="#editprovincias{{ $province->id }}">Editar</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('destroy.province', $province->id) }}"
                                                                data-toggle="modal"
                                                                data-target="#modalEliminar{{ $province->id }}">Eliminar</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Modal edit Provincia-->
                                            <div class="modal left fade" id="editprovincias{{ $province->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title font-family-Outfit-SemiBold">Actualizar
                                                                Provincia</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        @isset($province)
                                                            <form action="{{ route('update.province', $province->id) }}"
                                                                method="POST" class="formulario-modal" id="editprovinceForm">
                                                                @csrf
                                                                <div class="modal-body body_modal">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="provincia">Nombre de
                                                                                    Provincia</label>
                                                                                <input type="text"
                                                                                    placeholder="Nombre de Provincia"
                                                                                    name="provincia"
                                                                                    class="form-control @error('provincia') is-invalid @enderror"
                                                                                    id="provincia"
                                                                                    value="{{ old('provincia', isset($province) ? $province->provincia : '') }}">
                                                                                @error('provincia')
                                                                                    <span class="invalid-feedback"
                                                                                        style="color: red">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                                                                    <button type="submit"
                                                                        class="btn-gris btn-red mr-2">Actualizar cambios
                                                                    </button>
                                                                    <button type="button" class="btn-gris btn-border"
                                                                        data-dismiss="modal">Cancelar</button>
                                                                </div>
                                                            </form>
                                                        @endisset
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Eliminar-->
                                            <div class="modal fade" id="modalEliminar{{ $province->id }}" tabindex="-1" role="dialog"
                                                aria-labelledby="modelTitleId" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content border-radius-12">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                    <div class="box1">
                                                                        <img src="{{ asset('img/iconos/trash.svg') }}"
                                                                            alt="trash" width="76">
                                                                        <p class="mt-3 mb-0">
                                                                            ¿Seguro que quieres eliminar <span
                                                                                id="item-name"></span>?
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="modal-footer align-items-center justify-content-center">
                                                            @isset($province)
                                                                <form id="delete-form"
                                                                    action="{{ route('destroy.province', $province->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn-gris btn-red">Sí</button>
                                                                </form>
                                                            @endisset
                                                            <button type="button" class="btn-gris btn-border"
                                                                data-dismiss="modal">No</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Crear Provincia-->
                <div class="modal left fade" id="createprovincias" tabindex="-1" role="dialog"
                    aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-family-Outfit-SemiBold">Crear Provincia</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form action="{{ route('insert.province') }}" method="POST" class="formulario-modal"
                                id="createprovinceForm">
                                @csrf
                                <div class="modal-body body_modal">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="form-group">
                                                <label for="provincia">Nombre de Provincia</label>
                                                <input type="text" placeholder="Nombre de Provincia" name="provincia"
                                                    class="form-control" id="provincia">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                                    <button type="submit" class="btn-gris btn-red mr-2">Guardar Cambios</button>
                                    <button type="button" class="btn-gris btn-border"
                                        data-dismiss="modal">Cancelar</button>
                                </div>
                            </form>

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
                pageLength: 8, // Establece el número de registros por página a 8
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

            $('#createprovinceForm').validate({
                rules: {
                    provincia: "required"
                },
                messages: {
                    provincia: "Por favor, ingrese el nombre de la provincia"
                },
                errorElement: "span",
                errorPlacement: function(error, element) {
                    // Add the `invalid-feedback` class to the error element
                    error.addClass("invalid-feedback");
                    // Add error message after the invalid element
                    error.insertAfter(element);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass("is-invalid").addClass("is-valid");
                }
            });

            $('#editprovinceForm').validate({
                rules: {
                    provincia: "required"
                },
                messages: {
                    provincia: "Por favor, ingrese el nombre de la provincia"
                },
                errorElement: "span",
                errorPlacement: function(error, element) {
                    // Add the `invalid-feedback` class to the error element
                    error.addClass("invalid-feedback");
                    // Add error message after the invalid element
                    error.insertAfter(element);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass("is-invalid").addClass("is-valid");
                }
            });
        });
    </script>
@endpush
