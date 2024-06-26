@extends('layouts.main')
@section('content')
    <style>
        .qrcode {
            text-align: center;
        }
         .error{
            color: red;
        }
    </style>
    <div class="w-100 contenido">
        <div class="container-fluid container-mod">
            <div class="row">
                <div class="col-xl-10 col-lg-10 col-md-8 col-sm-8 col-8 mb-4">
                    <div class="titulo">
                        <h4>{{ $maint_in_review->tipo_de_revisión }}</h4>
                        <span>Mantenimiento en revisión >> MANTENIMIENTO PREVENTIVO</span>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-end">
                    <div class="dropdown btn-new">
                        <a class="btn-action dropdownMenuLink d-inline-block" href="#" role="button"
                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acción <i class="fas fa-chevron-down"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item edit-mantenimiento" href="#"
                                data-mantenimiento="{{ json_encode($maint_in_review) }}" data-toggle="modal"
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
                                        <div class="option">
                                            <h4>2</h4>
                                            <p class="mb-0">Imágenes</p>
                                        </div>
                                        <div class="option">
                                            <h4>2</h4>
                                            <p class="mb-0">Archivos</p>
                                        </div>
                                        <div class="option">
                                            <h4>{{ $maint_in_review->created_at->format('d M Y, g:i a') }}</h4>
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
                                                    <td>{{ $maint_in_review->tipo_de_revisión }}</td>
                                                </tr>
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
                                                    <td>{{ $maint_in_review->ascensor }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">#Máquina</td>
                                                    <td>-</td>
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
                                                    <td>{{ $maint_in_review->provincia }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Técnico</td>
                                                    <td>{{ $maint_in_review->técnico }}</td>
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
                                                    <td>{{ $maint_in_review->mes_programado }}</td>
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
                                                    <td>-</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Solución</td>
                                                    <td>-</td>
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
                                        <h3 id="imageCount" class="mb-3">Imágenes (2)</h3>
                                        <div class="gallery">
                                            <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <div class="img-container">
                                                        <img src=" {{ asset('img/galery1.png') }} " alt="galeria">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <div class="img-container">
                                                        <img src="{{ asset('img/galery2.png') }} " alt="galeria">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="file" id="imageUpload" accept="image/*" multiple class="d-none">
                                        <button id="uploadButton10" class="btn-gris"><i
                                                class="fas fa-arrow-to-top mr-2"></i> Subir Imagen</button>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="box-contenido contenido-elevatronic">
                                        <h3 id="fileCount" class="mb-3">Archivos (2)</h3>

                                        <div id="fileList" class="file-list">
                                            <div class="file-entry">
                                                <span class="file-info">Nombre-de-archivo.pdf (0.2 MB)</span>
                                                <button class="remove-file"><i class="fal fa-trash-alt"></i></button>
                                            </div>
                                            <div class="file-entry">
                                                <span class="file-info">Nombre-de-archivo.pdf (0.2 MB)</span>
                                                <button class="remove-file"><i class="fal fa-trash-alt"></i></button>
                                            </div>
                                        </div>

                                        <input type="file" id="fileUpload" accept=".pdf,.xlsx,.xls,.doc,.docx"
                                            multiple class="d-none">
                                        <button id="uploadButton11" class="btn-gris mt-4"><i
                                                class="fas fa-arrow-to-top mr-2"></i> Cargar archivo</button>
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
                                            {{-- <tbody>
                                                @foreach ($spareparts as $index => $sparepart)
                                                    <tr>
                                                        <td>{{ $sparepart->nombre }}</td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="limpieza" name="limpieza">
                                                                <label class="custom-control-label"
                                                                    for="limpieza"></label>
                                                            </div>
                                                            {{ $sparepart->frecuencia_de_limpieza }}
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="limpieza" name="limpieza">
                                                                <label class="custom-control-label"
                                                                    for="limpieza"></label>
                                                            </div>
                                                            {{ $sparepart->frecuencia_de_lubricación }}
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="limpieza" name="limpieza">
                                                                <label class="custom-control-label"
                                                                    for="limpieza"></label>
                                                            </div>{{ $sparepart->frecuencia_de_ajuste }}
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="limpieza" name="limpieza">
                                                                <label class="custom-control-label"
                                                                    for="limpieza"></label>
                                                            </div>{{ $sparepart->frecuencia_de_revisión }}
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="limpieza" name="limpieza">
                                                                <label class="custom-control-label"
                                                                    for="limpieza"></label>
                                                            </div>{{ $sparepart->frecuencia_de_cambio }}
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="limpieza" name="limpieza">
                                                                <label class="custom-control-label"
                                                                    for="limpieza"></label>
                                                            </div>{{ $sparepart->frecuencia_de_solicitud }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody> --}}
                                            <tbody>
                                                @foreach ($spareparts as $index => $sparepart)
                                                    <tr>
                                                        <td>{{ $sparepart->nombre }}</td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="limpieza-{{ $index }}" name="limpieza[]"
                                                                    {{ $sparepart->frecuencia_de_limpieza ? 'checked' : '' }}
                                                                    disabled>
                                                                <label class="custom-control-label"
                                                                    for="limpieza-{{ $index }}"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="lubricacion-{{ $index }}"
                                                                    name="lubricacion[]"
                                                                    {{ $sparepart->frecuencia_de_lubricación ? 'checked' : '' }}
                                                                    disabled>
                                                                <label class="custom-control-label"
                                                                    for="lubricacion-{{ $index }}"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="ajuste-{{ $index }}" name="ajuste[]"
                                                                    {{ $sparepart->frecuencia_de_ajuste ? 'checked' : '' }}
                                                                    disabled>
                                                                <label class="custom-control-label"
                                                                    for="ajuste-{{ $index }}"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="revision-{{ $index }}" name="revision[]"
                                                                    {{ $sparepart->frecuencia_de_revisión ? 'checked' : '' }}
                                                                    disabled>
                                                                <label class="custom-control-label"
                                                                    for="revision-{{ $index }}"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="cambio-{{ $index }}" name="cambio[]"
                                                                    {{ $sparepart->frecuencia_de_cambio ? 'checked' : '' }}
                                                                    disabled>
                                                                <label class="custom-control-label"
                                                                    for="cambio-{{ $index }}"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="solicitud-{{ $index }}" name="solicitud[]"
                                                                    {{ $sparepart->frecuencia_de_solicitud ? 'checked' : '' }}
                                                                    disabled>
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
                                        id="edit-MAscensor">
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
                                        class="form-control @error('dirección') is-invalid @enderror" value="">
                                    @error('dirección')
                                        <span class="invalid-feedback" style="color: red">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="provinciaAs">Provincia</label>
                                    <select id="edit-provincia" name="provincia" class="form-control">
                                        <option value="">Select Province</option>
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

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="NCertificado">Núm
                                                Certificado</label>
                                            <input type="number" placeholder="Núm Certificado" name="núm_certificado"
                                                id="edit-NCertificado" value=""
                                                class="form-control @error('núm_certificado') is-invalid @enderror">
                                            @error('núm_certificado')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="NMaquina">#Máquina</label>
                                            <input type="text" placeholder="#Máquina" name="máquina"
                                                id="edit-NMaquina" value=""
                                                class="form-control @error('máquina') is-invalid @enderror">
                                            @error('máquina')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="Supervisor">Supervisor</label>
                                    <select class="custom-select  @error('máquina') is-invalid @enderror"
                                        name="supervisor" id="edit-Supervisor">
                                        <option value="" class="">
                                            Seleccionar opción</option>
                                        <option value="supervisor_1"
                                            {{ old('supervisor') == 'supervisor_1' ? 'selected' : ($maint_in_review->supervisor == 'supervisor_1' ? 'selected' : '') }}>
                                            Supervisor 1</option>
                                        <option value="supervisor_2"
                                            {{ old('supervisor') == 'supervisor_2' ? 'selected' : ($maint_in_review->supervisor == 'supervisor_2' ? 'selected' : '') }}>
                                            Supervisor 2</option>
                                        <option value="supervisor_3"
                                            {{ old('supervisor') == 'supervisor_3' ? 'selected' : ($maint_in_review->supervisor == 'supervisor_3' ? 'selected' : '') }}>
                                            Supervisor 3</option>
                                    </select>
                                    @error('supervisor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="tecnico">Técnico</label>
                                    <select class="custom-select" name="técnico" id="edit-técnico">
                                        <option value="" class="d-none  @error('técnico') is-invalid @enderror">
                                            Seleccionar opción</option>
                                        <option value="técnico_1"
                                            {{ old('técnico') == 'técnico_1' ? 'selected' : ($maint_in_review->técnico == 'técnico_1' ? 'selected' : '') }}>
                                            Técnico 1</option>
                                        <option value="técnico_2"
                                            {{ old('técnico') == 'técnico_2' ? 'selected' : ($maint_in_review->técnico == 'técnico_2' ? 'selected' : '') }}>
                                            Técnico 2</option>
                                        <option value="técnico_3"
                                            {{ old('técnico') == 'técnico_3' ? 'selected' : ($maint_in_review->técnico == 'técnico_3' ? 'selected' : '') }}>
                                            Técnico 3</option>
                                    </select>
                                    @error('técnico')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Mprogramado">Mes
                                                programado</label>
                                            <select class="custom-select @error('mes_programado') is-invalid @enderror"
                                                name="mes_programado" id="edit-Mprogramado">
                                                <option value="" class="">Seleccionar
                                                    opción</option>
                                                <option value="mes_programado_1"
                                                    {{ old('mes_programado', $maint_in_review->mes_programado ?? '') == 'mes_programado_1' ? 'selected' : '' }}>
                                                    Mes programado 1</option>
                                                <option value="mes_programado_2"
                                                    {{ old('mes_programado', $maint_in_review->mes_programado ?? '') == 'mes_programado_2' ? 'selected' : '' }}>
                                                    Mes programado 2</option>
                                                <option value="mes_programado_3"
                                                    {{ old('mes_programado', $maint_in_review->mes_programado ?? '') == 'mes_programado_3' ? 'selected' : '' }}>
                                                    Mes programado 3</option>
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
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            $('#uploadButton10').click(function() {
                $('#imageUpload').click();
            });

            $('#imageUpload').change(function() {
                var imageCount = $('#imageCount'); // Selector para el contador de imágenes
                var count = 0; // Inicializar contador

                if (this.files) {
                    var filesCount = this.files.length; // Número de archivos seleccionados
                    count = $('.gallery img').length + filesCount; // Sumar al total actual de imágenes

                    for (var i = 0; i < filesCount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            var imgHtml = $(
                                '<div class="col-md-6 mb-4"><div class="img-container"><img src="' +
                                e.target.result + '" /></div></div>');
                            $('.gallery .row').append(imgHtml);
                            imageCount.text('Imágenes (' + count +
                                ')'); // Actualizar el texto del contador
                        }
                        reader.readAsDataURL(this.files[i]);
                    }
                }
            });


            $('#uploadButton11').on('click', function() {
                $('#fileUpload').trigger('click');
            });

            $('#fileUpload').on('change', function() {
                var files = this.files;
                var fileCount = $('#fileList').children().length;

                $.each(files, function(i, file) {
                    fileCount++;
                    var fileName = file.name;
                    var fileSize = (file.size / 1024 / 1024).toFixed(2) + ' MB';
                    var fileEntry = $('<div class="file-entry">' +
                        '<span class="file-info">' +
                        fileName + ' (' + fileSize + ')' +
                        '</span>' +
                        '<button class="remove-file"><i class="fal fa-trash-alt"></i></button>' +
                        '</div>');
                    $('#fileList').append(fileEntry);
                });

                $('#fileCount').text('Archivos (' + fileCount + ')');
            });

            // Evento para el botón de eliminar
            $('#fileList').on('click', '.remove-file', function() {
                $(this).parent().remove(); // Elimina la entrada del archivo
                var fileCount = $('#fileList').children().length; // Recuenta los archivos
                $('#fileCount').text('Archivos (' + fileCount + ')'); // Actualiza el contador
            });


            var table = $('#contratosTable').DataTable({
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

            // $('#customSearchBox').keyup(function(){
            //     table.search($(this).val()).draw();
            // });
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
                    // núm_certificado: "required",
                    // máquina: "required",
                    // supervisor: "required",
                    // técnico: "required",
                    // mes_programado: "required",
                    // fecha_de_mantenimiento: "required",
                    // hora_inicio: "required",
                    // hora_fin: "required",
                    // observaciónes: "required",
                    // solución: "required",
                },
                messages: {
                    tipo_de_revisión: "Por favor, seleccione el tipo de revisión.",
                    dirección: "Por favor, ingrese la dirección.",
                    provincia: 'Por favor, selecciona la provincia',
                    núm_certificado: "Por favor, ingrese el número de certificado.",
                    // máquina: "Por favor, ingrese el número de máquina.",
                    // supervisor: "Por favor, seleccione el supervisor.",
                    // técnico: "Por favor, seleccione el técnico.",
                    // mes_programado: "Por favor, seleccione el mes programado.",
                    // fecha_de_mantenimiento: "Por favor, ingrese la fecha de mantenimiento.",
                    // hora_inicio: "Por favor, ingrese la hora de inicio.",
                    // hora_fin: "Por favor, ingrese la hora de fin.",
                    // observaciónes: "Por favor, ingrese las observaciones.",
                    // solución: "Por favor, ingrese la solución."
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

            $('.edit-mantenimiento').on('click', function() {

                var mantenimiento = $(this).data('mantenimiento');
                console.log(mantenimiento);
                $('#edit-tipo_de_revisión').val(mantenimiento.tipo_de_revisión);
                $('#edit-MAscensor').val(mantenimiento.ascensor);
                $('#edit-dirección').val(mantenimiento.dirección);
                $('#edit-provincia').val(mantenimiento.provincia);
                $('#edit-NCertificado').val(mantenimiento.núm_certificado);
                $('#edit-NMaquina').val(mantenimiento.máquina);
                $('#edit-Supervisor').val(mantenimiento.supervisor);
                $('#edit-técnico').val(mantenimiento.técnico);
                $('#edit-Mprogramado').val(mantenimiento.mes_programado);
                $('#edit-FMantenimiento').val(mantenimiento.fecha_de_mantenimiento);
                $('#edit-FInicio').val(mantenimiento.hora_inicio);
                $('#edit-HFin').val(mantenimiento.hora_fin);
                $('#edit-observaciónes').val(mantenimiento.observaciónes);
                $('#edit-observacionesInternas').val(mantenimiento.observaciónes_internas);
                $('#edit-solucion').val(mantenimiento.solución);

                $('#editmaintreview').attr('action', '/mant/en/revisión/actualizar/' + mantenimiento.id);
            });
        });
    </script>
@endpush
