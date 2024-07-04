@extends('layouts.main')
@section('content')
    <style>
        .dt-head-center {
            text-align: center;
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
                                        @foreach ($elevators as $index => $elevator)
                                            <tr class="td-head-center">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $elevator->fecha }}</td>
                                                <td>{{ $elevator->tipo_de_ascensor }}</td>
                                                <td>
                                                    <a href="{{ route('view.elevator', $elevator->id) }}" class="text-blue">
                                                        {{ $elevator->nombre }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('view.customer', $elevator->id) }}" class="text-blue">
                                                        {{ $elevator->cliente }}
                                                    </a>
                                                </td>
                                                <td>{{ $elevator->provincia }}</td>
                                                <td align="right">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn-action dropdown-toggle"
                                                            data-toggle="dropdown">
                                                            Acción <i class="fas fa-chevron-down"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                                href="{{ route('view.elevator', $elevator->id) }}">Ver
                                                                detalles</a>
                                                            <a class="dropdown-item edit-elevator" href="#"
                                                                data-elevator="{{ json_encode($elevator) }}"
                                                                data-toggle="modal" data-target="#editarAscensor">Editar</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('destroy.elevator', $elevator->id) }}"
                                                                data-toggle="modal"
                                                                data-target="#modalEliminar{{ $elevator->id }}">Eliminar</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Modal Eliminar-->
                                            <div class="modal fade" id="modalEliminar{{ $elevator->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
                                                        <div class="modal-footer align-items-center justify-content-center">
                                                            @isset($elevator)
                                                                <form id="delete-form"
                                                                    action="{{ route('destroy.elevator', $elevator->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn-gris btn-red">Sí</button>
                                                                </form>
                                                            @endisset
                                                            <button type="button" class="btn-gris btn-border"
                                                                data-dismiss="modal">No</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
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
                                                                        name="contrato" id="contrato"
                                                                        class="form-control">
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
                                                                    <input type="text" placeholder="Marca"
                                                                        name="marca" id="marca"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="clienteAscensor">Cliente del
                                                                        ascensor</label>
                                                                    <select class="custom-select form-control"
                                                                        name="cliente" id="cliente">
                                                                        <option value="" class="d-none">Seleccionar
                                                                            opción</option>
                                                                        @foreach ($customers as $key => $value)
                                                                            <option value="{{ $key }}">
                                                                                {{ $value }}</option>
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
                                                                        @foreach ($provinces as $province)
                                                                            <option value="{{ $province }}">
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
                                                                        @foreach ($staffs as $staff)
                                                                            <option value="{{ $staff }}">
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
                                                                        @foreach ($staffs as $staff)
                                                                            <option value="{{ $staff }}">
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
                                                                        @foreach ($elevatortypes as $elevatortype)
                                                                            <option value="{{ $elevatortype }}">
                                                                                {{ $elevatortype }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="tiposAscensor">Cantidad</label>
                                                                    <select class="custom-select" name="cantidad"
                                                                        id="cantidad">
                                                                        <option value="" class="d-none">Seleccionar
                                                                        </option>
                                                                        <option value="cantidad_1">Cantidad 1</option>
                                                                        <option value="cantidad_2">Cantidad 2</option>
                                                                        <option value="cantidad_3">Cantidad 3</option>
                                                                    </select>
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
                                                                    <input type="text" placeholder="#" name="npisos"
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
                                                                id="DAdicional">
                                                                <div class="form-group">
                                                                    <label for="Descripcion2">Descripción 2</label>
                                                                    <textarea name="descripcion2" id="descripcion2" placeholder="Descripción" cols="30" rows="5"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <button type="button" class="btn-gris"
                                                                    id="AgregarDescripcion">+ Agregar
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
                                        @isset($elevator)
                                            <form action="{{ route('update.elevator', $elevator->id) }}"
                                                class="formulario-modal" enctype="multipart/form-data" method="POST"
                                                id="editelevatform">
                                                @csrf
                                                <div class="modal-body body_modal">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Foto de Ascensor</label>
                                                                    <div id="editimagePreview">
                                                                        @if ($elevator->imagen)
                                                                            <img src="{{ asset('images/' . $elevator->imagen) }}"
                                                                                alt="Existing Image" width="200px"
                                                                                height="200px">
                                                                        @endif
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
                                                                        <input type="text" placeholder="Marca"
                                                                            name="marca" id="edit-marca"
                                                                            class="form-control"
                                                                            value="{{ old('marca', $elevator->marca ?? '') }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="clienteAscensor">Cliente
                                                                            del
                                                                            ascensor</label>
                                                                        <select class="custom-select form-control"
                                                                            name="cliente" id="edit-cliente">
                                                                            <option value="" disabled>
                                                                                Seleccionar opción
                                                                            </option>
                                                                            @foreach ($customers as $key => $value)
                                                                                <option value="{{ $key }}"
                                                                                    {{ old('cliente', $elevator->cliente ?? '') == $key ? 'selected' : '' }}>
                                                                                    {{ $value }}
                                                                                </option>
                                                                            @endforeach
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
                                                                            <option value="">Seleccionar opción</option>
                                                                            @foreach ($provinces as $province)
                                                                                <option value="{{ $province }}"
                                                                                    {{ $elevator->provincia == $province ? 'selected' : '' }}>
                                                                                    {{ $province }}
                                                                                </option>
                                                                            @endforeach
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
                                                                            <option value="">Seleccionar opción</option>
                                                                            @foreach ($staffs as $staff)
                                                                                <option value="{{ $staff }}"
                                                                                    {{ $elevator->técnico_instalador == $staff ? 'selected' : '' }}>
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
                                                                            name="técnico_ajustador"
                                                                            id="edit-técnico_ajustador">
                                                                            <option value="">Seleccionar opción</option>
                                                                            @foreach ($staffs as $staff)
                                                                                <option value="{{ $staff }}"
                                                                                    {{ $elevator->técnico_ajustador == $staff ? 'selected' : '' }}>
                                                                                    {{ $staff }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="tipo_de_ascensor">Tipo de ascensor</label>
                                                                        <select class="custom-select form-control"
                                                                            name="tipo_de_ascensor"
                                                                            id="edit-tipo_de_ascensor">
                                                                            <option value="">Seleccionar opción</option>
                                                                            @foreach ($elevatortypes as $elevatortype)
                                                                                <option value="{{ $elevatortype }}"
                                                                                    {{ $elevator->tipo_de_ascensor == $elevatortype ? 'selected' : '' }}>
                                                                                    {{ $elevatortype }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="tiposAscensor">Cantidad</label>
                                                                        <select class="custom-select" name="cantidad"
                                                                            id="edit-cantidad">
                                                                            <option value="">
                                                                                Seleccionar</option>
                                                                            <option value="cantidad_1"
                                                                                {{ old('cantidad', $elevator->cantidad ?? '') == 'cantidad_1' ? 'selected' : '' }}>
                                                                                Cantidad 1</option>
                                                                            <option value="cantidad_2"
                                                                                {{ old('cantidad', $elevator->cantidad ?? '') == 'cantidad_2' ? 'selected' : '' }}>
                                                                                Cantidad 2</option>
                                                                            <option value="cantidad_3"
                                                                                {{ old('cantidad', $elevator->cantidad ?? '') == 'cantidad_3' ? 'selected' : '' }}>
                                                                                Cantidad 3</option>
                                                                        </select>
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
                                                                                for="mgratuito">Mantenimiento gratuito?</label>
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
                                                                                for="sincuarto">Sin cuarto de maquina?</label>
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
                                                                                for="concuarto">Con cuarto de maquina?</label>
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
                                                                    id="DAdicional">
                                                                    <div class="form-group">
                                                                        <label for="Descripcion2">Descripción
                                                                            2</label>
                                                                        <textarea name="descripcion2" id="descripcion2" placeholder="Descripción" cols="30" rows="5">{{ old('descripcion1', isset($elevator) ? $elevator->descripcion1 : '') }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <button type="button" class="btn-gris"
                                                                        id="AgregarDescripcion">+ Agregar
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

            var table = $('#ascensores').DataTable({
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

            $("#createelevatform").validate({
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
                    marca: "Por favor, ingrese la marca.",
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
                    marca: "Por favor, ingrese la marca.",
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
                $('#edit-marca').val(elevator.marca);
                $('#edit-cliente').val(elevator.cliente);
                $('#edit-fecha').val(elevator.fecha);
                $('#edit-garantizar').val(elevator.garantizar);
                $('#edit-dirección').val(elevator.dirección);
                $('#edit-ubigeo').val(elevator.ubigeo);
                $('#edit-provincia').val(elevator.provincia);
                $('#edit-técnico_instalador').val(elevator.técnico_instalador);
                $('#edit-técnico_ajustador').val(elevator.técnico_ajustador);
                $('#edit-tipo_de_ascensor').val(elevator.tipo_de_ascensor);
                $('#edit-cantidad').val(elevator.cantidad);

                // Check if quarters contain specific values
                var quarters = elevator.quarters.split(',');

                $('#mgratuito').prop('checked', quarters.includes('mgratuito'));
                $('#sincuarto').prop('checked', quarters.includes('sincuarto'));
                $('#concuarto').prop('checked', quarters.includes('concuarto'));

                $('#edit-npisos').val(elevator.npisos);
                $('#edit-ncontacto').val(elevator.ncontacto);
                $('#edit-teléfono').val(elevator.teléfono);
                $('#edit-correo').val(elevator.correo);
                $('#edit-descripcion1').val(elevator.descripcion1);
                $('#edit-descripcion2').val(elevator.descripcion2);
            });

        });
    </script>
@endpush
