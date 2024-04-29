@extends('layouts.main')
@section('content')
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
                                        <img src="img/iconos/export.svg" alt="icono" class="mr-2"> Exportar Datos <i
                                            class="iconoir-nav-arrow-down"></i>
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
                                <table id="ascensores" class="table" style="width:100%">
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
                                            <tr>
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
                                                            <a class="dropdown-item"
                                                                href="{{ route('edit.elevator', $elevator->id) }}"
                                                                data-toggle="modal" data-target="#editarAscensor">Editar</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('destroy.elevator', $elevator->id) }}"
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
                                            enctype="multipart/form-data" method="POST">
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
                                                                        class="form-control @error('contrato') is-invalid @enderror">
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
                                                                        class="form-control @error('nombre') is-invalid @enderror">
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
                                                                    <input type="text" placeholder="Código"
                                                                        name="código" id="código"
                                                                        class="form-control @error('código') is-invalid @enderror">
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
                                                                    <input type="text" placeholder="Marca"
                                                                        name="marca" id="marca"
                                                                        class="form-control @error('marca') is-invalid @enderror">
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
                                                                        <option selected class="d-none">Seleccionar opción
                                                                        </option>
                                                                        @foreach ($customers as $key => $value)
                                                                            <option value="{{ $key }}">
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
                                                                        name="fecha" id="fecha">
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
                                                                        name="garantizar" id="garantizar">
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
                                                                        name="dirección" id="dirección">
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
                                                                        name="ubigeo" id="ubigeo">
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
                                                                        <option selected class="d-none">Seleccionar opción
                                                                        </option>
                                                                        @foreach ($provinces as $province)
                                                                            <option value="{{ $province }}">
                                                                                {{ $province }}</option>
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
                                                                    <select
                                                                        class="custom-select form-control @error('técnico_instalador') is-invalid @enderror"
                                                                        name="técnico_instalador" id="técnico_instalador">
                                                                        <option selected class="d-none">Seleccionar opción
                                                                        </option>
                                                                        <option value="tecnico_1">Tecnico 1</option>
                                                                        <option value="tecnico_2">Tecnico 2</option>
                                                                        <option value="tecnico_3">Tecnico 3</option>
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
                                                                        <option selected class="d-none">Seleccionar opción
                                                                        </option>
                                                                        <option value="tecnico_1">Tecnico 1</option>
                                                                        <option value="tecnico_2">Tecnico 2</option>
                                                                        <option value="tecnico_3">Tecnico 3</option>
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
                                                                        <option selected class="d-none">Seleccionar opción
                                                                        </option>
                                                                        <option value="tipo_1">Tipo 1</option>
                                                                        <option value="tipo_2">Tipo 2</option>
                                                                        <option value="tipo_3">Tipo 3</option>
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
                                                                        <option selected class="d-none">Seleccionar
                                                                        </option>
                                                                        <option value="cantidad_1">Cantidad 1</option>
                                                                        <option value="cantidad_2">Cantidad 2</option>
                                                                        <option value="cantidad_3">Cantidad 3</option>
                                                                    </select>
                                                                    @error('tipo_de_ascensor')
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
                                                                            class="custom-control-input" id="mgratuito"
                                                                            name="mgratuito">
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
                                                                            class="custom-control-input" id="sincuarto"
                                                                            name="sincuarto">
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
                                                                            class="custom-control-input" id="concuarto"
                                                                            name="concuarto">
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
                                                                        id="npisos"
                                                                        class="form-control @error('npisos') is-invalid @enderror">
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
                                                                    <input type="text"
                                                                        placeholder="Nombre del contacto" name="ncontacto"
                                                                        id="ncontacto"
                                                                        class="form-control @error('ncontacto') is-invalid @enderror">
                                                                    @error('npisos')
                                                                        <span class="invalid-feedback" style="color: red">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="telefono">Teléfono</label>
                                                                    <input type="text" placeholder="Teléfono"
                                                                        class="form-control @error('teléfono') is-invalid @enderror"
                                                                        name="teléfono" id="teléfono">
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
                                                                        name="correo" id="correo">
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
                                                                        class="form-control @error('descripcion1') is-invalid @enderror"></textarea>
                                                                    @error('descripcion1')
                                                                        <span class="invalid-feedback" style="color: red">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
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
                                            <h5 class="modal-title font-family-Outfit-SemiBold">Editar Ascensor</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('update.elevator', $elevator->id) }}"
                                            class="formulario-modal" enctype="multipart/form-data" method="POST">
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
                                                                        class="text-gris mt-4">Seleccione una
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
                                                                    <label for="contrato"># de contrato</label>
                                                                    <input type="text" placeholder="# de contrato"
                                                                        name="contrato" id="contrato"
                                                                        class="form-control @error('contrato') is-invalid @enderror"
                                                                        value="{{ old('contrato', $elevator->contrato ?? '') }}">
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
                                                                        value="{{ old('nombre', $elevator->nombre ?? '') }}">
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
                                                                    <input type="text" placeholder="Código"
                                                                        name="código" id="código"
                                                                        class="form-control @error('código') is-invalid @enderror"
                                                                        value="{{ old('código', $elevator->código ?? '') }}">
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
                                                                    <input type="text" placeholder="Marca"
                                                                        name="marca" id="marca"
                                                                        class="form-control @error('marca') is-invalid @enderror"
                                                                        value="{{ old('marca', $elevator->marca ?? '') }}">
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
                                                                                {{ old('cliente', $elevator->cliente ?? '') == $key ? 'selected' : '' }}>
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
                                                                        value="{{ old('fecha', isset($elevator) ? $elevator->fecha : '') }}">
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
                                                                        value="{{ old('garantizar', $elevator->garantizar ?? '') }}">
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
                                                                        value="{{ old('dirección', $elevator->dirección ?? '') }}">
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
                                                                        value="{{ old('ubigeo', $elevator->ubigeo ?? '') }}">
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
                                                                        <option selected class="d-none">Seleccionar opción
                                                                        </option>
                                                                        @foreach ($provinces as $province)
                                                                            <option value="{{ $province }}"
                                                                                @if (isset($elevator) && $elevator->provincia == $province) selected @endif>
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
                                                                    <select
                                                                        class="custom-select form-control @error('técnico_instalador') is-invalid @enderror"
                                                                        name="técnico_instalador" id="técnico_instalador">
                                                                        <option selected disabled>Seleccionar opción
                                                                        </option>
                                                                        <option value="tecnico_1"
                                                                            {{ old('técnico_instalador', $elevator->técnico_instalador ?? '') == 'tecnico_1' ? 'selected' : '' }}>
                                                                            Técnico 1</option>
                                                                        <option value="tecnico_2"
                                                                            {{ old('técnico_instalador', $elevator->técnico_instalador ?? '') == 'tecnico_2' ? 'selected' : '' }}>
                                                                            Técnico 2</option>
                                                                        <option value="tecnico_3"
                                                                            {{ old('técnico_instalador', $elevator->técnico_instalador ?? '') == 'tecnico_3' ? 'selected' : '' }}>
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
                                                                            {{ old('técnico_ajustador', $elevator->técnico_ajustador ?? '') == 'tecnico_1' ? 'selected' : '' }}>
                                                                            Técnico 1</option>
                                                                        <option value="tecnico_2"
                                                                            {{ old('técnico_ajustador', $elevator->técnico_ajustador ?? '') == 'tecnico_2' ? 'selected' : '' }}>
                                                                            Técnico 2</option>
                                                                        <option value="tecnico_3"
                                                                            {{ old('técnico_ajustador', $elevator->técnico_ajustador ?? '') == 'tecnico_3' ? 'selected' : '' }}>
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
                                                                            {{ old('tipo_de_ascensor', $elevator->tipo_de_ascensor ?? '') == 'tipo_1' ? 'selected' : '' }}>
                                                                            Tipo 1</option>
                                                                        <option value="tipo_2"
                                                                            {{ old('tipo_de_ascensor', $elevator->tipo_de_ascensor ?? '') == 'tipo_2' ? 'selected' : '' }}>
                                                                            Tipo 2</option>
                                                                        <option value="tipo_3"
                                                                            {{ old('tipo_de_ascensor', $elevator->tipo_de_ascensor ?? '') == 'tipo_3' ? 'selected' : '' }}>
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
                                                                            {{ old('cantidad', $elevator->cantidad ?? '') == 'cantidad_1' ? 'selected' : '' }}>
                                                                            Cantidad 1</option>
                                                                        <option value="cantidad_2"
                                                                            {{ old('cantidad', $elevator->cantidad ?? '') == 'cantidad_2' ? 'selected' : '' }}>
                                                                            Cantidad 2</option>
                                                                        <option value="cantidad_3"
                                                                            {{ old('cantidad', $elevator->cantidad ?? '') == 'cantidad_3' ? 'selected' : '' }}>
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
                                                                        <input type="checkbox"
                                                                            class="custom-control-input" id="mgratuito"
                                                                            name="mgratuito"
                                                                            {{ isset($elevator) && $elevator->mgratuito ? 'checked' : '' }}>
                                                                        <label class="custom-control-label"
                                                                            for="MGratuito">Mantenimiento gratuito?</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="adornoinput mb-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input" id="sincuarto"
                                                                            name="sincuarto"
                                                                            {{ isset($elevator) && $elevator->sincuarto ? 'checked' : '' }}>
                                                                        <label class="custom-control-label"
                                                                            for="SinCuarto">Sin cuarto de maquina?</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="adornoinput mb-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input" id="concuarto"
                                                                            name="concuarto"
                                                                            {{ isset($elevator) && $elevator->concuarto ? 'checked' : '' }}>
                                                                        <label class="custom-control-label"
                                                                            for="ConCuarto">Con cuarto de maquina?</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="Npisos"># de pisos</label>
                                                                    <input type="text" placeholder="#" name="npisos"
                                                                        id="npisos"
                                                                        class="form-control @error('npisos') is-invalid @enderror"
                                                                        value="{{ old('npisos', isset($elevator) ? $elevator->npisos : '') }}">
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
                                                                    <input type="number"
                                                                        placeholder="Nombre del contacto" name="ncontacto"
                                                                        id="ncontacto"
                                                                        class="form-control @error('ncontacto') is-invalid @enderror"
                                                                        value="{{ old('ncontacto', isset($elevator) ? $elevator->ncontacto : '') }}">
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
                                                                        value="{{ old('teléfono', isset($elevator) ? $elevator->teléfono : '') }}">
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
                                                                        value="{{ old('correo', isset($elevator) ? $elevator->correo : '') }}">
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
                                                                        class="form-control">{{ old('descripcion1', isset($elevator) ? $elevator->descripcion1 : '') }}</textarea>

                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 d-none position-relative"
                                                                id="DAdicional">
                                                                <div class="form-group">
                                                                    <label for="Descripcion2">Descripción 2</label>
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
                                            <form id="delete-form"
                                                action="{{ route('destroy.elevator', $elevator->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-gris btn-red">Sí</button>
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
        });
    </script>
@endpush
