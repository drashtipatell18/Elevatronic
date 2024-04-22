@extends('layouts.main')
@section('content')
<div class="w-100 contenido">
    <div class="container-fluid container-mod">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="titulo">
                    <h4>Clientes</h4>
                    <span>Clientes</span>
                </div>
            </div>
            <div class="col-md-6 mb-4 text-right">
                <button type="button" class="btn-primario w-auto pl-3 pr-3" data-toggle="modal" data-target="#crearCliente">
                    + Crear Nuevo
                </button>
            </div>
            <div class="col-md-12">
                <div class="box-contenido">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="buscador">
                                <div class="form-group position-relative">
                                    <label for="customSearchBox"><i class="fal fa-search"></i></label>
                                    <input type="text" id="customSearchBox" placeholder="Buscar" class="w-auto">
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
                                    <button class="dropdown-item" id="export_excel">Excel</button>
                                    <button class="dropdown-item" id="export_pdf">PDF</button>
                                    <button class="dropdown-item" id="export_copy">Copiar</button>
                                    <button class="dropdown-item" id="export_print">Imprimir</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table id="clientes" class="table" style="width:100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>RAZÓN SOCIAL</th>
                                    <th>TIPO DE CLIENTE</th>
                                    <th>RUC O DNI</th>
                                    <th>DIRECCIÓN</th>
                                    <th>PROVINCIA</th>
                                    <th align="right" class="text-right">ACCIONES</th>
                                </tr>
                                </thead>
                                <tbody>
                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection