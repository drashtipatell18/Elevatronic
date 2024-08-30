@php
    use App\Models\ImagePdfs;
@endphp
@extends('layouts.main')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@section('content')
    <style>
        .qrcode {
            text-align: center;
        }

        .error {
            color: red;
        }

        .supervisorbtn {
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
    </style>
    @csrf
    <div class="w-100 contenido">
        <div class="container-fluid container-mod">
            <div class="row">
                <div class="col-xl-10 col-lg-10 col-md-8 col-sm-8 col-8 mb-4">
                    <div class="titulo">
                        <h4>{{ $maint_in_review->tipo_de_revisión }}</h4>
                        <span>Mantenimiento en revisión >> {{ $maint_in_review->tipo_de_revisión }}</span>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-end">
                    <div class="dropdown btn-new">
                        <a class="btn-action dropdownMenuLink d-inline-block" href="#" role="button"
                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acción <i class="fas fa-chevron-down"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item edit-maint_in_review" href="#"
                                data-maint_in_review="{{ json_encode($maint_in_review) }}" data-toggle="modal"
                                data-target="#editorMantenimiento">Editar</a>
                            <a class="dropdown-item texto-1 font-family-Inter-Regular" href="javascript:void(0)"
                                data-toggle="modal" data-target="#modalEliminar">Eliminar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="box-contenido pb-0">
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-start justify-content-start gap-20 mb-6 box-detalle">
                                <div class="contenido-img">
                                    <img src="{{ asset('img/mantenimiento.png') }}" alt="user" width="160">
                                </div>
                                <div class="align-items-start d-flex flex-column h-100 justify-content-between">
                                    <div>
                                        <h3>{{ $maint_in_review->tipo_de_revisión }}</h3>
                                        <span>Mantenimiento</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-start gap-15 flex-wrap">
                                        <div class="option">
                                            <h4>{{ $maint_in_review->id }}</h4>
                                            <p class="mb-0">ID elemento</p>
                                        </div>
                                        <div class="option">
                                            <h4>{{ $maint_in_review->núm_certificado }}</h4>
                                            <p class="mb-0"># de certificado</p>
                                        </div>

                                        @php
                                            // Get the image and file counts
                                            $imageCount = ImagePdfs::whereNotNull('image')
                                                ->where('mant_en_revisións_id', $maint_in_review->id)
                                                ->count();

                                            $fileCount = ImagePdfs::whereNotNull('document')
                                                ->where('mant_en_revisións_id', $maint_in_review->id)
                                                ->count();
                                        @endphp

                                        <div class="option">
                                            <h4 class="imageCount"></h4>
                                            {{-- <p>Images</p> --}}
                                        </div>

                                        <div class="option">
                                            <h4 class="fileCount"></h4>
                                            {{-- <p>Archivos</p> --}}
                                        </div>

                                        <div class="option">
                                            <h4>{{ $maint_in_review->created_at->locale('es')->isoFormat('D MMMM YYYY, h:mm a') }}
                                            </h4>
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
                                        <a class="nav-link" data-toggle="tab" href="#repuestos">Repuestos</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="tab-content contenido-elevatronic">
                        <div id="informacion" class="tab-pane active">
                            <div class="box-contenido mb-4">
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
                                                    <td class="text-gris">Tipo de revisión</td>
                                                    <td>{{ $maint_in_review->reviewtype ? $maint_in_review->reviewtype->nombre : '' }}</td>                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris"># de certificado</td>
                                                    <td>{{ $maint_in_review->núm_certificado }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Ascensor</td>
                                                    <td>{{ $maint_in_review->elevator ? $maint_in_review->elevator->nombre : '' }}</td>
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
                                                        {{ $maint_in_review->dirección }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Supervisor</td>
                                                    <td>
                                                        @if (!is_null($maint_in_review) && isset($maint_in_review->supervisor))
                                                            {{ $maint_in_review->supervisor->nomber }}
                                                        @else
                                                            {{ '-' }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Provincia</td>
                                                    <td>{{ $maint_in_review->province ? $maint_in_review->province->provincia : '' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Técnico</td>
                                                    <td>{{ $maint_in_review->staff->nombre }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Fecha mantenimiento</td>
                                                    <td>{{ $maint_in_review->fecha_de_mantenimiento }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Mes programado</td>
                                                    <td>{{ $maint_in_review->month->nombre }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Hora inicio</td>
                                                    <td>{{ $maint_in_review->hora_inicio }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Hora fin</td>
                                                    <td>{{ $maint_in_review->hora_fin }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Observaciones</td>
                                                    <td>{{ $maint_in_review->observaciónes }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Observaciones internas</td>
                                                    <td>{{ $maint_in_review->observaciónes_internas }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Solución</td>
                                                    <td>{{ $maint_in_review->solución }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Estado</td>
                                                    <td>Revisado</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Nombre del representante</td>
                                                    <td>-</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris" style="vertical-align: top !important;">Firma
                                                        del representante</td>
                                                    <td>
                                                        <img src="{{ asset('img/fondo.png') }}" alt="img"
                                                            width="233">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="box-contenido contenido-elevatronic">
                                        <h3 class="mb-3 imageCount">Imágenes</h3>
                                        <div class="gallery">
                                            <div class="row">
                                                @isset($main_image)
                                                    @foreach ($main_image as $image)
                                                        <div class="col-md-6 mb-4" data-image-id="{{ $image->id }}">
                                                            <div class="img-container">
                                                                <img src="{{ url('/images/' . $image->image) }}"
                                                                    alt="galeria">
                                                                <button class="btn-delete-image btn btn-light mt-2"
                                                                    data-image-id="{{ $image->id }}"><i
                                                                        class="fal fa-trash-alt"></i></button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endisset
                                            </div>
                                        </div>
                                        <input type="file" id="imageUpload" accept="image/*" multiple class="d-none">
                                        <button data-id="{{ $id ?? '' }}" id="uploadButton10" class="btn-gris">
                                            <i class="fas fa-arrow-to-top mr-2"></i> Subir Imagen
                                        </button>
                                    </div>
                                </div>


                                <div class="col-md-6 mb-4">
                                    <div class="box-contenido contenido-elevatronic">
                                        <h3 class="fileCount" class="mb-3">Archivos</h3>

                                        <div id="fileList" class="file-list">
                                            @if (isset($documents) && !empty($documents))
                                                @foreach ($documents as $document)
                                                    <div class="file-entry" data-id="{{ $document->id }}">
                                                        <span class="file-info">
                                                            <a href="/documents/{{ $document->document }}"
                                                                download>{{ $document->document }}</a>(0.2 MB)
                                                        </span>
                                                        <button data-id="{{ $document->id }}" class="remove-file"><i
                                                                class="fal fa-trash-alt"></i></button>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>

                                        <input type="file" id="fileUpload" accept=".pdf,.xlsx,.xls,.doc,.docx"
                                            multiple class="d-none">
                                        <button id="uploadButton11" data-id="@php if(isset($id)) { echo $id; } @endphp"
                                            class="btn-gris mt-4"><i class="fas fa-arrow-to-top mr-2"></i> Cargar
                                            archivo</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div id="repuestos" class="tab-pane">
                            <div class="box-contenido">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <h3 class="mb-0">Repuestos</h3>
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
                                    <div class="col-md-12">
                                        <table id="contratosTable" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>NOMBRE</th>
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
                                                    <tr>
                                                        <td>{{ $sparepart->nombre }}</td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="limpieza-{{ $index }}" name="limpieza[]"
                                                                    data-id="{{ $sparepart->id }}"
                                                                    data-type="frecuencia_de_limpieza"
                                                                    {{ $sparepart->frecuencia_de_limpieza ? 'checked' : '' }}>
                                                                <label class="custom-control-label"
                                                                    for="limpieza-{{ $index }}"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="lubricacion-{{ $index }}"
                                                                    name="lubricacion[]" data-id="{{ $sparepart->id }}"
                                                                    data-type="frecuencia_de_lubricación"
                                                                    {{ $sparepart->frecuencia_de_lubricación ? 'checked' : '' }}>
                                                                <label class="custom-control-label"
                                                                    for="lubricacion-{{ $index }}"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="ajuste-{{ $index }}" name="ajuste[]"
                                                                    data-id="{{ $sparepart->id }}"
                                                                    data-type="frecuencia_de_ajuste"
                                                                    {{ $sparepart->frecuencia_de_ajuste ? 'checked' : '' }}>
                                                                <label class="custom-control-label"
                                                                    for="ajuste-{{ $index }}"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="revision-{{ $index }}" name="revision[]"
                                                                    data-id="{{ $sparepart->id }}"
                                                                    data-type="frecuencia_de_revisión"
                                                                    {{ $sparepart->frecuencia_de_revisión ? 'checked' : '' }}>
                                                                <label class="custom-control-label"
                                                                    for="revision-{{ $index }}"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="cambio-{{ $index }}" name="cambio[]"
                                                                    data-id="{{ $sparepart->id }}"
                                                                    data-type="frecuencia_de_cambio"
                                                                    {{ $sparepart->frecuencia_de_cambio ? 'checked' : '' }}>
                                                                <label class="custom-control-label"
                                                                    for="cambio-{{ $index }}"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="solicitud-{{ $index }}" name="solicitud[]"
                                                                    data-id="{{ $sparepart->id }}"
                                                                    data-type="frecuencia_de_solicitud"
                                                                    {{ $sparepart->frecuencia_de_solicitud ? 'checked' : '' }}>
                                                                <label class="custom-control-label"
                                                                    for="solicitud-{{ $index }}"></label>
                                                            </div>
                                                        </td>
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

            </div>
        </div>
    </div>
    <!-- Modal Editor Mantenimiento-->
    <div class="modal left fade" id="editorMantenimiento" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-family-Outfit-SemiBold">Edición De
                        Mantenimiento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="" class="formulario-modal" enctype="multipart/form-data" method="POST"
                    id="editmaintreview">
                    @method('PUT')
                    @csrf
                    <div class="modal-body body_modal">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="TRevision">Tipo de revisión</label>
                                    <select class="custom-select @error('tipo_de_revisión') is-invalid @enderror"
                                        name="tipo_de_revisión" id="edit-tipo_de_revisión">
                                        <option disabled>Seleccionar tipo de
                                            revisión</option>
                                        @foreach ($review_types as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ old('tipo_de_revisión', $maint_in_review->tipo_de_revisión ?? '') == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tipo_de_revisión')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="MAscensor">Ascensor</label>
                                    <select class="custom-select @error('ascensor') is-invalid @enderror" name="ascensor"
                                        id="edit-MAscensor" autocomplete="new-ascensor" autoFill="off">
                                        @foreach ($elevators as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ old('ascensor') == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('ascensor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="Direccion">Dirección</label>
                                    <input type="text" placeholder="Dirección" name="dirección" id="edit-dirección"
                                        class="form-control @error('dirección') is-invalid @enderror" value=""
                                        autocomplete="new-dirección" autoFill="off">
                                    @error('dirección')
                                        <span class="invalid-feedback" style="color: red">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="provinciaAs">Provincia</label>
                                    <select id="edit-provincia" name="provincia" class="form-control"
                                        autocomplete="new-provincia" autoFill="off">
                                        <option value="">Seleccionar Provincia</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province }}"
                                                {{ old('provincia', $maint_in_review->provincia ?? '') == $province ? 'selected' : '' }}>
                                                {{ $province }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('provincia')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- <div class="row"> --}}
                                {{-- <div class="col-md-6"> --}}
                                <div class="form-group">
                                    <label for="núm_certificado">Núm Certificado</label>
                                    <input type="number" placeholder="Núm Certificado" name="núm_certificado"
                                        id="edit-NCertificado" class="form-control">
                                </div>
                                {{-- </div> --}}
                                {{-- <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="máquina">#Máquina</label>
                                                                                        <input type="text" placeholder="#Máquina" name="máquina" id="máquina"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                </div> --}}
                                {{-- </div> --}}

                                <div class="form-group">
                                    <label for="Supervisor">Supervisor</label>
                                    <select class="custom-select  @error('supervisor') is-invalid @enderror"
                                        name="supervisor_id" id="supervisor_id">

                                    </select>
                                    @error('supervisor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="técnico">Técnico</label>
                                    <select class="custom-select" name="técnico" id="edit-técnico">
                                        <option value="">Seleccionar opción</option>
                                        @foreach ($personals as $personal)
                                            <option value="{{ $personal }}"
                                                {{ old('técnico') == $personal || (isset($maintInRev) && $maintInRev->técnico == $personal) ? 'selected' : '' }}>
                                                {{ $personal }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Mprogramado">Mes
                                                programado</label>
                                            <select class="custom-select @error('mes_programado') is-invalid @enderror"
                                                name="mes_programado" id="edit-Mprogramado">
                                                {{-- <option value="" class="">Seleccionar
                                                    opción</option>
                                                <option value="mes_programado_1"
                                                    {{ old('mes_programado', $maint_in_review->mes_programado ?? '') == 'mes_programado_1' ? 'selected' : '' }}>
                                                    Mes programado 1</option>
                                                <option value="mes_programado_2"
                                                    {{ old('mes_programado', $maint_in_review->mes_programado ?? '') == 'mes_programado_2' ? 'selected' : '' }}>
                                                    Mes programado 2</option>
                                                <option value="mes_programado_3"
                                                    {{ old('mes_programado', $maint_in_review->mes_programado ?? '') == 'mes_programado_3' ? 'selected' : '' }}>
                                                    Mes programado 3</option> --}}

                                                <option value="">Seleccionar opción</option>
                                                <option value="1"
                                                    {{ old('mes_programado', $maint_in_review->mes_programado ?? '') == '1' ? 'selected' : '' }}>
                                                    Enero</option>
                                                <option value="2"
                                                    {{ old('mes_programado', $maint_in_review->mes_programado ?? '') == '2' ? 'selected' : '' }}>
                                                    Febrero</option>
                                                <option value="3"
                                                    {{ old('mes_programado', $maint_in_review->mes_programado ?? '') == '3' ? 'selected' : '' }}>
                                                    Marzo</option>
                                                <option value="4"
                                                    {{ old('mes_programado', $maint_in_review->mes_programado ?? '') == '4' ? 'selected' : '' }}>
                                                    Abril</option>
                                                <option value="5"
                                                    {{ old('mes_programado', $maint_in_review->mes_programado ?? '') == '5' ? 'selected' : '' }}>
                                                    Mayo</option>
                                                <option value="6"
                                                    {{ old('mes_programado', $maint_in_review->mes_programado ?? '') == '6' ? 'selected' : '' }}>
                                                    Junio</option>
                                                <option value="7"
                                                    {{ old('mes_programado', $maint_in_review->mes_programado ?? '') == '7' ? 'selected' : '' }}>
                                                    Julio</option>
                                                <option value="8"
                                                    {{ old('mes_programado', $maint_in_review->mes_programado ?? '') == '8' ? 'selected' : '' }}>
                                                    Agosto</option>
                                                <option value="9"
                                                    {{ old('mes_programado', $maint_in_review->mes_programado ?? '') == '9' ? 'selected' : '' }}>
                                                    Septiembre</option>
                                                <option value="10"
                                                    {{ old('mes_programado', $maint_in_review->mes_programado ?? '') == '10' ? 'selected' : '' }}>
                                                    Octubre</option>
                                                <option value="11"
                                                    {{ old('mes_programado', $maint_in_review->mes_programado ?? '') == '11' ? 'selected' : '' }}>
                                                    Noviembre</option>
                                                <option value="12"
                                                    {{ old('mes_programado', $maint_in_review->mes_programado ?? '') == '12' ? 'selected' : '' }}>
                                                    Diciembre</option>

                                            </select>
                                            @error('mes_programado')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="FMantenimiento">Fecha de
                                                mantenimiento</label>
                                            <input type="date" placeholder="dd/mm/aaaa" name="fecha_de_mantenimiento"
                                                id="edit-FMantenimiento"
                                                class="form-control @error('fecha_de_mantenimiento') is-invalid @enderror"
                                                value="">
                                            @error('fecha_de_mantenimiento')
                                                <span class="invalid-feedback" style="color: red">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="FInicio">Hora
                                                inicio</label>
                                            <input type="time" placeholder="Hora inicio" name="hora_inicio"
                                                id="edit-FInicio"
                                                class="form-control @error('hora_inicio') is-invalid @enderror"
                                                value="">
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
                                            <input type="time" placeholder="Hora fin" name="hora_fin" id="edit-HFin"
                                                class="form-control @error('hora_fin') is-invalid @enderror"
                                                value="">
                                            @error('hora_fin')
                                                <span class="invalid-feedback" style="color: red">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="observaciónes">Observaciones</label>
                                            <textarea name="observaciónes" id="edit-observaciónes" placeholder="Comentario de contrato" cols="30"
                                                rows="5"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="observacionesInternas">Observaciones
                                                internas</label>
                                            <textarea name="observaciónes_internas" id="edit-observacionesInternas" placeholder="Observaciones internas"
                                                cols="30" rows="5"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="solucion">Solución</label>
                                            <textarea name="solución" id="edit-solucion" placeholder="Solución" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                        <button type="submit" class="btn-gris btn-red mr-2">Guardar Cambios</button>
                        <button type="button" class="btn-gris btn-border" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Observaciones-->
    <div class="modal fade" id="observacion" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 10px;">
                <div class="modal-header">
                    <h5 class="modal-title">Observación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et mattis nulla. Pellentesque
                                laoreet sem sit amet nulla vestibulum, eu iaculis tellus aliquam. Sed lectus nisi, sagittis
                                eget enim suscipit, accumsan euismod tortor. Mauris gravida gravida suscipit. Praesent
                                rutrum bibendum mauris, eget sodales ex rutrum sed.
                            </p>
                        </div>
                    </div>
                </div>
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
                                <img src="{{ asset('img/iconos/trash.svg') }}" alt="trash" width="76">
                                <p class="mt-3 mb-0">
                                    ¿Seguro que quieres eliminar <span id="item-name"></span>?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer align-items-center justify-content-center">
                    @isset($maint_in_review)
                        <form id="delete-form" action="{{ route('destroy.maint.in.review', $maint_in_review->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-gris btn-red">Sí</button>
                            <button type="button" class="btn-gris btn-border" data-dismiss="modal">No</button>
                        </form>
                    @endisset
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="showQrCodeModal" role="dialog" aria-labelledby="showQrCodeModal"
        aria-hidden="true">
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
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Model Crear Supervisor --}}
    <div class="modal left fade" id="crearSupervisor" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-family-Outfit-SemiBold">Crear Supervisor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="col-md-12" id="marcaInputSection" style="">
                    <form method="POST" id="SupervisorForm">
                        @csrf
                        <div class="form-group">
                            <label>Ingresar Supervisor</label>
                            <input type="text" placeholder="Ingresar Supervisor" name="nomber" id="nomber"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn-primario w-auto pl-3 pr-3" id="submitSupervisor">
                                Entregar
                            </button>
                            <button type="button" class="btn-primario w-auto pl-3 pr-3" id="cancelSupervisor">
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#contratosTable').DataTable({
                responsive: true,
                dom: 'tp',
                pageLength: 20,
                language: {
                    decimal: "",
                    emptyTable: "No hay información",
                    info: "Mostrando START a END de TOTAL Registros",
                    infoEmpty: "Mostrando 0 a 0 de 0 Entradas",
                    infoFiltered: "(Filtrado de MAX total registros)",
                    lengthMenu: "Mostrar MENU Registros",
                    loadingRecords: "Cargando...",
                    processing: "Procesando...",
                    search: "Buscar:",
                    zeroRecords: "Sin resultados encontrados",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior"
                    }
                },
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            $('#SupervisorForm').on('keypress', function(e) {
                if (e.which === 13) {
                    e.preventDefault();
                    return false;
                }
            });

            function getSupervisors(edit) {
                if ($('#supervisor_id').data('select2')) {
                    $('#supervisor_id').select2('destroy');
                }

                $.ajax({
                    type: "GET",
                    url: "{{ route('supervisors') }}",
                    dataType: "JSON",
                    success: function(response) {
                        $("#supervisor_id").empty().append(
                            '<option value="" class="d-none">Seleccionar Supervisor</option>');

                        $.each(response, function() {
                            $("#supervisor_id").append(
                                `<option value='${this.id}'>${this.nomber}</option>`);
                        });

                        $('#supervisor_id').select2();

                        if (edit) {
                            setTimeout(function() {
                                $('#supervisor_id').val(edit).trigger('change');
                            }, 100);
                        }
                    },
                    error: function(xhr) {
                        console.error('Error fetching supervisors:', xhr.responseText);
                    }
                });
            }
            function getDataMain(edit) {
                // Destroy existing Select2 instances if they exist
                if ($('#edit-tipo_de_revisión').data('select2')) {
                    $('#edit-tipo_de_revisión').select2('destroy');
                }
                if ($('#edit-MAscensor').data('select2')) {
                    $('#edit-MAscensor').select2('destroy');
                }
                if ($('#edit-provincia').data('select2')) {
                    $('#edit-provincia').select2('destroy');
                }
                if ($('#edit-técnico').data('select2')) {
                    $('#edit-técnico').select2('destroy');
                }
                if ($('#edit-Mprogramado').data('select2')) {
                    $('#edit-Mprogramado').select2('destroy');
                }

                // Perform the AJAX call to get brand data
                $.ajax({
                    type: "GET",
                    url: "{{ route('getDataMaintance') }}",
                    dataType: "JSON",
                    success: function(response) {
                        // Clear the current options and append the retrieved options to the select elements
                        $("#edit-tipo_de_revisión, #edit-provincia, #edit-MAscensor, #edit-técnico, #edit-Mprogramado")
                            .empty();
                        $("#edit-tipo_de_revisión").append(
                            '<option value="" class="d-none">Seleccionar opción</option>');
                        $("#edit-MAscensor").append(
                            '<option value="" class="d-none">Seleccionar opción</option>');
                        $("#edit-técnico").append(
                            '<option value="" class="d-none">Seleccionar opción</option>');
                        $("#edit-Mprogramado").append(
                            '<option value="" class="d-none">Seleccionar opción</option>');

                        // Populate each dropdown with the corresponding data
                        $.each(response.review_types, function(id, nombre) {
                            $("#edit-tipo_de_revisión").append(
                                `<option value='${id}'>${nombre}</option>`);
                        });
                        $.each(response.provinces, function(id, provincia) {
                            $("#edit-provincia").append(
                                `<option value='${id}'>${provincia}</option>`);
                        });
                        $.each(response.staffs, function(id, nombre) {
                            $("#edit-técnico").append(
                                `<option value='${id}'>${nombre}</option>`);
                        });
                        $.each(response.elevators, function(id, nombre) {
                            $("#edit-MAscensor").append(
                                `<option value='${id}'>${nombre}</option>`);
                        });
                        $.each(response.months, function(id, nombre) {
                            $("#edit-Mprogramado").append(
                                `<option value='${id}'>${nombre}</option>`);
                        });

                        // Initialize Select2 on the select elements with placeholder
                        $('#edit-tipo_de_revisión, #edit-provincia, #edit-MAscensor, #edit-técnico, #edit-Mprogramado')
                            .select2({
                                placeholder: "Seleccionar opción",
                                allowClear: true
                            });

                        // Log the edit object to check values
                        console.log('Edit Object:', edit);

                        // If edit is true and has a valid ID, set the selected value
                        if (edit) {
                            console.log('Setting values for Select2:');
                            console.log('Tipo de revisión:', edit.tipo_de_revisión);
                            console.log('Ascensor:', edit.ascensor);
                            console.log('Mes programado:', edit.mes_programado);

                            $('#edit-tipo_de_revisión').val(edit.tipo_de_revisión).trigger('change');
                            $('#edit-provincia').val(edit.provincia).trigger('change');
                            $('#edit-técnico').val(edit.técnico).trigger('change');
                            $('#edit-MAscensor').val(edit.ascensor).trigger('change');
                            $('#edit-Mprogramado').val(edit.mes_programado).trigger('change');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching data: ", error);
                    }
                });
            }
            const editValue = '{{ $editValue ?? '' }}';
            getSupervisors(editValue);
            getDataMain();

            $('#submitSupervisor').click(function(e) {
                e.preventDefault();
                var formData = new FormData();
                formData.append('nomber', $('#nomber').val());

                $.ajax({
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('insert.supervisor') }}",
                    success: function(response) {
                        getSupervisors();
                        $('#cancelSupervisor').click();
                    },
                    error: function(xhr) {
                        console.error('Error creating supervisor:', xhr.responseText);
                    }
                });
            });
            $('#cancelSupervisor').click(function() {
                $("#crearSupervisor").modal('hide');
            });

            updateImageCount();
            $('#uploadButton10').click(function() {
                $('#imageUpload').click();
            });




            $('#imageUpload').change(function() {
                if (this.files.length) {
                    var formData = new FormData();
                    formData.append("_token", $("input[name='_token']").val());

                    $.each(this.files, function(i, file) {
                        formData.append('image[]', file);
                    });

                    let id = $("#uploadButton10").data('id');
                    formData.append('id', id);

                    $.ajax({
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        url: `/mant/en/revisión/detalle/${id}/saveImage`,
                        success: function(response) {
                            response.forEach(function(image) {
                                var imgHtml = $(
                                    '<div class="col-md-6 mb-4" data-image-id="' +
                                    image.id +
                                    '"><div class="img-container"><img src="' +
                                    '/images/' + image.filename +
                                    '" alt="galeria" /><button class="btn-delete-image btn btn-light mt-2" data-image-id="' +
                                    image.id +
                                    '"><i class="fal fa-trash-alt"></i></button></div></div>'
                                );

                                $('.gallery .row').append(imgHtml);
                                // window.location.reload();

                            });
                            updateImageCount();
                            $('#imageUpload').val('');

                        },
                        error: function(xhr) {
                            console.error('Error uploading images:', xhr.responseText);
                        }
                    });
                }
            });

            $('.gallery').on('click', '.btn-delete-image', function(e) {
                e.preventDefault();
                var imageId = $(this).data('image-id');
                var parentDiv = $(this).closest('.col-md-6');

                if (confirm('¿Estás seguro de que deseas eliminar esta imagen?')) {
                    $.ajax({
                        type: "DELETE",
                        url: `/document/${imageId}/delete`,
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                parentDiv.remove();
                                updateImageCount();
                                // window.location.reload();
                            } else {
                                console.error('Error deleting image.');
                            }
                        },
                        error: function(xhr) {
                            console.error('Request failed: ' + xhr.status + ' ' + xhr
                                .statusText);
                        }
                    });
                }
            });

            function updateImageCount() {
                var count = $('.gallery .row .col-md-6').length;
                $('.imageCount').html('Imágenes (' + count + ')');
            }

            updateFileCount();
            $('#uploadButton11').click(function() {
                $('#fileUpload').click();
            });

            $('#fileUpload').change(function() {
                var files = this.files;
                var formData = new FormData();
                formData.append("_token", $("input[name='_token']").val());

                $.each(files, function(i, file) {
                    formData.append('files[]', file);
                });

                let id = $("#uploadButton11").data('id');
                formData.append('id', id);

                $.ajax({
                    type: "POST",
                    url: `/mant/en/revisión/detalle/${id}/saveDocument`,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            response.documents.forEach(function(document) {
                                let existing = $('#fileList').find(
                                    `[data-id="${document.id}"]`);
                                if (existing.length) {
                                    existing.replaceWith(createFileEntry(document));
                                } else {
                                    $('#fileList').append(createFileEntry(document));
                                }
                            });
                            updateFileCount();
                            $('#fileUpload').val('');
                            //   window.location.reload();
                        } else {
                            console.error('Upload failed:', response.message);
                        }
                    },
                    error: function(xhr) {
                        console.error('Error uploading file:', xhr.responseText);
                    }
                });
            });

            $('#fileList').on('click', '.remove-file', function(event) {
                event.preventDefault();
                let button = $(this);
                let id = button.data('id');
                if (confirm('¿Estás seguro de que deseas eliminar este archivo?')) {
                    $.ajax({
                        type: "DELETE",
                        url: `/document/${id}/delete`,
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                button.closest('.file-entry').remove();
                                // Update file count
                                updateFileCount();
                                // window.location.reload();
                            } else {
                                console.error('Failed to delete file.');
                            }
                        },
                        error: function(xhr) {
                            console.error('Request failed: ' + xhr.status + ' ' + xhr
                                .statusText);
                        }
                    });
                }
            });



            function updateFileCount() {
                var count = $('#fileList').children().length;
                $('.fileCount').html('Archivos (' + count + ')');
            }

            function createFileEntry(document) {
                var fileSize = '0.2 MB'; // Adjust file size calculation if needed
                return $('<div class="file-entry" data-id="' + document.id + '">' +
                    '<span class="file-info">' +
                    '<a href="/documents/' + document.filename + '" download>' + document.filename + '</a>' +
                    ' (' + fileSize + ')' +
                    '</span>' +
                    '<button data-id="' + document.id +
                    '" class="remove-file"><i class="fal fa-trash-alt"></i></button>' +
                    '</div>');
            }

            function displayFileSize() {
                $('#fileList .file-entry').each(function() {
                    var fileSize = $(this).find('.file-info').text().match(/\(([^)]+)\)/);
                    if (fileSize) {
                        $(this).find('.file-info').append(' (' + fileSize[1] + ')');
                    }
                });
            }

            $('.customSearchBox').keyup(function() {
                table.search($(this).val()).draw();
            });

            $("#qrButton").click(function() {
                $('#showQrCodeModal').modal('show');
            });

            $("#editmaintreview").validate({
                rules: {
                    tipo_de_revisión: "required",
                    dirección: "required",
                    provincia: "required",
                    técnico: "required",
                    fecha_de_mantenimiento: "required",
                    hora_inicio: "required",
                    hora_fin: "required",
                    observaciónes: "required",
                },
                messages: {
                    tipo_de_revisión: "Por favor, seleccione el tipo de revisión.",
                    dirección: "Por favor, ingrese la dirección.",
                    provincia: 'Por favor, selecciona la provincia',
                    técnico: "Por favor, seleccione el técnico.",
                    fecha_de_mantenimiento: "Por favor, ingrese la fecha de mantenimiento.",
                    hora_inicio: "Por favor, ingrese la hora de inicio.",
                    hora_fin: "Por favor, ingrese la hora de fin.",
                    observaciónes: "Por favor, ingrese las observaciones.",
                },
                errorElement: "span",
                errorPlacement: function(error, element) {
                    error.addClass("error");
                    error.insertAfter(element);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass("is-invalid").addClass("is-valid");
                }
            });

            $(document).on('click', '.edit-maint_in_review', function() {
                var mantenimiento = $(this).data('maint_in_review');

                console.log(mantenimiento);
                $('#edit-tipo_de_revisión').val(mantenimiento.tipo_de_revisión).trigger('change');
                $('#edit-MAscensor').val(mantenimiento.ascensor).trigger('change');
                $('#edit-dirección').val(mantenimiento.dirección);
                $('#edit-provincia').val(mantenimiento.provincia);
                $('#edit-NCertificado').val(mantenimiento.núm_certificado);
                $('#edit-NMaquina').val(mantenimiento.máquina);
                $('#supervisor_id1').val(mantenimiento.supervisor_id).trigger('change');
                $('#edit-técnico').val(mantenimiento.técnico).trigger('change');
                $('#edit-Mprogramado').val(mantenimiento.mes_programado).trigger('change');
                $('#edit-FMantenimiento').val(mantenimiento.fecha_de_mantenimiento);
                $('#edit-FInicio').val(mantenimiento.hora_inicio);
                $('#edit-HFin').val(mantenimiento.hora_fin);
                $('#edit-observaciónes').val(mantenimiento.observaciónes);
                $('#edit-observacionesInternas').val(mantenimiento.observaciónes_internas);
                $('#edit-solucion').val(mantenimiento.solución);

                $('#editmaintreview').attr('action', '/mant/en/revisión/actualizar/' + mantenimiento.id);

            });
            $('#editorMantenimiento').on('hidden.bs.modal', function() {
                var form = $('#editmaintreview');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            });
            $('.custom-control-input').on('change', function() {
                var sparepartId = $(this).data('id');
                console.log(sparepartId);
                var type = $(this).data('type');
                var isChecked = $(this).is(':checked');

                $.ajax({
                    url: "{{ route('sparepart.updateFrequency') }}", // Update with your route
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: sparepartId,
                        type: type,
                        value: isChecked ? 1 : 0
                    },
                    success: function(response) {
                        console.log('Update successful:', response);
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr);
                    }
                });
            });

        });
    </script>
@endpush
