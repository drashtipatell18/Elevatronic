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
                            <a class="dropdown-item texto-1 font-family-Inter-Regular" href="javascript:void(0)"
                                data-toggle="modal" data-target="#editarCliente">Editar</a>
                            <a class="dropdown-item" href="{{ route('destroy.customer', $customer->id) }}"
                                data-toggle="modal" data-target="#modalEliminar">Eliminar</a>
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
                                            <h4>{{ $customer->created_at->format('d M Y, g:i a') }}</h4>
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
    <div class="modal left fade" id="editarCliente" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-family-Outfit-SemiBold">editar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body body_modal">
                    <div class="row">
                        <div class="col-md-12">
                            @isset($customer)
                                <form action="/clientes/actualizar/<?php echo $customer->id; ?>" method="POST" class="formulario-modal"
                                    id="customerForm">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nombreRuc">Nombre o Razón Social</label>
                                        <input type="text" placeholder="Nombre o Razón Social" name="nombre" id="nombre"
                                            value="{{ old('nombre', $customer->nombre ?? '') }}"
                                            class="form-control @error('nombre') is-invalid @enderror">
                                        @error('nombre')
                                            <span class="invalid-feedback" style="color: red">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tipo_de_cliente">Tipo de Cliente</label>
                                        <select
                                            class="custom-select form-control @error('tipo_de_cliente') is-invalid @enderror"
                                            name="tipo_de_cliente" id="Tcliente">
                                            <option selected disabled>Seleccionar opción</option>
                                            <option value="person1" @if (old('tipo_de_cliente', $customer->tipo_de_cliente ?? '') == 'person1') selected @endif>Cliente 1
                                            </option>
                                            <option value="person2" @if (old('tipo_de_cliente', $customer->tipo_de_cliente ?? '') == 'person2') selected @endif>Cliente 2
                                            </option>
                                            <option value="person3" @if (old('tipo_de_cliente', $customer->tipo_de_cliente ?? '') == 'person3') selected @endif>Cliente 3
                                            </option>
                                        </select>

                                        @error('tipo_de_cliente')
                                            <span class="invalid-feedback" style="color: red">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="RUC">RUC o DNI</label>
                                        <input type="text" placeholder="RUC o DNI" name="ruc" id="ruc"
                                            value="{{ old('ruc', $customer->ruc ?? '') }}"
                                            class="form-control @error('ruc') is-invalid @enderror">
                                        @error('ruc')
                                            <span class="invalid-feedback" style="color: red">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="pais">País</label>
                                        <select class="custom-select form-control @error('país') is-invalid @enderror"
                                            name="país" id="país">
                                            <option selected disabled>Seleccionar opción</option>
                                            <option value="perú" @if (old('país', $customer->país ?? '') == 'perú') selected @endif>Perú
                                            </option>
                                            <option value="chile" @if (old('país', $customer->país ?? '') == 'chile') selected @endif>Chile
                                            </option>
                                            <option value="argentina" @if (old('país', $customer->país ?? '') == 'argentina') selected @endif>
                                                Argentina
                                            </option>
                                        </select>
                                        @error('país')
                                            <span class="invalid-feedback" style="color: red">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="provincia">Provincia</label>
                                        <select class="custom-select form-control @error('provincia') is-invalid @enderror"
                                            name="provincia" id="provincia">
                                            <option selected disabled>Seleccionar opción</option>
                                            <option value="lima" @if (old('provincia', $customer->provincia ?? '') == 'lima') selected @endif>Lima
                                            </option>
                                            <option value="arequipa" @if (old('provincia', $customer->provincia ?? '') == 'arequipa') selected @endif>
                                                Arequipa
                                            </option>
                                            <option value="moquegua" @if (old('provincia', $customer->provincia ?? '') == 'moquegua') selected @endif>
                                                Moquegua
                                            </option>
                                        </select>

                                        @error('provincia')
                                            <span class="invalid-feedback" style="color: red">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="dirección">Dirección</label>
                                        <input type="text" placeholder="Dirección" name="dirección" id="dirección"
                                            value="{{ old('dirección', $customer->dirección ?? '') }}"
                                            class="form-control @error('dirección') is-invalid @enderror">
                                        @error('dirección')
                                            <span class="invalid-feedback" style="color: red">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="teléfono">Teléfono</label>
                                        <input type="text" placeholder="Teléfono" name="teléfono" id="teléfono"
                                            value="{{ old('teléfono', $customer->teléfono ?? '') }}"
                                            class="form-control @error('teléfono') is-invalid @enderror">
                                        @error('teléfono')
                                            <span class="invalid-feedback" style="color: red">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="teléfono_móvil">Teléfono Móvil</label>
                                        <input type="text" placeholder="Teléfono Móvil" name="teléfono_móvil"
                                            id="teléfono_móvil"
                                            value="{{ old('teléfono_móvil', $customer->teléfono_móvil ?? '') }}"
                                            class="form-control @error('teléfono_móvil') is-invalid @enderror">
                                        @error('teléfono_móvil')
                                            <span class="invalid-feedback" style="color: red">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="correo">Correo electrónico</label>
                                        <input type="text" placeholder="Correo electrónico" name="correo_electrónico"
                                            id="correo_electrónico"
                                            value="{{ old('correo_electrónico', $customer->correo_electrónico ?? '') }}"
                                            class="form-control @error('correo_electrónico') is-invalid @enderror">
                                        @error('correo_electrónico')
                                            <span class="invalid-feedback" style="color: red">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="Ncontacto">Nombre del conctacto</label>
                                        <input type="text" placeholder="Nombre del conctacto" name="nombre_del_contacto"
                                            id="nombre_del_contacto"
                                            value="{{ old('nombre_del_contacto', $customer->nombre_del_contacto ?? '') }}"
                                            class="form-control @error('nombre_del_contacto') is-invalid @enderror">
                                        @error('nombre_del_contacto')
                                            <span class="invalid-feedback" style="color: red">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="posición">Posición</label>
                                        <input type="text" placeholder="Posición" name="posición" id="posición"
                                            value="{{ old('posición', $customer->posición ?? '') }}"
                                            class="form-control @error('posición') is-invalid @enderror">
                                        @error('posición')
                                            <span class="invalid-feedback" style="color: red">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
