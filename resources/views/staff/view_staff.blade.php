@extends('layouts.main')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@section('content')
    <style>
         #edit-sparepart{
            background-color: white !important;
        }
        .dt-head-center {
            text-align: center;
        }

        .positionbtn {
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

        #editimagenPrevioPersonal {
            width: 200px;
            height: 200px;
            overflow: hidden;
            /* Ensures that any overflowed part of the image is hidden */
            display: flex;
            align-items: center;
            /* Centers the image vertically */
            justify-content: center;
            /* Centers the image horizontally */
        }

        #editimagenPrevioPersonal img {
            width: 100%;
            height: 100%;
            object-fit: cover;

            /* Ensures that the image covers the container without distortion */
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
                        <h4>Personal</h4>
                        <span>Personal</span>
                    </div>
                </div>
                <div class="col-md-6 mb-4 text-right">
                    <button type="button" class="btn-primario w-auto pl-3 pr-3" data-toggle="modal"
                        data-target="#crearPersonal">
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
                                <table id="TiposAscensores" class="table">
                                    <thead>
                                        <tr>
                                            <th>FOTO</th>
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                            <th>POSICIÓN</th>
                                            <th>CORREO</th>
                                            <th>TELÉFONO</th>
                                            <th>UBICAR</th>
                                            <th align="right" class="text-right">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($staffs as $index => $staff)
                                            <tr class="td-head-center">
                                                <td>
                                                    @if ($staff->personalfoto)
                                                        <img src="{{ asset('images/' . $staff->personalfoto) }}"
                                                            alt="personal" width="52" height="52" class="img-table">
                                                    @else
                                                        <img src="{{ asset('img/fondo.png') }}" width="52"
                                                            height="52" class="img-table" alt="user">
                                                    @endif
                                                </td>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <a href="{{ route('view.staff', $staff->id) }}" class="text-blue">
                                                        {{ $staff->nombre }}
                                                    </a>
                                                </td>
                                                <td>{{ $staff->posición }}</td>
                                                <td>{{ $staff->correo }}</td>
                                                <td>{{ $staff->teléfono }}</td>
                                                <td>
                                                    <span class="adornomapa">
                                                        <img src="img/mapa.svg" alt="mapa" width="22"
                                                            height="22">
                                                    </span>
                                                </td>
                                                <td align="right">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn-action dropdown-toggle"
                                                            data-toggle="dropdown">
                                                            Acción <i class="fas fa-chevron-down"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                                href="{{ route('view.staff', $staff->id) }}">Ver
                                                                detalles</a>
                                                            <a class="dropdown-item edit-staff" href="#"
                                                                data-staff="{{ json_encode($staff) }}" data-toggle="modal"
                                                                data-target="#editarPersonal">Editar</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('destroy.staff', $staff->id) }}"
                                                                data-toggle="modal"
                                                                data-target="#modalEliminar{{ $staff->id }}">Eliminar</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Modal Eliminar-->
                                            <div class="modal fade" id="modalEliminar{{ $staff->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
                                                            @isset($staff)
                                                                <form id="delete-form"
                                                                    action="{{ route('destroy.staff', $staff->id) }}"
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
            </div>
        </div>
    </div>

    <!-- Modal Crear Personal-->
    <div class="modal left fade" id="crearPersonal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-family-Outfit-SemiBold">Crear Personal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('insert.staff') }}" method="POST" class="formulario-modal"
                    enctype="multipart/form-data" id="createstaff">
                    @csrf
                    <div class="modal-body body_modal">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>Foto de Personal</label>
                                        <div id="imagenPrevioPersonal"></div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="">
                                            <label for="imageUpload10" class="text-gris mt-4">Seleccione una
                                                imagen</label>
                                            <input type="file" id="imageUpload10" name="personalfoto"
                                                style="display: none;" accept="image/*" />
                                            <button type="button" id="cargarimagenpersonal" class="btn-gris">
                                                <i class="fas fa-arrow-to-top mr-2"></i>Subir Imagen
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" placeholder="Nombre"
                                                class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                                id="nombre">
                                            @error('nombre')
                                                <span class="invalid-feedback" style="color: red">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="posición">Posición</label>
                                            <select
                                                class="custom-select form-control @error('posición') is-invalid @enderror"
                                                name="posición" id="posición">
                                            </select>
                                            @error('posición')
                                                <span class="invalid-feedback" style="color: red">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-right w-100">
                                        <div class="form-group">
                                            <button type="button" data-toggle="modal" data-target="#crearposición"
                                                class="btn-gris positionbtn" id="toggleMarcaInput">
                                                + Agregar posición
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="correo">Correo</label>
                                            <input type="email" placeholder="Correo" name="correo"
                                                class="form-control @error('correo') is-invalid @enderror" id="correo">
                                            @error('correo')
                                                <span class="invalid-feedback" style="color: red">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="telefonoPersonal">Teléfono</label>
                                            <input type="number" name="teléfono" id="teléfono"
                                                class="form-control @error('teléfono') is-invalid @enderror"
                                                placeholder="Teléfono">
                                            @error('teléfono')
                                                <span class="invalid-feedback" style="color: red">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                        <button type="submit" class="btn-gris btn-red mr-2">Guardar Cambios</button>
                        <button type="button" class="btn-gris btn-border" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal editar Personal-->
    <div class="modal left fade" id="editarPersonal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-family-Outfit-SemiBold">Editar
                        Personal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @isset($staff)
                    <form action="{{ route('update.staff', $staff->id) }}" class="formulario-modal"
                        enctype="multipart/form-data" method="POST" id="editstaff">
                        @csrf
                        <div class="modal-body body_modal">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>Foto de Personal</label>
                                            {{-- <input type="file" id="editimageUpload10"> --}}
                                            <div id="editimagenPrevioPersonal">
                                                @if ($staff->personalfoto)
                                                    <img src="{{ asset('images/' . $staff->personalfoto) }}"
                                                         alt="Staff Image" id="edit-sparepart">
                                                @else
                                                    <img src="{{ asset('img/fondo.png') }}"
                                                        alt="Staff Image">
                                                @endif
                                            </div>



                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="">
                                                <label for="editimageUpload10" class="text-gris mt-4">Seleccione
                                                    una
                                                    imagen</label>
                                                <input type="file" id="editimageUpload10" name="personalfoto"
                                                    style="display: none;" accept="image/*" />
                                                <button type="button" id="editcargarimagenpersonal" class="btn-gris">
                                                    <i class="fas fa-arrow-to-top mr-2"></i>Subir
                                                    Imagen
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" placeholder="Nombre"
                                                    class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                                    value="" id="edit-nombre">
                                                @error('nombre')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="posición">Posición</label>
                                                <select
                                                    class="custom-select form-control @error('posición') is-invalid @enderror"
                                                    name="posición" id="posición1">
                                                </select>
                                                @error('posición')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="text-right w-100">
                                            <div class="form-group">
                                                <button type="button" data-toggle="modal" data-target="#crearposición"
                                                    class="btn-gris positionbtn" id="toggleMarcaInput">
                                                    + Agregar posición
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="correo">Correo</label>
                                                <input type="email" placeholder="Correo"
                                                    class="form-control @error('correo') is-invalid @enderror" name="correo"
                                                    value="" id="edit-correo">
                                                @error('correo')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="telefonoPersonal">Teléfono</label>
                                                <input type="number" name="teléfono" id="edit-teléfono"
                                                    class="form-control @error('teléfono') is-invalid @enderror"
                                                    value="" placeholder="Teléfono">
                                                @error('teléfono')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                            <button type="submit" class="btn-gris btn-red mr-2">Actualizar
                                cambios</button>
                            <button type="button" class="btn-gris btn-border" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                @endisset
            </div>
        </div>
    </div>

    {{-- Model Crear Posición --}}
    <div class="modal left fade" id="crearposición" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-family-Outfit-SemiBold">Crear Posición</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="col-md-12" id="marcaInputSection" style="">
                    <form method="POST" id="posiciónForm">
                        @csrf
                        <div class="form-group">
                            <label>Ingresar Posición</label>
                            <input type="text" placeholder="Ingresar posición" name="position" id="position"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn-primario w-auto pl-3 pr-3" id="submitPosición">
                                Entregar
                            </button>
                            <button type="button" class="btn-primario w-auto pl-3 pr-3" id="cancelPosición">
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#posiciónForm').on('keypress', function(e) {
                if (e.which === 13) { // 13 is the Enter key code
                    e.preventDefault();
                    return false;
                }
            });

            function getPosition(edit) {
                // Destroy existing Select2 instances if they exist
                if ($('#position').data('select2')) {
                    $('#position').select2('destroy');
                }
                if ($('#position1').data('select2')) {
                    $('#position1').select2('destroy');
                }

                // Perform the AJAX call to get position data
                $.ajax({
                    type: "GET",
                    url: "{{ route('getPosition') }}",
                    dataType: "JSON",
                    success: function(response) {
                        // Clear the current options and append the retrieved options to the select elements
                        $("#posición, #posición1").empty();
                        $("#posición, #posición1").append(
                            '<option value="" class="d-none">Seleccionar opción</option>'
                        ); // Add placeholder option

                        $.each(response, function() {
                            $("#posición, #posición1").append(
                                `<option value='${this.id}'>${this['position']}</option>`
                            );
                        });

                        // Initialize Select2 on the select element with placeholder
                        $('#posición').select2({
                            placeholder: "Seleccionar posición",
                            allowClear: true
                        });

                        // Initialize Select2 on the select element with placeholder
                        $('#posición1').select2({
                            placeholder: "Seleccionar posición",
                            allowClear: true
                        });

                        // If edit is true and has a valid ID, set the selected value
                        if (edit) {
                            $('#position1').val(edit).trigger('change');
                            console.log(edit);
                        }
                    }
                });
            }

            // Initial call to populate positions
            getPosition();

            // Handle the submit button click
            $('#submitPosición').click(function(e) {
                e.preventDefault(); // Prevent default form submission
                var formData = new FormData();
                formData.append('position', $('#position').val());

                // Send AJAX request
                $.ajax({
                    type: "POST",
                    url: "{{ route('insert.position') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Handle success response
                        getPosition(); // Refresh the position list
                        $('#cancelPosición').click(); // Close the modal
                    },
                    error: function(xhr) {
                        // Handle error response
                        console.error('Error:', xhr.responseText);
                    }
                });
            });

            // Handle the cancel button click
            $('#cancelPosición').click(function() {
                $("#crearposición").modal('hide');
            });

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

            $('#cargarimagenpersonal').click(function() {
                $('#imageUpload10').click();
            });

            $('#imageUpload10').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagenPrevioPersonal').html('<img src="' + e.target.result +
                        '" width="200" height="200" alt="Preview Image">');
                    $('#imagenPrevioPersonal').show();
                }
                reader.readAsDataURL(this.files[0]);
            });

            function updateImagePreview(imageUrl) {
                $('#editimagenPrevioPersonal').empty();
                $('#editimagenPrevioPersonal').html('<img src="' + imageUrl +
                    '" width="200" height="200" alt="Preview Image">');
            }

            $('#editimageUpload10').change(function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        updateImagePreview(e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
            $('#editcargarimagenpersonal').click(function() {
                $('#editimageUpload10').click();
            });

            $('#editimageUpload10').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#editimagenPrevioPersonal').css('background-image', 'url(' + e.target.result + ')');
                    $('#editimagenPrevioPersonal').show();
                }
                reader.readAsDataURL(this.files[0]);
            });

            $('#editimageUpload10').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    // Update the background image of the preview div
                    $('#editimagenPrevioPersonal').css('background-image', 'url(' + e.target.result +
                        ')');

                    // Hide any existing image tags inside the preview div
                    $('#editimagenPrevioPersonal').find('img').remove();

                    // Show the preview div (in case it was hidden)
                    $('#editimagenPrevioPersonal').show();

                    // Optionally, add a new img element if needed
                    $('#editimagenPrevioPersonal').append('<img src="' + e.target.result +
                        '" width="200" height="200" alt="Preview Image">');
                }
                reader.readAsDataURL(this.files[0]);
            });


            $('#createstaff').validate({
                rules: {
                    nombre: "required",
                    posición: "required",
                    correo: {
                        // required: true,
                        email: true
                    },
                    teléfono: {
                        // required: true,
                        digits: true
                    }
                },
                messages: {
                    nombre: "Por favor, ingrese el nombre",
                    posición: "Por favor, seleccione la posición",
                    correo: {
                        required: "Por favor, ingrese el correo",
                        email: "Por favor, ingrese un correo válido"
                    },
                    teléfono: {
                        required: "Por favor, ingrese el teléfono",
                        digits: "Por favor, ingrese solo números"
                    }
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

            $('#editstaff').validate({
                rules: {
                    nombre: "required",
                    posición: "required",
                    correo: {
                        // required: true,
                        email: true
                    },
                    teléfono: {
                        // required: true,
                        digits: true
                    }
                },
                messages: {
                    nombre: "Por favor, ingrese el nombre",
                    posición: "Por favor, seleccione la posición",
                    correo: {
                        // required: "Por favor, ingrese el correo",
                        email: "Por favor, ingrese un correo válido"
                    },
                    teléfono: {
                        // required: "Por favor, ingrese el teléfono",
                        digits: "Por favor, ingrese solo números"
                    }
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

            $('.edit-staff').on('click', function() {
                var staff = $(this).data('staff');
                // Populate the modal with customer data
                $('#edit-nombre').val(staff.nombre);
                $('#posición1').val(staff.posición).trigger('change');
                $('#edit-correo').val(staff.correo);
                $('#edit-teléfono').val(staff.teléfono);
                $('#editimageUpload10').val('');

                var imageUrl = staff.personalfoto ?
                    "{{ asset('images/') }}/" + staff.personalfoto :
                    "{{ asset('img/fondo.png') }}";
                updateImagePreview(imageUrl);
                // Set the form action to the correct route
                $('#editstaff').attr('action', '/personal/actualizar/' + staff.id);
            });

            $('#crearPersonal').on('hidden.bs.modal', function() {
                var form = $('#createstaff');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            });
            $('#editarPersonal').on('hidden.bs.modal', function() {
                var form = $('#editstaff');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            });
        });
    </script>
@endpush
