@extends('layouts.main')
@section('content')
    <div class="w-100 contenido">
        <div class="container-fluid container-mod">
            <div class="row">
                <div class="col-xl-10 col-lg-10 col-md-8 col-sm-8 col-8 mb-4">
                    <div class="titulo">
                        <h4>{{ $elevator->nombre }}</h4>
                        <span>Ascensores >> {{ $elevator->nombre }}</span>
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
                                href="{{ route('destroy.elevator', $elevator->id) }}" data-toggle="modal"
                                data-target="#modalEliminar">Eliminar</a>>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="box-contenido pb-0">
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-start justify-content-start gap-20 mb-6 box-detalle">
                                <div class="contenido-img">
                                    <img src="{{ asset('images/' . $elevator->imagen) }}" alt="user" width="160">
                                </div>
                                <div class="align-items-start d-flex flex-column h-100 justify-content-between">
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
                                            <h4>{{ \Carbon\Carbon::parse($elevator->fecha)->format('d M Y, g:i a') }}</h4>
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
                                            <span class="float-right fz-15 btn-gris" style="min-width: auto;">
                                                <i class="fad fa-qrcode"></i> Ver QR
                                            </span>
                                        </h3>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Nombre</td>
                                                    <td>{{ $elevator->nombre }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Código</td>
                                                    <td>{{ $elevator->código }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Cliente del ascensor</td>
                                                    <td>{{ $elevator->cliente }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Marca</td>
                                                    <td>{{ $elevator->marca }}</td>
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
                                                    <td>{{ $elevator->garantizar }}</td>
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
                                                        {{ $elevator->dirección }}
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
                                                    <td>{{ $elevator->provincia }}</td>
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
                                                    <td>{{ $elevator->tipo_de_ascensor }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Cantidad</td>
                                                    <td>{{ $elevator->cantidad }}</td>
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
                                </div>
                            </div>
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
                                                <img src="{{ asset('img/iconos/export.svg') }}" alt="icono" class="mr-2"> Exportar
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
                                                <tr>
                                                    <td>1970-01-01</td>
                                                    <td>S/ 190.00</td>
                                                    <td>2018-01-09</td>
                                                    <td>2018-01-09</td>
                                                    <td>S/ 190.00</td>
                                                    <td>
                                                        <div class="alerta boton-activo">
                                                            <i class="fas fa-circle"></i> activo
                                                        </div>
                                                    </td>
                                                    <td align="right">
                                                        <div class="dropdown">
                                                            <button type="button" class="btn-action dropdown-toggle"
                                                                data-toggle="dropdown">
                                                                Acción <i class="fas fa-chevron-down"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="javascript:void(0)"
                                                                    data-toggle="modal" data-target="#crearContratos">Ver
                                                                    detalles</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"
                                                                    data-toggle="modal"
                                                                    data-target="#crearContratos">Editar</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"
                                                                    data-toggle="modal"
                                                                    data-target="#modalEliminar">Eliminar</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>1970-01-01</td>
                                                    <td>S/ 190.00</td>
                                                    <td>2018-01-09</td>
                                                    <td>2018-01-09</td>
                                                    <td>S/ 190.00</td>
                                                    <td>
                                                        <div class="alerta boton-activo">
                                                            <i class="fas fa-circle"></i> activo
                                                        </div>
                                                    </td>
                                                    <td align="right">
                                                        <div class="dropdown">
                                                            <button type="button" class="btn-action dropdown-toggle"
                                                                data-toggle="dropdown">
                                                                Acción <i class="fas fa-chevron-down"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="javascript:void(0)"
                                                                    data-toggle="modal" data-target="#crearContratos">Ver
                                                                    detalles</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"
                                                                    data-toggle="modal"
                                                                    data-target="#crearContratos">Editar</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"
                                                                    data-toggle="modal"
                                                                    data-target="#modalEliminar">Eliminar</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>1970-01-01</td>
                                                    <td>S/ 190.00</td>
                                                    <td>2018-01-09</td>
                                                    <td>2018-01-09</td>
                                                    <td>S/ 190.00</td>
                                                    <td>
                                                        <div class="alerta boton-inactivo">
                                                            <i class="fas fa-circle"></i> inactivo
                                                        </div>
                                                    </td>
                                                    <td align="right">
                                                        <div class="dropdown">
                                                            <button type="button" class="btn-action dropdown-toggle"
                                                                data-toggle="dropdown">
                                                                Acción <i class="fas fa-chevron-down"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="javascript:void(0)"
                                                                    data-toggle="modal" data-target="#crearContratos">Ver
                                                                    detalles</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"
                                                                    data-toggle="modal"
                                                                    data-target="#crearContratos">Editar</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"
                                                                    data-toggle="modal"
                                                                    data-target="#modalEliminar">Eliminar</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
                                                <img src="{{ asset('img/iconos/export.svg') }}" alt="icono" class="mr-2"> Exportar
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
                                                    <th># CERTIFICADO</th>
                                                    <th>FECHA MANTENIMIENTO</th>
                                                    <th>TÉCNICO</th>
                                                    <th>OBSERVACIÓN</th>
                                                    <th class="text-right">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>MANT. PREVENTIVO</td>
                                                    <td>02069</td>
                                                    <td>2023-10-16</td>
                                                    <td>ANDERSON RUBIO</td>
                                                    <td>
                                                        <a class="text-blue" href="javascript:void(0)"
                                                            data-toggle="modal" data-target="#observacion">
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
                                                                    href="detalle-mant-revision.php">Ver detalles</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"
                                                                    data-toggle="modal"
                                                                    data-target="#crearMantenimiento">Editar</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"
                                                                    data-toggle="modal"
                                                                    data-target="#modalEliminar">Eliminar</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>MANT. PREVENTIVO</td>
                                                    <td>02069</td>
                                                    <td>2023-10-16</td>
                                                    <td>ANDERSON RUBIO</td>
                                                    <td>
                                                        <a class="text-blue" href="javascript:void(0)"
                                                            data-toggle="modal" data-target="#observacion">
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
                                                                    href="detalle-mant-revision.php">Ver detalles</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"
                                                                    data-toggle="modal"
                                                                    data-target="#crearMantenimiento">Editar</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"
                                                                    data-toggle="modal"
                                                                    data-target="#modalEliminar">Eliminar</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>MANT. PREVENTIVO</td>
                                                    <td>02069</td>
                                                    <td>2023-10-16</td>
                                                    <td>ANDERSON RUBIO</td>
                                                    <td>
                                                        <a class="text-blue" href="javascript:void(0)"
                                                            data-toggle="modal" data-target="#observacion">
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
                                                                    href="detalle-mant-revision.php">Ver detalles</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"
                                                                    data-toggle="modal"
                                                                    data-target="#crearMantenimiento">Editar</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"
                                                                    data-toggle="modal"
                                                                    data-target="#modalEliminar">Eliminar</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
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
                                                <img src="{{ asset('img/iconos/export.svg') }}" alt="icono" class="mr-2"> Exportar
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
                                                    <th>REPUESTO</th>
                                                    <th>ÚLT. LIMPIEZA</th>
                                                    <th>ÚLT. LUBRICACIÓN</th>
                                                    <th>ÚLT. AJUSTE</th>
                                                    <th>ÚLT. REVISIÓN</th>
                                                    <th>ÚLT. CAMBIO</th>
                                                    <th>ÚLT. SOLICITUD</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="img/tipo-repuesto.png" alt="tipo repuesto"
                                                            width="52" height="52" class="img-table">
                                                    </td>
                                                    <td>1001</td>
                                                    <td>
                                                        <a href="detalle-repuestos.php" class="text-blue">
                                                            ACEITERAS PARA RIELES
                                                        </a>
                                                    </td>
                                                    <td>30</td>
                                                    <td>30</td>
                                                    <td>30</td>
                                                    <td>30</td>
                                                    <td>730</td>
                                                    <td>Ejemplo</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="img/tipo-repuesto.png" alt="tipo repuesto"
                                                            width="52" height="52" class="img-table">
                                                    </td>
                                                    <td>1001</td>
                                                    <td>
                                                        <a href="detalle-repuestos.php" class="text-blue">
                                                            ACEITERAS PARA RIELES
                                                        </a>
                                                    </td>
                                                    <td>30</td>
                                                    <td>30</td>
                                                    <td>30</td>
                                                    <td>30</td>
                                                    <td>730</td>
                                                    <td>Ejemplo</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="img/tipo-repuesto.png" alt="tipo repuesto"
                                                            width="52" height="52" class="img-table">
                                                    </td>
                                                    <td>1001</td>
                                                    <td>
                                                        <a href="detalle-repuestos.php" class="text-blue">
                                                            ACEITERAS PARA RIELES
                                                        </a>
                                                    </td>
                                                    <td>30</td>
                                                    <td>30</td>
                                                    <td>30</td>
                                                    <td>30</td>
                                                    <td>730</td>
                                                    <td>Ejemplo</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="img/tipo-repuesto.png" alt="tipo repuesto"
                                                            width="52" height="52" class="img-table">
                                                    </td>
                                                    <td>1001</td>
                                                    <td>
                                                        <a href="detalle-repuestos.php" class="text-blue">
                                                            ACEITERAS PARA RIELES
                                                        </a>
                                                    </td>
                                                    <td>30</td>
                                                    <td>30</td>
                                                    <td>30</td>
                                                    <td>30</td>
                                                    <td>730</td>
                                                    <td>Ejemplo</td>
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
@endsection
