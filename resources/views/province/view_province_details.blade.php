@extends('layouts.main')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@section('content')
    <div class="w-100 contenido">
        <div class="container-fluid container-mod">
            <div class="row">
                <div class="col-xl-10 col-lg-10 col-md-8 col-sm-8 col-8 mb-4">
                    <div class="titulo">
                        <h4>{{ $province->provincia }}</h4>
                        <span>Provincias >> {{ $province->provincia }}</span>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-end">
                    <div class="dropdown btn-new">
                        <a class="btn-action dropdownMenuLink d-inline-block" href="#" role="button"
                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acción <i class="fas fa-chevron-down"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item edit-province" href="#"
                                data-province="{{ json_encode($province) }}" data-toggle="modal"
                                data-target="#editprovincias">Editar</a>
                            <a class="dropdown-item texto-1 font-family-Inter-Regular"
                                href="{{ route('destroy.province', $province->id) }}" data-toggle="modal"
                                data-target="#modalEliminar">Eliminar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="box-contenido pb-0">
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-start justify-content-start gap-20 mb-6 box-detalle">
                                <div class="">
                                    <img src=" {{ asset('img/provincia.png') }}" alt="user">
                                </div>
                                <div class="align-items-start d-flex flex-column h-100 justify-content-between">
                                    <div>
                                        <h3>{{ $province->provincia }}</h3>
                                        <span>Provincias</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-start gap-15 flex-wrap">
                                        <div class="option">
                                            <h4>{{ $province->id }}</h4>
                                            <p class="mb-0">ID elemento</p>
                                        </div>
                                        <div class="option">
                                            <h4>{{ $province->created_at->locale('es')->isoFormat('D MMMM YYYY, h:mm a') }}
                                            </h4>
                                            <p class="mb-0">Fecha registro</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <ul class="nav nav-tabs tabs-elevatronic" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#AscensoresProvincias">Ascensores
                                            de la provincia</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box-contenido">
                        <div class="tab-content contenido-elevatronic">
                            <div id="AscensoresProvincias" class="tab-pane active"><br>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <h3 class="mb-0">Ascensores de la provincia</h3>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="buscador">
                                            <div class="form-group position-relative">
                                                <label for="customSearchBox"><i class="fal fa-search"></i></label>
                                                <input type="text" id="customSearchBox1" placeholder="Buscar"
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
                                                    data-table="#repuestosAsignados">Excel</button>
                                                <button class="dropdown-item export_pdf"
                                                    data-table="#repuestosAsignados">PDF</button>
                                                <button class="dropdown-item export_copy"
                                                    data-table="#repuestosAsignados">Copiar</button>
                                                <button class="dropdown-item export_print"
                                                    data-table="#repuestosAsignados">Imprimir</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <table id="repuestosAsignados" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ID</th>
                                                    <th class="text-center">FECHA ENTREGA</th>
                                                    <th class="text-center">TIPO DE ASCENSOR</th>
                                                    <th class="text-center">NOMBRE</th>
                                                    <th class="text-center">CLIENTE</th>
                                                    <th class="text-center">PROVINCIA</th>
                                                    <th align="right" class="text-right">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($elevators as $index => $elevator)
                                                    <tr class="td-head-center">
                                                        <td class="text-center">{{ $index + 1 }}</td>
                                                        <td class="text-center">{{ $elevator->fecha }}</td>
                                                        <td class="text-center">
                                                            {{ $elevator->tipoDeAscensor->nombre_de_tipo_de_ascensor ?? '-' }}
                                                        </td> <!-- Updated to show name -->
                                                        <td class="text-center">
                                                            <a href="{{ route('view.elevator', $elevator->id) }}"
                                                                class="text-blue text-center">
                                                                {{ $elevator->nombre }}
                                                            </a>
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($elevator->client)
                                                                <a href="{{ route('view.customer', $elevator->client_id) }}"
                                                                    class="text-blue text-center">
                                                                    {{ $elevator->client->nombre }}
                                                                </a>
                                                            @else
                                                                {{ '-' }}
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $elevator->province->provincia ?? '-' }}</td>
                                                        <!-- Updated to show name -->
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
                                                                        data-toggle="modal"
                                                                        data-target="#editarAscensor">Editar</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('destroy.elevator', $elevator->id) }}"
                                                                        data-toggle="modal"
                                                                        data-target="#modalEliminar{{ $elevator->id }}">Eliminar</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal Eliminar-->
                                                    <div class="modal fade" id="modalEliminar{{ $elevator->id }}"
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal edit Provincia-->
                <div class="modal left fade" id="editprovincias" tabindex="-1" role="dialog"
                    aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-family-Outfit-SemiBold">Actualizar
                                    Provincia</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @isset($province)
                                <form action="{{ route('update.province', $province->id) }}" method="POST"
                                    class="formulario-modal" id="editprovinceForm">
                                    @csrf
                                    <div class="modal-body body_modal">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="provincia">Nombre de
                                                        Provincia</label>
                                                    <select class="custom-select form-control" name="provincia"
                                                        id="edit-provincia">
                                                        <option value="">Seleccionar opción
                                                        </option>
                                                        <option value="amazonas"
                                                            {{ old('provincia', $province->provincia) == 'amazonas' ? 'selected' : '' }}>
                                                            Amazonas</option>
                                                        <option value="ancash"
                                                            {{ old('provincia', $province->provincia) == 'ancash' ? 'selected' : '' }}>
                                                            Ancash</option>
                                                        <option value="apurimac"
                                                            {{ old('provincia', $province->provincia) == 'apurimac' ? 'selected' : '' }}>
                                                            Apurimac</option>
                                                        <option value="arequipa"
                                                            {{ old('provincia', $province->provincia) == 'arequipa' ? 'selected' : '' }}>
                                                            Arequipa</option>
                                                        <option value="ayacucho"
                                                            {{ old('provincia', $province->provincia) == 'ayacucho' ? 'selected' : '' }}>
                                                            Ayacucho</option>
                                                        <option value="cajamarca"
                                                            {{ old('provincia', $province->provincia) == 'cajamarca' ? 'selected' : '' }}>
                                                            Cajamarca</option>
                                                        <option value="callao"
                                                            {{ old('provincia', $province->provincia) == 'callao' ? 'selected' : '' }}>
                                                            Callao</option>
                                                        <option value="cusco"
                                                            {{ old('provincia', $province->provincia) == 'cusco' ? 'selected' : '' }}>
                                                            Cusco</option>
                                                        <option value="huancavelica"
                                                            {{ old('provincia', $province->provincia) == 'huancavelica' ? 'selected' : '' }}>
                                                            Huancavelica</option>
                                                        <option value="huanuco"
                                                            {{ old('provincia', $province->provincia) == 'huanuco' ? 'selected' : '' }}>
                                                            Huanuco</option>
                                                        <option value="ica"
                                                            {{ old('provincia', $province->provincia) == 'ica' ? 'selected' : '' }}>
                                                            Ica</option>
                                                        <option
                                                            value="junín"{{ old('provincia', $province->provincia) == 'junín' ? 'selected' : '' }}>
                                                            Junín</option>
                                                        <option
                                                            value="la_libertad"{{ old('provincia', $province->provincia) == 'la_libertad' ? 'selected' : '' }}>
                                                            La Libertad</option>
                                                        <option
                                                            value="lambayeque"{{ old('provincia', $province->provincia) == 'lambayeque' ? 'selected' : '' }}>
                                                            Lambayeque</option>
                                                        <option
                                                            value="lima"{{ old('provincia', $province->provincia) == 'lima' ? 'selected' : '' }}>
                                                            Lima</option>
                                                        <option
                                                            value="loreto"{{ old('provincia', $province->provincia) == 'loreto' ? 'selected' : '' }}>
                                                            Loreto</option>
                                                        <option
                                                            value="madre_de_dios"{{ old('provincia', $province->provincia) == 'madre_de_dios' ? 'selected' : '' }}>
                                                            Madre de Dios</option>
                                                        <option
                                                            value="moquegua"{{ old('provincia', $province->provincia) == 'moquegua' ? 'selected' : '' }}>
                                                            Moquegua</option>
                                                        <option
                                                            value="pasco"{{ old('provincia', $province->provincia) == 'pasco' ? 'selected' : '' }}>
                                                            Pasco</option>
                                                        <option
                                                            value="piura"{{ old('provincia', $province->provincia) == 'piura' ? 'selected' : '' }}>
                                                            Piura</option>
                                                        <option
                                                            value="puno"{{ old('provincia', $province->provincia) == 'puno' ? 'selected' : '' }}>
                                                            Puno</option>
                                                        <option
                                                            value="san_martín"{{ old('provincia', $province->provincia) == 'san_martín' ? 'selected' : '' }}>
                                                            San Martín</option>
                                                        <option
                                                            value="tacna"{{ old('provincia', $province->provincia) == 'tacna' ? 'selected' : '' }}>
                                                            Tacna</option>
                                                        <option
                                                            value="tumbes"{{ old('provincia', $province->provincia) == 'tumbes' ? 'selected' : '' }}>
                                                            Tumbes</option>
                                                        <option
                                                            value="ucayali"{{ old('provincia', $province->provincia) == 'ucayali' ? 'selected' : '' }}>
                                                            Ucayali</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                                        <button type="submit" class="btn-gris btn-red mr-2">Actualizar cambios
                                        </button>
                                        <button type="button" class="btn-gris btn-border"
                                            data-dismiss="modal">Cancelar</button>
                                    </div>
                                </form>
                            @endisset
                        </div>
                    </div>
                </div>

                <!-- Modal Eliminar-->
                <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content border-radius-12">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                @isset($province)
                                    <form id="delete-form" action="{{ route('destroy.province', $province->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-gris btn-red">Sí</button>
                                    </form>
                                @endisset
                                <button type="button" class="btn-gris btn-border" data-dismiss="modal">No</button>
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
                                <h5 class="modal-title font-family-Outfit-SemiBold">Editar
                                    Ascensor</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @isset($elevator)
                                <form action="{{ route('update.elevator', $elevator->id) }}" class="formulario-modal"
                                    enctype="multipart/form-data" method="POST" id="editelevatform">
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
                                                                    alt="Image" width="200px" height="200px"
                                                                    id="edit-elevators">
                                                            @else
                                                                <img src="{{ asset('img/fondo.png') }}" alt="Image"
                                                                    width="200px" id="edit-elevators" height="200px">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="align-items-start col-md-6 d-flex flex-column justify-content-between mb-3">
                                                        <div class="">
                                                            <label for="imageUpload" class="text-gris mt-4">Seleccione
                                                                una
                                                                imagen</label>
                                                            <input type="file" id="editimageUpload" name="imagen"
                                                                style="display: none;" accept="image/*" />
                                                            <button type="button" id="edituploadButton" class="btn-gris">
                                                                <i class="fas fa-arrow-to-top mr-2"></i>Subir
                                                                Imagen
                                                            </button>
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <label for="contrato"># de
                                                                contrato</label>
                                                            <input type="text" placeholder="# de contrato" name="contrato"
                                                                id="edit-contrato" class="form-control" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="nombre">Nombre
                                                                ascensor</label>
                                                            <input type="text" placeholder="Nombre ascensor"
                                                                name="nombre" id="edit-nombre" class="form-control"
                                                                value="">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="código">Código</label>
                                                            <input type="text" placeholder="Código" name="código"
                                                                id="edit-código" class="form-control" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="marca">Marca</label>
                                                            <select class="custom-select form-control marcaItems"
                                                                name="marca_id" id="marca">
                                                                <option value="" class="d-none">Seleccionar
                                                                    opción
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="text-right w-100">
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
                                                            <label for="clienteAscensor">Cliente
                                                                del
                                                                ascensor</label>
                                                            <select name="client_id" class="ustom-select form-control"
                                                                id="edit-cliente">
                                                                @foreach ($customers as $key => $value)
                                                                    <option value="{{ $key }}"
                                                                        {{ old('client_id', $elevator->client_id ?? '') == $key ? 'selected' : '' }}>
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
                                                                class="form-control" name="fecha" id="edit-fecha"
                                                                value="">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="garantia">Garantía</label>
                                                            <input type="text" placeholder="Garantizar"
                                                                class="form-control" name="garantizar" id="edit-garantizar"
                                                                value="">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="dirección">Dirección</label>
                                                            <input type="text" placeholder="Dirección"
                                                                class="form-control" name="dirección" id="edit-dirección"
                                                                value="">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="ubigeo">Ubigeo</label>
                                                            <input type="text" placeholder="Ubigeo" class="form-control"
                                                                name="ubigeo" id="edit-ubigeo" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="provincia">Provincia</label>
                                                            <select class="custom-select form-control" name="provincia"
                                                                id="edit-province">
                                                                <option value="">Seleccionar
                                                                    opción</option>
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
                                                                name="técnico_instalador" id="edit-técnico_instalador">
                                                                <option value="">Seleccionar
                                                                    opción</option>
                                                                @foreach ($staffs as $staff)
                                                                    <option value="{{ $staff }}"
                                                                        {{ $elevator->técnico_instalador == $staff ? 'selected' : '' }}>
                                                                        {{ $staff }}
                                                                    </option>
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
                                                                <option value="">Seleccionar
                                                                    opción</option>
                                                                @foreach ($staffs as $staff)
                                                                    <option value="{{ $staff }}"
                                                                        {{ $elevator->técnico_ajustador == $staff ? 'selected' : '' }}>
                                                                        {{ $staff }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="tipo_de_ascensor">Tipo de
                                                                ascensor</label>
                                                            <select class="custom-select form-control" name="tipo_de_ascensor"
                                                                id="edit-tipo_de_ascensor">
                                                                <option value="">Seleccionar
                                                                    opción</option>
                                                                @foreach ($elevatortypes as $elevatortype)
                                                                    <option value="{{ $elevatortype }}"
                                                                        {{ $elevator->tipo_de_ascensor == $elevatortype ? 'selected' : '' }}>
                                                                        {{ $elevatortype }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tiposAscensor">Cantidad</label>
                                                            <input type="number" placeholder="Cantidad" class="form-control"
                                                                name="cantidad" id="edit-cantidad" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12"></div>
                                                    <div class="col-md-6">
                                                        <div class="adornoinput mb-3">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="mgratuito" name="quarters[]" value="mgratuito">
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
                                                                    id="sincuarto" name="quarters[]" value="sincuarto">
                                                                <label class="custom-control-label" for="sincuarto">Sin cuarto
                                                                    de
                                                                    maquina?</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="adornoinput mb-3">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="concuarto" name="quarters[]" value="concuarto">
                                                                <label class="custom-control-label" for="concuarto">Con cuarto
                                                                    de
                                                                    maquina?</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="Npisos"># de
                                                                pisos</label>
                                                            <input type="text" placeholder="#" name="npisos"
                                                                id="edit-npisos" class="form-control" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="Ncontacto">Nombre del
                                                                Contacto</label>
                                                            <input type="text" placeholder="Nombre del contacto"
                                                                name="ncontacto" id="edit-ncontacto" class="form-control"
                                                                value="">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="telefono">Teléfono</label>
                                                            <input type="number" placeholder="Teléfono" class="form-control"
                                                                name="teléfono" id="edit-teléfono" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="correo">Correo
                                                                electrónico</label>
                                                            <input type="text" placeholder="Correo electrónico"
                                                                class="form-control" name="correo" id="edit-correo"
                                                                value="">
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

                                                    <div class="col-md-12 d-none position-relative" id="DAdicional">
                                                        <div class="form-group">
                                                            <label for="Descripcion2">Descripción
                                                                2</label>
                                                            <textarea name="descripcion2" id="descripcion2" placeholder="Descripción" cols="30" rows="5">{{ old('descripcion1', isset($elevator) ? $elevator->descripcion1 : '') }}</textarea>
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
                                        <button type="button" class="btn-primario w-auto pl-3 pr-3" id="submitBrand">
                                            Entregar
                                        </button>
                                        <button type="button" class="btn-primario w-auto pl-3 pr-3" id="cancelMarca">
                                            Cancelar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            function getBrand(edit) {
                // Destroy existing Select2 instances if they exist
                if ($('#marca').data('select2')) {
                    $('#marca').select2('destroy');
                }

                // Perform the AJAX call to get brand data
                $.ajax({
                    type: "GET",
                    url: "{{ route('getBrands') }}",
                    dataType: "JSON",
                    success: function(response) {
                        // Clear the current options and append the retrieved options to the select elements
                        $("#marca").empty();
                        $("#marca").append(
                            '<option value="" class="d-none">Seleccionar opción</option>'
                        ); // Add placeholder option

                        $.each(response, function() {
                            $("#marca").append(
                                `<option value='${this.id}'>${this['marca_nombre']}</option>`
                            );
                        });

                        // Initialize Select2 on the select elements with placeholder
                        $('#marca').select2({
                            placeholder: "Seleccionar marca",
                            allowClear: true
                        });

                        // If edit is true and has a valid ID, set the selected value
                        if (edit) {
                            $('#marca').val(edit).trigger('change');
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
            var table1 = $('#repuestosAsignados').DataTable({
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
                        $("#edit-cliente, #edit-province, #edit-técnico_instalador, #edit-técnico_ajustador, #edit-tipo_de_ascensor")
                            .empty();
                        $("#edit-cliente").append(
                            '<option value="" class="d-none">Seleccionar opción</option>');
                        $("#edit-province").append(
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
                            $("#edit-province").append(
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
                            $('#edit-province').val(edit.provincia).trigger(
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
            getDatas();
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

            $('#customSearchBox1').keyup(function() {
                table1.search($(this).val()).draw();
            });
            $('.customSearchBox').keyup(function() {
                table.search($(this).val()).draw();
            });


            var table = $('#AscensoresTipo').DataTable({
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
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            $('#editprovinceForm').validate({
                rules: {
                    provincia: {
                        required: true
                    }
                },
                messages: {
                    provincia: {
                        required: "Por favor, seleccione una provincia"
                    }
                },
                errorElement: "span",
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                }
            });

            $(document).on('click', '.edit-province', function() {

                $('#edit-provincia').val('');

                var province = $(this).data('province');
                $('#edit-provincia').val(province.id);
                $('#editprovinceForm').attr('action', '/provincia/actualizar/' + province.id);

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
                    $('#marca').val(elevator.marca_id).trigger(
                        'change'); // Ensure the value is set and trigger change
                    $('#edit-cliente').val(elevator.client_id).trigger('change');
                    $('#edit-fecha').val(elevator.fecha);
                    $('#edit-garantizar').val(elevator.garantizar);
                    $('#edit-dirección').val(elevator.dirección);
                    $('#edit-ubigeo').val(elevator.ubigeo);
                    $('#edit-province').val(elevator.provincia).trigger('change');
                    $('#edit-técnico_instalador').val(elevator.técnico_instalador).trigger('change');
                    $('#edit-técnico_ajustador').val(elevator.técnico_ajustador).trigger('change');
                    $('#edit-tipo_de_ascensor').val(elevator.tipo_de_ascensor).trigger('change');
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
                    $('#editelevatform').attr('action', '/ascensore/actualizar/' + elevator.id);

            });

            $('#edituploadButton').click(function() {
                $('#editimageUpload').click();
            });
            $('#editimageUpload').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    // Update the background image of the preview div
                    $('#editimagePreview').css('background-image', 'url(' + e.target.result + ')');

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
        });
    </script>
@endpush
