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
                            @isset($elevator)
                                <h4>{{ $elevator->nombre }}</h4>
                                <span>Ascensores >> {{ $elevator->nombre }}</span>
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
                                                                No garantía disponible
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
                                                                No dirección disponible
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
                                                            @isset($elevators->técnico_instalador)
                                                                {{ $elevators->técnico_instalador }}
                                                            @else
                                                                No técnico instalador disponible
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
                                                                No Ubigeo disponible
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
                                                            @isset($elevators->provincia)
                                                                {{ $elevators->provincia }}
                                                            @else
                                                                No provincia disponible
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
                                                            @isset($elevators->técnico_ajustador)
                                                                {{ $elevators->técnico_ajustador }}
                                                            @else
                                                                No técnico ajustador disponible
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
                                                            @isset($elevators->tipo_de_ascensor)
                                                                {{ $elevators->tipo_de_ascensor }}
                                                            @else
                                                                Tipo de ascensor no especificado
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
                                                                cuarto de maquina?</label>
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
                                                                cuarto de maquina?</label>
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
                                                            <td>{{ $elevators->contrato }}</td>
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
                                                                @if ($contra->estado == 'activo')
                                                                    <div class="alerta boton-activo">
                                                                        <i class="fas fa-circle"></i> activo
                                                                    </div>
                                                                @elseif ($contra->estado == 'no_activo')
                                                                    <div class="alerta boton-inactivo">
                                                                        <i class="fas fa-circle"></i> inactivo
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
                                                                                    class="btn-gris btn-red">Sí</button>
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
                                                                            name="ascensor"
                                                                            value="{{ $elevators->nombre }}"
                                                                            id="ascensor" class="form-control" readonly>
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
                                                                        <textarea name="estado_cuenta_del_contrato" id="estado_cuenta_del_contrato" placeholder="Estado cuenta del contrato"
                                                                            cols="30" rows="5"></textarea>
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
                                                                            <option value="activo">Activo</option>
                                                                            <option value="inactivo">Inactivo</option>
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
                                                                                name="ascensor" id="ascensor"
                                                                                class="form-control"
                                                                                value="{{ old('ascensor', $contra->ascensor ?? '') }}"
                                                                                readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="fecha_de_propuesta">Fecha de
                                                                                propuesta</label>
                                                                            <input type="date" placeholder="dd/mm/aaaa"
                                                                                name="fecha_de_propuesta"
                                                                                id="fecha_de_propuesta" class="form-control"
                                                                                value="{{ old('fecha_de_propuesta', $contra->fecha_de_propuesta ?? '') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="monto_de_propuesta">Monto de
                                                                                propuesta</label>
                                                                            <input type="number" placeholder="S/ 300 mensual"
                                                                                name="monto_de_propuesta"
                                                                                id="monto_de_propuesta" class="form-control"
                                                                                value="{{ old('monto_de_propuesta', $contra->monto_de_propuesta ?? '') }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="monto_de_contrato">Monto de
                                                                                contrato</label>
                                                                            <input type="number" placeholder="S/ 300 mensual"
                                                                                name="monto_de_contrato"
                                                                                id="monto_de_contrato" class="form-control"
                                                                                value="{{ old('monto_de_contrato', $contra->monto_de_contrato ?? '') }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="fecha_de_inicio">Fecha de
                                                                                inicio</label>
                                                                            <input type="date" placeholder="dd/mm/aaaa"
                                                                                name="fecha_de_inicio" id="fecha_de_inicio"
                                                                                class="form-control"
                                                                                value="{{ old('fecha_de_inicio', $contra->fecha_de_inicio ?? '') }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="fecha_de_fin">Fecha de fin</label>
                                                                            <input type="date" placeholder="dd/mm/aaaa"
                                                                                name="fecha_de_fin" id="fecha_de_fin"
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
                                                                                    id="renovación" name="renovación"
                                                                                    class="form-control"
                                                                                    {{ $contra->renovación ? 'checked' : '' }}>
                                                                                <label class="custom-control-label"
                                                                                    for="renovación">Renovación</label>
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
                                                                                id="cada_cuantos_meses" class="form-control"
                                                                                value="{{ old('cada_cuantos_meses', $contra->cada_cuantos_meses ?? '') }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="observación">Observación</label>
                                                                            <textarea name="observación" id="observación" placeholder="Comentario de contrato" cols="30" rows="5"
                                                                                class="form-control">{{ old('observación', $contra->observación ?? '') }}</textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="estado_cuenta_del_contrato">Estado
                                                                                cuenta
                                                                                del contrato</label>
                                                                            <textarea name="estado_cuenta_del_contrato" id="estado_cuenta_del_contrato" placeholder="Estado cuenta del contrato"
                                                                                class="form-control" cols="30" rows="5"
                                                                                class="@error('estado_cuenta_del_contrato') is-invalid @enderror">{{ old('estado_cuenta_del_contrato', $contra->estado_cuenta_del_contrato ?? '') }}</textarea>
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
                                                                            <select name="estado" id="estado"
                                                                                class="custom-select form-control">
                                                                                <option value="" disabled>Seleccionar
                                                                                    opción</option>
                                                                                <option value="activo"
                                                                                    {{ old('estado', isset($contra) && $contra->estado == 'activo' ? 'selected' : '') }}>
                                                                                    Activo</option>
                                                                                <option value="no_activo"
                                                                                    {{ old('estado', isset($contra) && $contra->estado == 'inactivo' ? 'selected' : '') }}>
                                                                                    Inactivo</option>
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
                                                            <button type="submit" class="btn-gris btn-red">Sí</button>
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
                                                    aria-labelledby="dropdownMenuButton1">
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
                                                            <td>{{ $maint_in_rev->tipo_de_revisión }}</td>
                                                            <td>{{ $maint_in_rev->ascensor }}</td>
                                                            <td>{{ $maint_in_rev->fecha_de_mantenimiento }}</td>
                                                            <td>{{ $maint_in_rev->técnico }}</td>
                                                            <td>
                                                                <a class="text-blue view-observation" href="#"
                                                                    data-toggle="modal"
                                                                    data-target="#observacion{{ $maint_in_rev->id }}">
                                                                    Ver observación
                                                                </a>

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
                                                                        <a class="dropdown-item edit-mantenimiento"
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
                                                                                    class="btn-gris btn-red">Sí</button>
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

                                <!-- Modal Editor Mantenimiento-->
                                <div class="modal left fade" id="editorMantenimiento" tabindex="-1" role="dialog"
                                    aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title font-family-Outfit-SemiBold">Edición De
                                                    Mantenimiento</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            @isset($maint_in_rev)
                                                <form
                                                    action="{{ route('update.maint.in.review', ['id' => $maint_in_rev->id]) }}"
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
                                                                        @foreach ($review_types as $key => $value)
                                                                            <option value="{{ $key }}"
                                                                                {{ old('tipo_de_revisión', $maint_in_rev->tipo_de_revisión ?? '') == $key ? 'selected' : '' }}>
                                                                                {{ $value }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('tipo_de_revisión')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>


                                                                <div class="form-group">
                                                                    <label for="ascensor">Ascensor</label>
                                                                    <input type="text" class="form-control"
                                                                        name="ascensor" id="edit-MAscensor"
                                                                        value="{{ old('ascensor', $maint_in_rev->ascensor) }}"
                                                                        readonly>
                                                                    @error('ascensor')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="dirección">Dirección</label>
                                                                    <input type="text" placeholder="Dirección"
                                                                        name="dirección" id="dirección" class="form-control"
                                                                        value="{{ old('dirección', $maint_in_rev->dirección) }}">
                                                                    @error('dirección')
                                                                        <span class="invalid-feedback" style="color: red">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>


                                                                <div class="form-group">
                                                                    <label for="provinciaAs">Provincia</label>
                                                                    <select id="edit-provincia" name="provincia"
                                                                        class="form-control">
                                                                        <option value="">Select Province
                                                                        </option>
                                                                        @foreach ($provinces as $province)
                                                                            <option value="{{ $province }}"
                                                                                {{ old('provincia', $maint_in_rev->provincia ?? '') == $province ? 'selected' : '' }}>
                                                                                {{ $province }}
                                                                            </option>
                                                                        @endforeach
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
                                                                    <input type="text" placeholder="Núm Certificado"
                                                                        name="núm_certificado" id="edit-NCertificado"
                                                                        class="form-control"
                                                                        value="{{ old('núm_certificado', $maint_in_rev->núm_certificado ?? '') }}">
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
                                                                    <label for="Supervisor">Supervisor</label>
                                                                    <select
                                                                        class="custom-select  @error('supervisor') is-invalid @enderror"
                                                                        name="supervisor" id="supervisor1">

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
                                                                            class="btn-gris supervisorbtn"
                                                                            id="toggleMarcaInput">
                                                                            + Agregar Supervisor
                                                                        </button>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="técnico">Técnico</label>
                                                                    <select class="custom-select" name="técnico"
                                                                        id="edit-técnico">
                                                                        <option value="">Seleccionar opción
                                                                        </option>
                                                                        @foreach ($staffs as $staff)
                                                                            <option value="{{ $staff }}"
                                                                                {{ old('técnico', $maint_in_rev->técnico ?? '') == $staff ? 'selected' : '' }}>
                                                                                {{ $staff }}
                                                                            </option>
                                                                        @endforeach
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
                                                                                <option value="" class="">
                                                                                    Seleccionar
                                                                                    opción</option>
                                                                                <option value="mes_programado_1"
                                                                                    {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'mes_programado_1' ? 'selected' : '' }}>
                                                                                    Mes programado 1</option>
                                                                                <option value="mes_programado_2"
                                                                                    {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'mes_programado_2' ? 'selected' : '' }}>
                                                                                    Mes programado 2</option>
                                                                                <option value="mes_programado_3"
                                                                                    {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'mes_programado_3' ? 'selected' : '' }}>
                                                                                    Mes programado 3</option>
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
                                                                            <input type="date"
                                                                                name="fecha_de_mantenimiento"
                                                                                id="edit-FMantenimiento"
                                                                                class="form-control @error('fecha_de_mantenimiento') is-invalid @enderror"
                                                                                value="{{ old('fecha_de_mantenimiento', $maint_in_rev->fecha_de_mantenimiento ?? '') }}">
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
                                                                                value="{{ old('hora_inicio', $maint_in_rev->hora_inicio ?? '') }}">
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
                                                                                value="{{ old('hora_fin', $maint_in_rev->hora_fin ?? '') }}">
                                                                            @error('hora_fin')
                                                                                <span class="invalid-feedback" style="color: red">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="edit-observaciónes">Observaciones</label>
                                                                            <textarea name="observaciónes" id="edit-observaciónes" placeholder="Comentario de contrato" cols="30"
                                                                                rows="5">{{ old('observaciónes', $maint_in_rev->observaciónes ?? '') }}</textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="edit-observacionesInternas">Observaciones
                                                                                internas</label>
                                                                            <textarea name="observaciónes_internas" id="edit-observacionesInternas" placeholder="Observaciones internas"
                                                                                cols="30" rows="5">{{ old('observaciónes_internas', $maint_in_rev->observaciónes_internas ?? '') }}</textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="edit-solucion">Solución</label>
                                                                            <textarea name="solución" id="edit-solucion" placeholder="Solución" cols="30" rows="5">{{ old('solución', $maint_in_rev->solución ?? '') }}</textarea>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                                                        <button type="submit" class="btn-gris btn-red mr-2">Guardar
                                                            Cambios</button>
                                                        <button type="button" class="btn-gris btn-border"
                                                            data-dismiss="modal">Cancelar</button>
                                                    </div>

                                                </form>
                                            @endisset

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
                                                                    name="provincia" id="provincia">
                                                                    @foreach ($provinces as $province)
                                                                        <option value="{{ $province }}"
                                                                            @if (isset($elevators) && $elevators->provincia == $province) selected @endif>
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
                                                                <input type="text" placeholder="#" name="npisos"
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
                                                                <textarea name="descripcion2" id="descripcion2" placeholder="Descripción" cols="30" rows="5">{{ old('descripcion1', isset($elevators) ? $elevators->descripcion1 : '') }}</textarea>
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
                                                    <input type="hidden" name="ascensor_id"
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
                                                        @foreach ($provinces as $province)
                                                            <option value="{{ $province }}"
                                                                {{ old('provincia', $elevators->provincia) == $province ? 'selected' : '' }}>
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
                                                    <select class="custom-select" name="supervisor" id="supervisor">

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
                                                    <select class="custom-select form-control" name="técnico"
                                                        id="técnico">
                                                        <option value="" class="d-none">Seleccionar
                                                            opción
                                                        </option>
                                                        @foreach ($staffs as $staff)
                                                            <option value="{{ $staff }}">
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
                                                                <option selected disabled class="d-none">Seleccionar
                                                                    opción
                                                                </option>
                                                                <option value="mes_programado_1">Mes programado 1</option>
                                                                <option value="mes_programado_2">Mes programado 2</option>
                                                                <option value="mes_programado_3">Mes programado 3</option>
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
                                            <button type="submit" class="btn-gris btn-red">Sí</button>
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
                    if ($('#supervisor').data('select2')) {
                        $('#supervisor').select2('destroy');
                    }
                    if ($('#supervisor1').data('select2')) {
                        $('#supervisor1').select2('destroy');
                    }

                    // Perform the AJAX call to get supervisor data
                    $.ajax({
                        type: "GET",
                        url: "{{ route('supervisors') }}", // Ensure this route is correct
                        dataType: "JSON",
                        success: function(response) {
                            // Clear the current options and append the retrieved options to the select element
                            $("#supervisor,#supervisor1").empty();
                            $("#supervisor,supervisor1").append(
                                '<option value="" class="d-none">Seleccionar Supervisor</option>'
                            ); // Add placeholder option

                            $.each(response, function() {
                                $("#supervisor,#supervisor1").append(
                                    `<option value='${this.id}'>${this.nomber}</option>`
                                );
                            });

                            // Initialize Select2 on the select element
                            $('#supervisor').select2({
                                placeholder: "Seleccionar Supervisor",
                                allowClear: true
                            });

                            $('#supervisor1').select2({
                                placeholder: "Seleccionar Supervisor",
                                allowClear: true
                            });

                            // If edit is true and has a valid ID, set the selected value
                            if (edit) {
                                $('#supervisor1').val(edit).trigger('change');
                                console.log('Selected supervisor set to:', edit);
                            }
                        },
                        error: function(xhr) {
                            console.error('Error fetching supervisors:', xhr.responseText);
                        }
                    });
                }

                // Call the function when needed, e.g., when opening the modal
                const editValue = '{{ $editValue ?? '' }}'; // Replace with actual edit value if available
                getSupervisors(editValue);

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
                getBrand();
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
                    table1.button('.buttons-print').trigger();
                });

                $('#customSearchBox').keyup(function() {
                    console.log('uyuytuytu');
                    table1.search($(this).val()).draw();
                });
                $('#customSearchBox2').keyup(function() {
                    table2.search($(this).val()).draw();
                });
                $('#customSearchBox1').keyup(function() {
                    table.search($(this).val()).draw();
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

                var table = $('#repuestosAsensorTable').DataTable({
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

                $('.edit-mantenimiento').on('click', function() {

                    var mantenimiento = $(this).data('mantenimiento');
                    console.log(mantenimiento);
                    $('#edit-tipo_de_revisión').val(mantenimiento.tipo_de_revisión);
                    $('#edit-MAscensor').val(mantenimiento.ascensor);
                    $('#edit-mantdirección').val(mantenimiento.dirección);
                    $('#edit-provincia').val(mantenimiento.provincia);
                    $('#edit-NCertificado').val(mantenimiento.núm_certificado);
                    $('#edit-NMaquina').val(mantenimiento.máquina);
                    $('#edit-Supervisor').val(mantenimiento.supervisor);
                    $('#edit-técnico').val(mantenimiento.técnico);
                    $('#edit-Mprogramado').val(mantenimiento.mes_programado);
                    $('#edit-FMantenimiento').val(mantenimiento.fecha_de_mantenimiento);
                    $('#edit-FInicio').val(mantenimiento.hora_inicio);
                    $('#edit-HFin').val(mantenimiento.hora_fin);
                    $('#edit-observaciónes').val(mantenimiento.observaciónes);
                    $('#edit-observacionesInternas').val(mantenimiento.observaciónes_internas);
                    $('#edit-solucion').val(mantenimiento.solución);

                    $('#editmaintreview').attr('action', "{{ route('update.maint.in.review', '') }}/" +
                        mantenimiento.id);
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

                $('.edit-elevator').on('click', function() {
                    var elevator = $(this).data('elevator');
                    console.log(elevator);
                    $('#edit-contrato').val(elevator.contrato);
                    $('#edit-nombre').val(elevator.nombre);
                    $('#edit-código').val(elevator.código);
                    $('#marca_id').val(elevator.marca_id).trigger(
                        'change'); // Ensure the value is set and trigger change
                    $('#client_id').val(elevator.client_id);
                    $('#edit-fecha').val(elevator.fecha);
                    $('#edit-garantizar').val(elevator.garantizar);
                    $('#edit-dirección').val(elevator.dirección);
                    $('#edit-ubigeo').val(elevator.ubigeo);
                    $('#edit-provincia').val(elevator.provincia);
                    $('#edit-técnico_instalador').val(elevator.técnico_instalador);
                    $('#edit-tipo_de_ascensor').val(elevator.tipo_de_ascensor);
                    $('#edit-cantidad').val(elevator.cantidad);
                    $('#mgratuito').val(elevator.quarters);
                    $('#sincuarto').val(elevator.quarters);
                    $('#concuarto').val(elevator.quarters);
                    $('#edit-npisos').val(elevator.npisos);
                    $('#edit-ncontacto').val(elevator.ncontacto);
                    $('#edit-teléfono').val(elevator.teléfono);
                    $('#edit-correo').val(elevator.correo);
                    $('#edit-descripcion1').val(elevator.descripcion1);
                    $('#edit-descripcion2').val(elevator.descripcion2);
                    if (elevator.descripcion2 !== null) {
                        $('#DAdicional1').removeClass('d-none'); // Show Descripción 2 section
                    } else {
                        $('#DAdicional1').addClass('d-none'); // Show Descripción 2 section
                    }
                    getBrand(elevator.marca_id);

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

                $(".editContract").click(function() {
                    let id = $(this).data('id');
                    $.ajax({
                        type: "GET",
                        method: "GET",
                        dataType: "JSON",
                        url: `/contract/get/${id}`,
                        success: function(response) {
                            $("#editcontratos").attr("action", "/contrato/actualizar/" + id);
                            for (var key in response) {
                                $("#editcontratos").find("input[name='" + key + "']").val(response[
                                    key])
                            }
                        }
                    })
                })

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
