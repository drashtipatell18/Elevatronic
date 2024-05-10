@extends('layouts.main')
@section('content')
    <style>
        .qrcode {
            text-align: center;
        }

        .dt-head-center {
            text-align: center;
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
                            <a class="dropdown-item texto-1 font-family-Inter-Regular" href="javascript:void(0)"
                                data-toggle="modal" data-target="#editarAscensor">Editar</a>
                            <a class="dropdown-item texto-1 font-family-Inter-Regular"
                                href="{{ route('destroy.elevator', $elevators->id) }}" data-toggle="modal"
                                data-target="#modalEliminar">Eliminar</a>
                        </div>

                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="box-contenido pb-0">
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-start justify-content-start gap-20 mb-6 box-detalle">
                                @if (isset($elevator))
                                    <div class="contenido-img">
                                        <img src="{{ asset('images/' . $elevator->imagen) }}" alt="user" width="160">
                                    </div>
                                @endif
                                <div class="align-items-start d-flex flex-column h-100 justify-content-between">
                                    @if (isset($elevator))
                                        <div>
                                            <h3>{{ $elevator->nombre }}</h3>
                                            <span>Ascensor</span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-start gap-15 flex-wrap">
                                            <div class="option">
                                                <h4>{{ $elevator->id }}</h4>
                                                <p class="mb-0">ID elemento</p>
                                            </div>
                                            <div class="option">
                                                <h4>{{ $elevator->contrato }}</h4>
                                                <p class="mb-0"># de contrato</p>
                                            </div>
                                            <div class="option">
                                                <h4>{{ \Carbon\Carbon::parse($elevator->fecha)->format('d M Y, g:i a') }}
                                                </h4>
                                                <p class="mb-0">Fecha registro</p>
                                            </div>
                                        </div>
                                    @else
                                        <div>
                                            <h3>Elevator Name</h3>
                                            <span>Ascensor</span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-start gap-15 flex-wrap">
                                            <div class="option">
                                                <h4>N/A</h4>
                                                <p class="mb-0">ID elemento</p>
                                            </div>
                                            <div class="option">
                                                <h4>N/A</h4>
                                                <p class="mb-0"># de contrato</p>
                                            </div>
                                            <div class="option">
                                                <h4>N/A</h4>
                                                <p class="mb-0">Fecha registro</p>
                                            </div>
                                        </div>
                                    @endif
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
                                                        @isset($elevator->nombre)
                                                            {{ $elevator->nombre }}
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
                                                        @isset($elevator->código)
                                                            {{ $elevator->código }}
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
                                                        @isset($elevator->cliente)
                                                            {{ $elevator->cliente }}
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
                                                        @isset($elevator->marca)
                                                            {{ $elevator->marca }}
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
                                                    {{-- <h4>{{ $elevator->fecha->format('d M Y') }}</h4> --}}
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
                                                        @isset($elevator->garantizar)
                                                            {{ $elevator->garantizar }}
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
                                                        @isset($elevator->dirección)
                                                            {{ $elevator->dirección }}
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
                                                    <td>-</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Ubigeo</td>
                                                    <td>-</td>
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
                                                        @isset($elevator->provincia)
                                                            {{ $elevator->provincia }}
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
                                                    <td>-</td>
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
                                                        @isset($elevator->tipo_de_ascensor)
                                                            {{ $elevator->tipo_de_ascensor }}
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
                                                        @isset($elevator->cantidad)
                                                            {{ $elevator->cantidad }}
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
                                                            id="MGratuito" name="MGratuito" checked>
                                                        <label class="custom-control-label" for="MGratuito">Mantenimiento
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
                                                            id="SinCuarto" name="SinCuarto">
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
                                                            id="ConCuarto" name="ConCuarto">
                                                        <label class="custom-control-label" for="ConCuarto">Con
                                                            cuarto de maquina?</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @isset($elevator)
                                        <div class="col-md-12">

                                            <table class="table table-borderless">

                                                <tbody>
                                                    <tr>
                                                        <td class="text-gris"># Pisos</td>
                                                        <td>{{ $elevator->npisos }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-gris">Contacto</td>
                                                        <td>{{ $elevator->contrato }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-gris">Teléfono</td>
                                                        <td>{{ $elevator->teléfono }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-gris">Correo</td>
                                                        <td>{{ $elevator->correo }}</td>
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
                                                            {{ $elevator->descripcion1 }}
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
                                                            {{ $elevator->descripcion2 }}
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
                                        <button type="button" class="btn-primario w-auto pl-3 pr-3" data-toggle="modal"
                                            data-target="#crearContratos">
                                            + Agregar
                                        </button>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="buscador">
                                            <div class="form-group position-relative">
                                                <label for="customSearchBox"><i class="fal fa-search"></i></label>
                                                <input type="text" id="customSearchBox" placeholder="Buscar"
                                                    class="w-auto customSearchBox">
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
                                                <button class="dropdown-item export_pdf" data-table="#contratosTable">PDF
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
                                                        <td>{{ $contra->estado_cuenta_del_contrato }}
                                                        <td>
                                                            @if ($contra->estado == 'activo')
                                                                <div class="alerta boton-activo">
                                                                    <i class="fas fa-circle"></i> activo
                                                                </div>
                                                            @elseif ($contra->estado == 'inactivo')
                                                                <div class="alerta boton-inactivo">
                                                                    <i class="fas fa-circle"></i> inactivo
                                                                </div>
                                                            @endif
                                                        </td>

                                                        <td align="right">
                                                            <div class="dropdown">
                                                                <button type="button" class="btn-action dropdown-toggle"
                                                                    data-toggle="dropdown">
                                                                    Acción <i class="fas fa-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                                        data-toggle="modal"
                                                                        data-target="#crearContratos">Ver
                                                                        detalles</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('edit.contract', $contra->id) }}"
                                                                        data-toggle="modal"
                                                                        data-target="#editarContratos">Editar</a>

                                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                                        data-toggle="modal"
                                                                        data-target="#modalEliminar">Eliminar</a>
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
                                        <div class="modal-body body_modal">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form action="/contrato/insertar" method="POST"
                                                        class="formulario-modal" id="customerForm">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="ascensor">Ascensor</label>
                                                                    <input type="text" placeholder="Ascensor"
                                                                        name="ascensor" id="ascensor"
                                                                        class="@error('ascensor') is-invalid @enderror">
                                                                    @error('ascensor')
                                                                        <span class="invalid-feedback" style="color: red">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="fecha_de_propuesta">Fecha de
                                                                        propuesta</label>
                                                                    <input type="date" placeholder="dd/mm/aaaa"
                                                                        name="fecha_de_propuesta" id="fecha_de_propuesta"
                                                                        class="@error('fecha_de_propuesta') is-invalid @enderror">
                                                                    @error('fecha_de_propuesta')
                                                                        <span class="invalid-feedback" style="color: red">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="monto_de_propuesta">Monto de
                                                                        propuesta</label>
                                                                    <input type="text" placeholder="S/ 300 mensual"
                                                                        name="monto_de_propuesta" id="monto_de_propuesta"
                                                                        class="@error('monto_de_propuesta') is-invalid @enderror">
                                                                    @error('monto_de_propuesta')
                                                                        <span class="invalid-feedback" style="color: red">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="monto_de_contrato">Monto de
                                                                        contrato</label>
                                                                    <input type="text" placeholder="S/ 300 mensual"
                                                                        name="monto_de_contrato" id="monto_de_contrato"
                                                                        class="@error('monto_de_contrato') is-invalid @enderror">
                                                                    @error('monto_de_contrato')
                                                                        <span class="invalid-feedback" style="color: red">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="fecha_de_inicio">Fecha de inicio</label>
                                                                    <input type="date" placeholder="dd/mm/aaaa"
                                                                        name="fecha_de_inicio" id="fecha_de_inicio"
                                                                        class="@error('fecha_de_inicio') is-invalid @enderror">
                                                                    @error('fecha_de_inicio')
                                                                        <span class="invalid-feedback" style="color: red">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="fecha_de_fin">Fecha de fin</label>
                                                                    <input type="date" placeholder="dd/mm/aaaa"
                                                                        name="fecha_de_fin" id="fecha_de_fin"
                                                                        class="@error('fecha_de_fin') is-invalid @enderror">
                                                                    @error('fecha_de_fin')
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
                                                                        <input type="checkbox"
                                                                            class="custom-control-input" id="renovación"
                                                                            name="renovación">
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
                                                                        name="cada_cuantos_meses" id="cada_cuantos_meses"
                                                                        class="@error('cada_cuantos_meses') is-invalid @enderror">
                                                                    @error('cada_cuantos_meses')
                                                                        <span class="invalid-feedback" style="color: red">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
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
                                                                    <label for="estado_cuenta_del_contrato">Estado cuenta
                                                                        del
                                                                        contrato</label>
                                                                    <textarea name="estado_cuenta_del_contrato" id="estado_cuenta_del_contrato" placeholder="Estado cuenta del contrato"
                                                                        cols="30" rows="5"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="estado">Estado</label>
                                                                    <input type="text" placeholder="Activo"
                                                                        name="estado" id="estado">
                                                                </div>
                                                            </div>
                                                        </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                                            <button type="submit" class="btn-gris btn-red mr-2">Asignar
                                                Respuesto</button>
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
                                            <h5 class="modal-title font-family-Outfit-SemiBold">Creando Contrato</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body body_modal">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @isset($contra)
                                                        <form action="/contrato/actualizar/<?php echo $contra->id; ?>" method="POST"
                                                            class="formulario-modal" id="customerForm">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="ascensor">Ascensor</label>
                                                                        <input type="text" placeholder="Ascensor"
                                                                            name="ascensor" id="ascensor"
                                                                            class="@error('ascensor') is-invalid @enderror"
                                                                            value="{{ old('ascensor', $contra->ascensor ?? '') }}">
                                                                        @error('ascensor')
                                                                            <span class="invalid-feedback" style="color: red">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>


                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="fecha_de_propuesta">Fecha de
                                                                            propuesta</label>
                                                                        <input type="date" placeholder="dd/mm/aaaa"
                                                                            name="fecha_de_propuesta" id="fecha_de_propuesta"
                                                                            class="@error('fecha_de_propuesta') is-invalid @enderror"
                                                                            value="{{ old('fecha_de_propuesta', $contra->fecha_de_propuesta ?? '') }}">
                                                                        @error('fecha_de_propuesta')
                                                                            <span class="invalid-feedback" style="color: red">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="monto_de_propuesta">Monto de
                                                                            propuesta</label>
                                                                        <input type="text" placeholder="S/ 300 mensual"
                                                                            name="monto_de_propuesta" id="monto_de_propuesta"
                                                                            class="@error('monto_de_propuesta') is-invalid @enderror"
                                                                            value="{{ old('monto_de_propuesta', $contra->monto_de_propuesta ?? '') }}">
                                                                        @error('monto_de_propuesta')
                                                                            <span class="invalid-feedback" style="color: red">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="monto_de_contrato">Monto de
                                                                            contrato</label>
                                                                        <input type="text" placeholder="S/ 300 mensual"
                                                                            name="monto_de_contrato" id="monto_de_contrato"
                                                                            class="@error('monto_de_contrato') is-invalid @enderror"
                                                                            value="{{ old('monto_de_contrato', $contra->monto_de_contrato ?? '') }}">
                                                                        @error('monto_de_contrato')
                                                                            <span class="invalid-feedback" style="color: red">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="fecha_de_inicio">Fecha de inicio</label>
                                                                        <input type="date" placeholder="dd/mm/aaaa"
                                                                            name="fecha_de_inicio" id="fecha_de_inicio"
                                                                            class="@error('fecha_de_inicio') is-invalid @enderror"
                                                                            value="{{ old('fecha_de_inicio', $contra->fecha_de_inicio ?? '') }}">
                                                                        @error('fecha_de_inicio')
                                                                            <span class="invalid-feedback" style="color: red">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="fecha_de_fin">Fecha de fin</label>
                                                                        <input type="date" placeholder="dd/mm/aaaa"
                                                                            name="fecha_de_fin" id="fecha_de_fin"
                                                                            class="@error('fecha_de_fin') is-invalid @enderror"
                                                                            value="{{ old('fecha_de_fin', $contra->fecha_de_fin ?? '') }}">
                                                                        @error('fecha_de_fin')
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
                                                                            <input type="checkbox"
                                                                                class="custom-control-input" id="renovación"
                                                                                name="renovación"
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
                                                                            name="cada_cuantos_meses" id="cada_cuantos_meses"
                                                                            class="@error('cada_cuantos_meses') is-invalid @enderror"
                                                                            value="{{ old('cada_cuantos_meses', $contra->cada_cuantos_meses ?? '') }}">
                                                                        @error('cada_cuantos_meses')
                                                                            <span class="invalid-feedback" style="color: red">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="observación">Observación</label>
                                                                        <textarea name="observación" id="observación" placeholder="Comentario de contrato" cols="30" rows="5"
                                                                            class="@error('observación') is-invalid @enderror">{{ old('observación', $contra->observación ?? '') }}</textarea>
                                                                        @error('observación')
                                                                            <span class="invalid-feedback" style="color: red">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="estado_cuenta_del_contrato">Estado cuenta
                                                                            del contrato</label>
                                                                        <textarea name="estado_cuenta_del_contrato" id="estado_cuenta_del_contrato" placeholder="Estado cuenta del contrato"
                                                                            cols="30" rows="5" class="@error('estado_cuenta_del_contrato') is-invalid @enderror">{{ old('estado_cuenta_del_contrato', $contra->estado_cuenta_del_contrato ?? '') }}</textarea>
                                                                        @error('estado_cuenta_del_contrato')
                                                                            <span class="invalid-feedback" style="color: red">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="estado">Estado</label>
                                                                        <input type="text" placeholder="Activo"
                                                                            name="estado" id="estado"
                                                                            class="@error('estado') is-invalid @enderror"
                                                                            value="{{ old('estado', $contra->estado ?? '') }}">
                                                                        @error('estado')
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
                                                <button type="submit" class="btn-gris btn-red mr-2">Asignar
                                                    Respuesto</button>
                                                <button type="button" class="btn-gris btn-border"
                                                    data-dismiss="modal">Cancelar</button>
                                            </div>
                                            </form>
                                        @endisset

                                    </div>
                                </div>
                            </div>

                            <!-- Modal Eliminar-->
                            <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog"
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
                                            @isset($contra)
                                                <form id="delete-form" action="{{ route('destroy.contract', $contra->id) }}"
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

                            {{-- mantenimientos --}}
                            <div id="mantenimientos" class="tab-pane">
                                <div class="row">
                                    <div class="col-md-6 d-flex align-items-center justify-content-start mb-3">
                                        <h3 class="mb-0">Mantenimientos</h3>
                                    </div>
                                    <div class="col-md-6 mb-3 text-right">
                                        <button type="button" class="btn-primario w-auto pl-3 pr-3" data-toggle="modal"
                                            data-target="#crearMantenimiento">
                                            + Agregar
                                        </button>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="buscador">
                                            <div class="form-group position-relative">
                                                <label for="customSearchBox"><i class="fal fa-search"></i></label>
                                                <input type="text" id="customSearchBox" placeholder="Buscar"
                                                    class="w-auto customSearchBox">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 text-right">
                                        <!-- Botón de exportación con menú desplegable de Bootstrap 4 -->
                                        <div class="dropdown">
                                            <button class="btn-gris" type="button" id="dropdownMenuButton1"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="{{ asset('img/iconos/export.svg') }}" alt="icono"
                                                    class="mr-2"> Exportar
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
                                                                <button type="button" class="btn-action dropdown-toggle"
                                                                    data-toggle="dropdown">
                                                                    Acción <i class="fas fa-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('details.maint.in.review', $maint_in_rev->id) }}">Ver
                                                                        detalles</a>
                                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                                        data-toggle="modal"
                                                                        data-target="#editorMantenimiento{{ $maint_in_rev->id }}">Editar</a>
                                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                                        data-toggle="modal"
                                                                        data-target="#modalEliminar{{ $maint_in_rev->id }}">Eliminar</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal for observation -->
                                                    <div class="modal fade" id="observacion{{ $maint_in_rev->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
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

                                                    <!-- Modal Editor Mantenimiento-->
                                                    <div class="modal left fade"
                                                        id="editorMantenimiento{{ $maint_in_rev->id }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title font-family-Outfit-SemiBold">
                                                                        Edición De
                                                                        Mantenimiento</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                @isset($maint_in_rev)
                                                                    <form
                                                                        action="{{ route('update.maint.in.review', $maint_in_rev->id) }}"
                                                                        method="POST" class="formulario-modal">

                                                                        @csrf
                                                                        <div class="modal-body body_modal">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="TRevision">Tipo de
                                                                                            revisión</label>
                                                                                        <select
                                                                                            class="custom-select @error('tipo_de_revisión') is-invalid @enderror"
                                                                                            name="tipo_de_revisión"
                                                                                            id="TRevision">
                                                                                            <option disabled>Seleccionar tipo de
                                                                                                revisión</option>
                                                                                            @foreach ($review_types as $key => $value)
                                                                                                <option
                                                                                                    value="{{ $key }}"
                                                                                                    {{ old('tipo_de_revisión', $maint_in_rev->tipo_de_revisión ?? '') == $key ? 'selected' : '' }}>
                                                                                                    {{ $value }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        @error('tipo_de_revisión')
                                                                                            <span class="invalid-feedback"
                                                                                                role="alert">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                    </div>


                                                                                    <div class="form-group">
                                                                                        <label for="MAscensor">Ascensor</label>
                                                                                        <select
                                                                                            class="custom-select @error('ascensor') is-invalid @enderror"
                                                                                            name="ascensor" id="MAscensor">
                                                                                            @foreach ($elevators as $key => $value)
                                                                                                <option
                                                                                                    value="{{ $key }}"
                                                                                                    {{ old('ascensor') == $key ? 'selected' : '' }}>
                                                                                                    {{ $value }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        @error('ascensor')
                                                                                            <span class="invalid-feedback"
                                                                                                role="alert">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="Direccion">Dirección</label>
                                                                                        <input type="text"
                                                                                            placeholder="Dirección"
                                                                                            name="dirección" id="dirección"
                                                                                            class="form-control @error('dirección') is-invalid @enderror"
                                                                                            value="{{ old('dirección', $maint_in_rev->dirección ?? '') }}">
                                                                                        @error('dirección')
                                                                                            <span class="invalid-feedback"
                                                                                                style="color: red">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                    </div>


                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="provinciaAs">Provincia</label>
                                                                                        <input type="text"
                                                                                            placeholder="Provincia"
                                                                                            name="provincia" id="provincia"
                                                                                            class="form-control @error('provincia') is-invalid @enderror"
                                                                                            value="{{ old('provincia', $maint_in_rev->provincia ?? '') }}">
                                                                                        @error('provincia')
                                                                                            <span class="invalid-feedback"
                                                                                                role="alert">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label for="NCertificado">Núm
                                                                                                    Certificado</label>
                                                                                                <input type="text"
                                                                                                    placeholder="Núm Certificado"
                                                                                                    name="núm_certificado"
                                                                                                    id="NCertificado"
                                                                                                    value="{{ old('núm_certificado', $maint_in_rev->provincia ?? '') }}"
                                                                                                    class="form-control @error('núm_certificado') is-invalid @enderror">
                                                                                                @error('núm_certificado')
                                                                                                    <span class="invalid-feedback"
                                                                                                        role="alert">
                                                                                                        <strong>{{ $message }}</strong>
                                                                                                    </span>
                                                                                                @enderror
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    for="NMaquina">#Máquina</label>
                                                                                                <input type="text"
                                                                                                    placeholder="#Máquina"
                                                                                                    name="máquina"
                                                                                                    id="NMaquina"
                                                                                                    value="{{ old('máquina', $maint_in_rev->máquina ?? '') }}"
                                                                                                    class="form-control @error('máquina') is-invalid @enderror">
                                                                                                @error('máquina')
                                                                                                    <span class="invalid-feedback"
                                                                                                        role="alert">
                                                                                                        <strong>{{ $message }}</strong>
                                                                                                    </span>
                                                                                                @enderror
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>


                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="Supervisor">Supervisor</label>
                                                                                        <select
                                                                                            class="custom-select  @error('máquina') is-invalid @enderror"
                                                                                            name="supervisor" id="Supervisor">
                                                                                            <option value=""
                                                                                                class="d-none">
                                                                                                Seleccionar opción</option>
                                                                                            <option value="supervisor_1"
                                                                                                {{ old('supervisor') == 'supervisor_1' ? 'selected' : ($maint_in_rev->supervisor == 'supervisor_1' ? 'selected' : '') }}>
                                                                                                Supervisor 1</option>
                                                                                            <option value="supervisor_2"
                                                                                                {{ old('supervisor') == 'supervisor_2' ? 'selected' : ($maint_in_rev->supervisor == 'supervisor_2' ? 'selected' : '') }}>
                                                                                                Supervisor 2</option>
                                                                                            <option value="supervisor_3"
                                                                                                {{ old('supervisor') == 'supervisor_3' ? 'selected' : ($maint_in_rev->supervisor == 'supervisor_3' ? 'selected' : '') }}>
                                                                                                Supervisor 3</option>
                                                                                        </select>
                                                                                        @error('supervisor')
                                                                                            <span class="invalid-feedback"
                                                                                                role="alert">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                    </div>


                                                                                    <div class="form-group">
                                                                                        <label for="tecnico">Técnico</label>
                                                                                        <select class="custom-select"
                                                                                            name="técnico" id="tecnico">
                                                                                            <option value=""
                                                                                                class="d-none  @error('técnico') is-invalid @enderror">
                                                                                                Seleccionar opción</option>
                                                                                            <option value="técnico_1"
                                                                                                {{ old('técnico') == 'técnico_1' ? 'selected' : ($maint_in_rev->técnico == 'técnico_1' ? 'selected' : '') }}>
                                                                                                Técnico 1</option>
                                                                                            <option value="técnico_2"
                                                                                                {{ old('técnico') == 'técnico_2' ? 'selected' : ($maint_in_rev->técnico == 'técnico_2' ? 'selected' : '') }}>
                                                                                                Técnico 2</option>
                                                                                            <option value="técnico_3"
                                                                                                {{ old('técnico') == 'técnico_3' ? 'selected' : ($maint_in_rev->técnico == 'técnico_3' ? 'selected' : '') }}>
                                                                                                Técnico 3</option>
                                                                                        </select>
                                                                                        @error('técnico')
                                                                                            <span class="invalid-feedback"
                                                                                                role="alert">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                    </div>


                                                                                    <div class="row">
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label for="Mprogramado">Mes
                                                                                                    programado</label>
                                                                                                <select
                                                                                                    class="custom-select @error('mes_programado') is-invalid @enderror"
                                                                                                    name="mes_programado"
                                                                                                    id="Mprogramado">
                                                                                                    <option value=""
                                                                                                        class="d-none">
                                                                                                        Seleccionar
                                                                                                        opción</option>
                                                                                                    <option
                                                                                                        value="mes_programado_1"
                                                                                                        {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'mes_programado_1' ? 'selected' : '' }}>
                                                                                                        Mes programado 1
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="mes_programado_2"
                                                                                                        {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'mes_programado_2' ? 'selected' : '' }}>
                                                                                                        Mes programado 2
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="mes_programado_3"
                                                                                                        {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'mes_programado_3' ? 'selected' : '' }}>
                                                                                                        Mes programado 3
                                                                                                    </option>
                                                                                                </select>
                                                                                                @error('mes_programado')
                                                                                                    <span class="invalid-feedback"
                                                                                                        role="alert">
                                                                                                        <strong>{{ $message }}</strong>
                                                                                                    </span>
                                                                                                @enderror
                                                                                            </div>
                                                                                        </div>


                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    for="FMantenimiento">Fecha
                                                                                                    de
                                                                                                    mantenimiento</label>
                                                                                                <input type="date"
                                                                                                    placeholder="dd/mm/aaaa"
                                                                                                    name="fecha_de_mantenimiento"
                                                                                                    id="FMantenimiento"
                                                                                                    class="form-control @error('fecha_de_mantenimiento') is-invalid @enderror"
                                                                                                    value="{{ old('fecha_de_mantenimiento', $maint_in_rev->fecha_de_mantenimiento ?? '') }}">
                                                                                                @error('fecha_de_mantenimiento')
                                                                                                    <span class="invalid-feedback"
                                                                                                        style="color: red">
                                                                                                        <strong>{{ $message }}</strong>
                                                                                                    </span>
                                                                                                @enderror
                                                                                            </div>
                                                                                        </div>


                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label for="FInicio">Hora
                                                                                                    inicio</label>
                                                                                                <input type="time"
                                                                                                    placeholder="Hora inicio"
                                                                                                    name="hora_inicio"
                                                                                                    id="FInicio"
                                                                                                    class="form-control @error('hora_inicio') is-invalid @enderror"
                                                                                                    value="{{ old('hora_inicio', $maint_in_rev->hora_inicio ?? '') }}">
                                                                                                @error('hora_inicio')
                                                                                                    <span class="invalid-feedback"
                                                                                                        style="color: red">
                                                                                                        <strong>{{ $message }}</strong>
                                                                                                    </span>
                                                                                                @enderror
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label for="HFin">Hora
                                                                                                    fin</label>
                                                                                                <input type="time"
                                                                                                    placeholder="Hora fin"
                                                                                                    name="hora_fin"
                                                                                                    id="HFin"
                                                                                                    class="form-control @error('hora_fin') is-invalid @enderror"
                                                                                                    value="{{ old('hora_fin', $maint_in_rev->hora_fin ?? '') }}">
                                                                                                @error('hora_fin')
                                                                                                    <span class="invalid-feedback"
                                                                                                        style="color: red">
                                                                                                        <strong>{{ $message }}</strong>
                                                                                                    </span>
                                                                                                @enderror
                                                                                            </div>
                                                                                        </div>


                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    for="observaciónes">Observaciones</label>
                                                                                                <textarea name="observaciónes" id="observaciónes" placeholder="Comentario de contrato" cols="30"
                                                                                                    rows="5">{{ old('observaciónes', $maint_in_rev->observaciónes ?? '') }}</textarea>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    for="observacionesInternas">Observaciones
                                                                                                    internas</label>
                                                                                                <textarea name="observaciónes_internas" id="observacionesInternas" placeholder="Observaciones internas"
                                                                                                    cols="30" rows="5">{{ old('observaciónes_internas', $maint_in_rev->observaciónes_internas ?? '') }}</textarea>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    for="solucion">Solución</label>
                                                                                                <textarea name="solución" id="solucion" placeholder="Solución" cols="30" rows="5">{{ old('solución', $maint_in_rev->solución ?? '') }}</textarea>
                                                                                            </div>
                                                                                        </div>


                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                                                                            <button type="submit"
                                                                                class="btn-gris btn-red mr-2">Guardar
                                                                                Cambios</button>
                                                                            <button type="button" class="btn-gris btn-border"
                                                                                data-dismiss="modal">Cancelar</button>
                                                                        </div>
                                                                    </form>
                                                                @endisset
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal Eliminar-->
                                                    <div class="modal fade" id="modalEliminar{{ $maint_in_rev->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                                                        aria-hidden="true">
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
                                                                    @isset($maint_in_rev)
                                                                        <form id="delete-form"
                                                                            action="{{ route('destroy.maint.in.review', $maint_in_rev->id) }}"
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


                            <div id="repuestos" class="tab-pane">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <h3>Repuestos del Ascensor</h3>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="buscador">
                                            <div class="form-group position-relative">
                                                <label for="customSearchBox2"><i class="fal fa-search"></i></label>
                                                <input type="text" id="customSearchBox2" placeholder="Buscar"
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
                                                    class="mr-2"> Exportar
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
                                                        <td><img src="{{ asset('images/' . $sparepart->foto_de_repuesto) }}"
                                                                alt="personal" width="52" height="52"
                                                                class="img-table"></td>
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
                                    enctype="multipart/form-data" method="POST">
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
                                                                    alt="Existing Image" width="200px" height="200px">
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
                                                            <button type="button" id="edituploadButton" class="btn-gris">
                                                                <i class="fas fa-arrow-to-top mr-2"></i>Subir
                                                                Imagen
                                                            </button>
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <label for="contrato"># de contrato</label>
                                                            <input type="text" placeholder="# de contrato" name="contrato"
                                                                id="contrato"
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
                                                            <input type="text" placeholder="Marca" name="marca"
                                                                id="marca"
                                                                class="form-control @error('marca') is-invalid @enderror"
                                                                value="{{ old('marca', $elevators->marca ?? '') }}">
                                                            @error('marca')
                                                                <span class="invalid-feedback" style="color: red">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="clienteAscensor">Cliente del
                                                                ascensor</label>
                                                            <select
                                                                class="custom-select form-control @error('cliente') is-invalid @enderror"
                                                                name="cliente" id="cliente">
                                                                <option selected disabled>Seleccionar opción
                                                                </option>
                                                                @foreach ($customers as $key => $value)
                                                                    <option value="{{ $key }}"
                                                                        {{ old('cliente', $elevators->cliente ?? '') == $key ? 'selected' : '' }}>
                                                                        {{ $value }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('cliente')
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
                                                                <option selected disabled>Seleccionar opción
                                                                </option>
                                                                <option value="lima"
                                                                    {{ old('provincia', $elevators->provincia ?? '') == 'lima' ? 'selected' : '' }}>
                                                                    Lima</option>
                                                                <option value="arequipa"
                                                                    {{ old('provincia', $elevators->provincia ?? '') == 'arequipa' ? 'selected' : '' }}>
                                                                    Arequipa</option>
                                                                <option value="moquegua"
                                                                    {{ old('provincia', $elevators->provincia ?? '') == 'moquegua' ? 'selected' : '' }}>
                                                                    Moquegua</option>
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
                                                            <select
                                                                class="custom-select form-control @error('técnico_instalador') is-invalid @enderror"
                                                                name="técnico_instalador" id="técnico_instalador">
                                                                <option selected disabled>Seleccionar opción
                                                                </option>
                                                                <option value="tecnico_1"
                                                                    {{ old('técnico_instalador', $elevators->técnico_instalador ?? '') == 'tecnico_1' ? 'selected' : '' }}>
                                                                    Técnico 1</option>
                                                                <option value="tecnico_2"
                                                                    {{ old('técnico_instalador', $elevators->técnico_instalador ?? '') == 'tecnico_2' ? 'selected' : '' }}>
                                                                    Técnico 2</option>
                                                                <option value="tecnico_3"
                                                                    {{ old('técnico_instalador', $elevators->técnico_instalador ?? '') == 'tecnico_3' ? 'selected' : '' }}>
                                                                    Técnico 3</option>
                                                            </select>
                                                            @error('técnico_instalador')
                                                                <span class="invalid-feedback" style="color: red">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="técnico_ajustador">Técnico
                                                                ajustador</label>
                                                            <select
                                                                class="custom-select form-control @error('técnico_ajustador') is-invalid @enderror"
                                                                name="técnico_ajustador" id="técnico_ajustador">
                                                                <option selected disabled>Seleccionar opción
                                                                </option>
                                                                <option value="tecnico_1"
                                                                    {{ old('técnico_ajustador', $elevators->técnico_ajustador ?? '') == 'tecnico_1' ? 'selected' : '' }}>
                                                                    Técnico 1</option>
                                                                <option value="tecnico_2"
                                                                    {{ old('técnico_ajustador', $elevators->técnico_ajustador ?? '') == 'tecnico_2' ? 'selected' : '' }}>
                                                                    Técnico 2</option>
                                                                <option value="tecnico_3"
                                                                    {{ old('técnico_ajustador', $elevators->técnico_ajustador ?? '') == 'tecnico_3' ? 'selected' : '' }}>
                                                                    Técnico 3</option>
                                                            </select>
                                                            @error('técnico_ajustador')
                                                                <span class="invalid-feedback" style="color: red">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="tipo_de_ascensor">Tipo de ascensor</label>
                                                            <select
                                                                class="custom-select form-control @error('tipo_de_ascensor') is-invalid @enderror"
                                                                name="tipo_de_ascensor" id="tipo_de_ascensor">
                                                                <option selected disabled>Seleccionar opción
                                                                </option>
                                                                <option value="tipo_1"
                                                                    {{ old('tipo_de_ascensor', $elevators->tipo_de_ascensor ?? '') == 'tipo_1' ? 'selected' : '' }}>
                                                                    Tipo 1</option>
                                                                <option value="tipo_2"
                                                                    {{ old('tipo_de_ascensor', $elevators->tipo_de_ascensor ?? '') == 'tipo_2' ? 'selected' : '' }}>
                                                                    Tipo 2</option>
                                                                <option value="tipo_3"
                                                                    {{ old('tipo_de_ascensor', $elevators->tipo_de_ascensor ?? '') == 'tipo_3' ? 'selected' : '' }}>
                                                                    Tipo 3</option>
                                                            </select>
                                                            @error('tipo_de_ascensor')
                                                                <span class="invalid-feedback" style="color: red">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tiposAscensor">Cantidad</label>
                                                            <select
                                                                class="custom-select @error('cantidad') is-invalid @enderror"
                                                                name="cantidad" id="cantidad">
                                                                <option selected disabled>Seleccionar</option>
                                                                <option value="cantidad_1"
                                                                    {{ old('cantidad', $elevators->cantidad ?? '') == 'cantidad_1' ? 'selected' : '' }}>
                                                                    Cantidad 1</option>
                                                                <option value="cantidad_2"
                                                                    {{ old('cantidad', $elevators->cantidad ?? '') == 'cantidad_2' ? 'selected' : '' }}>
                                                                    Cantidad 2</option>
                                                                <option value="cantidad_3"
                                                                    {{ old('cantidad', $elevators->cantidad ?? '') == 'cantidad_3' ? 'selected' : '' }}>
                                                                    Cantidad 3</option>
                                                            </select>
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
                                                                    id="mgratuito" name="mgratuito"
                                                                    {{ isset($elevators) && $elevators->mgratuito ? 'checked' : '' }}>
                                                                <label class="custom-control-label"
                                                                    for="MGratuito">Mantenimiento gratuito?</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="adornoinput mb-3">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="sincuarto" name="sincuarto"
                                                                    {{ isset($elevators) && $elevators->sincuarto ? 'checked' : '' }}>
                                                                <label class="custom-control-label" for="SinCuarto">Sin
                                                                    cuarto
                                                                    de maquina?</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="adornoinput mb-3">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="concuarto" name="concuarto"
                                                                    {{ isset($elevators) && $elevators->concuarto ? 'checked' : '' }}>
                                                                <label class="custom-control-label" for="ConCuarto">Con
                                                                    cuarto
                                                                    de maquina?</label>
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
                                                            <input type="number" placeholder="Nombre del contacto"
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

                                                    <div class="col-md-12 d-none position-relative" id="DAdicional">
                                                        <div class="form-group">
                                                            <label for="Descripcion2">Descripción 2</label>
                                                            <textarea name="descripcion2" id="descripcion2" placeholder="Descripción" cols="30" rows="5">{{ old('descripcion1', isset($elevators) ? $elevators->descripcion1 : '') }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="button" class="btn-gris" id="AgregarDescripcion">+
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
                            <form action="{{ route('insert.maint.in.review') }}" method="POST"
                                class="formulario-modal" id="customerForm">
                                @csrf
                                <div class="modal-body body_modal">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="tipo_de_revisión">Tipo de revisión</label>
                                                <select
                                                    class="custom-select @error('tipo_de_revisión') is-invalid @enderror"
                                                    name="tipo_de_revisión" id="tipo_de_revisión">
                                                    <option selected disabled>Seleccionar tipo de revisión</option>
                                                    @foreach ($review_types as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('tipo_de_revisión')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="ascensor">Ascensor</label>
                                                <select class="custom-select @error('ascensor') is-invalid @enderror"
                                                    name="ascensor" id="ascensor">
                                                    <option selected disabled>Seleccionar opción</option>
                                                    @foreach ($elevators as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('ascensor')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="dirección">Dirección</label>
                                                <input type="text" placeholder="Dirección" name="dirección"
                                                    id="dirección" class="@error('dirección') is-invalid @enderror">
                                                @error('dirección')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="provincia">Provincia</label>
                                                <input type="text" placeholder="Provincia" name="provincia"
                                                    id="provincia" class="@error('provincia') is-invalid @enderror">
                                                @error('provincia')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="núm_certificado">Núm Certificado</label>
                                                        <input type="text" placeholder="Núm Certificado"
                                                            name="núm_certificado" id="núm_certificado"
                                                            class="@error('núm_certificado') is-invalid @enderror">
                                                        @error('núm_certificado')
                                                            <span class="invalid-feedback" style="color: red">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="máquina">#Máquina</label>
                                                        <input type="text" placeholder="#Máquina" name="máquina"
                                                            id="máquina"
                                                            class="@error('máquina') is-invalid @enderror">
                                                        @error('máquina')
                                                            <span class="invalid-feedback" style="color: red">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="supervisor">Supervisor</label>
                                                <select class="custom-select @error('supervisor') is-invalid @enderror"
                                                    name="supervisor" id="supervisor">
                                                    <option selected disabled class="d-none">Seleccionar opción</option>
                                                    <option value="supervisor_1">Supervisor 1</option>
                                                    <option value="supervisor_2">Supervisor 2</option>
                                                    <option value="supervisor_3">Supervisor 3</option>
                                                </select>
                                                @error('supervisor')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="técnico">Técnico</label>
                                                <select class="custom-select @error('técnico') is-invalid @enderror"
                                                    name="técnico" id="técnico">
                                                    <option selected disabled class="d-none">Seleccionar opción</option>
                                                    <option value="técnico_1">Técnico 1</option>
                                                    <option value="técnico_2">Técnico 2</option>
                                                    <option value="técnico_3">Técnico 3</option>
                                                </select>
                                                @error('técnico')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="Mprogramado">Mes programado</label>
                                                        <select
                                                            class="custom-select @error('mes_programado') is-invalid @enderror"
                                                            name="mes_programado" id="Mprogramado">
                                                            <option selected disabled class="d-none">Seleccionar opción
                                                            </option>
                                                            <option value="mes_programado_1">Mes programado 1</option>
                                                            <option value="mes_programado_2">Mes programado 2</option>
                                                            <option value="mes_programado_3">Mes programado 3</option>
                                                        </select>
                                                        @error('mes_programado')
                                                            <span class="invalid-feedback" style="color: red">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="FMantenimiento">Fecha de mantenimiento</label>
                                                        <input type="date" placeholder="dd/mm/aaaa"
                                                            name="fecha_de_mantenimiento" id="FMantenimiento"
                                                            class="@error('fecha_de_mantenimiento') is-invalid @enderror">
                                                        @error('fecha_de_mantenimiento')
                                                            <span class="invalid-feedback" style="color: red">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="FInicio">Hora inicio</label>
                                                        <input type="time" placeholder="dd/mm/aaaa"
                                                            name="hora_inicio" id="FInicio"
                                                            class="@error('hora_inicio') is-invalid @enderror">
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
                                                        <input type="time" placeholder="dd/mm/aaaa" name="hora_fin"
                                                            id="HFin"
                                                            class="@error('hora_fin') is-invalid @enderror">
                                                        @error('hora_fin')
                                                            <span class="invalid-feedback" style="color: red">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="observaciones">Observaciónes</label>
                                                        <textarea name="observaciónes" id="observaciones" placeholder="Comentario de contrato" cols="30"
                                                            rows="5" class="@error('observaciónes') is-invalid @enderror"></textarea>
                                                        @error('observaciónes')
                                                            <span class="invalid-feedback" style="color: red">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="observacionesInternas">Observaciónes internas</label>
                                                        <textarea name="observaciónes_internas" id="observacionesInternas" placeholder="Observaciónes internas"
                                                            cols="30" rows="5" class="@error('observaciónes_internas') is-invalid @enderror"></textarea>
                                                        @error('observaciónes_internas')
                                                            <span class="invalid-feedback" style="color: red">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="solucion">Solución</label>
                                                        <textarea name="solución" id="solucion" placeholder="Solución" cols="30" rows="5"
                                                            class="@error('solución') is-invalid @enderror"></textarea>
                                                        @error('solución')
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
                                    <button type="button" class="btn-gris btn-border"
                                        data-dismiss="modal">Cancelar</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>


                <!-- Modal Eliminar-->
                <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog"
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
                                @isset($elevator)
                                    <form id="delete-form" action="{{ route('destroy.elevator', $elevator->id) }}"
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
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            var table = $('#contratosTable').DataTable({
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
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            // Mover el contenedor de búsqueda (filtro) a la izquierda
            // $("#miTabla_filter").css('float', 'left');

            // Manejadores para los botones de exportación personalizados
            $(".export_excel").on("click", function() {
                var tableId = $(this).data("table");
                var table = $(tableId).DataTable();
                table.button('.buttons-csv').trigger();
            });
            $(".export_pdf").on("click", function() {
                var tableId = $(this).data("table");
                var table = $(tableId).DataTable();
                table.button('.buttons-pdf').trigger();
            });
            $(".export_copy").on("click", function() {
                var tableId = $(this).data("table");
                var table = $(tableId).DataTable();
                table.button('.buttons-copy').trigger();
            });
            $(".export_print").on("click", function() {
                var tableId = $(this).data("table");
                var table = $(tableId).DataTable();
                table.button('.buttons-print').trigger();
            });

            // $('#customSearchBox').keyup(function(){
            //     table.search($(this).val()).draw();
            // });
            $('.customSearchBox').keyup(function() {
                table.search($(this).val()).draw();
            });


            var table = $('#mantenimientosTable').DataTable({
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
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            var table = $('#repuestosAsensorTable').DataTable({
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
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
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
        });
    </script>
@endpush
