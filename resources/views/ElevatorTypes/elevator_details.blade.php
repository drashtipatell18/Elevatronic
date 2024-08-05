@extends('layouts.main')
@section('content')
    <style>
        .error {
            color: red;
        }
    </style>
    <div class="w-100 contenido">
        <div class="container-fluid container-mod">
            <div class="row">
                <div class="col-xl-10 col-lg-10 col-md-8 col-sm-8 col-8 mb-4">
                    <div class="titulo">
                        <h4>{{ $elevator_type->nombre_de_tipo_de_ascensor }}</h4>
                        <span>Tipos de ascensor >> {{ $elevator_type->nombre_de_tipo_de_ascensor }}</span>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-end">
                    <div class="dropdown btn-new">
                        <a class="btn-action dropdownMenuLink d-inline-block" href="#" role="button"
                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acción <i class="fas fa-chevron-down"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item edit-elevator-type" href="#"
                                data-elevator-type="{{ json_encode($elevator_type) }}" data-toggle="modal"
                                data-target="#editartiposAscensores">Editar</a>
                            <a class="dropdown-item texto-1 font-family-Inter-Regular"
                                href="{{ route('destroy.elevatortypes', $elevator_type->id) }}" data-toggle="modal"
                                data-target="#modalEliminar{{ $elevator_type->id }}">Eliminar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="box-contenido pb-0">
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-start justify-content-start gap-20 mb-6 box-detalle">
                                <div class="">
                                    <img src="{{ asset('img/tipo-ascensor.png') }}" alt="user">
                                </div>
                                <div class="align-items-start d-flex flex-column h-100 justify-content-between">
                                    <div>
                                        <h3>{{ $elevator_type->nombre_de_tipo_de_ascensor }}</h3>
                                        <span>Tipo de Ascensor</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-start gap-15 flex-wrap">
                                        <div class="option">
                                            <h4>{{ $elevator_type->id }}</h4>
                                            <p class="mb-0">ID elemento</p>
                                        </div>
                                        <div class="option">
                                            <h4>{{ $elevator_type->created_at->locale('es')->isoFormat('D MMMM YYYY, h:mm a') }}</h4>
                                            <p class="mb-0">Fecha registro</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <ul class="nav nav-tabs tabs-elevatronic" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#repuestos">Repuestos
                                            Asignados</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tipoAscensores">Ascensores del Tipo</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box-contenido">
                        <div class="tab-content contenido-elevatronic">
                            <div id="repuestos" class="tab-pane active"><br>
                                <div class="row">
                                    <div class="col-md-6 d-flex align-items-center justify-content-start mb-3">
                                        <h3 class="mb-0">Información de cliente</h3>
                                    </div>
                                    <div class="col-md-6 mb-3 text-right">
                                        <button type="button" class="btn-primario w-auto pl-3 pr-3" data-toggle="modal"
                                            data-target="#asignarRepuestos">
                                            + Asignar
                                        </button>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="buscador">
                                            <div class="form-group position-relative">
                                                <label for="customSearchBox"><i class="fal fa-search"></i></label>
                                                <input type="text" id="customSearchBox" placeholder="Buscar"
                                                    class="w-auto customSearchBox">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 text-right">
                                        <!-- Botón de exportación con menú desplegable de Bootstrap 4 -->
                                        <div class="dropdown">
                                            <button class="btn-gris" type="button" id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="{{ asset('img/iconos/export.svg') }}" alt="icono"
                                                    class="mr-2"> Exportar Datos <i class="iconoir-nav-arrow-down"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdownMenuButton">
                                                <button class="dropdown-item export_excel"
                                                    data-table="#repuestosAsignados">Excel</button>
                                                <button class="dropdown-item export_pdf"
                                                    data-table="#repuestosAsignados">PDF</button>
                                                <button class="dropdown-item export_copy"
                                                    data-table="#repuestosAsignados">Copiar</button>
                                                <button class="dropdown-item export_print"
                                                    data-table="#repuestosAsignados">Imprimir</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <table id="repuestosAsignados" class="table" style="width:100%">
                                            <thead>
                                                {{-- <tr>
                                                    <th>FOTO</th>
                                                    <th>ID</th>
                                                    <th>NOMBRE</th>
                                                    <th>PRECIO</th>
                                                    <th>LIMPIEZA</th>
                                                    <th>LUBRICACIÓN</th>
                                                    <th>AJUSTE</th>
                                                    <th>REVISIÓN</th>
                                                    <th>CAMBIO</th>
                                                    <th>SOLICITUD</th>
                                                </tr> --}}
                                                <tr>
                                                    <th>ID</th>
                                                    <th class="text-center">Nombre de Tipo de Ascensor</th>
                                                    <th>Repuesto</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($assginspares as $index => $assginspare)
                                                    <tr class="">
                                                        <td>{{ $index + 1 }}</td>
                                                        <td class="text-center">
                                                            {{ $assginspare->nombre_del_tipo_de_ascensor }}</td>
                                                        <td>{{ $assginspare->reemplazo }}</td>
                                                    </tr>
                                                @endforeach
                                                {{-- @foreach ($spareparts as $index => $sparepart)
                                                    <tr class="">
                                                        <td><img src="{{ asset('images/' . $sparepart->foto_de_repuesto) }}"
                                                                alt="personal" width="52" height="52"
                                                                class="img-table"></td>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>
                                                            <a href="{{ route('view.sparepart', $sparepart->id) }}"
                                                                class="text-blue">
                                                                {{ $sparepart->nombre }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $sparepart->precio }}</td>
                                                        <td>{{ $sparepart->frecuencia_de_limpieza }}</td>
                                                        <td>{{ $sparepart->frecuencia_de_lubricación }}</td>
                                                        <td>{{ $sparepart->frecuencia_de_ajuste }}</td>
                                                        <td>{{ $sparepart->frecuencia_de_revisión }}</td>
                                                        <td>{{ $sparepart->frecuencia_de_cambio }}</td>
                                                        <td>{{ $sparepart->frecuencia_de_solicitud }}</td>
                                                    </tr>
                                                @endforeach --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="tipoAscensores" class="tab-pane"><br>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <h3>Ascensores del Tipo</h3>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="buscador">
                                            <div class="form-group position-relative">
                                                <label for="customSearchBox1"><i class="fal fa-search"></i></label>
                                                <input type="text" id="customSearchBox1" placeholder="Buscar"
                                                    class="w-auto customSearchBox">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 text-right">
                                        <!-- Botón de exportación con menú desplegable de Bootstrap 4 -->
                                        <div class="dropdown">
                                            <button class="btn-gris" type="button" id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="{{ asset('img/iconos/export.svg') }}" alt="icono"
                                                    class="mr-2"> Exportar
                                                Datos <i class="iconoir-nav-arrow-down"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdownMenuButton">
                                                <button class="dropdown-item export_excel"
                                                    data-table="#repuestosAsignados">Excel</button>
                                                <button class="dropdown-item export_pdf"
                                                    data-table="#repuestosAsignados">PDF</button>
                                                <button class="dropdown-item export_copy"
                                                    data-table="#repuestosAsignados">Copiar</button>
                                                <button class="dropdown-item export_print"
                                                    data-table="#repuestosAsignados">Imprimir</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <table id="repuestosAsignados" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>FECHA ENTREGA</th>
                                                    <th>TIPO DE ASCENSOR</th>
                                                    <th>NOMBRE</th>
                                                    <th>CLIENTE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($elevators as $index => $elevator)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $elevator->fecha }}</td>
                                                        <td>{{ $elevator->tipo_de_ascensor }}</td>
                                                        <td>
                                                            <a href="{{ route('view.elevator', $elevator->id) }}"
                                                                class="text-blue">
                                                                {{ $elevator->nombre }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $elevator->cliente }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Asignar Repuesto-->
                <div class="modal left fade" id="asignarRepuestos" tabindex="-1" role="dialog"
                    aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-family-Outfit-SemiBold">Asignar Repuesto</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form action="{{ route('insert.asignarrepuesto') }}" method="POST" class="formulario-modal"
                                id="assginsparpart">
                                @csrf
                                <div class="modal-body body_modal">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" name="tipos_de_ascensors_id" value="{{ $elevator_type->id }}"> <!-- Hidden field for ID -->
                                            <div class="form-group">
                                                <label for="nombre_del_tipo_de_ascensor">Nombre de Tipo de Ascensor</label>
                                                <input type="text" placeholder="Nombre de Tipo de Ascensor"
                                                    name="nombre_del_tipo_de_ascensor" id="nombre_del_tipo_de_ascensor" value="{{ $elevator_type->nombre_de_tipo_de_ascensor}}" readonly>
                                                @error('nombre_del_tipo_de_ascensor')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="repuesto">Repuesto</label>
                                                <select class="custom-select form-control" name="reemplazo"
                                                    id="reemplazo">
                                                    <option value="" selected disabled>Seleccionar opción</option>
                                                    @foreach ($spareparts as $sparepart)
                                                        <option value="{{ $sparepart->nombre }}">{{ $sparepart->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('reemplazo')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                                    <button type="submit" class="btn-gris btn-red mr-2">Asignar respuesto</button>
                                    <button type="button" class="btn-gris btn-border"
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
                                <form id="delete-form" action="{{ route('destroy.elevatortypes', $elevator_type->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-gris btn-red">Sí</button>
                                </form>
                                <button type="button" class="btn-gris btn-border" data-dismiss="modal">No</button>
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

            var table = $('#repuestosAsignados').DataTable({
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
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            $(".export_excel").on("click", function() {
                var tableId = $(this).data("table");
                var table = $(tableId).DataTable();
                table.button('.buttons-csv').trigger();
            });
            $(".export_pdf").on("click", function() {
                var tableId = $(this).data("table");
                var table = $(tableId).DataTable();
                table.button('.buttons-pdf').trigger();
            });
            $(".export_copy").on("click", function() {
                var tableId = $(this).data("table");
                var table = $(tableId).DataTable();
                table.button('.buttons-copy').trigger();
            });
            $(".export_print").on("click", function() {
                var tableId = $(this).data("table");
                var table = $(tableId).DataTable();
                table.button('.buttons-print').trigger();
            });

            // $('#customSearchBox').keyup(function(){
            //     table.search($(this).val()).draw();
            // });
            $('.customSearchBox').keyup(function() {
                table.search($(this).val()).draw();
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

            $("#assginsparpart").validate({
                rules: {
                    nombre_del_tipo_de_ascensor: {
                        required: true,
                        minlength: 2 // Example: Minimum length of 2 characters
                        // Add more rules as needed
                    },
                    reemplazo: {
                        required: true
                    }
                    // Add rules for other fields here
                },
                messages: {
                    nombre_del_tipo_de_ascensor: {
                        required: "Por favor, ingrese el nombre del tipo de ascensor.",
                        minlength: "El nombre del tipo de ascensor debe tener al menos 2 caracteres."
                        // Add more messages as needed
                    },
                    reemplazo: "Por favor, seleccione un repuesto."
                    // Add messages for other fields here
                },
                errorElement: "span",
                errorPlacement: function(error, element) {
                    error.addClass("error");
                    if (element.is("select")) {
                        // If the error is for a select element, append it after the select element's parent div
                        error.insertAfter(element.closest('.form-group'));
                    } else {
                        // For other elements, insert the error after the element
                        error.insertAfter(element);
                    }
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass("is-invalid").addClass("is-valid");
                }
            });
            $('#editartiposAscensores').on('hidden.bs.modal', function() {
                var form = $('#editelevatorForm');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            });
            $('#asignarRepuestos').on('hidden.bs.modal', function() {
                var form = $('#assginsparpart');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            });
        });
    </script>
@endpush
