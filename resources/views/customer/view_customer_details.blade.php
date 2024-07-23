@extends('layouts.main')
@section('content')
    <div class="w-100 contenido">
        <div class="container-fluid container-mod">
            <div class="row">
                <div class="col-xl-10 col-lg-10 col-md-8 col-sm-8 col-8 mb-4">
                    <div class="titulo">
                        <h4>EDIFICIO DEL MARE</h4>
                        <span>Clientes >> EDIFICIO DEL MARE</span>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-end">
                    <div class="dropdown btn-new">
                        <a class="btn-action dropdownMenuLink d-inline-block" href="#" role="button"
                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acción <i class="fas fa-chevron-down"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item edit-customer" href="#"
                                data-customer="{{ json_encode($customer) }}" data-toggle="modal"
                                data-target="#editarCliente">Editar</a>
                            <a class="dropdown-item" href=""
                                data-toggle="modal" data-target="#modalEliminar{{ $customer->id }}">Eliminar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="box-contenido pb-0">
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-start justify-content-start gap-20 mb-6 box-detalle">
                                <div class="">
                                    <img src="{{ asset('img/card-user.svg') }}" alt="user">
                                </div>
                                <div class="align-items-start d-flex flex-column h-100 justify-content-between">
                                    <div>
                                        <h3>{{ $customer->nombre }}</h3>
                                        <span>Cliente</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-start gap-15 flex-wrap">
                                        <div class="option">
                                            <h4>{{ $customer->id }}</h4>
                                            <p class="mb-0">ID elemento</p>
                                        </div>
                                        <div class="option">
                                            <h4>{{ $customer->tipo_de_cliente }}</h4>
                                            <p class="mb-0">Tipo de cliente</p>
                                        </div>
                                        <div class="option">
                                            <h4>{{ $customer->created_at->locale('es')->isoFormat('D MMM YYYY, h:mm a') }}</h4>
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
                    <div class="box-contenido">
                        <div class="tab-content contenido-elevatronic">
                            <div id="informacion" class="tab-pane active"><br>
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <h3>Información de cliente</h3>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table table-borderless table-hover">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Nombre o Razón Social</td>
                                                    <td>{{ $customer->nombre }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">RUC o DNI</td>
                                                    <td>{{ $customer->ruc }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">País</td>
                                                    <td>{{ $customer->país }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">Provincia</td>
                                                    <td>{{ $customer->provincia }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">Dirección</td>
                                                    <td>{{ $customer->dirección }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">Teléfono</td>
                                                    <td>{{ $customer->teléfono }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">Correo electrónico</td>
                                                    <td>{{ $customer->correo_electrónico }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">Nombre del contacto</td>
                                                    <td>{{ $customer->nombre_del_contacto }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">Posición</td>
                                                    <td>{{ $customer->posición }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">Correo electrónico</td>
                                                    <td>-</td>
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
                                <form action="" method="POST"
                                    class="formulario-modal" id="EditcustomerForm">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="nombreRuc">Nombre o Razón
                                            Social</label>
                                        <input type="text" placeholder="Nombre o Razón Social" name="nombre"
                                            id="edit-nombre" value=""
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="tipo_de_cliente">Tipo de
                                            Cliente</label>
                                            <select class="custom-select form-control" name="tipo_de_cliente" id="edit-tipo_de_cliente">
                                                <option value="">Seleccionar opción</option>
                                                <option value="cilente1" {{ $customer->tipo_de_cliente == 'cilente1' ? 'selected' : '' }}>Cliente 1</option>
                                                <option value="cilente2" {{ $customer->tipo_de_cliente == 'cilente2' ? 'selected' : '' }}>Cliente 2</option>
                                                <option value="cilente3" {{ $customer->tipo_de_cliente == 'cilente3' ? 'selected' : '' }}>Cliente 3</option>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="RUC">RUC o DNI</label>
                                        <input type="number" placeholder="RUC o DNI" name="ruc"
                                            id="edit-ruc" value=""
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="pais">País</label>
                                        <select class="custom-select form-control" name="país" id="edit-país">
                                            <option value="">Seleccionar opción
                                            </option>
                                            <option value="perú"{{ $customer->país == 'perú' ? 'selected': ''}}> Perú </option>
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
                                                    {{ $customer->provincia == $province ? 'selected' : ''}}>
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
                                            id="edit-dirección"
                                            value=""
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="teléfono">Teléfono</label>
                                        <input type="number" placeholder="Teléfono" name="teléfono"
                                            id="edit-teléfono"
                                            value=""
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="teléfono_móvil">Teléfono
                                            Móvil</label>
                                        <input type="number" placeholder="Teléfono Móvil" name="teléfono_móvil"
                                            id="edit-teléfono_móvil"
                                            value=""
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="correo">Correo
                                            electrónico</label>
                                        <input type="text" placeholder="Correo electrónico"
                                            name="correo_electrónico" id="edit-correo_electrónico"
                                            value=""
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="Ncontacto">Nombre del
                                            conctacto</label>
                                        <input type="text" placeholder="Nombre del conctacto"
                                            name="nombre_del_contacto" id="edit-nombre_del_contacto"
                                            value=""
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="posición">Posición</label>
                                        <input type="text" placeholder="Posición" name="posición"
                                            id="edit-posición"
                                            value=""
                                            class="form-control">
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
    <div class="modal fade" id="modalEliminar{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
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
                    @isset($customer)
                        <form id="delete-form" action="{{ route('destroy.customer', $customer->id) }}" method="POST">
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
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
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
                        minlength: 'El RUC debe tener exactamente 8 dígitos',
                        maxlength: 'El RUC debe tener exactamente 8 dígitos'
                    },
                    país: 'Por favor, selecciona el país',
                    provincia: 'Por favor, selecciona la provincia',
                    dirección: 'Por favor, ingresa la dirección',
                    teléfono: {
                        required: 'Por favor, ingresa el teléfono',
                        digits: 'Por favor, ingresa solo dígitos',
                        minlength: 'El teléfono debe tener exactamente 8 dígitos',
                        maxlength: 'El teléfono debe tener exactamente 8 dígitos'
                    },
                    teléfono_móvil: {
                        required: 'Por favor, ingresa el teléfono móvil',
                        digits: 'Por favor, ingresa solo dígitos',
                        minlength: 'El teléfono móvil debe tener exactamente 8 dígitos',
                        maxlength: 'El teléfono móvil debe tener exactamente 8 dígitos'
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
            $('#edit-tipo_de_cliente').val(customer.tipo_de_cliente);
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
        $('#editarCliente').on('hidden.bs.modal', function() {
            var form = $('#EditcustomerForm');
            form.validate().resetForm();
            form.find('.is-invalid').removeClass('is-invalid');
            form.find('.is-valid').removeClass('is-valid');
        });

    });
</script>
@endpush
