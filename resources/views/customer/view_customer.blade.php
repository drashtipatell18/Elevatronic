@extends('layouts.main')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@section('content')
    <style>
        .dt-head-center {
            text-align: center;
        }

        .clienttypebtn {
            margin-right: 15px;
            font-size: 14px;
            padding: 2px 8px !important;
        }

        .select2-selection__arrow {
            top: 7px !important;
            width: 24px !important;
        }

        .select2-selection__placeholder {
            margin-bottom: 53px !important;
        }

        .select2-selection--single {
            height: 39px !important;
            display: flex !important;
            align-items: center !important;
            width: 100% !important;
        }

        .select2-container--default {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__clear {
            display: none;
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
                        <h4>Clientes</h4>
                        <span>Clientes</span>
                    </div>
                </div>
                <div class="col-md-6 mb-4 text-right">
                    <button type="button" class="btn-primario w-auto pl-3 pr-3" data-toggle="modal"
                        data-target="#crearCliente">
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
                                <table id="clientes" class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>RAZÓN SOCIAL</th>
                                            <th>TIPO DE CLIENTE</th>
                                            <th>RUC O DNI</th>
                                            <th>DIRECCIÓN</th>
                                            <th>PROVINCIA</th>
                                            <th align="right" class="text-right">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $index => $customer)
                                            <tr class="td-head-center">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $customer->nombre }}</td>
                                                <td>{{ $customer->tipo_de_cliente }}</td>
                                                <td>{{ $customer->ruc }}</td>
                                                <td>{{ $customer->dirección }}</td>
                                                <td>{{ $customer->provincia }}</td>
                                                <td align="right">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn-action dropdown-toggle"
                                                            data-toggle="dropdown">
                                                            Acción <i class="fas fa-chevron-down"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                                href="{{ route('view.customer', $customer->id) }}">Ver
                                                                detalles</a>
                                                            <a class="dropdown-item edit-customer" href="#"
                                                                data-customer="{{ json_encode($customer) }}"
                                                                data-toggle="modal" data-target="#editarCliente">Editar</a>
                                                            <a class="dropdown-item" href="" data-toggle="modal"
                                                                data-target="#modalEliminar{{ $customer->id }}">Eliminar</a>
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

                <div class="modal left fade" id="crearCliente" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-family-Outfit-SemiBold">
                                    Crear Cliente</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body body_modal">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="/clientes/insertar" method="POST" class="formulario-modal"
                                            id="customerForm">
                                            @csrf
                                            <div class="form-group">
                                                <label for="nombreRuc">Nombre o Razón Social</label>
                                                <input type="text" placeholder="Nombre o Razón Social" name="nombre"
                                                    id="nombre" class="form-control">
                                            </div>
                                            <div class="text-right w-100">
                                                <div class="form-group">
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#crearTipodeclient" class="btn-gris clienttypebtn"
                                                        id="toggleMarcaInput">
                                                        + Agregar Tipo de Cliente
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tipo_de_cliente">Tipo de Cliente</label>
                                                <select class="custom-select form-control" name="tipo_de_cliente"
                                                    id="tipo_de_cliente">
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="RUC">RUC o DNI</label>
                                                <input type="number" placeholder="RUC o DNI" name="ruc"
                                                    id="ruc" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="pais">País</label>
                                                <select class="custom-select form-control" name="país" id="país">
                                                    <option value="">Seleccionar opción</option>
                                                    <option value="perú" selected>Perú</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="provincia">Provincia</label>
                                                <select id="provincia" name="provincia" class="form-control">
                                                    <option value="">Select Province</option>
                                                    @foreach ($provinces as $province)
                                                        <option value="{{ $province }}">{{ $province }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="dirección">Dirección</label>
                                                <input type="text" placeholder="Dirección" name="dirección"
                                                    id="dirección" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="teléfono">Teléfono</label>
                                                <input type="number" placeholder="Teléfono" name="teléfono"
                                                    id="teléfono" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="teléfono_móvil">Teléfono Móvil</label>
                                                <input type="number" placeholder="Teléfono Móvil" name="teléfono_móvil"
                                                    id="teléfono_móvil" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="correo">Correo electrónico</label>
                                                <input type="email" placeholder="Correo electrónico"
                                                    name="correo_electrónico" id="correo_electrónico"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="Ncontacto">Nombre del conctacto</label>
                                                <input type="text" placeholder="Nombre del conctacto"
                                                    name="nombre_del_contacto" id="nombre_del_contacto"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="posición">Posición</label>
                                                <input type="text" placeholder="Posición" name="posición"
                                                    id="posición" class="form-control">
                                            </div>
                                            <div class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                                                <button type="submit" class="btn-gris btn-red mr-2">
                                                    Guardar Cambios
                                                </button>
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

                <!-- Modal agregar/editar clientes-->
                <div class="modal left fade" id="editarCliente" tabindex="-1" role="dialog"
                    aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-family-Outfit-SemiBold">editar
                                    Cliente</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body body_modal">
                                <div class="row">
                                    <div class="col-md-12">
                                        @isset($customer)
                                            <form action="" method="POST" class="formulario-modal"
                                                id="EditcustomerForm">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="nombreRuc">Nombre o Razón
                                                        Social</label>
                                                    <input type="text" placeholder="Nombre o Razón Social" name="nombre"
                                                        id="edit-nombre" value="" class="form-control">
                                                </div>
                                                <div class="text-right w-100">
                                                    <div class="form-group">
                                                        <button type="button" data-toggle="modal"
                                                            data-target="#crearTipodeclient" class="btn-gris clienttypebtn"
                                                            id="toggleMarcaInput">
                                                            + Agregar Tipo de Cliente
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tipo_de_cliente">Tipo de Cliente</label>
                                                    <select class="custom-select form-control" name="tipo_de_cliente"
                                                        id="tipo_de_cliente1">
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="RUC">RUC o DNI</label>
                                                    <input type="number" placeholder="RUC o DNI" name="ruc"
                                                        id="edit-ruc" value="" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="pais">País</label>
                                                    <select class="custom-select form-control" name="país" id="edit-país">
                                                        <option value="">Seleccionar opción</option>
                                                        <option
                                                            value="perú"{{ $customer->país == 'perú' ? 'selected' : '' }}>
                                                            Perú </option>
                                                    </select>

                                                </div>
                                                <div class="form-group">
                                                    <label for="provincia">Provincia</label>
                                                    <select class="custom-select form-control" name="provincia"
                                                        id="edit-provincia">
                                                        <option value="">
                                                            Seleccionar
                                                            opción
                                                        </option>
                                                        @foreach ($provinces as $province)
                                                            <option value="{{ $province }}"
                                                                {{ $customer->provincia == $province ? 'selected' : '' }}>
                                                                {{ $province }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('provincia')
                                                        <span class="invalid-feedback" style="color: red">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="dirección">Dirección</label>
                                                    <input type="text" placeholder="Dirección" name="dirección"
                                                        id="edit-dirección" value="" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="teléfono">Teléfono</label>
                                                    <input type="number" placeholder="Teléfono" name="teléfono"
                                                        id="edit-teléfono" value="" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="teléfono_móvil">Teléfono
                                                        Móvil</label>
                                                    <input type="number" placeholder="Teléfono Móvil" name="teléfono_móvil"
                                                        id="edit-teléfono_móvil" value="" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="correo">Correo
                                                        electrónico</label>
                                                    <input type="text" placeholder="Correo electrónico"
                                                        name="correo_electrónico" id="edit-correo_electrónico" value=""
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="Ncontacto">Nombre del
                                                        conctacto</label>
                                                    <input type="text" placeholder="Nombre del conctacto"
                                                        name="nombre_del_contacto" id="edit-nombre_del_contacto"
                                                        value="" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="posición">Posición</label>
                                                    <input type="text" placeholder="Posición" name="posición"
                                                        id="edit-posición" value="" class="form-control">
                                                </div>
                                                <div class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                                                    <button type="submit" class="btn-gris btn-red mr-2">
                                                        Actualizar Cambios

                                                    </button>
                                                    <button type="button" class="btn-gris btn-border"
                                                        data-dismiss="modal">Cancelar</button>
                                                </div>
                                            </form>
                                        @endisset

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Eliminar-->
                @isset($customer)
                    <div class="modal fade" id="modalEliminar{{ $customer->id }}" tabindex="-1" role="dialog"
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
                                    @isset($customer)
                                        <form id="delete-form" action="{{ route('destroy.customer', $customer->id) }}"
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
                @endisset
            </div>
        </div>

        {{-- Model Crear Tipodeclient --}}
        <div class="modal left fade" id="crearTipodeclient" tabindex="-1" role="dialog"
            aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-family-Outfit-SemiBold">Crear Tipo De Clients</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="col-md-12" id="marcaInputSection" style="">
                        <form method="POST" id="brandForm">
                            @csrf
                            <div class="form-group">
                                <label>Ingresar Tipo De Clients</label>
                                <input type="text" placeholder="Ingresar Tipo De Clients" name="tipo_de_client"
                                    id="tipo_de_client" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn-primario w-auto pl-3 pr-3" id="submitClientType">
                                    Entregar
                                </button>
                                <button type="button" class="btn-primario w-auto pl-3 pr-3" id="cancelClientType">
                                    Cancelar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {

            function getClientTypes(edit) {
                // Destroy existing Select2 instances if they exist
                if ($('#tipo_de_cliente').data('select2')) {
                    $('#tipo_de_cliente').select2('destroy');
                }
                if ($('#tipo_de_cliente1').data('select2')) {
                    $('#tipo_de_cliente1').select2('destroy');
                }

                // Perform the AJAX call to get client type data
                $.ajax({
                    type: "GET",
                    url: "{{ route('customertype') }}", // Ensure this route is correct
                    dataType: "JSON",
                    success: function(response) {
                        // Clear the current options and append the retrieved options to the select elements
                        $("#tipo_de_cliente, #tipo_de_cliente1").empty();
                        $("#tipo_de_cliente, #tipo_de_cliente1").append(
                            '<option value="" class="d-none">Seleccionar opción</option>'
                        ); // Add placeholder option

                        $.each(response, function() {
                            $("#tipo_de_cliente, #tipo_de_cliente1").append(
                                `<option value='${this.tipo_de_client}'>${this.tipo_de_client}</option>`
                            );
                        });

                        // // Initialize Select2 on the select elements with placeholder
                        $('#tipo_de_cliente1').select2({
                            // placeholder: "Seleccionar tipo de cliente",
                            // allowClear: true
                        });
                        $('#tipo_de_cliente').select2({
                            // placeholder: "Seleccionar tipo de cliente",
                            // allowClear: true
                        });

                        // If edit is true and has a valid ID, set the selected value
                        if (edit) {
                            $('#tipo_de_cliente1').val(edit).trigger('change');
                            console.log('Selected value set to:', edit); // Debugging
                        }
                    },
                    error: function(xhr) {
                        console.error('Error fetching client types:', xhr.responseText); // Debugging
                    }
                });
            }

            // Example call with an edit ID if applicable
            const editValue = '{{ $editValue ?? '' }}'; // Replace with actual edit value if available
            getClientTypes(editValue);


            $('#submitClientType').click(function(e) {
                e.preventDefault(); // Prevent default form submission
                var formData = new FormData();
                formData.append('tipo_de_client', $('#tipo_de_client').val());
                // Send AJAX request
                $.ajax({
                    type: "POST",
                    method: "POST",
                    dataType: "JSON",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('insert.customertype') }}", // Make sure to create this route
                    success: function(response) {
                        getClientTypes();
                        $('#cancelClientType').click();
                    }
                })
            });

            $('#cancelClientType').click(function() {
                $("#crearTipodeclient").modal('hide')
            });
            var table = $('#clientes').DataTable({
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
                            columns: ':not(:last-child)' // Exclude the last column
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

            $('div[id^="editarCliente"]').on('shown.bs.modal', function() {
                const formId = $(this).find('form').attr('id');
                $('#' + formId).validate({
                    rules: {
                        nombre: 'required',
                        tipo_de_cliente: 'required',
                        ruc: {
                            required: true,
                            digits: true,
                            minlength: 11,
                            maxlength: 11
                        },
                        país: 'required',
                        provincia: 'required',
                        dirección: 'required',
                        teléfono: {
                            required: true,
                            digits: true,
                            minlength: 9,
                            maxlength: 9
                        },
                        teléfono_móvil: {
                            required: true,
                            digits: true,
                            minlength: 9,
                            maxlength: 9
                        },
                        correo_electrónico: {
                            required: true,
                            email: true
                        },
                        nombre_del_contacto: 'required',
                        // posición: 'required'
                    },
                    messages: {
                        nombre: 'Por favor, ingresa el nombre o razón social',
                        tipo_de_cliente: 'Por favor, selecciona el tipo de cliente',
                        ruc: {
                            required: 'Por favor, ingresa el RUC o DNI',
                            digits: 'Por favor, ingresa solo dígitos',
                            minlength: 'El RUC debe tener exactamente 11 dígitos',
                            maxlength: 'El RUC debe tener exactamente 11 dígitos'
                        },
                        país: 'Por favor, selecciona el país',
                        provincia: 'Por favor, selecciona la provincia',
                        dirección: 'Por favor, ingresa la dirección',
                        teléfono: {
                            required: 'Por favor, ingresa el teléfono',
                            digits: 'Por favor, ingresa solo dígitos',
                            minlength: 'El teléfono debe tener exactamente 9 dígitos',
                            maxlength: 'El teléfono debe tener exactamente 9 dígitos'
                        },
                        teléfono_móvil: {
                            required: 'Por favor, ingresa el teléfono móvil',
                            digits: 'Por favor, ingresa solo dígitos',
                            minlength: 'El teléfono móvil debe tener exactamente 9 dígitos',
                            maxlength: 'El teléfono móvil debe tener exactamente 9 dígitos'
                        },
                        correo_electrónico: {
                            required: 'Por favor, ingresa un correo electrónico',
                            email: 'Por favor, ingresa un correo electrónico válido'
                        },
                        nombre_del_contacto: 'Por favor, ingresa el nombre del contacto',
                        posición: 'Por favor, ingresa la posición'
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
                        $(element).closest('.form-group').find('.invalid-feedback').remove();
                    }
                });
            });
            $('.edit-customer').on('click', function() {
                var customer = $(this).data('customer');
                // Populate the modal with customer data
                $('#edit-nombre').val(customer.nombre);
                $('#tipo_de_cliente1').val(customer.tipo_de_cliente).trigger('change');
                $('#edit-ruc').val(customer.ruc);
                $('#edit-país').val(customer.país);
                $('#edit-provincia').val(customer.provincia);
                $('#edit-dirección').val(customer.dirección);
                $('#edit-teléfono').val(customer.teléfono);
                $('#edit-teléfono_móvil').val(customer.teléfono_móvil);
                $('#edit-correo_electrónico').val(customer.correo_electrónico);
                $('#edit-nombre_del_contacto').val(customer.nombre_del_contacto);
                $('#edit-posición').val(customer.posición);

                // Set the form action to the correct route
                $('#EditcustomerForm').attr('action', '/clientes/actualizar/' + customer.id);
            });
            $('#customerForm').validate({
                rules: {
                    nombre: 'required',
                    tipo_de_cliente: 'required',
                    ruc: {
                        required: true,
                        digits: true,
                        minlength: 11,
                        maxlength: 11
                    },
                    país: 'required',
                    provincia: 'required',
                    dirección: 'required',
                    teléfono: {
                        required: true,
                        digits: true,
                        minlength: 9,
                        maxlength: 9
                    },
                    teléfono_móvil: {
                        required: true,
                        digits: true,
                        minlength: 9,
                        maxlength: 9
                    },
                    correo_electrónico: {
                        required: true,
                        email: true
                    },
                    nombre_del_contacto: 'required',
                    // posición: 'required'
                },
                messages: {
                    nombre: 'Por favor, ingresa el nombre o razón social',
                    tipo_de_cliente: 'Por favor, selecciona el tipo de cliente',
                    ruc: {
                        required: 'Por favor, ingresa el RUC o DNI',
                        digits: 'Por favor, ingresa solo dígitos',
                        minlength: 'El RUC debe tener exactamente 11 dígitos',
                        maxlength: 'El RUC debe tener exactamente 11 dígitos'
                    },
                    país: 'Por favor, selecciona el país',
                    provincia: 'Por favor, selecciona la provincia',
                    dirección: 'Por favor, ingresa la dirección',
                    teléfono: {
                        required: 'Por favor, ingresa el teléfono',
                        digits: 'Por favor, ingresa solo dígitos',
                        minlength: 'El teléfono debe tener exactamente 9 dígitos',
                        maxlength: 'El teléfono debe tener exactamente 9 dígitos'
                    },
                    teléfono_móvil: {
                        required: 'Por favor, ingresa el teléfono móvil',
                        digits: 'Por favor, ingresa solo dígitos',
                        minlength: 'El teléfono móvil debe tener exactamente 9 dígitos',
                        maxlength: 'El teléfono móvil debe tener exactamente 9 dígitos'
                    },
                    correo_electrónico: {
                        required: 'Por favor, ingresa un correo electrónico',
                        email: 'Por favor, ingresa un correo electrónico válido'
                    },
                    nombre_del_contacto: 'Por favor, ingresa el nombre del contacto',
                    posición: 'Por favor, ingresa la posición'
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
            $('#crearCliente').on('hidden.bs.modal', function() {
                var form = $('#customerForm');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            });
            $('#editarCliente').on('hidden.bs.modal', function() {
                var form = $('#EditcustomerForm');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            });
        });
    </script>
@endpush
