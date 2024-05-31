@extends('layouts.main')
@section('content')
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
                                    <img src="{{ asset('images/' . $users->image) }}" alt="repuesto">
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
                                            <p class="mb-0">Username</p>
                                        </div>
                                        <div class="option">
                                            <h4>{{ $users->created_at->format('d M Y, g:i a') }}</h4>
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
                                        <img src="{{ asset('images/' . $users->image) }}" alt="personal" class="w-100">
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
                                                    <td>{{ $users->employee }}</td>
                                                </tr>
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
                                                <div id="editimagenPrevioUsuario">
                                                    @if ($users->image)
                                                        <img src="{{ asset('images/' . $users->image) }}" width="200"
                                                            height="200" alt="Existing Image">
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
                                                    <select id="edit-employee" name="employee"
                                                        class="form-control @error('employee') is-invalid @enderror">
                                                        <option value="">Seleccionar
                                                            empleado</option>
                                                        @foreach ($staffs as $staff)
                                                            <option value="{{ $staff }}"
                                                                {{ old('employee', $users->employee ?? '') == $staff ? 'selected' : '' }}>
                                                                {{ $staff }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('employee')
                                                        <span class="invalid-feedback" style="color: red">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
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
                                <button type="submit" class="btn-gris btn-red">Sí</button>
                            </form>
                        @endisset
                        <button type="button" class="btn-gris btn-border" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#edituserform').validate({
                rules: {
                    username: "required",
                    name: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
                        digits: true
                    },
                    employee: "required",
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
                $('#edit-employee').val(user.employee);
                // Set the form action to the correct route
                $('#edituserform').attr('action', '/usuarios/actualizar/' + user.id);
            });
        });
    </script>
@endpush
