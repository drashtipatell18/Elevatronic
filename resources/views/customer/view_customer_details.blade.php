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
                    <a class="btn-action dropdownMenuLink d-inline-block" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Acción <i class="fas fa-chevron-down"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item texto-1 font-family-Inter-Regular" href="javascript:void(0)"  data-toggle="modal" data-target="#editarCliente">Editar</a>
                        <a class="dropdown-item texto-1 font-family-Inter-Regular" href="javascript:void(0)" data-toggle="modal" data-target="#modalEliminar">Eliminar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="box-contenido pb-0">
                    <div class="row">
                        <div class="col-md-12 d-flex align-items-start justify-content-start gap-20 mb-6 box-detalle">
                            <div class="">
                                <img src="{{ asset('img/card-user.svg')}}" alt="user">
                            </div>
                            <div class="align-items-start d-flex flex-column h-100 justify-content-between">
                                <div>
                                    <h3>{{ $customers->nombre }}</h3>
                                    <span>Cliente</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-start gap-15 flex-wrap">
                                    <div class="option">
                                        <h4>{{ $customers->id }}</h4>
                                        <p class="mb-0">ID elemento</p>
                                    </div>
                                    <div class="option">
                                        <h4>{{ $customers->tipo_de_cliente }}</h4>
                                        <p class="mb-0">Tipo de cliente</p>
                                    </div>
                                    <div class="option">
                                        <h4>{{ $customers->created_at->format('d M Y, g:i a') }}</h4>
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
                                            <td>{{ $customers->nombre }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-gris">RUC o DNI</td>
                                            <td>{{ $customers->ruc }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-gris">País</td>
                                            <td>{{ $customers->país }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-gris">Provincia</td>
                                            <td>{{ $customers->provincia }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-gris">Dirección</td>
                                            <td>{{ $customers->dirección }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-gris">Teléfono</td>
                                            <td>{{ $customers->teléfono	 }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-gris">Correo electrónico</td>
                                            <td>{{ $customers->correo_electrónico }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-gris">Nombre del contacto</td>
                                            <td>{{ $customers->nombre_del_contacto }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-gris">Posición</td>
                                            <td>{{ $customers->posición }}</td>
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
@endsection
