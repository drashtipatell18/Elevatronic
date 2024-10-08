@extends('layouts.main')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@section('content')
    <style>
        .qrcode {
            text-align: center;
        }

        .dt-head-center {
            text-align: center;
        }

        .brandbtn {
            margin-right: 15px;
            font-size: 14px;
            padding: 2px 8px !important;
        }

        .supervisorbtn {
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

        #editimagePreview {
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

        #editimagePreview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Ensures that the image covers the container without distortion */
        }

        #edit-elevator {
            background-color: white !important;
        }

        .imageCrops {
            object-fit: cover;
            width: 100%;
            height: 400px;
        }
    </style>
    <div class="w-100 contenido">
        <div class="container-fluid container-mod">
            <div class="row">
                <div class="col-xl-10 col-lg-10 col-md-8 col-sm-8 col-8 mb-4">
                    <div class="titulo">
                        @isset($elevators)
                            <h4>{{ $elevators->nombre }}</h4>
                            <span>Ascensores >> {{ $elevators->nombre }}</span>
                        @endisset
                    </div>

                </div>
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-end">
                    <div class="dropdown btn-new">
                        <a class="btn-action dropdownMenuLink d-inline-block" href="#" role="button"
                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acción <i class="fas fa-chevron-down"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item edit-elevator" href="#"
                                data-elevator="{{ json_encode($elevators) }}" data-toggle="modal"
                                data-target="#editarAscensor">Editar</a>
                            <a class="dropdown-item" href="" data-toggle="modal"
                                data-target="#modalEliminar{{ $elevators->id }}">Eliminar</a>
                        </div>

                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="box-contenido pb-0">
                        <div class="row">
                            <div
                                class="col-md-12 d-flex align-items-start justify-content-start gap-20 mb-6 box-detalle">
                                @if (isset($elevators))
                                    <div class="contenido-img">
                                        @if ($elevators->imagen)
                                            <img src="{{ asset('images/' . $elevators->imagen) }}" alt="user"
                                                width="160" class="imageCrops">
                                        @else
                                            <img src="{{ asset('img/fondo.png') }}" width="160" class="img-table"
                                                alt="user">
                                        @endif
                                    </div>
                                @endif
                                <div class="align-items-start d-flex flex-column h-100 justify-content-between">
                                    <div>
                                        <h3>{{ $elevators->nombre }}</h3>
                                        <span>Ascensor</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-start gap-15 flex-wrap">
                                        <div class="option">
                                            <h4>{{ $elevators->id }}</h4>
                                            <p class="mb-0">ID elemento</p>
                                        </div>
                                        <div class="option">
                                            <h4>{{ $elevators->contrato }}</h4>
                                            <p class="mb-0"># de contrato</p>
                                        </div>
                                        <div class="option">
                                            <h4>{{ \Carbon\Carbon::parse($elevators->created_at)->locale('es')->isoFormat('D MMMM YYYY, h:mm a') }}
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
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#contratos">Contratos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#mantenimientos">Mantenimientos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#repuestos">Repuestos del
                                            Ascensor</a>
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
                                        <h3>
                                            Información del ascensor
                                            <span class="float-right fz-15 btn-gris" style="min-width: auto;"
                                                id="qrButton">
                                                <i class="fad fa-qrcode"></i> Ver QR
                                            </span>
                                        </h3>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Nombre</td>
                                                    <td>
                                                        @isset($elevators->nombre)
                                                            {{ $elevators->nombre }}
                                                        @else
                                                            Nombre no especificado
                                                        @endisset
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Código</td>
                                                    <td>
                                                        @isset($elevators->código)
                                                            {{ $elevators->código }}
                                                        @else
                                                            Código no especificado
                                                        @endisset
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Cliente del ascensor</td>
                                                    <td>
                                                        @isset($elevators->client->nombre)
                                                            <!-- Change from $elevators->cliente to $elevators->client->nombre -->
                                                            {{ $elevators->client->nombre }}
                                                            <!-- Display the client's name -->
                                                        @else
                                                            No cliente disponible
                                                        @endisset
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Marca</td>
                                                    <td>
                                                        @isset($elevators->marca)
                                                            {{ $elevators->marca->marca_nombre }}
                                                        @else
                                                            No marca disponible
                                                        @endisset
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Fecha de entrega</td>
                                                    <td>{{ $elevators->fecha }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Garantía</td>
                                                    <td>
                                                        @isset($elevators->garantizar)
                                                            {{ $elevators->garantizar }}
                                                        @else
                                                            {{ '-' }}
                                                        @endisset
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Dirección</td>
                                                    <td>
                                                        @isset($elevators->dirección)
                                                            {{ $elevators->dirección }}
                                                        @else
                                                            {{ '-' }}
                                                        @endisset
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Técnico instalador</td>
                                                    <td>
                                                        @isset($elevators->tecnicoInstalador)
                                                            {{ $elevators->tecnicoInstalador->nombre }}
                                                        @else
                                                            {{ '-' }}
                                                        @endisset
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Ubigeo</td>
                                                    <td>
                                                        @isset($elevators->ubigeo)
                                                            {{ $elevators->ubigeo }}
                                                        @else
                                                            {{ '-' }}
                                                        @endisset
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Provincia</td>
                                                    <td>
                                                        @isset($elevators->province)
                                                            {{ $elevators->province->provincia }}
                                                        @else
                                                            {{ '-' }}
                                                        @endisset
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Técnico ajustador</td>
                                                    <td>
                                                        @isset($elevators->tecnicoAjustador)
                                                            {{ $elevators->tecnicoAjustador->nombre }}
                                                        @else
                                                            {{ '-' }}
                                                        @endisset
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Tipo de ascensor</td>
                                                    <td>
                                                        @isset($elevators->tipoDeAscensor)
                                                            {{ $elevators->tipoDeAscensor->nombre_de_tipo_de_ascensor }}
                                                        @else
                                                            {{ '-' }}
                                                        @endisset
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Cantidad</td>
                                                    <td>
                                                        @isset($elevators->cantidad)
                                                            {{ $elevators->cantidad }}
                                                        @else
                                                            Cantidad no especificada
                                                        @endisset
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="adornoinput mb-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="MGratuito" name="mgratuito" value="mgratuito"
                                                            {{ in_array('mgratuito', explode(',', $elevators->quarters)) ? 'checked' : '' }}
                                                            disabled>
                                                        <label class="custom-control-label"
                                                            for="MGratuito">Mantenimiento
                                                            gratuito?</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="adornoinput mb-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="SinCuarto" name="sincuarto" value="sincuarto"
                                                            {{ in_array('sincuarto', explode(',', $elevators->quarters)) ? 'checked' : '' }}
                                                            disabled>
                                                        <label class="custom-control-label" for="SinCuarto">Sin
                                                            cuarto de máquina?</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="adornoinput mb-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="ConCuarto" name="concuarto" value="concuarto"
                                                            {{ in_array('concuarto', explode(',', $elevators->quarters)) ? 'checked' : '' }}
                                                            disabled>
                                                        <label class="custom-control-label" for="ConCuarto">Con
                                                            cuarto de máquina?</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @isset($elevators)
                                        <div class="col-md-12">

                                            <table class="table table-borderless">

                                                <tbody>
                                                    <tr>
                                                        <td class="text-gris"># Pisos</td>
                                                        <td>{{ $elevators->npisos }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-gris">Contacto</td>
                                                        <td>{{ $elevators->ncontacto }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-gris">Teléfono</td>
                                                        <td>{{ $elevators->teléfono }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-gris">Correo</td>
                                                        <td>{{ $elevators->correo }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-12">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-gris">Descripción 1</td>
                                                        <td>
                                                            {{ $elevators->descripcion1 }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-12">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-gris">Descripción 2</td>
                                                        <td>
                                                            {{ $elevators->descripcion2 }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endisset


                                </div>
                            </div>
                            {{-- contratos --}}
                            <div id="contratos" class="tab-pane">
                                <div class="row">
                                    <div class="col-md-6 d-flex align-items-center justify-content-start mb-3">
                                        <h3 class="mb-0">Contratos</h3>
                                    </div>
                                    <div class="col-md-6 mb-3 text-right">
                                        <button type="button" class="btn-primario w-auto pl-3 pr-3"
                                            data-toggle="modal" data-target="#crearContratos">
                                            + Agregar
                                        </button>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="buscador">
                                            <div class="form-group position-relative">
                                                <label for="customSearchBox"><i class="fal fa-search"></i></label>
                                                <input type="text" id="customSearchBox" placeholder="Buscar"
                                                    class="w-auto">
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
                                                    data-table="#contratosTable">Excel
                                                </button>
                                                <button class="dropdown-item export_pdf"
                                                    data-table="#contratosTable">PDF
                                                </button>
                                                <button class="dropdown-item export_copy"
                                                    data-table="#contratosTable">Copiar
                                                </button>
                                                <button class="dropdown-item export_print"
                                                    data-table="#contratosTable">Imprimir
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <table id="contratosTable" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>FECHA PROPUESTA</th>
                                                    <th>MONTO PROPUESTO</th>
                                                    <th>FECHA INICIO</th>
                                                    <th>FECHA FINAL</th>
                                                    <th>MONTO CONTRATO</th>
                                                    <th>ESTADO</th>
                                                    <th class="text-right">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($contracts as $contra)
                                                    <tr>
                                                        <td>{{ $contra->fecha_de_propuesta }}</td>
                                                        <td>{{ $contra->monto_de_propuesta }}</td>
                                                        <td>{{ $contra->fecha_de_inicio }}</td>
                                                        <td>{{ $contra->fecha_de_fin }}</td>
                                                        <td>{{ $contra->monto_de_contrato }}
                                                        <td>
                                                            @if ($contra->estado == '1')
                                                                <div class="alerta boton-activo">
                                                                    <i class="fas fa-circle"></i>Vigente
                                                                </div>
                                                            @elseif ($contra->estado == '0')
                                                                <div class="alerta boton-inactivo">
                                                                    <i class="fas fa-circle"></i> No vigente
                                                                </div>
                                                            @endif
                                                        </td>

                                                        <td align="right">
                                                            <div class="dropdown">
                                                                <button type="button"
                                                                    class="btn-action dropdown-toggle"
                                                                    data-toggle="dropdown">
                                                                    Acción <i class="fas fa-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                                        data-toggle="modal"
                                                                        data-target="#crearContratos">Ver
                                                                        detalles</a>
                                                                    <a class="dropdown-item editContract"
                                                                        href="" data-id="{{ $contra->id }}"
                                                                        data-contract="{{ $contra }}"
                                                                        data-toggle="modal"
                                                                        data-target="#editarContratos">Editar</a>

                                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                                        data-toggle="modal"
                                                                        data-target="#modalEliminar{{ $contra->id }}">Eliminar</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal Eliminar-->
                                                    <div class="modal fade" id="modalEliminar{{ $contra->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered"
                                                            role="document">
                                                            <div class="modal-content border-radius-12">
                                                                <divw class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-label="Close">
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
                                                                </divw>
                                                                <div
                                                                    class="modal-footer align-items-center justify-content-center">
                                                                    @isset($contra)
                                                                        <form id="delete-form"
                                                                            action="{{ route('destroy.contract', $contra->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn-gris btn-red" onclick="this.disabled=true;this.form.submit();">Sí</button>
                                                                            <button type="button"
                                                                                class="btn-gris btn-border"
                                                                                data-dismiss="modal">No</button>
                                                                        </form>
                                                                    @endisset
                                                                </div>
                                                            </div>
                                                        </div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Creando Contrato-->
                            <div class="modal left fade" id="crearContratos" tabindex="-1" role="dialog"
                                aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-family-Outfit-SemiBold">Creando Contrato</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="/contrato/insertar" method="POST" class="formulario-modal"
                                            id="createcontratos">
                                            @csrf
                                            <div class="modal-body body_modal">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="ascensor">Ascensor</label>
                                                                    <input type="text" placeholder="Ascensor"
                                                                        name=""
                                                                        value="{{ $elevators->nombre }}"
                                                                        id="ascensor" class="form-control" readonly>
                                                                    <input type="hidden" name="ascensor"
                                                                        id="ascensor" value="{{ $elevators->id }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="fecha_de_propuesta">Fecha de
                                                                        propuesta</label>
                                                                    <input type="date" placeholder="dd/mm/aaaa"
                                                                        name="fecha_de_propuesta"
                                                                        id="fecha_de_propuesta" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="monto_de_propuesta">Monto de
                                                                        propuesta</label>
                                                                    <input type="number" placeholder="S/ 300 mensual"
                                                                        name="monto_de_propuesta"
                                                                        id="monto_de_propuesta" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="monto_de_contrato">Monto de
                                                                        contrato</label>
                                                                    <input type="number" placeholder="S/ 300 mensual"
                                                                        name="monto_de_contrato"
                                                                        id="monto_de_contrato" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="fecha_de_inicio">Fecha de
                                                                        inicio</label>
                                                                    <input type="date" placeholder="dd/mm/aaaa"
                                                                        name="fecha_de_inicio" id="fecha_de_inicio"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="fecha_de_fin">Fecha de fin</label>
                                                                    <input type="date" placeholder="dd/mm/aaaa"
                                                                        name="fecha_de_fin" id="fecha_de_fin"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12"></div>
                                                            <div class="col-md-6">
                                                                <div class="adornoinput mb-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="renovación" name="renovación">
                                                                        <label class="custom-control-label"
                                                                            for="renovación">Renovación</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12"></div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="cada_cuantos_meses">Cada cuantos
                                                                        meses?</label>
                                                                    <input type="text" placeholder="Meses"
                                                                        name="cada_cuantos_meses"
                                                                        id="cada_cuantos_meses" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="observación">Observación</label>
                                                                    <textarea name="observación" id="observación" placeholder="Comentario de contrato" cols="30" rows="5"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="estado_cuenta_del_contrato">Estado
                                                                        cuenta
                                                                        del
                                                                        contrato</label>
                                                                        <input type="number" name="estado_cuenta_del_contrato" id="estado_cuenta_del_contrato" placeholder="Estado cuenta del contrato" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="estado">Estado</label>
                                                                    {{-- <input type="text" placeholder="Activo"
                                                                        name="estado" id="estado"> --}}
                                                                    <select class="custom-select form-control"
                                                                        name="estado" id="estado">
                                                                        <option selected disabled>Seleccionar opción
                                                                        </option>
                                                                        <option value="1">Vigente</option>
                                                                        <option value="0">No vigente</option>
                                                                    </select>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                                                <button type="submit" class="btn-gris btn-red mr-2">Guardar cambios
                                                </button>
                                                <button type="button" class="btn-gris btn-border"
                                                    data-dismiss="modal">Cancelar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal editar Contrato-->
                            <div class="modal left fade" id="editarContratos" tabindex="-1" role="dialog"
                                aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-family-Outfit-SemiBold">Contrato De Edición
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        @isset($contra)
                                            <form action="/contrato/actualizar/<?php echo $contra->id; ?>" method="POST"
                                                class="formulario-modal" id="editcontratos">
                                                @csrf
                                                <div class="modal-body body_modal">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="ascensor">Ascensor</label>
                                                                        <input type="text" placeholder="Ascensor"
                                                                            name="" id=""
                                                                            class="form-control"
                                                                            value="{{ old('ascensor', $elevators->nombre ?? '') }}"
                                                                            readonly>
                                                                        <input type="hidden" name="ascensor"
                                                                            id="ascensor" value="{{ $elevators->id }}">

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="fecha_de_propuesta">Fecha de
                                                                            propuesta</label>
                                                                        <input type="date" placeholder="dd/mm/aaaa"
                                                                            name="fecha_de_propuesta"
                                                                            id="edit_fecha_de_propuesta"
                                                                            class="form-control"
                                                                            value="{{ old('fecha_de_propuesta', $contra->fecha_de_propuesta ?? '') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="monto_de_propuesta">Monto de
                                                                            propuesta</label>
                                                                        <input type="number" placeholder="S/ 300 mensual"
                                                                            name="monto_de_propuesta"
                                                                            id="edit_monto_de_propuesta"
                                                                            class="form-control"
                                                                            value="{{ old('monto_de_propuesta', $contra->monto_de_propuesta ?? '') }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="monto_de_contrato">Monto de
                                                                            contrato</label>
                                                                        <input type="number" placeholder="S/ 300 mensual"
                                                                            name="monto_de_contrato"
                                                                            id="edit_monto_de_contrato"
                                                                            class="form-control"
                                                                            value="{{ old('monto_de_contrato', $contra->monto_de_contrato ?? '') }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="fecha_de_inicio">Fecha de
                                                                            inicio</label>
                                                                        <input type="date" placeholder="dd/mm/aaaa"
                                                                            name="fecha_de_inicio"
                                                                            id="edit_fecha_de_inicio" class="form-control"
                                                                            value="{{ old('fecha_de_inicio', $contra->fecha_de_inicio ?? '') }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="fecha_de_fin">Fecha de fin</label>
                                                                        <input type="date" placeholder="dd/mm/aaaa"
                                                                            name="fecha_de_fin" id="edit_fecha_de_fin"
                                                                            class="form-control"
                                                                            value="{{ old('fecha_de_fin', $contra->fecha_de_fin ?? '') }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12"></div>
                                                                <div class="col-md-6">
                                                                    <div class="adornoinput mb-3">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox"
                                                                                class="custom-control-input"
                                                                                id="edit_renovación" name="renovación"
                                                                                class="form-control"
                                                                                {{ $contra->renovación == 'Y' ? 'checked' : '' }}>
                                                                            <!-- Updated condition -->
                                                                            <label class="custom-control-label"
                                                                                for="edit_renovación">Renovación</label>
                                                                            <!-- Corrected 'for' attribute -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12"></div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="cada_cuantos_meses">Cada cuántos
                                                                            meses?</label>
                                                                        <input type="text" placeholder="Meses"
                                                                            name="cada_cuantos_meses"
                                                                            id="edit_cada_cuantos_meses"
                                                                            class="form-control"
                                                                            value="{{ old('cada_cuantos_meses', $contra->cada_cuantos_meses ?? '') }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="observación">Observación</label>
                                                                        <textarea name="observación" id="edit_observación" placeholder="Comentario de contrato" cols="30"
                                                                            rows="5" class="form-control">{{ old('observación', $contra->observación ?? '') }}</textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="estado_cuenta_del_contrato">Estado cuenta del contrato</label>
                                                                        <!-- Change from textarea to input type number -->
                                                                        <input type="number" name="estado_cuenta_del_contrato" id="edit_estado_cuenta_del_contrato"
                                                                            placeholder="Estado cuenta del contrato" class="form-control @error('estado_cuenta_del_contrato') is-invalid @enderror"
                                                                            value="{{ old('estado_cuenta_del_contrato', $contra->estado_cuenta_del_contrato ?? '') }}">
                                                                        @error('estado_cuenta_del_contrato')
                                                                            <span class="invalid-feedback" style="color: red">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="Estado">Estado</label>
                                                                        <select name="estado" id="edit_estado"
                                                                            class="custom-select form-control">
                                                                            <option value="" disabled>Seleccionar
                                                                                opción</option>
                                                                            <option value="activo"
                                                                                {{ old('estado', isset($contra) && $contra->estado == '1' ? 'selected' : '') }}>
                                                                                Vigente</option>
                                                                            <option value="inactivo"
                                                                                {{ old('estado', isset($contra) && $contra->estado == '0' ? 'selected' : '') }}>
                                                                                No vigente</option>
                                                                        </select>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                                                    <button type="submit" class="btn-gris btn-red mr-2">Actualizar cambio
                                                    </button>
                                                    <button type="button" class="btn-gris btn-border"
                                                        data-dismiss="modal">Cancelar</button>
                                                </div>
                                            </form>
                                        @endisset

                                    </div>
                                </div>
                            </div>

                            @isset($contra)
                                <!-- Modal Eliminar-->
                                <div class="modal fade" id="modalEliminar{{ $contra->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content border-radius-12">
                                            <divw class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
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
                                            </divw>
                                            <div class="modal-footer align-items-center justify-content-center">
                                                @isset($contra)
                                                    <form id="delete-form"
                                                        action="{{ route('destroy.contract', $contra->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-gris btn-red" onclick="this.disabled=true;this.form.submit();">Sí</button>
                                                        <button type="button" class="btn-gris btn-border"
                                                            data-dismiss="modal">No</button>
                                                    </form>
                                                @endisset
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endisset


                            {{-- mantenimientos --}}
                            <div id="mantenimientos" class="tab-pane">
                                <div class="row">
                                    <div class="col-md-6 d-flex align-items-center justify-content-start mb-3">
                                        <h3 class="mb-0">Mantenimientos</h3>
                                    </div>
                                    <div class="col-md-6 mb-3 text-right">
                                        <button type="button" class="btn-primario w-auto pl-3 pr-3"
                                            data-toggle="modal" data-target="#crearMantenimiento">
                                            + Agregar
                                        </button>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="buscador">
                                            <div class="form-group position-relative">
                                                <label for="customSearchBox2"><i class="fal fa-search"></i></label>
                                                <input type="text" id="customSearchBox2" placeholder="Buscar"
                                                    class="w-auto">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 text-right">
                                        <!-- Botón de exportación con menú desplegable de Bootstrap 4 -->
                                        <div class="dropdown">
                                            <button class="btn-gris" type="button" id="dropdownMenuButton1"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="{{ asset('img/iconos/export.svg') }}" alt="icono"
                                                    class="mr-2">
                                                Exportar
                                                Datos <i class="iconoir-nav-arrow-down"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdownMenuButton">
                                                <button class="dropdown-item export_excel"
                                                    data-table="#mantenimientosTable">Excel
                                                </button>
                                                <button class="dropdown-item export_pdf"
                                                    data-table="#mantenimientosTable">PDF
                                                </button>
                                                <button class="dropdown-item export_copy"
                                                    data-table="#mantenimientosTable">Copiar
                                                </button>
                                                <button class="dropdown-item export_print"
                                                    data-table="#mantenimientosTable">Imprimir
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <table id="mantenimientosTable" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>TIPO DE REVISIÓN</th>
                                                    <th># Certificado</th>
                                                    <th># ASCENSOR</th>
                                                    <th>FECHA MANTENIMIENTO</th>
                                                    <th>TÉCNICO</th>
                                                    <th>OBSERVACIÓN</th>
                                                    <th class="text-right">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($maint_in_reviews as $maint_in_rev)
                                                    <tr>
                                                        <td>{{ $elevators->tipoDeAscensor ? $elevators->tipoDeAscensor->nombre_de_tipo_de_ascensor : '-' }}</td>
                                                        <td>{{ $maint_in_rev->núm_certificado }}</td>
                                                        <td>{{ $elevators->nombre }}</td>
                                                        <td>{{ $maint_in_rev->fecha_de_mantenimiento }}</td>
                                                        <td>{{ isset($maint_in_rev->staff) ? $maint_in_rev->staff->nombre : '-' }}</td>
                                                        <td>
                                                            {{ $maint_in_rev->observaciónes }}
                                                            {{-- <a class="text-blue view-observation" href="#"
                                                                data-toggle="modal"
                                                                data-target="#observacion{{ $maint_in_rev->id }}">
                                                                Ver observación
                                                            </a> --}}

                                                        </td>
                                                        <td align="right">
                                                            <div class="dropdown">
                                                                <button type="button"
                                                                    class="btn-action dropdown-toggle"
                                                                    data-toggle="dropdown">
                                                                    Acción <i class="fas fa-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('details.maint.in.review', $maint_in_rev->id) }}">Ver
                                                                        detalles</a>
                                                                    <a class="dropdown-item edit-maint_in_review"
                                                                        href="#"
                                                                        data-maint_in_rev="{{ json_encode($maint_in_rev) }}"
                                                                        data-toggle="modal"
                                                                        data-target="#editorMantenimiento">Editar</a>
                                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                                        data-toggle="modal"
                                                                        data-target="#modalEliminar{{ $maint_in_rev->id }}">Eliminar</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal for observation -->
                                                    <div class="modal fade" id="observacion{{ $maint_in_rev->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered"
                                                            role="document">
                                                            <div class="modal-content" style="border-radius: 10px;">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Observación</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            @isset($maint_in_rev->observaciónes)
                                                                                <p>{{ $maint_in_rev->observaciónes }}</p>
                                                                            @else
                                                                                <p>No hay observación disponible.</p>
                                                                            @endisset
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal Eliminar-->
                                                    <div class="modal fade" id="modalEliminar{{ $maint_in_rev->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered"
                                                            role="document">
                                                            <div class="modal-content border-radius-12">
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-label="Close">
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
                                                                    @isset($maint_in_rev)
                                                                        <form id="delete-form"
                                                                            action="{{ route('destroy.maint.in.review', $maint_in_rev->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn-gris btn-red" onclick="this.disabled=true;this.form.submit();">Sí</button>
                                                                            <button type="button"
                                                                                class="btn-gris btn-border"
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



                            <div id="repuestos" class="tab-pane">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <h3>Repuestos del Ascensor</h3>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="buscador">
                                            <div class="form-group position-relative">
                                                <label for="customSearchBox2"><i class="fal fa-search"></i></label>
                                                <input type="text" id="customSearchBox1" placeholder="Buscar"
                                                    class="w-auto customSearchBox">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 text-right">
                                        <!-- Botón de exportación con menú desplegable de Bootstrap 4 -->
                                        <div class="dropdown">
                                            <button class="btn-gris" type="button" id="dropdownMenuButton2"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="{{ asset('img/iconos/export.svg') }}" alt="icono"
                                                    class="mr-2">
                                                Exportar
                                                Datos <i class="iconoir-nav-arrow-down"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdownMenuButton2">
                                                <button class="dropdown-item export_excel"
                                                    data-table="#repuestosAsensorTable">Excel
                                                </button>
                                                <button class="dropdown-item export_pdf"
                                                    data-table="#repuestosAsensorTable">PDF
                                                </button>
                                                <button class="dropdown-item export_copy"
                                                    data-table="#repuestosAsensorTable">Copiar
                                                </button>
                                                <button class="dropdown-item export_print"
                                                    data-table="#repuestosAsensorTable">Imprimir
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <table id="repuestosAsensorTable" class="table" style="width:100%">
                                            <thead>
                                                <tr>
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($spareparts as $index => $sparepart)
                                                    <tr class="">
                                                        <td>
                                                            @if ($sparepart->foto_de_repuesto)
                                                                <img src="{{ asset('images/' . $sparepart->foto_de_repuesto) }}"
                                                                    alt="personal" width="52" height="52"
                                                                    class="img-table">
                                                        </td>
                                                    @else
                                                        <img src="{{ asset('img/fondo.png') }}" alt="personal"
                                                            width="52" height="52" class="img-table"></td>
                                                @endif
                                                <td>{{ $sparepart->id }}</td>
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
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal actualizar Ascensor-->
                <div class="modal left fade" id="editarAscensor" tabindex="-1" role="dialog"
                    aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-family-Outfit-SemiBold">Editar Ascensor</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>

                            @isset($elevators)
                                <form action="{{ route('update.elevator', $elevators->id) }}" class="formulario-modal"
                                    enctype="multipart/form-data" method="POST" id="editelevatform">
                                    @csrf
                                    <div class="modal-body body_modal">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label>Foto de Ascensor</label>
                                                        <div id="editimagePreview">
                                                            @if ($elevators->imagen)
                                                                <img src="{{ asset('images/' . $elevators->imagen) }}"
                                                                    alt="user" width="200px" height="200px"
                                                                    id="edit-elevator">
                                                            @else
                                                                <img src="{{ asset('img/fondo.png') }}" width="200px"
                                                                    height="200px" class="img-table" alt="user">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="align-items-start col-md-6 d-flex flex-column justify-content-between mb-3">
                                                        <div class="">
                                                            <label for="imageUpload" class="text-gris mt-4">Seleccione una
                                                                imagen</label>
                                                            <input type="file" id="editimageUpload" name="imagen"
                                                                style="display: none;" accept="image/*" />
                                                            <button type="button" id="edituploadButton"
                                                                class="btn-gris">
                                                                <i class="fas fa-arrow-to-top mr-2"></i>Subir
                                                                Imagen
                                                            </button>
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <label for="contrato"># de contrato</label>
                                                            <input type="text" placeholder="# de contrato"
                                                                name="contrato" id="contrato"
                                                                class="form-control @error('contrato') is-invalid @enderror"
                                                                value="{{ old('contrato', $elevators->contrato ?? '') }}">
                                                            @error('contrato')
                                                                <span class="invalid-feedback" style="color: red">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="nombre">Nombre ascensor</label>
                                                            <input type="text" placeholder="Nombre ascensor"
                                                                name="nombre" id="nombre"
                                                                class="form-control @error('nombre') is-invalid @enderror"
                                                                value="{{ old('nombre', $elevators->nombre ?? '') }}">
                                                            @error('nombre')
                                                                <span class="invalid-feedback" style="color: red">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="código">Código</label>
                                                            <input type="text" placeholder="Código" name="código"
                                                                id="código"
                                                                class="form-control @error('código') is-invalid @enderror"
                                                                value="{{ old('código', $elevators->código ?? '') }}">
                                                            @error('código')
                                                                <span class="invalid-feedback" style="color: red">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="marca">Marca</label>
                                                            <select class="custom-select form-control" name="marca_id"
                                                                id="marca_id">
                                                                <option value="" class="d-none">Seleccionar
                                                                    opción
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="text-right mb-3 w-100">
                                                        <div class="form-group">
                                                            <button type="button" data-toggle="modal"
                                                                data-target="#crearMarcas" class="btn-gris brandbtn"
                                                                id="toggleMarcaInput">
                                                                + Agregar marca
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="clienteAscensor">Cliente del
                                                                ascensor</label>
                                                            <select
                                                                class="custom-select form-control @error('client_id') is-invalid @enderror"
                                                                name="client_id" id="client_id">
                                                                @foreach ($customers as $key => $value)
                                                                    <option value="{{ $key }}"
                                                                        {{ old('client_id', $elevators->client_id ?? '') == $key ? 'selected' : '' }}>
                                                                        {{ $value }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('client_id')
                                                                <span class="invalid-feedback" style="color: red">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="fechaEntrega">Fecha de entrega</label>
                                                            <input type="date" placeholder="dd/mm/aaaa"
                                                                class="form-control @error('fecha') is-invalid @enderror"
                                                                name="fecha" id="fecha"
                                                                value="{{ old('fecha', isset($elevators) ? $elevators->fecha : '') }}">
                                                            @error('fecha')
                                                                <span class="invalid-feedback" style="color: red">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="garantia">Garantía</label>
                                                            <input type="text" placeholder="Garantizar"
                                                                class="form-control @error('garantizar') is-invalid @enderror"
                                                                name="garantizar" id="garantizar"
                                                                value="{{ old('garantizar', $elevators->garantizar ?? '') }}">
                                                            @error('garantizar')
                                                                <span class="invalid-feedback" style="color: red">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="dirección">Dirección</label>
                                                            <input type="text" placeholder="Dirección"
                                                                class="form-control @error('dirección') is-invalid @enderror"
                                                                name="dirección" id="dirección"
                                                                value="{{ old('dirección', $elevators->dirección ?? '') }}">
                                                            @error('dirección')
                                                                <span class="invalid-feedback" style="color: red">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="ubigeo">Ubigeo</label>
                                                            <input type="text" placeholder="Ubigeo"
                                                                class="form-control @error('ubigeo') is-invalid @enderror"
                                                                name="ubigeo" id="ubigeo"
                                                                value="{{ old('ubigeo', $elevators->ubigeo ?? '') }}">
                                                            @error('ubigeo')
                                                                <span class="invalid-feedback" style="color: red">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="provincia">Provincia</label>
                                                            <select
                                                                class="custom-select form-control @error('provincia') is-invalid @enderror"
                                                                name="provincia" id="edit-provincia">
                                                                <option value="">Seleccionar
                                                                    opción</option>
                                                            </select>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="tecnicoInstalador">Técnico
                                                                instalador</label>
                                                            <select class="custom-select form-control"
                                                                name="técnico_instalador" id="edit-técnico_instalador">
                                                                <option value="">Seleccionar opción</option>
                                                                @foreach ($staffs as $staff)
                                                                    <option value="{{ $staff }}"
                                                                        {{ $elevators->técnico_instalador == $staff ? 'selected' : '' }}>
                                                                        {{ $staff }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="técnico_ajustador">Técnico
                                                                ajustador</label>
                                                            <select class="custom-select form-control"
                                                                name="técnico_ajustador" id="edit-técnico_ajustador">
                                                                <option value="">Seleccionar opción</option>
                                                                @foreach ($staffs as $staff)
                                                                    <option value="{{ $staff }}"
                                                                        {{ $elevators->técnico_ajustador == $staff ? 'selected' : '' }}>
                                                                        {{ $staff }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="tipo_de_ascensor">Tipo de ascensor</label>
                                                            <select class="custom-select form-control"
                                                                name="tipo_de_ascensor" id="edit-tipo_de_ascensor">
                                                                <option value="">Seleccionar opción</option>
                                                                @foreach ($elevatortypes as $elevatortype)
                                                                    <option value="{{ $elevatortype }}"
                                                                        {{ $elevators->tipo_de_ascensor == $elevatortype ? 'selected' : '' }}>
                                                                        {{ $elevatortype }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tiposAscensor">Cantidad</label>

                                                            <input type="number" placeholder="Cantidad"
                                                                class="form-control" name="cantidad" id="cantidad"
                                                                value="{{ old('cantidad', $elevators->cantidad ?? '') }}">
                                                            @error('cantidad')
                                                                <span class="invalid-feedback" style="color: red">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12"></div>
                                                    <div class="col-md-6">
                                                        <div class="adornoinput mb-3">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="mgratuito" name="quarters[]" value="mgratuito"
                                                                    {{ in_array('mgratuito', explode(',', $elevators->quarters)) ? 'checked' : '' }}>
                                                                <label class="custom-control-label"
                                                                    for="mgratuito">Mantenimiento
                                                                    gratuito?</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="adornoinput mb-3">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="sincuarto" name="quarters[]" value="sincuarto"
                                                                    {{ in_array('sincuarto', explode(',', $elevators->quarters)) ? 'checked' : '' }}>
                                                                <label class="custom-control-label" for="sincuarto">Sin
                                                                    cuarto de
                                                                    maquina?</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="adornoinput mb-3">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="concuarto" name="quarters[]" value="concuarto"
                                                                    {{ in_array('concuarto', explode(',', $elevators->quarters)) ? 'checked' : '' }}>
                                                                <label class="custom-control-label" for="concuarto">Con
                                                                    cuarto de
                                                                    maquina?</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="Npisos"># de pisos</label>
                                                            <input type="number" placeholder="#" name="npisos"
                                                                id="npisos"
                                                                class="form-control @error('npisos') is-invalid @enderror"
                                                                value="{{ old('npisos', isset($elevators) ? $elevators->npisos : '') }}">
                                                            @error('npisos')
                                                                <span class="invalid-feedback" style="color: red">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="Ncontacto">Nombre del Contacto</label>
                                                            <input type="text" placeholder="Nombre del contacto"
                                                                name="ncontacto" id="ncontacto"
                                                                class="form-control @error('ncontacto') is-invalid @enderror"
                                                                value="{{ old('ncontacto', isset($elevators) ? $elevators->ncontacto : '') }}">
                                                            @error('ncontacto')
                                                                <span class="invalid-feedback" style="color: red">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="telefono">Teléfono</label>
                                                            <input type="number" placeholder="Teléfono"
                                                                class="form-control @error('teléfono') is-invalid @enderror"
                                                                name="teléfono" id="teléfono"
                                                                value="{{ old('teléfono', isset($elevators) ? $elevators->teléfono : '') }}">
                                                            @error('teléfono')
                                                                <span class="invalid-feedback" style="color: red">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="correo">Correo electrónico</label>
                                                            <input type="text" placeholder="Correo electrónico"
                                                                class="form-control @error('correo') is-invalid @enderror"
                                                                name="correo" id="correo"
                                                                value="{{ old('correo', isset($elevators) ? $elevators->correo : '') }}">
                                                            @error('correo')
                                                                <span class="invalid-feedback" style="color: red">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="Descripcion1">Descripción 1</label>
                                                            <textarea name="descripcion1" id="descripcion1" placeholder="Descripción" cols="30" rows="5"
                                                                class="form-control">{{ old('descripcion1', isset($elevators) ? $elevators->descripcion1 : '') }}</textarea>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 d-none position-relative" id="DAdicional1">
                                                        <div class="form-group">
                                                            <label for="Descripcion2">Descripción 2</label>
                                                            <textarea name="descripcion2" id="descripcion2" placeholder="Descripción" cols="30" rows="5">{{ old('descripcion2', isset($elevators) ? $elevators->descripcion2 : '') }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="button" class="btn-gris"
                                                            id="AgregarDescripcion1">+
                                                            Agregar
                                                            Descripción</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                                        <button type="submit" class="btn-gris btn-red mr-2">actualizar cambios
                                        </button>
                                        <button type="button" class="btn-gris btn-border"
                                            data-dismiss="modal">Cancelar</button>
                                    </div>
                                </form>
                            @endisset
                        </div>
                    </div>
                </div>

                {{-- Model Crear Marcas --}}
                <div class="modal left fade" id="crearMarcas" tabindex="-1" role="dialog"
                    aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-family-Outfit-SemiBold">Crear Ascensor</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="col-md-12" id="marcaInputSection" style="">
                                <form method="POST" id="brandForm">
                                    @csrf
                                    <div class="form-group">
                                        <label>Ingresar marca</label>
                                        <input type="text" placeholder="Ingresar marca" name="marca_nombre"
                                            id="marca_nombre" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn-primario w-auto pl-3 pr-3"
                                            id="submitBrand">
                                            Entregar
                                        </button>
                                        <button type="button" class="btn-primario w-auto pl-3 pr-3"
                                            id="cancelMarca">
                                            Cancelar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Creando Mantenimiento-->
                <div class="modal left fade" id="crearMantenimiento" tabindex="-1" role="dialog"
                    aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-family-Outfit-SemiBold">Creando Mantenimiento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form action="{{ route('maintInReviewInsert.elevator', ['id' => $elevators->id]) }}"
                                method="POST" class="formulario-modal" id="createmaintreview">
                                @csrf
                                <div class="modal-body body_modal">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="tipo_de_revisión">Tipo de revisión</label>
                                                <select class="custom-select" name="tipo_de_revisión"
                                                    id="tipo_de_revisión" class="form-control">
                                                    <option selected disabled>Seleccionar tipo de revisión</option>
                                                    @foreach ($review_types as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="ascensor">Ascensor</label>
                                                <input type="text" class="form-control" name="ascensor"
                                                    id="ascensor"
                                                    value="{{ old('ascensor', $elevators->nombre) }}" readonly>
                                                <input type="hidden" name="ascensor"
                                                    value="{{ $elevators->id }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="dirección">Dirección</label>
                                                <input type="text" placeholder="Dirección" name="dirección"
                                                    id="dirección" class="form-control"
                                                    value="{{ old('dirección', $elevators->dirección) }}">
                                                @error('dirección')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="provincia">Provincia</label>
                                                <select id="provincia" name="provincia" class="form-control">
                                                    <option value="">Seleccionar Provincia</option>
                                                    @foreach ($provinces as $key => $province)
                                                        <option value="{{ $key }}"
                                                            {{ old('provincia', $elevators->provincia) == $key ? 'selected' : '' }}>
                                                            {{ $province }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            {{-- <div class="row"> --}}
                                            {{-- <div class="col-md-6"> --}}
                                            <div class="form-group">
                                                <label for="núm_certificado">Núm Certificado</label>
                                                <input type="text" placeholder="Núm Certificado"
                                                    name="núm_certificado" id="núm_certificado"
                                                    class="form-control">
                                            </div>
                                            {{-- </div> --}}
                                            {{-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="máquina">#Máquina</label>
                                                        <input type="text" placeholder="#Máquina"
                                                            name="máquina" id="máquina" class="form-control">
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="form-group">
                                                <label for="supervisor">Supervisor</label>
                                                <select class="custom-select" name="supervisor_id" id="supervisor_id">

                                                </select>
                                                @error('supervisor_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="text-right w-100">
                                                <div class="form-group">
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#crearSupervisor"
                                                        class="btn-gris supervisorbtn" id="toggleMarcaInput">
                                                        + Agregar Supervisor
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="técnico">Técnico</label>
                                                <select class="custom-select form-control" name="técnico"
                                                    id="técnico">
                                                    <option value="" class="d-none">Seleccionar
                                                        opción
                                                    </option>
                                                    @foreach ($staffs as $key => $staff)
                                                        <option value="{{ $key }}">
                                                            {{ $staff }}</option>
                                                    @endforeach
                                                </select>
                                                @error('técnico')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="Mprogramado">Mes programado</label>
                                                        <select class="custom-select" name="mes_programado"
                                                            id="Mprogramado">
                                                            <option value="">Seleccionar opción</option>
                                                            <option value="1">Enero</option>
                                                            <option value="2">Febrero</option>
                                                            <option value="3">Marzo</option>
                                                            <option value="4">Abril</option>
                                                            <option value="5">Mayo</option>
                                                            <option value="6">Junio</option>
                                                            <option value="7">Julio</option>
                                                            <option value="8">Agosto</option>
                                                            <option value="9">Septiembre</option>
                                                            <option value="10">Octubre</option>
                                                            <option value="11">Noviembre</option>
                                                            <option value="12">Diciembre</option>


                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="FMantenimiento">Fecha de mantenimiento</label>
                                                        <input type="date" placeholder="dd/mm/aaaa"
                                                            name="fecha_de_mantenimiento" id="FMantenimiento"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="FInicio">Hora inicio</label>
                                                        <input type="time" placeholder="dd/mm/aaaa"
                                                            name="hora_inicio" id="FInicio"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="HFin">Hora fin</label>
                                                        <input type="time" placeholder="dd/mm/aaaa"
                                                            name="hora_fin" id="HFin" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="observaciones">Observaciónes</label>
                                                        <textarea name="observaciónes" id="observaciones" placeholder="Comentario de contrato" cols="30"
                                                            rows="5" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="observacionesInternas">Observaciónes
                                                            internas</label>
                                                        <textarea name="observaciónes_internas" id="observacionesInternas" placeholder="Observaciónes internas"
                                                            cols="30" rows="5" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="solucion">Solución</label>
                                                        <textarea name="solución" id="solucion" placeholder="Solución" cols="30" rows="5"
                                                            class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                                    <button type="submit" class="btn-gris btn-red mr-2" onclick="this.disabled=true;this.form.submit();">Guardar Cambios</button>
                                    <button type="button" class="btn-gris btn-border"
                                        data-dismiss="modal">Cancelar</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- Modal Editor Mantenimiento-->
                <div class="modal left fade" id="editorMantenimiento" tabindex="-1" role="dialog"
                    aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-family-Outfit-SemiBold">Edición De
                                    Mantenimiento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form action="" class="formulario-modal" enctype="multipart/form-data"
                                method="POST" id="editmaintreview">
                                @csrf
                                @method('PUT')
                                <div class="modal-body body_modal">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="TRevision">Tipo de revisión</label>
                                                <select
                                                    class="custom-select @error('tipo_de_revisión') is-invalid @enderror"
                                                    name="tipo_de_revisión" id="edit-tipo_de_revisión">
                                                    <option disabled>Seleccionar tipo de
                                                        revisión</option>

                                                </select>
                                                @error('tipo_de_revisión')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label for="MAscensor">Ascensor</label>
                                                <select class="custom-select @error('ascensor') is-invalid @enderror"
                                                    name="ascensor" id="edit-MAscensor">

                                                </select>
                                                @error('ascensor')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="Direccion">Dirección</label>
                                                <input type="text" placeholder="Dirección" name="dirección"
                                                    id="edit-dirección"
                                                    class="form-control @error('dirección') is-invalid @enderror"
                                                    value="">
                                                @error('dirección')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label for="provinciaAs">Provincia</label>
                                                <select id="edit-province" name="provincia" class="form-control">
                                                    <option value="">Seleccionar
                                                        Provincia
                                                    </option>

                                                </select>
                                                @error('provincia')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            {{-- <div class="row"> --}}
                                            {{-- <div class="col-md-6"> --}}
                                            <div class="form-group">
                                                <label for="núm_certificado">Núm Certificado</label>
                                                <input type="number" placeholder="Núm Certificado"
                                                    name="núm_certificado" id="edit-NCertificado"
                                                    class="form-control">
                                            </div>
                                            {{-- </div> --}}
                                            {{-- <div class="col-md-6">
                             <div class="form-group">
                                 <label for="máquina">#Máquina</label>
                                 <input type="text" placeholder="#Máquina" name="máquina" id="máquina"
                                     class="form-control">
                             </div>
                         </div> --}}
                                            {{-- </div> --}}
                                            <div class="form-group">
                                                <label for="Supervisor">Supervisor</label>
                                                <select
                                                    class="custom-select  @error('supervisor') is-invalid @enderror"
                                                    name="supervisor_id" id="supervisor_id1">

                                                </select>
                                                @error('supervisor')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="text-right w-100">
                                                <div class="form-group">
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#crearSupervisor"
                                                        class="btn-gris supervisorbtn" id="toggleMarcaInput">
                                                        + Agregar Supervisor
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="técnico">Técnico</label>
                                                <select class="custom-select" name="técnico" id="edit-técnico">
                                                    <option value="">Seleccionar opción
                                                    </option>

                                                </select>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="Mprogramado">Mes
                                                            programado</label>
                                                        <select
                                                            class="custom-select @error('mes_programado') is-invalid @enderror"
                                                            name="mes_programado" id="edit-Mprogramado">
                                                            <option value="">Seleccionar opción</option>

                                                        </select>
                                                        @error('mes_programado')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="FMantenimiento">Fecha de
                                                            mantenimiento</label>
                                                        <input type="date" placeholder="dd/mm/aaaa"
                                                            name="fecha_de_mantenimiento" id="edit-FMantenimiento"
                                                            class="form-control @error('fecha_de_mantenimiento') is-invalid @enderror"
                                                            value="">
                                                        @error('fecha_de_mantenimiento')
                                                            <span class="invalid-feedback" style="color: red">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="FInicio">Hora
                                                            inicio</label>
                                                        <input type="time" placeholder="Hora inicio"
                                                            name="hora_inicio" id="edit-FInicio"
                                                            class="form-control @error('hora_inicio') is-invalid @enderror"
                                                            value="">
                                                        @error('hora_inicio')
                                                            <span class="invalid-feedback" style="color: red">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="HFin">Hora fin</label>
                                                        <input type="time" placeholder="Hora fin"
                                                            name="hora_fin" id="edit-HFin"
                                                            class="form-control @error('hora_fin') is-invalid @enderror"
                                                            value="">
                                                        @error('hora_fin')
                                                            <span class="invalid-feedback" style="color: red">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="observaciónes">Observaciones</label>
                                                        <textarea name="observaciónes" id="edit-observaciónes" placeholder="Comentario de contrato" cols="30"
                                                            rows="5"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="observacionesInternas">Observaciones
                                                            internas</label>
                                                        <textarea name="observaciónes_internas" id="edit-observacionesInternas" placeholder="Observaciones internas"
                                                            cols="30" rows="5"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="solucion">Solución</label>
                                                        <textarea name="solución" id="edit-solucion" placeholder="Solución" cols="30" rows="5"></textarea>
                                                    </div>
                                                </div>


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

                <!-- Modal Eliminar-->
                <div class="modal fade" id="modalEliminar{{ $elevators->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content border-radius-12">
                            <divw class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
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
                            </divw>
                            <div class="modal-footer align-items-center justify-content-center">
                                @isset($elevators)
                                    <form id="delete-form" action="{{ route('destroy.elevator', $elevators->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-gris btn-red" onclick="this.disabled=true;this.form.submit();">Sí</button>
                                        <button type="button" class="btn-gris btn-border"
                                            data-dismiss="modal">No</button>
                                    </form>
                                @endisset
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal fade text-left" id="showQrCodeModal" role="dialog"
                    aria-labelledby="showQrCodeModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Código QR Generado</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="qrcode" class="qrcode">
                                    <img src="{{ asset('img/qr_code.jpg') }}" width="100"></img>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn grey btn-outline-secondary"
                                    data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- Model Crear Supervisor --}}
    <div class="modal left fade" id="crearSupervisor" tabindex="-1" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-family-Outfit-SemiBold">Crear Supervisor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="col-md-12" id="marcaInputSection" style="">
                    <form method="POST" id="SupervisorForm">
                        @csrf
                        <div class="form-group">
                            <label>Ingresar Supervisor</label>
                            <input type="text" placeholder="Ingresar Supervisor" name="nomber"
                                id="nomber" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn-primario w-auto pl-3 pr-3" id="submitSupervisor">
                                Entregar
                            </button>
                            <button type="button" class="btn-primario w-auto pl-3 pr-3" id="cancelSupervisor">
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

            $('#AgregarDescripcion1').click(function() {
                $('#DAdicional1').removeClass('d-none');
            });
            $('#brandForm').on('keypress', function(e) {
                if (e.which === 13) { // 13 is the Enter key code
                    e.preventDefault();
                    return false;
                }
            });
            $('#SupervisorForm').on('keypress', function(e) {
                if (e.which === 13) { // 13 is the Enter key code
                    e.preventDefault();
                    return false;
                }
            });

            function getSupervisors(edit) {
                // Destroy existing Select2 instance if it exists
                if ($('#supervisor_id').data('select2')) {
                    $('#supervisor_id').select2('destroy');
                }
                if ($('#supervisor_id1').data('select2')) {
                    $('#supervisor_id1').select2('destroy');
                }

                // Perform the AJAX call to get supervisor data
                $.ajax({
                    type: "GET",
                    url: "{{ route('supervisors') }}", // Ensure this route is correct
                    dataType: "JSON",
                    success: function(response) {
                        // Clear the current options and append the retrieved options to the select element
                        $("#supervisor_id,#supervisor_id1").empty();
                        $("#supervisor_id,supervisor_id1").append(
                            '<option value="" class="d-none">Seleccionar Supervisor</option>'
                        ); // Add placeholder option

                        $.each(response, function() {
                            $("#supervisor_id,#supervisor_id1").append(
                                `<option value='${this.id}'>${this.nomber}</option>`
                            );
                        });

                        // Initialize Select2 on the select element
                        $('#supervisor_id').select2({
                            placeholder: "Seleccionar Supervisor",
                            allowClear: true
                        });

                        $('#supervisor_id1').select2({
                            placeholder: "Seleccionar Supervisor",
                            allowClear: true
                        });

                        // If edit is true and has a valid ID, set the selected value
                        if (edit) {
                            $('#supervisor_id1').val(edit).trigger('change');
                            console.log('Selected supervisor set to:', edit);
                        }
                    },
                    error: function(xhr) {
                        console.error('Error fetching supervisors:', xhr.responseText);
                    }
                });
            }

            function getDataMain(edit) {
                // Destroy existing Select2 instances if they exist
                if ($('#edit-tipo_de_revisión').data('select2')) {
                    $('#edit-tipo_de_revisión').select2('destroy');
                }
                if ($('#edit-MAscensor').data('select2')) {
                    $('#edit-MAscensor').select2('destroy');
                }
                if ($('#edit-province').data('select2')) {
                    $('#edit-province').select2('destroy');
                }
                if ($('#edit-técnico').data('select2')) {
                    $('#edit-técnico').select2('destroy');
                }
                if ($('#edit-Mprogramado').data('select2')) {
                    $('#edit-Mprogramado').select2('destroy');
                }

                // Perform the AJAX call to get brand data
                $.ajax({
                    type: "GET",
                    url: "{{ route('getDataMaintance') }}",
                    dataType: "JSON",
                    success: function(response) {
                        // Clear the current options and append the retrieved options to the select elements
                        $("#edit-tipo_de_revisión, #edit-province, #edit-MAscensor, #edit-técnico, #edit-Mprogramado")
                            .empty();
                        $("#edit-tipo_de_revisión").append(
                            '<option value="" class="d-none">Seleccionar opción</option>');
                        $("#edit-MAscensor").append(
                            '<option value="" class="d-none">Seleccionar opción</option>');
                        $("#edit-técnico").append(
                            '<option value="" class="d-none">Seleccionar opción</option>');
                        $("#edit-Mprogramado").append(
                            '<option value="" class="d-none">Seleccionar opción</option>');

                        // Populate each dropdown with the corresponding data
                        $.each(response.review_types, function(id, nombre) {
                            $("#edit-tipo_de_revisión").append(
                                `<option value='${id}'>${nombre}</option>`);
                        });
                        $.each(response.provinces, function(id, provincia) {
                            $("#edit-province").append(
                                `<option value='${id}'>${provincia}</option>`);
                        });
                        $.each(response.staffs, function(id, nombre) {
                            $("#edit-técnico").append(
                                `<option value='${id}'>${nombre}</option>`);
                        });
                        $.each(response.elevators, function(id, nombre) {
                            $("#edit-MAscensor").append(
                                `<option value='${id}'>${nombre}</option>`);
                        });
                        $.each(response.months, function(id, nombre) {
                            $("#edit-Mprogramado").append(
                                `<option value='${id}'>${nombre}</option>`);
                        });

                        // Initialize Select2 on the select elements with placeholder
                        $('#edit-tipo_de_revisión, #edit-province, #edit-MAscensor, #edit-técnico, #edit-Mprogramado')
                            .select2({
                                placeholder: "Seleccionar opción",
                                allowClear: true
                            });

                        // Log the edit object to check values
                        console.log('Edit Object:', edit);

                        // If edit is true and has a valid ID, set the selected value
                        if (edit) {
                            console.log('Setting values for Select2:');
                            console.log('Tipo de revisión:', edit.tipo_de_revisión);
                            console.log('Ascensor:', edit.ascensor);
                            console.log('Mes programado:', edit.mes_programado);

                            $('#edit-tipo_de_revisión').val(edit.tipo_de_revisión).trigger('change');
                            $('#edit-province').val(edit.provincia).trigger('change');
                            $('#edit-técnico').val(edit.técnico).trigger('change');
                            $('#edit-MAscensor').val(edit.ascensor).trigger('change');
                            $('#edit-Mprogramado').val(edit.mes_programado).trigger('change');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching data: ", error);
                    }
                });
            }

            // Call the function when needed, e.g., when opening the modal
            const editValue = '{{ $editValue ?? '' }}'; // Replace with actual edit value if available
            getSupervisors(editValue);
            getDataMain();

            // Handle form submission
            $('#submitSupervisor').click(function(e) {
                e.preventDefault(); // Prevent default form submission
                var formData = new FormData();
                formData.append('nomber', $('#nomber').val());

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
                    url: "{{ route('insert.supervisor') }}", // Make sure to create this route
                    success: function(response) {
                        getSupervisors();
                        $('#cancelSupervisor').click();
                    },
                    error: function(xhr) {
                        console.error('Error creating supervisor:', xhr.responseText);
                        // Handle error (e.g., show error message to user)
                    }
                });
            });

            // Handle modal close on cancel button click
            $('#cancelSupervisor').click(function() {
                $("#crearSupervisor").modal('hide');
            });

            let selectize;

            function getBrand(edit) {
                // Destroy existing Select2 instances if they exist
                if ($('#marca_id').data('select2')) {
                    $('#marca_id').select2('destroy');
                }

                // Perform the AJAX call to get brand data
                $.ajax({
                    type: "GET",
                    url: "{{ route('getBrands') }}",
                    dataType: "JSON",
                    success: function(response) {
                        // Clear the current options and append the retrieved options to the select elements
                        $("#marca_id").empty();
                        $("#marca_id").append(
                            '<option value="" class="d-none">Seleccionar opción</option>'
                        ); // Add placeholder option

                        $.each(response, function() {
                            $("#marca_id").append(
                                `<option value='${this.id}'>${this['marca_nombre']}</option>`
                            );
                        });

                        // Initialize Select2 on the select elements with placeholder
                        $('#marca_id').select2({
                            placeholder: "Seleccionar marca",
                            allowClear: true
                        });

                        // If edit is true and has a valid ID, set the selected value
                        if (edit) {
                            $('#marca_id').val(edit).trigger('change');
                            console.log(edit);
                        }
                    }
                });
            }

            function getDatas(edit) {
                // Destroy existing Select2 instances if they exist
                if ($('#edit-cliente').data('select2')) {
                    $('#edit-cliente').select2('destroy');
                }
                if ($('#edit-provincia').data('select2')) {
                    $('#edit-provincia').select2('destroy');
                }
                if ($('#edit-técnico_instalador').data('select2')) {
                    $('#edit-técnico_instalador').select2('destroy');
                }
                if ($('#edit-técnico_ajustador').data('select2')) {
                    $('#edit-técnico_ajustador').select2('destroy');
                }
                if ($('#edit-tipo_de_ascensor').data('select2')) {
                    $('#edit-tipo_de_ascensor').select2('destroy');
                }

                // Perform the AJAX call to get brand data
                $.ajax({
                    type: "GET",
                    url: "{{ route('getData') }}",
                    dataType: "JSON",
                    success: function(response) {
                        // Clear the current options and append the retrieved options to the select elements
                        $("#edit-cliente, #edit-provincia, #edit-técnico_instalador, #edit-técnico_ajustador, #edit-tipo_de_ascensor")
                            .empty();
                        $("#edit-cliente").append(
                            '<option value="" class="d-none">Seleccionar opción</option>');
                        $("#edit-provincia").append(
                            '<option value="" class="d-none">Seleccionar opción</option>');
                        $("#edit-técnico_instalador").append(
                            '<option value="" class="d-none">Seleccionar opción</option>');
                        $("#edit-técnico_ajustador").append(
                            '<option value="" class="d-none">Seleccionar opción</option>');
                        $("#edit-tipo_de_ascensor").append(
                            '<option value="" class="d-none">Seleccionar opción</option>');

                        // Populate each dropdown with the corresponding data
                        $.each(response.clientes, function(id, nombre) {
                            $("#edit-cliente").append(
                                `<option value='${id}'>${nombre}</option>`);
                        });
                        $.each(response.provincias, function(id, provincia) {
                            $("#edit-provincia").append(
                                `<option value='${id}'>${provincia}</option>`);
                        });
                        $.each(response.staffs, function(id, nombre) {
                            $("#edit-técnico_instalador").append(
                                `<option value='${id}'>${nombre}</option>`);
                            $("#edit-técnico_ajustador").append(
                                `<option value='${id}'>${nombre}</option>`);
                        });
                        $.each(response.elevatortypes, function(id, nombre_de_tipo_de_ascensor) {
                            $("#edit-tipo_de_ascensor").append(
                                `<option value='${id}'>${nombre_de_tipo_de_ascensor}</option>`
                            );
                        });

                        // Initialize Select2 on the select elements with placeholder
                        $('#edit-cliente, #edit-provincia, #edit-técnico_instalador, #edit-técnico_ajustador, #edit-tipo_de_ascensor')
                            .select2({
                                placeholder: "Seleccionar opción",
                                allowClear: true
                            });

                        // If edit is true and has a valid ID, set the selected value
                        if (edit) {
                            $('#edit-cliente').val(edit.client_id).trigger(
                                'change'); // Ensure the value is set and trigger change
                            $('#edit-provincia').val(edit.provincia).trigger(
                                'change'); // Ensure the value is set and trigger change
                            $('#edit-técnico_instalador').val(edit.técnico_instalador).trigger(
                                'change'); // Ensure the value is set and trigger change
                            $('#edit-técnico_ajustador').val(edit.técnico_ajustador).trigger(
                                'change'); // Ensure the value is set and trigger change
                            $('#edit-tipo_de_ascensor').val(edit.tipo_de_ascensor.id).trigger(
                                'change'); // Ensure the value is set and trigger change
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching data: ", error);
                    }
                });
            }

            getBrand();
            getDatas();

            $('#submitBrand').click(function(e) {
                e.preventDefault(); // Prevent default form submission
                var formData = new FormData();
                formData.append('marca_nombre', $('#marca_nombre').val());
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
                    url: "{{ route('insert.brand') }}",
                    success: function(response) {
                        getBrand();
                        $('#cancelMarca').click();
                    }
                })
            });

            $('#cancelMarca').click(function() {
                $("#crearMarcas").modal('hide')
            });

            var table1 = $('#contratosTable').DataTable({
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
                            // Remove the last column from the table body
                            doc.content[1].table.body.forEach(function(row) {
                                row.pop(); // Remove the last column from each row
                            });
                            doc.content[1].table.widths = Array(doc.content[1].table.body[0]
                                .length + 1).join('*').split('');
                            var columnCount = doc.content[1].table.body[0].length;
                            doc.content[1].table.body.forEach(function(row) {
                                row[0].alignment =
                                    'center'; // Center align the first column
                                row[1].alignment =
                                    'center'; // Center align the second column
                                row[2].alignment =
                                    'center'; // Center align the third column
                                row[3].alignment =
                                    'center'; // Center align the fourth column
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
            $(".export_excel").on("click", function() {
                var tableId = $(this).data("table");
                var table1 = $(tableId).DataTable();
                table1.button('.buttons-csv').trigger();
            });
            $(".export_pdf").on("click", function() {
                var tableId = $(this).data("table");
                var table1 = $(tableId).DataTable();
                table1.button('.buttons-pdf').trigger();
            });
            $(".export_copy").on("click", function() {
                var tableId = $(this).data("table");
                var table1 = $(tableId).DataTable();
                table1.button('.buttons-copy').trigger();
            });
            $(".export_print").on("click", function() {
                var tableId = $(this).data("table");
                var table1 = $(tableId).DataTable();

                event.stopPropagation(); // Stop the event from bubbling up

                // Set a delay of 1 second before triggering the print
                setTimeout(function() {
                    table1.button('.buttons-print').trigger();
                    $('.row').css('cursor', 'pointer');
                }, 1000); // 1000 milliseconds = 1 second
                setTimeout(function() {
                    window.location.reload();
                }, 1000); // Adjust the delay as needed

            });

            $('#customSearchBox').keyup(function() {
                table1.column(0).search($(this).val()).draw(); // Change here to target only the second column
            });
            $('#customSearchBox2').keyup(function() {
                table2.column(0).search($(this).val()).draw(); // Change here to target only the second column
            });
            $('#customSearchBox1').keyup(function() {
                table.column(2).search($(this).val()).draw(); // Change here to target only the second column
            });

            var table2 = $('#mantenimientosTable').DataTable({
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
                            columns: ':not(:nth-last-child(-n+1))' // Excluye las dos últimas columnas
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:nth-last-child(-n+1))' // Excluye las dos últimas columnas
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':not(:nth-last-child(-n+1))' // Excluye las dos últimas columnas
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':not(:nth-last-child(-n+1))' // Excluye las dos últimas columnas
                        },
                        customize: function(doc) {
                            doc.pageSize = 'A4'; // Set page size to A4
                            doc.defaultStyle.fontSize = 10; // Set default font size
                            doc.pageMargins = [30, 0, 20, 0]; // Set left margin to 30, right margin to 20

                            // Set specific widths for each column
                            doc.content[1].table.widths = [70, 70, 70, 70, 70, '*']; // Adjust the first column width

                            var columnCount = doc.content[1].table.body[0].length;
                            doc.content[1].table.body.forEach(function(row) {
                                row[0].alignment =
                                    'center'; // Center align the first column
                                row[1].alignment =
                                    'center'; // Center align the second column
                                row[2].alignment =
                                    'center'; // Center align the third column
                                row[3].alignment =
                                    'left'; // Center align the fourth column
                                row[columnCount - 1].alignment =
                                    'center'; // Center align the last column
                            });
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(:nth-last-child(-n+1))' // Excluye las dos últimas columnas
                        }
                    }
                    // 'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            // $("#export_excel").on("click", function() {

            //     // Perform AJAX request to export Excel
            //     $.ajax({
            //         url: "{{ route('elevators.export', ['type' => 'excel', 'id' => $elevators->id]) }}", // Added 'id' parameter
            //         method: 'GET',
            //         xhrFields: {
            //             responseType: 'blob' // Set response type to blob for file download
            //         },
            //         success: function(data) {
            //             // if (!isDownloading) {
            //             //     isDownloading = true;
            //             //     // Create a link element to download the Excel file
            //             //     const url = window.URL.createObjectURL(data);
            //             //     const a = document.createElement('a');
            //             //     a.href = url;
            //             //     a.download = 'maint_in_review.xlsx'; // Set the desired file name
            //             //     document.body.appendChild(a);
            //             //     a.click();
            //             //     a.remove();
            //             //     window.URL.revokeObjectURL(url); // Clean up
            //             // }
            //         },
            //         error: function(xhr) {
            //             console.error('Error exporting Excel:', xhr.responseText);
            //         },
            //         complete: function() {
            //         }
            //     });
            // });

            // $("#export_copy").on("click", function() {
            //     $.ajax({
            //         url: "{{ route('elevators.export', ['type' => 'copy', 'id' => $elevators->id]) }}", // Added 'id' parameter
            //         method: 'GET',
            //         success: function(response) {
            //             console.log('Response from server:',
            //             response); // Log the response to debug

            //             // Create a temporary textarea element
            //             const tempTextArea = document.createElement("textarea");
            //             tempTextArea.value = response; // Set the response as the value
            //             document.body.appendChild(tempTextArea); // Append to the body
            //             tempTextArea.select(); // Select the text

            //             // Copy the text to clipboard
            //             document.execCommand("copy"); // Copy the text to clipboard
            //             document.body.removeChild(tempTextArea); // Remove the textarea
            //         },
            //         error: function(xhr) {
            //             console.error('Error copying table:', xhr.responseText);
            //         },
            //         complete: function() {
            //         }
            //     });
            // });
            // $("#export_pdf").on("click", function() {

            //     // Perform AJAX request to export PDF
            //     $.ajax({
            //         url: "{{ route('elevators.export', ['type' => 'pdf', 'id' => $elevators->id]) }}", // Added 'id' parameter
            //         method: 'GET',
            //         xhrFields: {
            //             responseType: 'blob' // Set response type to blob for file download
            //         },
            //         success: function(data) {
            //             // // Create a link element to download the PDF
            //             // const url = window.URL.createObjectURL(data);
            //             // const a = document.createElement('a');
            //             // a.href = url;
            //             // a.download = 'maint_in_review.pdf'; // Set the desired file name
            //             // document.body.appendChild(a);
            //             // a.click();
            //             // a.remove();
            //             // window.URL.revokeObjectURL(url); // Clean up
            //         },
            //         error: function(xhr) {
            //             console.error('Error exporting PDF:', xhr.responseText);
            //         },
            //         complete: function() {
            //         }
            //     });
            // });

            // // ... existing code ...
            // $("#export_print").on("click", function() {
            //     // Perform AJAX request to export Print
            //     $.ajax({
            //         url: "{{ route('elevators.export', ['type' => 'print', 'id' => $elevators->id]) }}", // Added 'id' parameter
            //         method: 'GET',
            //         success: function(data) {
            //             // Handle the successful response here
            //             // For example, you might want to trigger a download or display a message
            //             console.log('Print export successful:', data);
            //         },
            //         error: function(xhr) {
            //             console.error('Error exporting Print:', xhr.responseText);
            //             alert('An error occurred while exporting. Please try again.'); // Notify user
            //         },
            //         complete: function() {
            //             $("#").hide(); // Hide loader after the request is complete
            //         }
            //     });
            // });
            // // ... existing code ...

            var table = $('#repuestosAsensorTable').DataTable({
                responsive: true,
                dom: 'tp',
                pageLength: 20, // Establece el número de registros por página a 8
                order: [[1, 'desc']],
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
                            columns: ':not(:first-child)' // Excluye la última columna
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:first-child)' // Excluye la última columna
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
                            columns: ':not(:first-child)' // Excludes the first and last columns
                        },
                        customize: function(doc) {
                            var table = doc.content[1].table;

                            // Center align all header cells
                            table.headerRows = 1; // Specify that the first row is the header

                            // Center align all cells in the body
                            table.body.forEach(function(row, rowIndex) {
                                row.forEach(function(cell) {
                                    cell.alignment =
                                        'center'; // Center align all cells
                                });
                            });

                            // Center align all cells in the header
                            if (table.body.length > 0) {
                                table.body[0].forEach(function(cell) {
                                    cell.alignment = 'center'; // Center align header cells
                                });
                            }

                            // Ensure this is suitable for your content
                            doc.pageOrientation = 'landscape';
                            doc.pageSize = 'A4';
                            doc.defaultStyle.fontSize = 8; // Adjust font size as needed

                            // Adjust the height of rows if necessary
                            table.body.forEach(function(row) {
                                row.forEach(function(cell) {
                                    cell.margin = [5,
                                        5
                                    ]; // Add margin to cells for better spacing
                                });
                            });
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(:first-child)' // Excluye la última columna
                        }
                    }
                    // 'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            $("#qrButton").click(function() {
                $('#showQrCodeModal').modal('show');
            });
            $('.view-observation').click(function(e) {
                e.preventDefault(); // Prevent default link behavior
                var maintenanceId = $(this).data('id');
                console.log(maintenanceId);
                var observation = $('#observacion_' + maintenanceId).text();
                console.log(observation);
                $('#observacion .modal-body p').text(observation);
                $('#observacion').modal('show'); // Show the modal
            });

            $("#createmaintreview").validate({
                rules: {
                    tipo_de_revisión: "required",
                    ascensor: "required",
                    dirección: "required",
                    provincia: "required",
                    núm_certificado: "required",
                    máquina: "required",
                    // supervisor: "required",
                    técnico: "required",
                    // mes_programado: "required",
                    fecha_de_mantenimiento: "required",
                    hora_inicio: "required",
                    hora_fin: "required",
                    observaciónes: "required",
                    // solución: "required"
                },
                messages: {
                    // Specify validation error messages
                    tipo_de_revisión: "Por favor, seleccione el tipo de revisión.",
                    ascensor: "Por favor, seleccione el ascensor.",
                    dirección: "Por favor, ingrese la dirección.",
                    provincia: 'Por favor, selecciona la provincia',
                    núm_certificado: "Por favor, ingrese el número de certificado.",
                    // máquina: "Por favor, ingrese el número de máquina.",
                    // supervisor: "Por favor, seleccione el supervisor.",
                    técnico: "Por favor, seleccione el técnico.",
                    // mes_programado: "Por favor, seleccione el mes programado.",
                    fecha_de_mantenimiento: "Por favor, ingrese la fecha de mantenimiento.",
                    hora_inicio: "Por favor, ingrese la hora de inicio.",
                    hora_fin: "Por favor, ingrese la hora de fin.",
                    observaciónes: "Por favor, ingrese las observaciones.",
                    // solución: "Por favor, ingrese la solución."
                },
                errorElement: "span",
                errorPlacement: function(error, element) {
                    // Add the `invalid-feedback` class to the error element
                    error.addClass("invalid-feedback");
                    // Add error message after the invalid element
                    error.insertAfter(element);
                },
                // Highlight the invalid fields
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                // Remove the error message and green border when the field is valid
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass("is-invalid").addClass("is-valid");
                }
            });

            $("#editmaintreview").validate({
                rules: {
                    tipo_de_revisión: "required",
                    dirección: "required",
                    provincia: "required",
                    núm_certificado: "required",
                    máquina: "required",
                    // supervisor: "required",
                    técnico: "required",
                    // mes_programado: "required",
                    fecha_de_mantenimiento: "required",
                    hora_inicio: "required",
                    hora_fin: "required",
                    observaciónes: "required",
                    // solución: "required",
                },
                messages: {
                    tipo_de_revisión: "Por favor, seleccione el tipo de revisión.",
                    dirección: "Por favor, ingrese la dirección.",
                    provincia: 'Por favor, selecciona la provincia',
                    núm_certificado: "Por favor, ingrese el número de certificado.",
                    // máquina: "Por favor, ingrese el número de máquina.",
                    // supervisor: "Por favor, seleccione el supervisor.",
                    técnico: "Por favor, seleccione el técnico.",
                    // mes_programado: "Por favor, seleccione el mes programado.",
                    fecha_de_mantenimiento: "Por favor, ingrese la fecha de mantenimiento.",
                    hora_inicio: "Por favor, ingrese la hora de inicio.",
                    hora_fin: "Por favor, ingrese la hora de fin.",
                    observaciónes: "Por favor, ingrese las observaciones.",
                    // solución: "Por favor, ingrese la solución."
                },
                errorElement: "span",
                errorPlacement: function(error, element) {
                    // Add the `invalid-feedback` class to the error element
                    error.addClass("invalid-feedback");
                    // Add error message after the invalid element
                    error.insertAfter(element);
                },
                // Highlight the invalid fields
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                // Remove the error message and green border when the field is valid
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass("is-invalid").addClass("is-valid");
                }
            });

            $(document).on('click', '.edit-maint_in_review', function() {
                var mantenimiento = $(this).data('maint_in_rev');

                console.log(mantenimiento);
                $('#edit-tipo_de_revisión').val(mantenimiento.tipo_de_revisión).trigger('change');
                $('#edit-MAscensor').val(mantenimiento.ascensor).trigger('change');
                $('#edit-dirección').val(mantenimiento.dirección);
                $('#edit-province').val(mantenimiento.provincia).trigger('change');
                $('#edit-NCertificado').val(mantenimiento.núm_certificado);
                $('#edit-NMaquina').val(mantenimiento.máquina);
                $('#supervisor_id1').val(mantenimiento.supervisor_id).trigger('change');
                $('#edit-técnico').val(mantenimiento.técnico).trigger('change');
                $('#edit-Mprogramado').val(mantenimiento.mes_programado).trigger('change');
                $('#edit-FMantenimiento').val(mantenimiento.fecha_de_mantenimiento);
                $('#edit-FInicio').val(mantenimiento.hora_inicio);
                $('#edit-HFin').val(mantenimiento.hora_fin);
                $('#edit-observaciónes').val(mantenimiento.observaciónes);
                $('#edit-observacionesInternas').val(mantenimiento.observaciónes_internas);
                $('#edit-solucion').val(mantenimiento.solución);

                $('#editmaintreview').attr('action', '/mant/en/revisión/actualizar/' + mantenimiento.id);

            });

            $('#createcontratos').validate({
                rules: {
                    ascensor: "required",
                    fecha_de_propuesta: "required",
                    monto_de_propuesta: "required",
                    monto_de_contrato: "required",
                    fecha_de_inicio: "required",
                    fecha_de_fin: "required",
                    cada_cuantos_meses: "required",
                    observación: "required",
                    estado_cuenta_del_contrato: "required",
                    estado: "required"
                },
                messages: {
                    ascensor: "Por favor, ingrese el ascensor",
                    fecha_de_propuesta: "Por favor, ingrese la fecha de propuesta",
                    monto_de_propuesta: "Por favor, ingrese el monto de propuesta",
                    monto_de_contrato: "Por favor, ingrese el monto de contrato",
                    fecha_de_inicio: "Por favor, ingrese la fecha de inicio",
                    fecha_de_fin: "Por favor, ingrese la fecha de fin",
                    cada_cuantos_meses: "Por favor, ingrese cada cuantos meses",
                    observación: "Por favor, ingrese la observación",
                    estado_cuenta_del_contrato: "Por favor, ingrese el estado cuenta del contrato",
                    estado: "Por favor, ingrese el estado"
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

            $('#editcontratos').validate({
                rules: {
                    ascensor: "required",
                    fecha_de_propuesta: "required",
                    monto_de_propuesta: "required",
                    monto_de_contrato: "required",
                    fecha_de_inicio: "required",
                    fecha_de_fin: "required",
                    cada_cuantos_meses: "required",
                    observación: "required",
                    estado_cuenta_del_contrato: "required",
                    estado: "required"
                },
                messages: {
                    ascensor: "Por favor, ingrese el ascensor",
                    fecha_de_propuesta: "Por favor, ingrese la fecha de propuesta",
                    monto_de_propuesta: "Por favor, ingrese el monto de propuesta",
                    monto_de_contrato: "Por favor, ingrese el monto de contrato",
                    fecha_de_inicio: "Por favor, ingrese la fecha de inicio",
                    fecha_de_fin: "Por favor, ingrese la fecha de fin",
                    cada_cuantos_meses: "Por favor, ingrese cada cuántos meses",
                    observación: "Por favor, ingrese la observación",
                    estado_cuenta_del_contrato: "Por favor, ingrese el estado cuenta del contrato",
                    estado: "Por favor, ingrese el estado"
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

            $("#editelevatform").validate({
                // Specify validation rules
                rules: {
                    imagen: {
                        required: true,
                        extension: "jpg|jpeg|png|gif"
                    },
                    // contrato: "required",
                    nombre: "required",
                    // código: "required",
                    // marca: "required",
                    cliente: "required",
                    // fecha: "required",
                    // garantizar: "required",
                    dirección: "required",
                    // ubigeo: "required",
                    // provincia: "required",
                    // técnico_instalador: "required",
                    // técnico_ajustador: "required",
                    // tipo_de_ascensor: "required",
                    // cantidad: "required",
                    // npisos: "required",
                    ncontacto: "required",
                    teléfono: {
                        // required: true,
                        digits: true
                    },
                    cantidad: {
                        // required: true,
                        digits: true
                    },
                    correo: {
                        // required: true,
                        email: true
                    },
                    descripcion1: "required",
                    // Add more rules for other fields as needed
                },
                // Specify validation error messages
                messages: {
                    imagen: {
                        required: "Por favor, seleccione una imagen.",
                        extension: "Por favor, seleccione un archivo de imagen válido (jpg, jpeg, png, gif)."
                    },
                    contrato: "Por favor, ingrese el número de contrato.",
                    nombre: "Por favor, ingrese el nombre del ascensor.",
                    código: "Por favor, ingrese el código.",
                    marca_id: "Por favor, ingrese la marca.",
                    cliente: "Por favor, seleccione un cliente.",
                    fecha: "Por favor, seleccione una fecha de entrega.",
                    garantizar: "Por favor, ingrese la garantía.",
                    dirección: "Por favor, ingrese la dirección.",
                    // ubigeo: "Por favor, ingrese el ubigeo.",
                    provincia: "Por favor, seleccione una provincia.",
                    técnico_instalador: "Por favor, seleccione un técnico instalador.",
                    técnico_ajustador: "Por favor, seleccione un técnico ajustador.",
                    tipo_de_ascensor: "Por favor, seleccione un tipo de ascensor.",
                    cantidad: "Por favor, seleccione una cantidad.",
                    npisos: "Por favor, ingrese el número de pisos.",
                    ncontacto: "Por favor, ingrese el nombre del contacto.",
                    teléfono: {
                        required: "Por favor, ingrese un número de teléfono.",
                        digits: "Por favor, ingrese solo dígitos para el número de teléfono."
                    },
                    correo: {
                        required: "Por favor, ingrese una dirección de correo electrónico.",
                        email: "Por favor, ingrese una dirección de correo electrónico válida."
                    },
                    descripcion1: "Por favor, ingrese una descripción.",
                    // Add more messages for other fields as needed
                },
                // Make sure the error messages are displayed in a Bootstrap-friendly way
                errorElement: "span",
                errorPlacement: function(error, element) {
                    // Add the `invalid-feedback` class to the error element
                    error.addClass("invalid-feedback");
                    // Add error message after the invalid element
                    element.closest(".form-group").append(error);
                },
                // Highlight the invalid fields
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                // Remove the error message and green border when the field is valid
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass("is-invalid").addClass("is-valid");
                }
            });

            $(document).on('click', '.edit-elevator', function() {
                var elevator = $(this).data('elevator');
                console.log(elevator);
                $('#editelevatform').attr('action', '/ascensore/actualizar/' + elevator.id);
                // Set values for all form fields using jQuery
                $('#edit-contrato').val(elevator.contrato);
                $('#edit-nombre').val(elevator.nombre);
                $('#edit-código').val(elevator.código);
                $('#marca_id1').val(elevator.marca_id).trigger(
                    'change'); // Ensure the value is set and trigger change
                $('#edit-cliente').val(elevator.client_id).trigger('change');
                $('#edit-fecha').val(elevator.fecha);
                $('#edit-garantizar').val(elevator.garantizar);
                $('#edit-dirección').val(elevator.dirección);
                $('#edit-ubigeo').val(elevator.ubigeo);
                $('#edit-provincia').val(elevator.provincia).trigger('change');
                $('#edit-técnico_instalador').val(elevator.técnico_instalador).trigger('change');
                $('#edit-técnico_ajustador').val(elevator.técnico_ajustador).trigger('change');
                $('#edit-tipo_de_ascensor').val(elevator.tipo_de_ascensor.id).trigger('change');
                $('#edit-cantidad').val(elevator.cantidad);
                $('#edit-npisos').val(elevator.npisos);
                $('#edit-ncontacto').val(elevator.ncontacto);
                $('#edit-teléfono').val(elevator.teléfono);
                $('#edit-correo').val(elevator.correo);
                $('#edit-descripcion1').val(elevator.descripcion1);
                $('#edit-descripcion2').val(elevator.descripcion2);

                // Check if quarters contain specific values
                if (elevator.quarters) {
                    var quarters = elevator.quarters.split(',');
                    $('#mgratuito').prop('checked', quarters.includes('mgratuito'));
                    $('#sincuarto').prop('checked', quarters.includes('sincuarto'));
                    $('#concuarto').prop('checked', quarters.includes('concuarto'));
                }

                // Show or hide additional description based on elevator data
                if (elevator.descripcion2 !== null) {
                    $('#DAdicional1').removeClass('d-none'); // Show Descripción 2 section
                } else {
                    $('#DAdicional1').addClass('d-none'); // Hide Descripción 2 section
                }

                getBrand(elevator.marca_id);
                // Set the image preview
                var imageUrl = elevator.imagen ? "{{ asset('images/') }}/" + elevator.imagen :
                    "{{ asset('img/fondo.png') }}";
                $('#edit-elevators').attr('src', imageUrl);
            });

            $(document).on('click', '.delete-elevator', function() {
                var elevatorId = $(this).data('id'); // Get the elevator ID
                $('#modalEliminar').modal('show'); // Show the modal
                $('#delete-form').attr('action', '/ascensore/actualizar/' +
                    elevatorId); // Set the form action
            });
            $('#edituploadButton').click(function() {
                $('#editimageUpload').click();
            });

            // $('#editimageUpload').change(function() {
            //     var reader = new FileReader();
            //     reader.onload = function(e) {
            //         $('#editimagePreview').css('background-image', 'url(' + e.target.result + ')');
            //         $('#editimagePreview').show();
            //     }
            //     reader.readAsDataURL(this.files[0]);
            // });

            $('#editimageUpload').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    // Update the background image of the preview div
                    $('#editimagePreview').css('background-image', 'url(' + e.target.result +
                        ')');

                    // Hide any existing image tags inside the preview div
                    $('#editimagePreview').find('img').remove();

                    // Show the preview div (in case it was hidden)
                    $('#editimagePreview').show();

                    // Optionally, add a new img element if needed
                    $('#editimagePreview').append('<img src="' + e.target.result +
                        '" width="200" height="200" alt="Preview Image">');
                }
                reader.readAsDataURL(this.files[0]);
            });

            $('#editimageUpload').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#editimagePreview').css('background-image', 'url(' + e.target.result +
                        ')');
                    $('#editimagePreview').show();
                }
                reader.readAsDataURL(this.files[0]);
            });

            $(document).on('click', '.editContract', function() {
                // Clear previous modal data
                // $('#ascensor').val('');
                $('#edit_fecha_de_propuesta').val('');
                $('#edit_monto_de_propuesta').val('');
                $('#edit_monto_de_contrato').val('');
                $('#edit_fecha_de_inicio').val('');
                $('#edit_fecha_de_fin').val('');
                $('#edit_renovación').prop('checked', false); // Assuming this is a checkbox
                $('#edit_cada_cuantos_meses').val('');
                $('#edit_observación').val('');
                $('#edit_estado_cuenta_del_contrato').val('');
                $('#edit_estado').val('');

                // Get the current contract data
                var contract = $(this).data('contract');
                console.log(contract);
                // Populate the modal with the selected contract's data
                // $('#ascensor').val(contract.ascensor || '');
                $('#edit_fecha_de_propuesta').val(contract.fecha_de_propuesta || '');
                $('#edit_monto_de_propuesta').val(contract.monto_de_propuesta || '');
                $('#edit_monto_de_contrato').val(contract.monto_de_contrato || '');
                $('#edit_fecha_de_inicio').val(contract.fecha_de_inicio || '');
                $('#edit_fecha_de_fin').val(contract.fecha_de_fin || '');
                $('#edit_renovación').prop('checked', contract.renovación || false);
                $('#edit_cada_cuantos_meses').val(contract.cada_cuantos_meses || '');
                $('#edit_observación').val(contract.observación || '');
                $('#edit_estado_cuenta_del_contrato').val(contract.estado_cuenta_del_contrato || '');
                $('#edit_estado').val(contract.estado || '');

                // Set the form action to the correct route
                $('#editcontratos').attr('action', '/contrato/actualizar/' + contract.id);
            });

            $('#editarAscensor').on('hidden.bs.modal', function() {
                var form = $('#editelevatform');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            });

            $('#crearMantenimiento').on('hidden.bs.modal', function() {
                var form = $('#createmaintreview');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            });
            $('#editorMantenimiento').on('hidden.bs.modal', function() {
                var form = $('#editmaintreview');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            });

            $('#crearContratos').on('hidden.bs.modal', function() {
                var form = $('#createcontratos');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            });
            $('#editarContratos').on('hidden.bs.modal', function() {
                var form = $('#editcontratos');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            });
        });
    </script>
@endpush
