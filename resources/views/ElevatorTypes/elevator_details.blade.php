@extends('layouts.main')
@section('content')
<div class="w-100 contenido">
    <div class="container-fluid container-mod">
        <div class="row">
            <div class="col-xl-10 col-lg-10 col-md-8 col-sm-8 col-8 mb-4">
                <div class="titulo">
                    <h4>{{ $elevator_type->nombre_de_tipo_de_ascensor }}</h4>
                    <span>Tipos de ascensor >> PLATAFORMA DE DISCAPACITADOS</span>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-end">
                <div class="dropdown btn-new">
                    <a class="btn-action dropdownMenuLink d-inline-block" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Acción <i class="fas fa-chevron-down"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item texto-1 font-family-Inter-Regular" href="javascript:void(0)"  data-toggle="modal" data-target="#editartiposAscensores">Editar</a>
                        <a class="dropdown-item texto-1 font-family-Inter-Regular" href="javascript:void(0)" data-toggle="modal" data-target="#modalEliminar">Eliminar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="box-contenido pb-0">
                    <div class="row">
                        <div class="col-md-12 d-flex align-items-start justify-content-start gap-20 mb-6 box-detalle">
                            <div class="">
                                <img src="{{ asset('img/tipo-ascensor.png')}}" alt="user">
                            </div>
                            <div class="align-items-start d-flex flex-column h-100 justify-content-between">
                                <div>
                                    <h3>{{ $elevator_type->nombre_de_tipo_de_ascensor }}</h3>
                                    <span>Tipo de Ascensor</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-start gap-15 flex-wrap">
                                    <div class="option">
                                        <h4>{{ $elevator_type->id }}</h4>
                                        <p class="mb-0">ID elemento</p>
                                    </div>
                                    <div class="option">
                                        <h4>{{ $elevator_type->created_at->format('d M Y, g:i a') }}</h4>
                                        <p class="mb-0">Fecha registro</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ul class="nav nav-tabs tabs-elevatronic" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#repuestos">Repuestos Asignados</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tipoAscensores">Ascensores del Tipo</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="box-contenido">
                    <div class="tab-content contenido-elevatronic">
                        <div id="repuestos" class="tab-pane active"><br>
                            <div class="row">
                                <div class="col-md-6 d-flex align-items-center justify-content-start mb-3">
                                    <h3 class="mb-0">Información de cliente</h3>
                                </div>
                                <div class="col-md-6 mb-3 text-right">
                                    <button type="button" class="btn-primario w-auto pl-3 pr-3" data-toggle="modal" data-target="#asignarRepuestos">
                                        + Asignar
                                    </button>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="buscador">
                                        <div class="form-group position-relative">
                                            <label for="customSearchBox"><i class="fal fa-search"></i></label>
                                            <input type="text" id="customSearchBox" placeholder="Buscar" class="w-auto customSearchBox">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 text-right">
                                    <!-- Botón de exportación con menú desplegable de Bootstrap 4 -->
                                    <div class="dropdown">
                                        <button class="btn-gris" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="{{ asset('img/iconos/export.svg')}}" alt="icono" class="mr-2"> Exportar Datos <i class="iconoir-nav-arrow-down"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                            <button class="dropdown-item export_excel" data-table="#repuestosAsignados">Excel</button>
                                            <button class="dropdown-item export_pdf" data-table="#repuestosAsignados">PDF</button>
                                            <button class="dropdown-item export_copy" data-table="#repuestosAsignados">Copiar</button>
                                            <button class="dropdown-item export_print" data-table="#repuestosAsignados">Imprimir</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table id="repuestosAsignados" class="table" style="width:100%">
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
                                        <tr>
                                            <td>
                                                <img src="img/tipo-repuesto.png" alt="tipo repuesto" width="52" height="52" class="img-table">
                                            </td>
                                            <td>1001</td>
                                            <td>
                                                <a href="detalle-repuestos.php" class="text-blue">ACEITERAS PARA RIELES</a>
                                            </td>
                                            <td>$25,000</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>730</td>
                                            <td>Ejemplo</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/tipo-repuesto.png" alt="tipo repuesto" width="52" height="52" class="img-table">
                                            </td>
                                            <td>1001</td>
                                            <td>
                                                <a href="detalle-repuestos.php" class="text-blue">ACEITERAS PARA RIELES</a>
                                            </td>
                                            <td>$25,000</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>730</td>
                                            <td>Ejemplo</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/tipo-repuesto.png" alt="tipo repuesto" width="52" height="52" class="img-table">
                                            </td>
                                            <td>1001</td>
                                            <td>
                                                <a href="detalle-repuestos.php" class="text-blue">ACEITERAS PARA RIELES</a>
                                            </td>
                                            <td>$25,000</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>730</td>
                                            <td>Ejemplo</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/tipo-repuesto.png" alt="tipo repuesto" width="52" height="52" class="img-table">
                                            </td>
                                            <td>1001</td>
                                            <td>
                                                <a href="detalle-repuestos.php" class="text-blue">ACEITERAS PARA RIELES</a>
                                            </td>
                                            <td>$25,000</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>730</td>
                                            <td>Ejemplo</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/tipo-repuesto.png" alt="tipo repuesto" width="52" height="52" class="img-table">
                                            </td>
                                            <td>1001</td>
                                            <td>
                                                <a href="detalle-repuestos.php" class="text-blue">ACEITERAS PARA RIELES</a>
                                            </td>
                                            <td>$25,000</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>730</td>
                                            <td>Ejemplo</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/tipo-repuesto.png" alt="tipo repuesto" width="52" height="52" class="img-table">
                                            </td>
                                            <td>1001</td>
                                            <td>
                                                <a href="detalle-repuestos.php" class="text-blue">ACEITERAS PARA RIELES</a>
                                            </td>
                                            <td>$25,000</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>730</td>
                                            <td>Ejemplo</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/tipo-repuesto.png" alt="tipo repuesto" width="52" height="52" class="img-table">
                                            </td>
                                            <td>1001</td>
                                            <td>
                                                <a href="detalle-repuestos.php" class="text-blue">ACEITERAS PARA RIELES</a>
                                            </td>
                                            <td>$25,000</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>730</td>
                                            <td>Ejemplo</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/tipo-repuesto.png" alt="tipo repuesto" width="52" height="52" class="img-table">
                                            </td>
                                            <td>1001</td>
                                            <td>
                                                <a href="detalle-repuestos.php" class="text-blue">ACEITERAS PARA RIELES</a>
                                            </td>
                                            <td>$25,000</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>730</td>
                                            <td>Ejemplo</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/tipo-repuesto.png" alt="tipo repuesto" width="52" height="52" class="img-table">
                                            </td>
                                            <td>1001</td>
                                            <td>
                                                <a href="detalle-repuestos.php" class="text-blue">ACEITERAS PARA RIELES</a>
                                            </td>
                                            <td>$25,000</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>30</td>
                                            <td>730</td>
                                            <td>Ejemplo</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/tipo-repuesto.png" alt="tipo repuesto" width="52" height="52" class="img-table">
                                            </td>
                                            <td>1001</td>
                                            <td>
                                                <a href="detalle-repuestos.php" class="text-blue">ACEITERAS PARA RIELES</a>
                                            </td>
                                            <td>$25,000</td>
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
                        <div id="tipoAscensores" class="tab-pane"><br>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <h3>Ascensores del Tipo</h3>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="buscador">
                                        <div class="form-group position-relative">
                                            <label for="customSearchBox1"><i class="fal fa-search"></i></label>
                                            <input type="text" id="customSearchBox1" placeholder="Buscar" class="w-auto customSearchBox">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 text-right">
                                    <!-- Botón de exportación con menú desplegable de Bootstrap 4 -->
                                    <div class="dropdown">
                                        <button class="btn-gris" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="img/iconos/export.svg" alt="icono" class="mr-2"> Exportar Datos <i class="iconoir-nav-arrow-down"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                            <button class="dropdown-item export_excel" data-table="#AscensoresTipo">Excel</button>
                                            <button class="dropdown-item export_pdf" data-table="#AscensoresTipo">PDF</button>
                                            <button class="dropdown-item export_copy" data-table="#AscensoresTipo">Copiar</button>
                                            <button class="dropdown-item export_print" data-table="#AscensoresTipo">Imprimir</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table id="AscensoresTipo" class="table" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>FOTO</th>
                                            <th>ID</th>
                                            <th>TIPO DE ASCENSOR</th>
                                            <th>NOMBRE</th>
                                            <th>CLIENTE</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <img src="img/ascensoresTipo.png" alt="tipo repuesto" width="52" height="52" class="img-table">
                                            </td>
                                            <td>1001</td>
                                            <td>PLATAFORMA DE DISCAPACITADOS</td>
                                            <td>
                                                <a href="detalle-ascensores-old.php" class="text-blue">EDIFICIO MULTIFAMILIAR CHAMA</a>
                                            </td>
                                            <td>GUIDO BERGER SUAREZ</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/ascensoresTipo.png" alt="tipo repuesto" width="52" height="52" class="img-table">
                                            </td>
                                            <td>1001</td>
                                            <td>PLATAFORMA DE DISCAPACITADOS</td>
                                            <td>
                                                <a href="detalle-ascensores-old.php" class="text-blue">EDIFICIO MULTIFAMILIAR CHAMA</a>
                                            </td>
                                            <td>GUIDO BERGER SUAREZ</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/ascensoresTipo.png" alt="tipo repuesto" width="52" height="52" class="img-table">
                                            </td>
                                            <td>1001</td>
                                            <td>PLATAFORMA DE DISCAPACITADOS</td>
                                            <td>
                                                <a href="detalle-ascensores-old.php" class="text-blue">EDIFICIO MULTIFAMILIAR CHAMA</a>
                                            </td>
                                            <td>GUIDO BERGER SUAREZ</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/ascensoresTipo.png" alt="tipo repuesto" width="52" height="52" class="img-table">
                                            </td>
                                            <td>1001</td>
                                            <td>PLATAFORMA DE DISCAPACITADOS</td>
                                            <td>
                                                <a href="detalle-ascensores-old.php" class="text-blue">EDIFICIO MULTIFAMILIAR CHAMA</a>
                                            </td>
                                            <td>GUIDO BERGER SUAREZ</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/ascensoresTipo.png" alt="tipo repuesto" width="52" height="52" class="img-table">
                                            </td>
                                            <td>1001</td>
                                            <td>PLATAFORMA DE DISCAPACITADOS</td>
                                            <td>
                                                <a href="detalle-ascensores-old.php" class="text-blue">EDIFICIO MULTIFAMILIAR CHAMA</a>
                                            </td>
                                            <td>GUIDO BERGER SUAREZ</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/ascensoresTipo.png" alt="tipo repuesto" width="52" height="52" class="img-table">
                                            </td>
                                            <td>1001</td>
                                            <td>PLATAFORMA DE DISCAPACITADOS</td>
                                            <td>
                                                <a href="detalle-ascensores-old.php" class="text-blue">EDIFICIO MULTIFAMILIAR CHAMA</a>
                                            </td>
                                            <td>GUIDO BERGER SUAREZ</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/ascensoresTipo.png" alt="tipo repuesto" width="52" height="52" class="img-table">
                                            </td>
                                            <td>1001</td>
                                            <td>PLATAFORMA DE DISCAPACITADOS</td>
                                            <td>
                                                <a href="detalle-ascensores-old.php" class="text-blue">EDIFICIO MULTIFAMILIAR CHAMA</a>
                                            </td>
                                            <td>GUIDO BERGER SUAREZ</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/ascensoresTipo.png" alt="tipo repuesto" width="52" height="52" class="img-table">
                                            </td>
                                            <td>1001</td>
                                            <td>PLATAFORMA DE DISCAPACITADOS</td>
                                            <td>
                                                <a href="detalle-ascensores-old.php" class="text-blue">EDIFICIO MULTIFAMILIAR CHAMA</a>
                                            </td>
                                            <td>GUIDO BERGER SUAREZ</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/ascensoresTipo.png" alt="tipo repuesto" width="52" height="52" class="img-table">
                                            </td>
                                            <td>1001</td>
                                            <td>PLATAFORMA DE DISCAPACITADOS</td>
                                            <td>
                                                <a href="detalle-ascensores-old.php" class="text-blue">EDIFICIO MULTIFAMILIAR CHAMA</a>
                                            </td>
                                            <td>GUIDO BERGER SUAREZ</td>
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
