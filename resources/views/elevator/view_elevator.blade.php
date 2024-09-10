@extends('layouts.main')
<!-- Select2 CSS -->
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@section('content')
    <style>
        .dt-head-center {
            text-align: center;
        }

        .brandbtn {
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

        #edit-elevators {
            background-color: white !important;
        }
    </style>
    <div class="w-100 contenido">
        <div class="container-fluid container-mod">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="titulo">
                        <h4>Ascensores</h4>
                        <span>Ascensores</span>
                    </div>
                </div>
                <div class="col-md-6 mb-4 text-right">
                    <button type="button" class="btn-primario w-auto pl-3 pr-3" data-toggle="modal"
                        data-target="#crearAscensor">
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
                                    <button class="btn-gris" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <img src="{{ asset('img/iconos/export.svg') }}" alt="icono" class="mr-2">
                                        Exportar Datos <i class="iconoir-nav-arrow-down"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <button class="dropdown-item" id="export_excel">Excel</button>
                                        <button class="dropdown-item" id="export_pdf">PDF</button>
                                        <button class="dropdown-item" id="export_copy">Copiar</button>
                                        <button class="dropdown-item" id="export_print">Imprimir</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 tbl table-responsive">
                                <table id="ascensores" class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>FECHA ENTREGA</th>
                                            <th>TIPO DE ASCENSOR</th>
                                            <th>NOMBRE</th>
                                            <th>CLIENTE</th>
                                            <th>PROVINCIA</th>
                                            <th align="right" class="text-right">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                            <!-- Modal Crear Ascensor-->
                            <div class="modal left fade" id="crearAscensor" tabindex="-1" role="dialog"
                                aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-family-Outfit-SemiBold">Crear Ascensor</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('insert.elevator') }}" class="formulario-modal"
                                            enctype="multipart/form-data" method="POST" id="createelevatform">
                                            @csrf
                                            <div class="modal-body body_modal">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label>Foto de Ascensor</label>
                                                                <div id="imagePreview"></div>
                                                            </div>
                                                            <div
                                                                class="align-items-start col-md-6 d-flex flex-column justify-content-between mb-3">
                                                                <div class="">
                                                                    <label for="imageUpload"
                                                                        class="text-gris mt-4">Seleccione una
                                                                        imagen</label>
                                                                    <input type="file" id="imageUpload" name="imagen"
                                                                        style="display: none;" accept="image/*" />
                                                                    <button type="button" id="uploadButton"
                                                                        class="btn-gris">
                                                                        <i class="fas fa-arrow-to-top mr-2"></i>Subir
                                                                        Imagen
                                                                    </button>
                                                                </div>
                                                                <div class="form-group mb-0">
                                                                    <label for="contrato"># de contrato</label>
                                                                    <input type="text" placeholder="# de contrato"
                                                                        name="contrato" id="contrato" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="nombre">Nombre ascensor</label>
                                                                    <input type="text" placeholder="Nombre ascensor"
                                                                        name="nombre" id="nombre"
                                                                        class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="código">Código</label>
                                                                    <input type="text" placeholder="Código"
                                                                        name="código" id="código"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="marca">Marca</label>
                                                                    <select class="custom-select form-control"
                                                                        name="marca_id" id="marca_id">
                                                                        <option value="">Seleccionar
                                                                            opción
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="text-right w-100">
                                                                <div class="form-group">
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#crearMarcas"
                                                                        class="btn-gris brandbtn" id="toggleMarcaInput">
                                                                        + Agregar marca
                                                                    </button>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="clienteAscensor">Cliente del
                                                                        ascensor</label>
                                                                    <select class="custom-select form-control"
                                                                        name="client_id" id="client_id">
                                                                        <option value="" class="d-none">Seleccionar
                                                                            opción</option>
                                                                        @foreach ($allCustomers as $customer)
                                                                            <option value="{{ $customer->id }}">
                                                                                {{ $customer->nombre }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="fechaEntrega">Fecha de entrega</label>
                                                                    <input type="date" placeholder="dd/mm/aaaa"
                                                                        class="form-control" name="fecha"
                                                                        id="fecha">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="garantia">Garantía</label>
                                                                    <input type="text" placeholder="Garantizar"
                                                                        class="form-control" name="garantizar"
                                                                        id="garantizar">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="dirección">Dirección</label>
                                                                    <input type="text" placeholder="Dirección"
                                                                        class="form-control" name="dirección"
                                                                        id="dirección">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ubigeo">Ubigeo</label>
                                                                    <input type="text" placeholder="Ubigeo"
                                                                        class="form-control" name="ubigeo"
                                                                        id="ubigeo">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="provincia">Provincia</label>
                                                                    <select class="custom-select form-control"
                                                                        name="provincia" id="provincia">
                                                                        <option value="" class="d-none">Seleccionar
                                                                            opción
                                                                        </option>
                                                                        @foreach ($provinces as $id => $province)
                                                                            <option value="{{ $id }}">
                                                                                {{ $province }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="tecnicoInstalador">Técnico
                                                                        instalador</label>
                                                                    <select class="custom-select form-control"
                                                                        name="técnico_instalador" id="técnico_instalador">
                                                                        <option value="" class="d-none">Seleccionar
                                                                            opción
                                                                        </option>
                                                                        @foreach ($staffs as $id => $staff)
                                                                            <option value="{{ $id }}">
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
                                                                        name="técnico_ajustador" id="técnico_ajustador">
                                                                        <option value="" class="d-none">Seleccionar
                                                                            opción
                                                                        </option>
                                                                        @foreach ($staffs as $id => $staff)
                                                                            <option value="{{ $id }}">
                                                                                {{ $staff }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="tipo_de_ascensor">Tipo de ascensor</label>
                                                                    <select class="custom-select form-control"
                                                                        name="tipo_de_ascensor" id="tipo_de_ascensor">
                                                                        <option value="" class="d-none">Seleccionar
                                                                            opción
                                                                        </option>
                                                                        @foreach ($elevatortypes as $id => $elevatortype)
                                                                            <option value="{{ $id }}">
                                                                                {{ $elevatortype }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="tiposAscensor">Cantidad</label>
                                                                    <input type="number" placeholder="Cantidad"
                                                                        class="form-control" name="cantidad"
                                                                        id="cantidad">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12"></div>
                                                            <div class="col-md-6">
                                                                <div class="adornoinput mb-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input" id="MGratuito"
                                                                            name="quarters[]" value="mgratuito">
                                                                        <label class="custom-control-label"
                                                                            for="MGratuito">Mantenimiento
                                                                            gratuito?</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="adornoinput mb-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input" id="SinCuarto"
                                                                            name="quarters[]" value="sincuarto">
                                                                        <label class="custom-control-label"
                                                                            for="SinCuarto">Sin cuarto de
                                                                            maquina?</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="adornoinput mb-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input" id="ConCuarto"
                                                                            name="quarters[]" value="concuarto">
                                                                        <label class="custom-control-label"
                                                                            for="ConCuarto">Con cuarto de
                                                                            maquina?</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="Npisos"># de pisos</label>
                                                                    <input type="number" placeholder="#" name="npisos"
                                                                        id="npisos" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="Ncontacto">Nombre del Contacto</label>
                                                                    <input type="text"
                                                                        placeholder="Nombre del contacto" name="ncontacto"
                                                                        id="ncontacto" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="telefono">Teléfono</label>
                                                                    <input type="text" placeholder="Teléfono"
                                                                        class="form-control" name="teléfono"
                                                                        id="teléfono">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="correo">Correo electrónico</label>
                                                                    <input type="text" placeholder="Correo electrónico"
                                                                        class="form-control" name="correo"
                                                                        id="correo">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="Descripcion1">Descripción 1</label>
                                                                    <textarea name="descripcion1" id="descripcion1" placeholder="Descripción" cols="30" rows="5"
                                                                        class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 d-none position-relative"
                                                                id="DAdicional2">
                                                                <div class="form-group">
                                                                    <label for="Descripcion2">Descripción 2</label>
                                                                    <textarea name="descripcion2" id="descripcion2" placeholder="Descripción" cols="30" rows="5"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <button type="button" class="btn-gris"
                                                                    id="AgregarDescripcion2">+ Agregar
                                                                    Descripción</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                                                <button type="submit" class="btn-gris btn-red mr-2">Guardar
                                                    Cambios</button>
                                                <button type="button" class="btn-gris btn-border"
                                                    data-dismiss="modal">Cancelar</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <!-- Modal actualizar Ascensor-->
                            <div class="modal left fade" id="editarAscensor" tabindex="-1" role="dialog"
                                aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-family-Outfit-SemiBold">Editar
                                                Ascensor</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="" class="formulario-modal" enctype="multipart/form-data"
                                            method="POST" id="editelevatform">
                                            @csrf
                                            <div class="modal-body body_modal">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label>Foto de Ascensor</label>
                                                                <div id="editimagePreview">
                                                                    <img src="" alt="Image" width="200px"
                                                                        height="200px" id="edit-elevators">
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="align-items-start col-md-6 d-flex flex-column justify-content-between mb-3">
                                                                <div class="">
                                                                    <label for="imageUpload"
                                                                        class="text-gris mt-4">Seleccione
                                                                        una
                                                                        imagen</label>
                                                                    <input type="file" id="editimageUpload"
                                                                        name="imagen" style="display: none;"
                                                                        accept="image/*" />
                                                                    <button type="button" id="edituploadButton"
                                                                        class="btn-gris">
                                                                        <i class="fas fa-arrow-to-top mr-2"></i>Subir
                                                                        Imagen
                                                                    </button>
                                                                </div>
                                                                <div class="form-group mb-0">
                                                                    <label for="contrato"># de
                                                                        contrato</label>
                                                                    <input type="text" placeholder="# de contrato"
                                                                        name="contrato" id="edit-contrato"
                                                                        class="form-control" value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="nombre">Nombre
                                                                        ascensor</label>
                                                                    <input type="text" placeholder="Nombre ascensor"
                                                                        name="nombre" id="edit-nombre"
                                                                        class="form-control" value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="código">Código</label>
                                                                    <input type="text" placeholder="Código"
                                                                        name="código" id="edit-código"
                                                                        class="form-control" value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="marca">Marca</label>
                                                                    <select class="custom-select form-control marcaItems"
                                                                        name="marca_id" id="marca_id1">
                                                                        <option value="" class="d-none">Seleccionar
                                                                            opción
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="text-right w-100">
                                                                <div class="form-group">
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#crearMarcas"
                                                                        class="btn-gris brandbtn" id="toggleMarcaInput">
                                                                        + Agregar marca
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="clienteAscensor">Cliente
                                                                        del
                                                                        ascensor</label>
                                                                    <select name="client_id"
                                                                        class="ustom-select form-control"
                                                                        id="edit-cliente">
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="fechaEntrega">Fecha de
                                                                        entrega</label>
                                                                    <input type="date" placeholder="dd/mm/aaaa"
                                                                        class="form-control" name="fecha"
                                                                        id="edit-fecha" value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="garantia">Garantía</label>
                                                                    <input type="text" placeholder="Garantizar"
                                                                        class="form-control" name="garantizar"
                                                                        id="edit-garantizar" value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="dirección">Dirección</label>
                                                                    <input type="text" placeholder="Dirección"
                                                                        class="form-control" name="dirección"
                                                                        id="edit-dirección" value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ubigeo">Ubigeo</label>
                                                                    <input type="text" placeholder="Ubigeo"
                                                                        class="form-control" name="ubigeo"
                                                                        id="edit-ubigeo" value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="provincia">Provincia</label>
                                                                    <select class="custom-select form-control"
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
                                                                        name="técnico_instalador"
                                                                        id="edit-técnico_instalador">
                                                                        <option value="">Seleccionar
                                                                            opción</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="técnico_ajustador">Técnico
                                                                        ajustador</label>
                                                                    <select class="custom-select form-control"
                                                                        name="técnico_ajustador"
                                                                        id="edit-técnico_ajustador">
                                                                        <option value="">Seleccionar
                                                                            opción</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="tipo_de_ascensor">Tipo de
                                                                        ascensor</label>
                                                                    <select class="custom-select form-control"
                                                                        name="tipo_de_ascensor"
                                                                        id="edit-tipo_de_ascensor">
                                                                        <option value="">Seleccionar
                                                                            opción</option>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="tiposAscensor">Cantidad</label>
                                                                    <input type="number" placeholder="Cantidad"
                                                                        class="form-control" name="cantidad"
                                                                        id="edit-cantidad" value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12"></div>
                                                            <div class="col-md-6">
                                                                <div class="adornoinput mb-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input" id="mgratuito"
                                                                            name="quarters[]" value="mgratuito">
                                                                        <label class="custom-control-label"
                                                                            for="mgratuito">Mantenimiento
                                                                            gratuito?</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="adornoinput mb-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input" id="sincuarto"
                                                                            name="quarters[]" value="sincuarto">
                                                                        <label class="custom-control-label"
                                                                            for="sincuarto">Sin cuarto de
                                                                            maquina?</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="adornoinput mb-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input" id="concuarto"
                                                                            name="quarters[]" value="concuarto">
                                                                        <label class="custom-control-label"
                                                                            for="concuarto">Con cuarto de
                                                                            maquina?</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="Npisos"># de
                                                                        pisos</label>
                                                                    <input type="text" placeholder="#" name="npisos"
                                                                        id="edit-npisos" class="form-control"
                                                                        value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="Ncontacto">Nombre del
                                                                        Contacto</label>
                                                                    <input type="text"
                                                                        placeholder="Nombre del contacto" name="ncontacto"
                                                                        id="edit-ncontacto" class="form-control"
                                                                        value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="telefono">Teléfono</label>
                                                                    <input type="number" placeholder="Teléfono"
                                                                        class="form-control" name="teléfono"
                                                                        id="edit-teléfono" value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="correo">Correo
                                                                        electrónico</label>
                                                                    <input type="text" placeholder="Correo electrónico"
                                                                        class="form-control" name="correo"
                                                                        id="edit-correo" value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="Descripcion1">Descripción
                                                                        1</label>
                                                                    <textarea name="descripcion1" id="edit-descripcion1" placeholder="Descripción" cols="30" rows="5"
                                                                        class="form-control"></textarea>

                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 d-none position-relative"
                                                                id="DAdicional1">
                                                                <div class="form-group">
                                                                    <label for="Descripcion2">Descripción
                                                                        2</label>
                                                                    <textarea name="descripcion2" id="edit-descripcion2" placeholder="Descripción" cols="30" rows="5"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <button type="button" class="btn-gris"
                                                                    id="AgregarDescripcion1">+ Agregar
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
                                    </div>
                                </div>
                            </div>

                            {{-- Model Crear Marcas --}}
                            <div class="modal left fade" id="crearMarcas" tabindex="-1" role="dialog"
                                aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-family-Outfit-SemiBold">Crear Marcas</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="col-md-12" id="marcaInputSection" style="">
                                            <form method="POST" id="brandForm">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Ingresar marca</label>
                                                    <input type="text" placeholder="Ingresar marca"
                                                        name="marca_nombre" id="marca_nombre" class="form-control">
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
                            <!-- Modal Eliminar-->
                            <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog"
                                aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content border-radius-12">
                                        <div class="modal-body">
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
                                        </div>
                                        <div class="modal-footer align-items-center justify-content-center">
                                            <form id="delete-form" action="" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-gris btn-red"
                                                    onclick="this.disabled=true;this.form.submit();">Sí</button>
                                            </form>
                                            <button type="button" class="btn-gris btn-border"
                                                data-dismiss="modal">No</button>
                                        </div>
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
@push('scripts')
    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#AgregarDescripcion1').click(function() {
                $('#DAdicional1').removeClass('d-none');
            });
            $('#AgregarDescripcion2').click(function() {
                $('#DAdicional2').removeClass('d-none');
            });
            $('#brandForm').on('keypress', function(e) {
                if (e.which === 13) { // 13 is the Enter key code
                    e.preventDefault();
                    return false;
                }
            });

            function getBrand(edit) {
                // Destroy existing Select2 instances if they exist
                if ($('#marca_id').data('select2')) {
                    $('#marca_id').select2('destroy');
                }
                if ($('#marca_id1').data('select2')) {
                    $('marca_id1').select2('destroy');
                }

                // Perform the AJAX call to get brand data
                $.ajax({
                    type: "GET",
                    url: "{{ route('getBrands') }}",
                    dataType: "JSON",
                    success: function(response) {
                        // Clear the current options and append the retrieved options to the select elements
                        $("#marca_id, #marca_id1").empty();
                        $("#marca_id, #marca_id1").append(
                            '<option value="" class="d-none">Seleccionar opción</option>'
                        ); // Add placeholder option

                        $.each(response, function() {
                            $("#marca_id, #marca_id1").append(
                                `<option value='${this.id}'>${this['marca_nombre']}</option>`
                            );
                        });

                        // Initialize Select2 on the select elements with placeholder
                        $('#marca_id1').select2({
                            placeholder: "Seleccionar marca",
                            allowClear: true
                        });
                        $('#marca_id').select2({
                            placeholder: "Seleccionar marca",
                            allowClear: true
                        });

                        // If edit is true and has a valid ID, set the selected value
                        if (edit) {
                            $('#marca_id1').val(edit).trigger('change');
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
                            $('#edit-tipo_de_ascensor').val(edit.tipo_de_ascensor).trigger(
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
            var table = $('#ascensores').DataTable({
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
                            doc.content[1].table.widths = Array(doc.content[1].table.body[0]
                                .length + 1).join('*').split('');
                            var columnCount = doc.content[1].table.body[0].length;
                            doc.content[1].table.body.forEach(function(row) {
                                row[0].alignment =
                                    'center'; // Center align the first column
                                row[columnCount - 1].alignment =
                                    'center'; // Center align the last column
                                row[2].alignment =
                                    'center'; // Center align the third column
                                row[3].alignment =
                                    'center'; // Center align the fourth column
                                row[4].alignment =
                                    'center'; // Center align the fifth column
                            });
                            doc.pageSize = 'A4'; // Set page size to A4
                            doc.defaultStyle.fontSize = 6; // Set default font size
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

            function fetchData() {
                $.ajax({
                    url: "/api/ascensore", // Ensure this route is correct
                    method: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log("Fetched Data:", data.elevators); // Log the fetched data

                        // Check if the expected property exists
                        if (data.elevators && Array.isArray(data.elevators)) {
                            table.clear(); // Clear existing data
                            var baseUrl = "{{ url('/') }}"; // Define base URL

                            // Populate the DataTable with new data
                            $.each(data.elevators, function(index, elevator) {
                                table.row.add([
                                    elevator.id || '', // Column 0
                                    elevator.fecha || '', // Column 1
                                    elevator.tipo_de_ascensor ? elevator
                                    .tipo_de_ascensor.nombre_de_tipo_de_ascensor : '',
                                    `<a href="${baseUrl}/ascensore/vista/${elevator.id}" class="text-blue">${elevator.nombre}</a>`, // Updated to show elevator name as a link
                                    elevator.client ?
                                    `<a href="${baseUrl}/clientes/vista/${elevator.client_id}" class="text-blue">${elevator.client.nombre}</a>` :
                                    '-',
                                    elevator.province ? elevator.province.provincia :
                                    '', // Column 5
                                    // ... existing code ...
                                    `<td align="right">
                                        <div class="dropdown">
                                            <button type="button" class="btn-action dropdown-toggle" data-toggle="dropdown">
                                                Acción <i class="fas fa-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ route('view.elevator', '') }}/${elevator.id}">Ver detalles</a>
                                                <a class="dropdown-item edit-elevator" href="#" data-elevator='${JSON.stringify(elevator)}' data-toggle="modal" data-target="#editarAscensor">Editar</a>
   <a class="dropdown-item delete-elevator" href="#" data-id="${elevator.id}" data-toggle="modal" data-target="#modalEliminar">Eliminar</a>                                        </div>
                                    </td>` // Column 6 with dropdown actions
                                ]);
                            });
                            table.draw(); // Draw the updated table
                        } else {
                            console.error("No elevators found in the response.");
                            alert("No data available.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching data: ", error);
                        alert("Failed to fetch data. Please check the console for more details.");
                    }
                });
            }

            fetchData(); // Ensure this is called after DataTable initialization

            // Mover el contenedor de búsqueda (filtro) a la izquierda
            $("#miTabla_filter").css('float', 'left');

            // Manejadores para los botones de exportación personalizados
            $("#export_excel").on("click", function() {
                table.button('.buttons-csv').trigger();
            });
            $("#export_pdf").on("click", function() {
                table.button('.buttons-pdf').trigger();
            });
            $("#export_copy").on("click", function() {
                table.button('.buttons-copy').trigger();
            });
            $("#export_print").on("click", function() {
                table.button('.buttons-print').trigger();
            });
            $('#customSearchBox').keyup(function() {
                table.search($(this).val()).draw();
            });
            setTimeout(function() {
                $(".alert-success").fadeOut(1000);
            }, 1000);
            setTimeout(function() {
                $(".alert-danger").fadeOut(1000);
            }, 1000);

            $('#uploadButton').click(function() {
                $('#imageUpload').click();
            });

            $('#imageUpload').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').show();
                }
                reader.readAsDataURL(this.files[0]);
            });

            $('#edituploadButton').click(function() {
                $('#editimageUpload').click();
            });

            $('#editimageUpload').change(function() {

                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#editimagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#editimagePreview').show();
                }
                reader.readAsDataURL(this.files[0]);
            });

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

            // Custom alphanumeric validation method
            $.validator.addMethod("alphanumeric", function(value, element) {
                return this.optional(element) || /^[a-zA-Z0-9\s]+$/.test(value);
            }, "Por favor, ingrese solo letras, números y espacios.");

            // Initialize validation
            function initializeValidation(formId, rules, messages) {
                $(formId).validate({
                    rules: rules,
                    messages: messages,
                    errorElement: "span",
                    errorPlacement: function(error, element) {
                        error.addClass("invalid-feedback");
                        element.closest(".form-group").append(error);
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass("is-invalid").removeClass("is-valid");
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).removeClass("is-invalid").addClass("is-valid");
                    }
                });
            }

            // Define validation rules
            var validationRules = {
                imagen: {
                    extension: "jpg|jpeg|png|gif"
                },
                nombre: {
                    required: true,
                },
                cliente: {
                    required: true,
                },
                dirección: {
                    required: true,
                },
                ncontacto: {
                    required: true,
                },
                teléfono: {
                    digits: true
                },
                cantidad: {
                    digits: true
                },
                correo: {
                    email: true
                },
                descripcion1: {
                    required: true,
                }
            };

            // Define validation messages
            var validationMessages = {
                imagen: {
                    extension: "Por favor, seleccione un archivo de imagen válido (jpg, jpeg, png, gif)."
                },
                nombre: {
                    required: "Por favor, ingrese el nombre del ascensor.",
                },
                cliente: {
                    required: "Por favor, seleccione un cliente.",
                },
                dirección: {
                    required: "Por favor, ingrese la dirección.",
                },
                ncontacto: {
                    required: "Por favor, ingrese el nombre del contacto.",
                },
                teléfono: {
                    digits: "Por favor, ingrese solo dígitos para el número de teléfono."
                },
                cantidad: {
                    digits: "Por favor, ingrese solo dígitos para el número de cantidad."
                },
                correo: {
                    email: "Por favor, ingrese una dirección de correo electrónico válida."
                },
                descripcion1: {
                    required: "Por favor, ingrese una descripción.",
                }
            };

            // Apply validation to both forms
            initializeValidation("#createelevatform", validationRules, validationMessages);
            initializeValidation("#editelevatform", validationRules, validationMessages);

            // ... existing code ...
            $(document).on('click', '.edit-elevator', function() {
                var elevator = $(this).data('elevator');
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
                $('#edit-tipo_de_ascensor').val(elevator.tipo_de_ascensor.id).trigger(
                'change'); // Ensure the value is set and trigger change
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

                // Set the image preview
                var imageUrl = elevator.imagen ? "{{ asset('images/') }}/" + elevator.imagen :
                        "{{ asset('img/fondo.png') }}";
                    $('#edit-elevators').attr('src', imageUrl);

            });

            $(document).on('click', '.delete-elevator', function() {
                var elevatorId = $(this).data('id'); // Get the elevator ID
                $('#modalEliminar').modal('show'); // Show the modal
                $('#delete-form').attr('action', '/ascensore/destruir/' +
                elevatorId); // Set the form action to the DELETE route
            });
            $('#crearAscensor').on('hidden.bs.modal', function() {
                var form = $('#createelevatform');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            });
            $('#editarAscensor').on('hidden.bs.modal', function() {
                var form = $('#editelevatform');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            });
        });
    </script>
@endpush
