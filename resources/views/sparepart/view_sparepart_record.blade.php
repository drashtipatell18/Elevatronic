@extends('layouts.main')
@section('content')
    <div class="w-100 contenido">
        <div class="container-fluid container-mod">
            <div class="row">
                <div class="col-xl-10 col-lg-10 col-md-8 col-sm-8 col-8 mb-4">
                    <div class="titulo">
                        <h4>{{ $sparepart->nombre }}</h4>
                        <span>Repuestos >> CHAPA TRINCO</span>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-end">
                    <div class="dropdown btn-new">
                        <a class="btn-action dropdownMenuLink d-inline-block" href="#" role="button"
                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acción <i class="fas fa-chevron-down"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item texto-1 font-family-Inter-Regular" href="javascript:void(0)"
                                data-toggle="modal" data-target="#editorRepuesto">Editar</a>
                            <a class="dropdown-item texto-1 font-family-Inter-Regular" href="javascript:void(0)"
                                data-toggle="modal" data-target="#modalEliminar">Eliminar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="box-contenido pb-0">
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-start justify-content-start gap-20 mb-6 box-detalle">
                                <div class="">
                                    <img src="{{ asset('images/' . $sparepart->foto_de_repuesto) }}" alt="repuesto">
                                </div>
                                <div class="align-items-start d-flex flex-column h-100 justify-content-between">
                                    <div>
                                        <h3>{{ $sparepart->nombre }}</h3>
                                        <span>Repuestos</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-start gap-15 flex-wrap">
                                        <div class="option">
                                            <h4>{{ $sparepart->id }}</h4>
                                            <p class="mb-0">ID elemento</p>
                                        </div>
                                        <div class="option">
                                            <h4>{{ $sparepart->created_at->format('d M Y, g:i a') }}</h4>
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
                    <div class="tab-content contenido-elevatronic">
                        <div id="informacion" class="tab-pane active">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <div class="box-contenido">
                                        <h3>Foto de repuesto</h3>
                                        <img src="{{ asset('images/' . $sparepart->foto_de_repuesto) }}" alt="personal">
                                    </div>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <div class="box-contenido">
                                        <h3>Información de repuesto</h3>
                                        <table class="table table-borderless tabla-repuestos">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gris">Nombre</td>
                                                    <td>{{ $sparepart->nombre }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">Precio</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">Descripción</td>
                                                    <td>
                                                        {{ $sparepart->descripción }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">Frecuencia de limpieza (días)</td>
                                                    <td> {{ $sparepart->frecuencia_de_limpieza }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">Frecuencia de lubricación (días)</td>
                                                    <td> {{ $sparepart->frecuencia_de_lubricación }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">Frecuencia de ajuste (días)</td>
                                                    <td> {{ $sparepart->frecuencia_de_ajuste }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">Frecuencia de revisión (días)</td>
                                                    <td> {{ $sparepart->frecuencia_de_revisión }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">Frecuencia de cambio (días)</td>
                                                    <td> {{ $sparepart->frecuencia_de_cambio }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gris">Frecuencia de solicitud (días)</td>
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

        <!-- Modal Editor Repuesto-->
        <div class="modal left fade" id="editorRepuesto" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-family-Outfit-SemiBold">Editar Repuesto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{ route('update.sparepart', $sparepart->id) }}" method="POST" class="formulario-modal"
                        enctype="multipart/form-data">
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
                                                <label for="editimageUpload1" class="text-gris mt-4">Seleccione una
                                                    imagen</label>
                                                <input type="file" id="editimageUpload1" name="foto_de_repuesto"
                                                    style="display: none;" accept="image/*" />
                                                <button type="button" id="editcargarimagen" class="btn-gris">
                                                    <i class="fas fa-arrow-to-top mr-2"></i>Subir Imagen
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="NombreRepuesto">Nombre</label>
                                                <input type="text" placeholder="Nombre"
                                                    class="form-control @error('nombre') is-invalid @enderror"
                                                    value="{{ old('nombre', $sparepart->nombre ?? '') }}" name="nombre"
                                                    id="nombre">
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
                                                    value="{{ old('precio', $sparepart->precio ?? '') }}" name="precio"
                                                    id="precio">
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
                                                <textarea name="descripción" id="descripción" placeholder="Descripción" cols="30" rows="5">{{ old('descripción', $sparepart->descripción ?? '') }}</textarea>
                                                @error('descripción')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Flimpieza">Frecuencia de limpieza (días)</label>
                                                <input type="text" placeholder="Frecuencia de limpieza (días)"
                                                    name="frecuencia_de_limpieza" id="frecuencia_de_limpieza"
                                                    class="form-control @error('frecuencia_de_limpieza') is-invalid @enderror"
                                                    value="{{ old('frecuencia_de_limpieza', $sparepart->frecuencia_de_limpieza ?? '') }}">
                                                @error('frecuencia_de_limpieza')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Flubricacion">Frecuencia de lubricación (días)</label>
                                                <input type="text" placeholder="Frecuencia de lubricación (días)"
                                                    name="frecuencia_de_lubricación" id="frecuencia_de_lubricación"
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
                                                <label for="FAjustes">Frecuencia de ajuste (días)</label>
                                                <input type="text" placeholder="Frecuencia de ajuste (días)"
                                                    name="frecuencia_de_ajuste" id="frecuencia_de_ajuste"
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
                                                <label for="FRevision">Frecuencia de revisión (días)</label>
                                                <input type="text" placeholder="Frecuencia de revisión (días)"
                                                    class="form-control @error('frecuencia_de_revisión') is-invalid @enderror"
                                                    value="{{ old('frecuencia_de_revisión', $sparepart->frecuencia_de_revisión ?? '') }}"
                                                    name="frecuencia_de_revisión" id="frecuencia_de_revisión">
                                                    @error('frecuencia_de_revisión')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="FCambio">Frecuencia de cambio (días)</label>
                                                <input type="text" placeholder="Frecuencia de cambio (días)"
                                                    class="form-control @error('frecuencia_de_cambio') is-invalid @enderror"
                                                    value="{{ old('frecuencia_de_cambio', $sparepart->frecuencia_de_cambio ?? '') }}"
                                                    name="frecuencia_de_cambio" id="frecuencia_de_cambio">
                                                    @error('frecuencia_de_cambio')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="FSolicitud">Frecuencia de solicitud (días)</label>
                                                <input type="text" placeholder="Frecuencia de solicitud (días)"
                                                    class="form-control @error('frecuencia_de_solicitud') is-invalid @enderror"
                                                    value="{{ old('frecuencia_de_solicitud', $sparepart->frecuencia_de_solicitud ?? '') }}"
                                                    name="frecuencia_de_solicitud" id="frecuencia_de_solicitud">
                                                    @error('frecuencia_de_solicitud')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                            <button type="submit" class="btn-gris btn-red mr-2">Actualizar cambios</button>
                            <button type="button" class="btn-gris btn-border" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>

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
                        <form id="delete-form" action="{{ route('destroy.sparepart', $sparepart->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-gris btn-red">Sí</button>
                        </form>
                        <button type="button" class="btn-gris btn-border" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
