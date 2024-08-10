@extends('layouts.main')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@section('content')
    <style>
        .dt-head-center {
            text-align: center;
        }

        .employeebtn {
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

        #editimagenPrevioUsuario {
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

        #editimagenPrevioUsuario img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Ensures that the image covers the container without distortion */
        }
    </style>
    <div class="w-100 contenido">
        <div class="container-fluid container-mod">
            {{-- @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif --}}
            <div class="alert alert-success" style="display: none;"></div> <!-- Initially hidden -->
            @if (session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="titulo">
                        <h4>Usuarios</h4>
                        <span>Usuarios</span>
                    </div>
                </div>
                <div class="col-md-6 mb-4 text-right">
                    <button type="button" class="btn-primario w-auto pl-3 pr-3" data-toggle="modal"
                        data-target="#crearUsuario">
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
                                            <th>CORREO</th>
                                            <th>TELÉFONO</th>
                                            <th align="right" class="text-right">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $index => $user)
                                            <tr class="td-head-center">
                                                <td>
                                                    @if ($user->image)
                                                        <img src="{{ asset('images/' . $user->image) }}" alt="personal"
                                                            width="52" height="52" class="img-table">
                                                    @else
                                                        <img src="{{ asset('img/fondo.png') }}" alt="user"
                                                            width="52" height="52" class="img-table">
                                                    @endif
                                                </td>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <a href="{{ route('view.user', $user->id) }}" class="text-blue">
                                                        {{ $user->name }}
                                                    </a>
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td align="right">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn-action dropdown-toggle"
                                                            data-toggle="dropdown">
                                                            Acción <i class="fas fa-chevron-down"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                                href="{{ route('view.user', $user->id) }}">Ver
                                                                detalles</a>
                                                            <a class="dropdown-item edit-user" href="#"
                                                                data-user="{{ json_encode($user) }}" data-toggle="modal"
                                                                data-target="#editorUsuario">Editar</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('destroy.user', $user->id) }}"
                                                                data-toggle="modal"
                                                                data-target="#modalEliminar{{ $user->id }}">Eliminar</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Modal Eliminar-->
                                            <div class="modal fade" id="modalEliminar{{ $user->id }}" tabindex="-1"
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
                                                            @isset($user)
                                                                <form id="delete-form"
                                                                    action="{{ route('destroy.user', $user->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn-gris btn-red">Sí</button>
                                                                    <button type="button" class="btn-gris btn-border"
                                                                        data-dismiss="modal">No</button>
                                                                </form>
                                                            @endisset

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

    <!-- Modal Crear Usuario-->
    <div class="modal left fade" id="crearUsuario" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-family-Outfit-SemiBold">Crear Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('insert.user') }}" method="POST" class="formulario-modal"
                    enctype="multipart/form-data" id="createuserform">
                    @csrf
                    <div class="modal-body body_modal">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>Foto de usuario</label>
                                        <div id="imagenPrevioUsuario"></div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="">
                                            <label for="imageUploadUsuario" class="text-gris mt-4">Seleccione una
                                                imagen</label>
                                            <input type="file" id="imageUploadUsuario" name="image"
                                                style="display: none;" accept="image/*" />
                                            <button type="button" id="cargarimagenUsuario" class="btn-gris">
                                                <i class="fas fa-arrow-to-top mr-2"></i>Subir Imagen
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="Nombre de usuario">Nombre de usuario</label>
                                            <input type="text" placeholder="nombre de usuario" name="username"
                                                class="form-control @error('username') is-invalid @enderror"
                                                id="username" autocomplete="new-email" autoFill="off" />
                                            @error('username')
                                                <span class="invalid-feedback" style="color: red">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="NombreUsuario">Nombre</label>
                                            <input type="text" placeholder="Nombre" name="name" id="name"
                                                class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                                <span class="invalid-feedback" style="color: red">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="correoUsuario">Correo</label>
                                            <input type="text" placeholder="Correo" name="email" id="email"
                                                class="form-control @error('email') is-invalid @enderror">
                                            @error('email')
                                                <span class="invalid-feedback" style="color: red">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="telefonoUsuario">Teléfono</label>
                                            <input type="text" name="phone" id="phone" placeholder="Teléfono"
                                                class="form-control @error('phone') is-invalid @enderror">
                                            @error('phone')
                                                <span class="invalid-feedback" style="color: red">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="Empleado">Empleado</label>
                                            <select id="employee" name="employee"
                                                class="custom-select form-control @error('employee') is-invalid @enderror">
                                                <option value="">Seleccionar empleado</option>
                                            </select>
                                            @error('employee')
                                                <span class="invalid-feedback" style="color: red">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-right w-100">
                                        <div class="form-group">
                                            <button type="button" data-toggle="modal" data-target="#crearempleado"
                                                class="btn-gris employeebtn" id="toggleMarcaInput">
                                                + Agregar Empleado
                                            </button>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="contrasenaUser">Contraseña</label>
                                            <input type="password" name="password" id="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Contraseña" autocomplete="new-password">
                                            @error('password')
                                                <span class="invalid-feedback" style="color: red">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div> --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="contrasenaUser">Contraseña</label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-eye" id="togglePassword"
                                                            style="cursor: pointer;"></i>
                                                    </span>
                                                </div>
                                                <input type="password" name="password" id="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    placeholder="Contraseña" autocomplete="new-password">

                                            </div>
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

    <!-- Modal Editor Usuario-->
    <div class="modal left fade" id="editorUsuario" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-family-Outfit-SemiBold">Editar
                        Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @isset($user)
                    <form action="" method="POST" enctype="multipart/form-data" id="edituserform">
                        @csrf
                        @method('PUT')
                        <div class="modal-body body_modal">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>Foto de usuario</label>
                                            {{-- <div id="editimagenPrevioUsuario">
                                                @if ($user->image)
                                                    <img src="{{ asset('images/' . ($user->image ?? 'fondo.png')) }}"
                                                        id="edituser-image" width="200" height="200" alt="User Image">
                                                @endif
                                            </div> --}}

                                            <div id="editimagenPrevioUsuario">
                                                @if ($user->image)
                                                    <img src="{{ asset('images/' . $user->image) }}" id="edituser-image"
                                                        alt="Staff Image">
                                                @else
                                                    <img src="{{ asset('img/fondo.png') }}" id="edituser-image"
                                                        alt="Staff Image">
                                                @endif
                                            </div>



                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="">
                                                <label for="imageUploadUsuario" class="text-gris mt-4">Seleccione
                                                    una
                                                    imagen</label>
                                                <input type="file" id="editimageUploadUsuario" name="image"
                                                    style="display: none;" accept="image/*" />
                                                <button type="button" id="editcargarimagenUsuario" class="btn-gris">
                                                    <i class="fas fa-arrow-to-top mr-2"></i>Subir
                                                    Imagen
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="Nombre de usuario">Nombre
                                                    de usuario</label>
                                                <input type="text" placeholder="nombre de usuario" name="username"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    value="" id="edit-username">
                                                @error('username')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="NombreUsuario">Nombre</label>
                                                <input type="text" placeholder="Nombre" name="name" id="edit-name"
                                                    class="form-control @error('name') is-invalid @enderror" value="">
                                                @error('name')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="correoUsuario">Correo</label>
                                                <input type="email" placeholder="Correo" name="email" id="edit-email"
                                                    class="form-control @error('email') is-invalid @enderror" value="">
                                                @error('email')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="telefonoUsuario">Teléfono</label>
                                                <input type="number" name="phone" id="edit-phone" placeholder="Teléfono"
                                                    value="" class="form-control @error('phone') is-invalid @enderror">
                                                @error('phone')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="Empleado">Empleado</label>
                                                <select id="employee1" name="employee"
                                                    class="form-control @error('employee') is-invalid @enderror">
                                                    <option value="">Seleccionar
                                                        empleado</option>
                                                </select>
                                                @error('employee')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="text-right w-100">
                                            <div class="form-group">
                                                <button type="button" data-toggle="modal" data-target="#crearempleado"
                                                    class="btn-gris employeebtn" id="toggleMarcaInput">
                                                    + Agregar Empleado
                                                </button>
                                            </div>
                                        </div>

                                        @if (!isset($users))
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="contrasenaUser">Contraseña</label>
                                                    <input type="password" name="password" id="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        placeholder="Contraseña">
                                                    @error('password')
                                                        <span class="invalid-feedback" style="color: red">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
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

    {{-- Model Crear Employee --}}
    <div class="modal left fade" id="crearempleado" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-family-Outfit-SemiBold">Crear Empleado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="col-md-12" id="marcaInputSection" style="">
                    <form method="POST" id="empledoForm">
                        @csrf
                        <div class="form-group">
                            <label>Insertar Empleado</label>
                            <input type="text" placeholder="Insertar Empleado" name="empleado" id="empleado"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn-primario w-auto pl-3 pr-3" id="submitEmpleado">
                                Entregar
                            </button>
                            <button type="button" class="btn-primario w-auto pl-3 pr-3" id="cancelEmpleado">
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

            $('#empledoForm').on('keypress', function(e) {
                if (e.which === 13) { // 13 is the Enter key code
                    e.preventDefault();
                    return false;
                }
            });

            // Function to get employees (similar to getPosition)
            function getEmployees(edit) {
                // Destroy existing Select2 instances if they exist
                if ($('#employee').data('select2')) {
                    $('#employee').select2('destroy');
                }
                if ($('#employee1').data('select2')) {
                    $('#employee1').select2('destroy');
                }

                // Perform the AJAX call to get employee data
                $.ajax({
                    type: "GET",
                    url: "{{ route('getEmployee') }}", // Ensure this route exists
                    dataType: "JSON",
                    success: function(response) {
                        // Clear the current options and append the retrieved options to the select elements
                        $("#employee, #employee1").empty();
                        $("#employee, #employee1").append(
                            '<option value="" class="d-none">Seleccionar empleado</option>'
                        );

                        $.each(response, function() {
                            $("#employee, #employee1").append(
                                `<option value='${this.id}'>${this['empleado']}</option>`
                            );
                        });

                        // Initialize Select2 on the select elements
                        $('#employee, #employee1').select2({
                            placeholder: "Seleccionar empleado",
                            allowClear: true
                        });

                        // If edit is true and has a valid ID, set the selected value
                        if (edit) {
                            $('#employee1').val(edit).trigger('change');
                        }
                    }
                });
            }

            // Initial call to populate employees
            getEmployees();

            // Handle the submit button click
            $('#submitEmpleado').click(function(e) {
                e.preventDefault(); // Prevent default form submission
                var formData = new FormData();
                formData.append('empleado', $('#empleado').val());

                // Send AJAX request
                $.ajax({
                    type: "POST",
                    url: "{{ route('insert.employee') }}", // Ensure this route exists
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Handle success response
                        getEmployees(); // Refresh the employee list
                        $("#cancelEmpleado").click(); // Close the modal
                    },
                    error: function(xhr) {
                        // Handle error response
                        console.error('Error:', xhr.responseText);
                    }
                });
            });

            // Handle the cancel button click
            $('#cancelEmpleado').click(function() {
                $("#crearempleado").modal('hide');
            });

            // // Prevent form submission on enter key
            // $('#empledoForm').submit(function(e) {
            //     e.preventDefault();
            // });
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

            $('#cargarimagenUsuario').click(function() {
                $('#imageUploadUsuario').click();
            });

            $('#imageUploadUsuario').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagenPrevioUsuario').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagenPrevioUsuario').show();
                }
                reader.readAsDataURL(this.files[0]);
            });


            $('#editcargarimagenUsuario').click(function() {
                $('#editimageUploadUsuario').click();
            });

            $('#editimageUploadUsuario').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#editimagenPrevioUsuario').css('background-image', 'url(' + e.target.result +
                        ')');
                    $('#editimagenPrevioUsuario').show();
                }
                reader.readAsDataURL(this.files[0]);
            });

            $('#editimageUploadUsuario').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    // Update the background image of the preview div
                    $('#editimagenPrevioUsuario').css('background-image', 'url(' + e.target.result +
                        ')');

                    // Hide any existing image tags inside the preview div
                    $('#editimagenPrevioUsuario').find('img').remove();

                    // Show the preview div (in case it was hidden)
                    $('#editimagenPrevioUsuario').show();

                    // Optionally, add a new img element if needed
                    $('#editimagenPrevioUsuario').append('<img src="' + e.target.result +
                        '" width="200" height="200" alt="Preview Image">');
                }
                reader.readAsDataURL(this.files[0]);
            });



            setTimeout(function() {
                $(".alert-success").fadeOut(1000);
            }, 1000);
            setTimeout(function() {
                $(".alert-danger").fadeOut(1000);
            }, 1000);

            $('#createuserform').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('.alert-success').text(response.message).fadeIn();
                        setTimeout(function() {
                            $('.alert-success').fadeOut(1000);
                        }, 1000);
                        $('#createuserform').trigger('reset');
                        $('#crearUsuario').modal('hide');
                        // Optionally reload the page or update the table dynamically
                        window.location.reload();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // Validation error
                            var errors = xhr.responseJSON.errors;
                            if (errors.email) {
                                console.log('Email Error:', errors.email[0]);
                                $('#createuserform').validate().showErrors({
                                    email: errors.email[0]
                                });
                            }
                        }
                    },
                });
            });
            $('#edituserform').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('.alert-success').text(response.message).fadeIn();
                        setTimeout(function() {
                            $('.alert-success').fadeOut(1000);
                        }, 1000);
                        $('#editorUsuario').trigger('reset');
                        $('#editorUsuario').modal('hide');
                        // Optionally reload the page or update the table dynamically
                        window.location.reload();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // Validation error
                            var errors = xhr.responseJSON.errors;
                            // Clear previous errors
                            $('#edituserform').validate().resetForm();
                            // Show new errors
                            $.each(errors, function(key, value) {
                                $('#edituserform').validate().showErrors({
                                    [key]: value[0]
                                });
                            });
                        }
                    }
                });
            });

            $.validator.addMethod("passwordFormat", function(value, element) {
                    return this.optional(element) || (
                        /(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.,-])[A-Za-z\d@$!%*?&.,-]{8,}/.test(
                            value)
                    );
                },
                "La contraseña debe tener al menos 8 caracteres, contener al menos una letra mayúscula, una letra minúscula y un carácter especial como @$!%*?&.,-."
            );

            $.validator.addMethod("customEmail", function(value, element) {
                return this.optional(element) || /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(value);
            }, "Por favor, introduce una dirección de correo electrónico válida");

            $.validator.addMethod("customPhone", function(value, element) {
                return this.optional(element) || /^[0-9]{9}$/.test(value);
            }, "Por favor, introduzca al menos 9 caracteres.");

            // Initialize jQuery Validation plugin on the form
            $('#createuserform').validate({
                rules: {
                    username: "required",
                    name: "required",
                    email: {
                        required: true,
                        customEmail: true
                    },
                    phone: {
                        required: true,
                        digits: true,
                        customPhone: true
                    },
                    // employee: "required",
                    password: {
                        required: true,
                        minlength: 8, // Adjusted minlength to 8 characters
                        passwordFormat: true // Apply custom passwordFormat rule
                    }
                },
                messages: {
                    username: "Por favor, ingrese el nombre de usuario",
                    name: "Por favor, ingrese el nombre",
                    // email: {
                    //     required: "Por favor, ingrese el correo",
                    //     email: "Por favor, ingrese un correo válido",
                    //     unique: 'El correo electrónico ya está en uso.',

                    // },
                    phone: {
                        required: "Por favor, ingrese el teléfono",
                        digits: "Por favor, ingrese solo números"
                    },
                    employee: "Por favor, seleccione un empleado",
                    password: {
                        required: "Por favor, ingrese la contraseña",
                        minlength: "La contraseña debe tener al menos 8 caracteres" // Updated minlength message
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

            $('#edituserform').validate({
                rules: {
                    username: "required",
                    name: "required",
                    email: {
                        required: true,
                        customEmail: true
                    },
                    phone: {
                        required: true,
                        digits: true,
                        customPhone: true
                    },
                    // employee: "required",
                },
                messages: {
                    username: "Por favor, ingrese el nombre de usuario",
                    name: "Por favor, ingrese el nombre",
                    email: {
                        required: "Por favor, ingrese el correo",
                        email: "Por favor, ingrese un correo válido"
                    },
                    phone: {
                        required: "Por favor, ingrese el teléfono",
                        digits: "Por favor, ingrese solo números"
                    },
                    employee: "Por favor, seleccione un empleado",

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

            $('.edit-user').on('click', function() {
                var user = $(this).data('user');
                // Populate the modal with customer data
                $('#edit-username').val(user.username);
                $('#edit-name').val(user.name);
                $('#edit-email').val(user.email);
                $('#edit-phone').val(user.phone);
                // $('#edit-employee').val(user.employee);
                $('#employee1').val(user.employee).trigger('change');

                // Set the form action to the correct route
                $('#edituserform').attr('action', '/usuarios/actualizar/' + user.id);
                var imageUrl = "{{ asset('images/') }}" + "/" + user.image;
                $('#edituser-image').attr('src', imageUrl);

            });

            $('#crearUsuario').on('hidden.bs.modal', function() {
                var form = $('#createuserform');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');

                // Clear all input fields
                form.find('input').val('');

                // Reset select fields
                form.find('select').val('').trigger('change');

                // Clear any file input
                form.find('input[type="file"]').val('');

            });
            $('#editorUsuario').on('hidden.bs.modal', function() {
                var form = $('#edituserform');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            });
        });
    </script>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            var passwordField = document.getElementById('password');
            var passwordFieldType = passwordField.getAttribute('type');
            if (passwordFieldType === 'password') {
                passwordField.setAttribute('type', 'text');
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                passwordField.setAttribute('type', 'password');
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    </script>
@endpush
