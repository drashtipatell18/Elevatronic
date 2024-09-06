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
        .imageCrops{
                object-fit: cover;
                width: 100%;
                height: 400px;
        }
        .object{
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
        #edit-users {
            background-color: white !important;
        }
    </style>
    <div class="w-100 contenido">
        <div class="container-fluid container-mod">
            <div class="row">
                <div class="col-xl-10 col-lg-10 col-md-8 col-sm-8 col-8 mb-4">
                    <div class="titulo">
                        <h4>{{ $users->name }}</h4>
                        <span>Usuarios >> {{ $users->name }}</span>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-end">
                    <div class="dropdown btn-new">
                        <a class="btn-action dropdownMenuLink d-inline-block" href="#" role="button"
                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acción <i class="fas fa-chevron-down"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item edit-user" href="#" data-user="{{ json_encode($users) }}"
                                data-toggle="modal" data-target="#editorUsuario">Editar</a>
                            <a class="dropdown-item" href="{{ route('destroy.user', $users->id) }}" data-toggle="modal"
                                data-target="#modalEliminar">Eliminar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="box-contenido pb-0">
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-start justify-content-start gap-20 mb-6 box-detalle">
                                <div class="">
                                    @if ($users->image)
                                        <img src="{{ asset('images/' . $users->image) }}" alt="User Image" class="imageCrops">
                                    @else
                                        <img src="{{ asset('img/fondo.png') }}" alt="User Image">
                                    @endif
                                </div>
                                <div class="align-items-start d-flex flex-column h-100 justify-content-between">
                                    <div>
                                        <h3>{{ $users->name }}</h3>
                                        <span>Usuario</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-start gap-15 flex-wrap">
                                        <div class="option">
                                            <h4>{{ $users->id }}</h4>
                                            <p class="mb-0">ID elemento</p>
                                        </div>
                                        <div class="option">
                                            <h4>{{ $users->username }}</h4>
                                            <p class="mb-0">Nombre de usuario</p>
                                        </div>
                                        <div class="option">
                                            <h4>{{ $users->created_at->locale('es')->isoFormat('D MMMM YYYY, h:mm a') }}
                                            </h4>
                                            <p class="mb-0">Fecha registro</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <ul class="nav nav-tabs tabs-elevatronic" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#informacion">Información</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="tab-content contenido-elevatronic">
                        <div id="informacion" class="tab-pane active">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <div class="box-contenido">
                                        <h3>Foto de usuario</h3>
                                        @if ($users->image)
                                            <img src="{{ asset('images/' . $users->image) }}" alt="personal"
                                                class="imageCrops" id="edit-users">
                                        @else
                                            <img src="{{ asset('img/fondo.png') }}" alt="personal" class="imageCrops"  id="edit-users">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <div class="box-contenido">
                                        <h3>Información de usuario</h3>
                                        <table class="table table-borderless tabla-repuestos">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Username</td>
                                                    <td>{{ $users->username }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">Nombres</td>
                                                    <td>{{ $users->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">Correo</td>
                                                    <td>{{ $users->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">Teléfono</td>
                                                    <td>{{ $users->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">Empleado</td>
                                                    <td>@if ($users->employee)
                                                        {{ $users->employee->empleado }}
                                                    @else
                                                        N/A
                                                    @endif</td> <!-- Fetching employee name -->                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <form action="" method="POST" enctype="multipart/form-data" id="edituserform">
                        @csrf
                        @method('PUT')
                        <div class="modal-body body_modal">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>Foto de usuario</label>
                                            <div id="editimagenPrevioUsuario" style="overflow: hidden">
                                                @if ($users->image)
                                                    <img src="{{ asset('images/' . $users->image) }}"  alt="Existing Image" class="object" id="edit-users">
                                                @else
                                                    <img src="{{ asset('images/fondo.png') }}" alt="Default Image" class="object" id="edit-users">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="">
                                                <label for="imageUploadUsuario" class="text-gris mt-4">Seleccione
                                                    una
                                                    imagen</label>
                                                <input type="file" id="editimageUploadUsuario" name="image"
                                                    style="display:none;"accept="image/*" />
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
                                                <input type="text" placeholder="nombredeusuario" name="username"
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
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    value="">
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
                                                <input type="email" placeholder="Correo" name="email"
                                                    id="edit-email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    value="">
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
                                                <input type="number" name="phone" id="edit-phone"
                                                    placeholder="Teléfono" value=""
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
                                                <select id="employee_id" name="employee_id"
                                                    class="form-control @error('employee_id') is-invalid @enderror">
                                                    <option value="">Seleccionar
                                                        empleado</option>
                                                </select>
                                                @error('employee_id')
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
                </div>
            </div>
        </div>

        <!-- Modal Eliminar-->
        <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-radius-12">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <div class="box1">
                                    <img src="{{ asset('img/iconos/trash.svg') }}" alt="trash" width="76">
                                    <p class="mt-3 mb-0">
                                        ¿Seguro que quieres eliminar <span id="item-name"></span>?
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer align-items-center justify-content-center">
                        @isset($users)
                            <form id="delete-form" action="{{ route('destroy.user', $users->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-gris btn-red" onclick="this.disabled=true;this.form.submit();">Sí</button>
                            </form>
                        @endisset
                        <button type="button" class="btn-gris btn-border" data-dismiss="modal">No</button>
                    </div>
                </div>
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

            function getEmployees(edit) {
                // Destroy existing Select2 instances if they exist
                if ($('#employee_id').data('select2')) {
                    $('#employee_id').select2('destroy');
                }

                // Perform the AJAX call to get employee data
                $.ajax({
                    type: "GET",
                    url: "{{ route('getEmployee') }}", // Ensure this route exists
                    dataType: "JSON",
                    success: function(response) {
                        // Clear the current options and append the retrieved options to the select elements
                        $("#employee_id").empty();
                        $("#employee_id").append(
                            '<option value="" class="d-none">Seleccionar empleado</option>'
                        );

                        $.each(response, function() {
                            $("#employee_id").append(
                                `<option value='${this.id}'>${this['empleado']}</option>`
                            );
                        });

                        // Initialize Select2 on the select elements
                        $('#employee_id').select2({
                            placeholder: "Seleccionar empleado",
                            allowClear: true
                        });

                        // If edit is true and has a valid ID, set the selected value
                        if (edit) {
                            $('#employee_id').val(edit).trigger('change');
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
            // $('#edituserform').submit(function(e) {
            //     e.preventDefault();
            //     $.ajax({
            //         url: $(this).attr('action'),
            //         type: 'POST',
            //         data: $(this).serialize(),
            //         success: function(response) {
            //             $('.alert-success').text(response.message).fadeIn();
            //             setTimeout(function() {
            //                 $('.alert-success').fadeOut(1000);
            //             }, 1000);
            //             $('#editorUsuario').trigger('reset');
            //             $('#editorUsuario').modal('hide');
            //             // Optionally reload the page or update the table dynamically
            //             window.location.reload();
            //         },
            //         error: function(xhr) {
            //             if (xhr.status === 422) { // Validation error
            //                 var errors = xhr.responseJSON.errors;
            //                 // Clear previous errors
            //                 $('#edituserform').validate().resetForm();
            //                 // Show new errors
            //                 $.each(errors, function(key, value) {
            //                     $('#edituserform').validate().showErrors({
            //                         [key]: value[0]
            //                     });
            //                 });
            //             }
            //         }
            //     });
            // });

            $.validator.addMethod("customEmail", function(value, element) {
                return this.optional(element) || /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(value);
            }, "Por favor, introduce una dirección de correo electrónico válida");

            $.validator.addMethod("customPhone", function(value, element) {
                return this.optional(element) || /^[0-9]{9}$/.test(value);
            }, "Por favor, introduzca al menos 9 caracteres.");

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

            // $('.edit-user').on('click', function() {
            //     var user = $(this).data('user');
            //     // Populate the modal with customer data
            //     $('#edit-username').val(user.username);
            //     $('#edit-name').val(user.name);
            //     $('#edit-email').val(user.email);
            //     $('#edit-phone').val(user.phone);
            //     // $('#edit-employee').val(user.employee);
            //     $('#employee_id').val(user.employee_id).trigger('change');

            //     var imageUrl = user.image ?
            //         "{{ asset('images/') }}/" + user.image :
            //         "{{ asset('img/fondo.png') }}";
            //     $('#edit-users').attr('src', imageUrl);
            //     // Set the form action to the correct route
            //     $('#edituserform').attr('action', '/usuarios/actualizar/' + user.id);
            // });


                $(document).on('click', '.edit-user', function() {
        // Clear previous modal data
                $('#edit-username').val('');
                $('#edit-name').val('');
                $('#edit-email').val('');
                $('#edit-phone').val('');
                $('#employee_id').val('').trigger('change');
                $('#edit-users').attr('src', "{{ asset('img/fondo.png') }}"); // Default image

                // Get the current user data
                var user = $(this).data('user');

                // Populate the modal with the selected user's data
                $('#edit-username').val(user.username);
                $('#edit-name').val(user.name);
                $('#edit-email').val(user.email);
                $('#edit-phone').val(user.phone);
                $('#employee_id').val(user.employee_id).trigger('change');

                // Set the form action to the correct route
                var imageUrl = user.image ?
                    "{{ asset('images/') }}/" + user.image :
                    "{{ asset('img/fondo.png') }}";
                $('#edit-users').attr('src', imageUrl);
                $('#edituserform').attr('action', '/usuarios/actualizar/' + user.id);
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
                        ')' );

                    // Hide any existing image tags inside the preview div
                    $('#editimagenPrevioUsuario').find('img').remove();

                    // Show the preview div (in case it was hidden)
                    $('#editimagenPrevioUsuario').show();

                    // Optionally, add a new img element if needed
                    $('#editimagenPrevioUsuario').append('<img src="' + e.target.result +
                        '" width="200" height="200" class="object" alt="Preview Image">');
                }
                reader.readAsDataURL(this.files[0]);
            });

            $('#editorUsuario').on('hidden.bs.modal', function() {
                var form = $('#edituserform');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            });
        });
    </script>
@endpush
