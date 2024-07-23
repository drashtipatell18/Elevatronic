@extends('layouts.main')
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
                                            <h4>{{ $province->created_at->locale('es')->isoFormat('D MMM YYYY, h:mm a') }}</h4>
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
                                                    <th align="right" class="text-right">ACCIONES</th>
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
                                                        <td align="right">
                                                            <div class="dropdown">
                                                                <button type="button" class="btn-action dropdown-toggle"
                                                                    data-toggle="dropdown">
                                                                    Acción <i class="fas fa-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('view.sparepart', $sparepart->id) }}">Ver
                                                                        detalles</a>
                                                                    <a class="dropdown-item edit-sparepart" href="#"
                                                                        data-sparepart="{{ json_encode($sparepart) }}"
                                                                        data-toggle="modal"
                                                                        data-target="#editorRepuesto">Editar</a>
                                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                                        data-toggle="modal"
                                                                        data-target="#modalEliminar{{ $sparepart->id }}">Eliminar</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>


                                                    <!-- Modal Eliminar-->
                                                    <div class="modal fade" id="modalEliminar{{ $sparepart->id }}"
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
                                                                    @isset($sparepart)
                                                                        <form id="delete-form"
                                                                            action="{{ route('destroy.sparepart', $sparepart->id) }}"
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

                <!-- Modal Editor Repuesto-->
                <div class="modal left fade" id="editorRepuesto" tabindex="-1" role="dialog"
                    aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-family-Outfit-SemiBold">Editar
                                    Repuesto</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @isset($sparepart)
                                <form action="{{ route('update.sparepart', $sparepart->id) }}" method="POST"
                                    class="formulario-modal" enctype="multipart/form-data" id="editsparepart">
                                    @csrf
                                    <div class="modal-body body_modal">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label>Foto de repuesto</label>
                                                        <div id="editimagenPrevio">
                                                            @if ($sparepart->foto_de_repuesto)
                                                                <img src="{{ asset('images/' . $sparepart->foto_de_repuesto) }}"
                                                                    width="200" height="200" alt="Existing Image">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="">
                                                            <label for="editimageUpload1" class="text-gris mt-4">Seleccione
                                                                una
                                                                imagen</label>
                                                            <input type="file" id="editimageUpload1"
                                                                name="foto_de_repuesto" style="display: none;"
                                                                accept="image/*" />
                                                            <button type="button" id="editcargarimagen" class="btn-gris">
                                                                <i class="fas fa-arrow-to-top mr-2"></i>Subir
                                                                Imagen
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="NombreRepuesto">Nombre</label>
                                                            <input type="text" placeholder="Nombre"
                                                                class="form-control @error('nombre') is-invalid @enderror"
                                                                value="" name="nombre" id="edit-nombre">
                                                            @error('nombre')
                                                                <span class="invalid-feedback" style="color: red">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="precioRepuesto">Precio</label>
                                                            <input type="text" placeholder="Precio"
                                                                class="form-control @error('precio') is-invalid @enderror"
                                                                value="" name="precio" id="edit-precio">
                                                            @error('precio')
                                                                <span class="invalid-feedback" style="color: red">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="DescripcionRepuesto">Descripción</label>
                                                            <textarea name="descripción" id="edit-descripción" placeholder="Descripción" cols="30" rows="5">{{ old('descripción', $sparepart->descripción ?? '') }}</textarea>
                                                            @error('descripción')
                                                                <span class="invalid-feedback" style="color: red">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="Flimpieza">Frecuencia de
                                                                limpieza (días)</label>
                                                            <input type="number" placeholder="Frecuencia de limpieza (días)"
                                                                name="frecuencia_de_limpieza" id="edit-frecuencia_de_limpieza"
                                                                class="form-control @error('frecuencia_de_limpieza') is-invalid @enderror"
                                                                value="">
                                                            @error('frecuencia_de_limpieza')
                                                                <span class="invalid-feedback" style="color: red">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="Flubricacion">Frecuencia de
                                                                lubricación (días)</label>
                                                            <input type="number"
                                                                placeholder="Frecuencia de lubricación (días)"
                                                                name="frecuencia_de_lubricación"
                                                                id="edit-frecuencia_de_lubricación"
                                                                class="form-control @error('frecuencia_de_lubricación') is-invalid @enderror"
                                                                value="{{ old('frecuencia_de_lubricación', $sparepart->frecuencia_de_lubricación ?? '') }}">
                                                            @error('frecuencia_de_lubricación')
                                                                <span class="invalid-feedback" style="color: red">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="FAjustes">Frecuencia de
                                                                ajuste (días)</label>
                                                            <input type="number" placeholder="Frecuencia de ajuste (días)"
                                                                name="frecuencia_de_ajuste" id="edit-frecuencia_de_ajuste"
                                                                class="form-control @error('frecuencia_de_ajuste') is-invalid @enderror"
                                                                value="{{ old('frecuencia_de_ajuste', $sparepart->frecuencia_de_ajuste ?? '') }}">
                                                            @error('frecuencia_de_ajuste')
                                                                <span class="invalid-feedback" style="color: red">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="FRevision">Frecuencia de
                                                                revisión (días)</label>
                                                            <input type="number" placeholder="Frecuencia de revisión (días)"
                                                                class="form-control @error('frecuencia_de_revisión') is-invalid @enderror"
                                                                value="{{ old('frecuencia_de_revisión', $sparepart->frecuencia_de_revisión ?? '') }}"
                                                                name="frecuencia_de_revisión"
                                                                id="edit-frecuencia_de_revisión">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="FCambio">Frecuencia de
                                                                cambio (días)</label>
                                                            <input type="number" placeholder="Frecuencia de cambio (días)"
                                                                class="form-control @error('frecuencia_de_cambio') is-invalid @enderror"
                                                                value="{{ old('frecuencia_de_cambio', $sparepart->frecuencia_de_cambio ?? '') }}"
                                                                name="frecuencia_de_cambio" id="edit-frecuencia_de_cambio">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="FSolicitud">Frecuencia de
                                                                solicitud (días)</label>
                                                            <input type="number" placeholder="Frecuencia de solicitud (días)"
                                                                class="form-control @error('frecuencia_de_solicitud') is-invalid @enderror"
                                                                value="{{ old('frecuencia_de_solicitud', $sparepart->frecuencia_de_solicitud ?? '') }}"
                                                                name="frecuencia_de_solicitud"
                                                                id="edit-frecuencia_de_solicitud">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                                        <button type="submit" class="btn-gris btn-red mr-2">Actualizar
                                            cambios</button>
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
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            var table = $('#repuestosAsignados').DataTable({
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


            var table = $('#AscensoresTipo').DataTable({
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

            $('.edit-province').on('click', function() {
                var province = $(this).data('province');
                $('#edit-provincia').val(province.provincia);
                $('#editprovinceForm').attr('action', '/provincia/actualizar/' + province.id);

            });

            $('#editsparepart').validate({
                rules: {
                    nombre: "required",
                    precio: {
                        required: true,
                        number: true
                    },
                    descripción: "required",
                    frecuencia_de_limpieza: {
                        required: true,
                        number: true
                    },
                    frecuencia_de_lubricación: {
                        required: true,
                        number: true
                    },
                    frecuencia_de_ajuste: {
                        required: true,
                        number: true
                    },
                    frecuencia_de_revisión: {
                        number: true
                    },
                    frecuencia_de_cambio: {
                        number: true
                    },
                    frecuencia_de_solicitud: {
                        number: true
                    }
                },
                messages: {
                    nombre: "Por favor, ingrese el nombre del repuesto",
                    precio: {
                        required: "Por favor, ingrese el precio",
                        number: "Por favor, ingrese un valor numérico para el precio"
                    },
                    frecuencia_de_limpieza: {
                        required: "Por favor, ingrese la frecuencia de limpieza",
                        number: "Por favor, ingrese un valor numérico para la frecuencia de limpieza"
                    },
                    frecuencia_de_lubricación: {
                        required: "Por favor, ingrese la frecuencia de lubricación",
                        number: "Por favor, ingrese un valor numérico para la frecuencia de lubricación"
                    },
                    frecuencia_de_ajuste: {
                        required: "Por favor, ingrese la frecuencia de ajuste",
                        number: "Por favor, ingrese un valor numérico para la frecuencia de ajuste"
                    }
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

            $('.edit-sparepart').on('click', function() {
                var sparepart = $(this).data('sparepart');
                console.log(sparepart);
                // Populate the modal with customer data
                $('#edit-nombre').val(sparepart.nombre);
                $('#edit-precio').val(sparepart.precio);
                $('#edit-descripción').val(sparepart.descripción);
                $('#edit-frecuencia_de_limpieza').val(sparepart.frecuencia_de_limpieza);
                $('#edit-frecuencia_de_lubricación').val(sparepart.frecuencia_de_lubricación);
                $('#edit-frecuencia_de_ajuste').val(sparepart.frecuencia_de_ajuste);
                $('#edit-frecuencia_de_revisión').val(sparepart.frecuencia_de_revisión);
                $('#edit-frecuencia_de_cambio').val(sparepart.frecuencia_de_cambio);
                $('#edit-frecuencia_de_solicitud').val(sparepart.frecuencia_de_solicitud);

                // Set the form action to the correct route
                $('#editsparepart').attr('action', '/repuestos/actualizar/' + sparepart.id);
            });
 
            $('#editprovincias').on('hidden.bs.modal', function() {
                var form = $('#editprovinceForm');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            }); 
        });
    </script>
@endpush
