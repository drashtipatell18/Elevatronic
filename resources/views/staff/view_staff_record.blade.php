    @extends('layouts.main')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@section('content')
    <style>
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
            <div class="row">
                <div class="col-xl-10 col-lg-10 col-md-8 col-sm-8 col-8 mb-4">
                    <div class="titulo">
                        <h4>{{ $staffs->nombre }}</h4>
                        <span>Personal >> {{ $staffs->nombre }}</span>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-end">
                    <div class="dropdown btn-new">
                        <a class="btn-action dropdownMenuLink d-inline-block" href="#" role="button"
                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acción <i class="fas fa-chevron-down"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item edit-staff" href="#" data-staff="{{ json_encode($staffs) }}"
                                data-toggle="modal" data-target="#editarPersonal">Editar</a>
                            <a class="dropdown-item" href="{{ route('destroy.staff', $staffs->id) }}" data-toggle="modal"
                                data-target="#modalEliminar">Eliminar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="box-contenido pb-0">
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-start justify-content-start gap-20 mb-6 box-detalle">
                                <div class="">
                                    @if ($staffs->personalfoto)
                                        <img src="{{ asset('images/' . $staffs->personalfoto) }}" alt="Personal Photo">
                                    @else
                                        <img src="{{ asset('img/fondo.png') }}" alt="Personal Photo">
                                    @endif
                                </div>
                                <div class="align-items-start d-flex flex-column h-100 justify-content-between">
                                    <div>
                                        <h3>{{ $staffs->nombre }}</h3>
                                        <span>Personal</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-start gap-15 flex-wrap">
                                        <div class="option">
                                            <h4>{{ $staffs->id }}</h4>
                                            <p class="mb-0">ID elemento</p>
                                        </div>
                                        <div class="option">
                                            <h4>{{ $staffs->posición }}</h4>
                                            <p class="mb-0">Puesto</p>
                                        </div>
                                        <div class="option">
                                            <h4>{{ $staffs->created_at->locale('es')->isoFormat('D MMMM YYYY, h:mm a') }}
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
                                        <h3>Foto de personal</h3>
                                        <img src="{{ asset('images/' . ($staffs->personalfoto ?: 'fondo.png')) }}"
                                            alt="personal" class="w-100">
                                    </div>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <div class="box-contenido">
                                        <h3>Información de personal</h3>
                                        <table class="table table-borderless tabla-repuestos">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Nombre</td>
                                                    <td>{{ $staffs->nombre }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">Posición</td>
                                                    <td>{{ $staffs->posición }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">Correo</td>
                                                    <td>{{ $staffs->correo }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">Teléfono</td>
                                                    <td>{{ $staffs->teléfono }}</td>
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
                <form action="" class="formulario-modal" enctype="multipart/form-data" method="POST" id="editstaff">
                    @csrf
                    <div class="modal-body body_modal">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>Foto de Personal</label>
                                        <div id="editimagenPrevioPersonal">
                                            @if ($staffs->personalfoto)
                                                <img src="{{ asset('images/' . $staffs->personalfoto) }}"
                                                    width="200" height="200" alt="Personal Image">
                                            @else
                                                <img src="{{ asset('img/fondo.png') }}"
                                                width="200" height="200" alt="Personal Image">
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
                    @isset($staffs)
                        <form id="delete-form" action="{{ route('destroy.staff', $staffs->id) }}" method="POST">
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
            function getPosition(edit) {
                // Destroy existing Select2 instances if they exist
                if ($('#position').data('select2')) {
                    $('#position').select2('destroy');
                }

                // Perform the AJAX call to get position data
                $.ajax({
                    type: "GET",
                    url: "{{ route('getPosition') }}",
                    dataType: "JSON",
                    success: function(response) {
                        // Clear the current options and append the retrieved options to the select elements
                        $("#posición").empty();
                        $("#posición").append(
                            '<option value="" class="d-none">Seleccionar opción</option>'
                        ); // Add placeholder option

                        $.each(response, function() {
                            $("#posición").append(
                                `<option value='${this.id}'>${this['position']}</option>`
                            );
                        });

                        // Initialize Select2 on the select element with placeholder
                        $('#posición').select2({
                            placeholder: "Seleccionar posición",
                            allowClear: true
                        });

                        // If edit is true and has a valid ID, set the selected value
                        if (edit) {
                            $('#position').val(edit).trigger('change');
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

            $('#editcargarimagenpersonal').click(function() {
                $('#editimageUpload10').click();
            });

            $('#editimageUpload10').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    // Update the background image of the preview div
                    $('#editimagenPrevioPersonal').css('background-image', 'url(' + e.target.result + ')');

                    // Hide any existing image tags inside the preview div
                    $('#editimagenPrevioPersonal').find('img').remove();

                    // Show the preview div (in case it was hidden)
                    $('#editimagenPrevioPersonal').show();

                    // Optionally, add a new img element if needed
                    $('#editimagenPrevioPersonal').append('<img src="' + e.target.result + '" width="200" height="200" alt="Preview Image">');
                }
                reader.readAsDataURL(this.files[0]);
            });

            // $('#editimageUpload10').change(function() {
            //     var reader = new FileReader();
            //     reader.onload = function(e) {
            //         $('#editimagenPrevioPersonal').css('background-image', 'url(' + e.target.result +
            //             ')');
            //         $('#editimagenPrevioPersonal').show();
            //     }
            //     reader.readAsDataURL(this.files[0]);
            // });

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
                $('#edit-posición').val(staff.posición);
                $('#edit-correo').val(staff.correo);
                $('#edit-teléfono').val(staff.teléfono);
                // Set the form action to the correct route
                $('#editstaff').attr('action', '/personal/actualizar/' + staff.id);
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
