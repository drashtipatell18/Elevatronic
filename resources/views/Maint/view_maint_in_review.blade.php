@extends('layouts.main')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@section('content')
    <style>
        .dt-head-center {
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
                        <h4>Mantenimiento en revisión</h4>
                        <span>Mantenimiento en revisión</span>
                    </div>
                </div>
                <div class="col-md-6 mb-4 text-right">
                    <button type="button" class="btn-primario w-auto pl-3 pr-3" data-toggle="modal"
                        data-target="#crearMantenimiento">
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
                                            <th>TIPO DE REVISIÓN</th>
                                            <th>ASCENSOR</th>
                                            {{-- <th>#CERTIFICADO</th> --}}
                                            <th>FECHA</th>
                                            <th>HOR. INI</th>
                                            <th>HOR. FIN</th>
                                            <th>TÉCNICO</th>
                                            <th>OBSERVACIÓN</th>
                                            <th align="right" class="text-right">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($maint_in_reviews as $index => $maint_in_rev)
                                            <tr class="td-head-center">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $maint_in_rev->tipo_de_revisión }}</td>
                                                <td>{{ $maint_in_rev->ascensor }}</td>
                                                {{-- <td>{{ $maint_in_rev->núm_certificado }}</td> --}}
                                                <td>{{ $maint_in_rev->fecha_de_mantenimiento }}</td>
                                                <td>{{ $maint_in_rev->hora_inicio }}</td>
                                                <td>{{ $maint_in_rev->hora_fin }}</td>
                                                <td>{{ $maint_in_rev->técnico }}</td>
                                                <td>
                                                    <a class="text-blue view-observation" href="#" data-toggle="modal"
                                                        data-target="#observacion{{ $maint_in_rev->id }}">
                                                        Ver observación
                                                    </a>
                                                </td>
                                                <td align="right">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn-action dropdown-toggle"
                                                            data-toggle="dropdown">
                                                            Acción <i class="fas fa-chevron-down"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                                href="{{ route('details.maint.in.review', $maint_in_rev->id) }}">Ver
                                                                detalles</a>
                                                            <a class="dropdown-item edit-mantenimiento" href="#"
                                                                data-mantenimiento="{{ json_encode($maint_in_rev) }}"
                                                                data-toggle="modal"
                                                                data-target="#editorMantenimiento">Editar</a>
                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                data-toggle="modal"
                                                                data-target="#modalEliminar{{ $maint_in_rev->id }}">Eliminar</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Modal Editor Mantenimiento-->
                                            <div class="modal left fade" id="editorMantenimiento" tabindex="-1"
                                                role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title font-family-Outfit-SemiBold">Edición De
                                                                Mantenimiento</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <form action="" class="formulario-modal"
                                                            enctype="multipart/form-data" method="POST"
                                                            id="editmaintreview">
                                                            @csrf
                                                            @method('PUT')
                                                            @isset($maint_in_rev)
                                                                <div class="modal-body body_modal">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="TRevision">Tipo de revisión</label>
                                                                                <select
                                                                                    class="custom-select @error('tipo_de_revisión') is-invalid @enderror"
                                                                                    name="tipo_de_revisión"
                                                                                    id="edit-tipo_de_revisión">
                                                                                    <option disabled>Seleccionar tipo de
                                                                                        revisión</option>
                                                                                    @foreach ($review_types as $key => $value)
                                                                                        <option value="{{ $key }}"
                                                                                            {{ old('tipo_de_revisión', $maint_in_rev->tipo_de_revisión ?? '') == $key ? 'selected' : '' }}>
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
                                                                                <select
                                                                                    class="custom-select @error('ascensor') is-invalid @enderror"
                                                                                    name="ascensor" id="edit-MAscensor">
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
                                                                                <input type="text" placeholder="Dirección"
                                                                                    name="dirección" id="edit-dirección"
                                                                                    class="form-control @error('dirección') is-invalid @enderror"
                                                                                    value="">
                                                                                @error('dirección')
                                                                                    <span class="invalid-feedback"
                                                                                        style="color: red">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>


                                                                            <div class="form-group">
                                                                                <label for="provinciaAs">Provincia</label>
                                                                                <select id="edit-provincia" name="provincia"
                                                                                    class="form-control">
                                                                                    <option value="">Seleccionar
                                                                                        Provincia
                                                                                    </option>
                                                                                    @foreach ($provinces as $province)
                                                                                        <option value="{{ $province }}"
                                                                                            {{ old('provincia', $maint_in_rev->provincia ?? '') == $province ? 'selected' : '' }}>
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
                                                                                <select
                                                                                    class="custom-select  @error('supervisor') is-invalid @enderror"
                                                                                    name="supervisor_id" id="supervisor_id1">

                                                                                </select>
                                                                                @error('supervisor')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>

                                                                            <div class="text-right w-100">
                                                                                <div class="form-group">
                                                                                    <button type="button" data-toggle="modal"
                                                                                        data-target="#crearSupervisor"
                                                                                        class="btn-gris supervisorbtn"
                                                                                        id="toggleMarcaInput">
                                                                                        + Agregar Supervisor
                                                                                    </button>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="técnico">Técnico</label>
                                                                                <select class="custom-select" name="técnico"
                                                                                    id="edit-técnico">
                                                                                    <option value="">Seleccionar opción
                                                                                    </option>
                                                                                    @foreach ($Personals as $personal)
                                                                                        <option value="{{ $personal }}"
                                                                                            {{ old('técnico', $maint_in_rev->técnico ?? '') == $personal ? 'selected' : '' }}>
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
                                                                                        <select
                                                                                            class="custom-select @error('mes_programado') is-invalid @enderror"
                                                                                            name="mes_programado"
                                                                                            id="edit-Mprogramado">
                                                                                            {{-- <option value=""
                                                                                                class="">Seleccionar
                                                                                                opción</option>
                                                                                            <option value="mes_programado_1"
                                                                                                {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'mes_programado_1' ? 'selected' : '' }}>
                                                                                                Mes programado 1</option>
                                                                                            <option value="mes_programado_2"
                                                                                                {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'mes_programado_2' ? 'selected' : '' }}>
                                                                                                Mes programado 2</option>
                                                                                            <option value="mes_programado_3"
                                                                                                {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'mes_programado_3' ? 'selected' : '' }}>
                                                                                                Mes programado 3</option> --}}


                                                                                                <option value="">Seleccionar opción</option>
                                                                                                <option value="enero" {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'enero' ? 'selected' : '' }}>Enero</option>
                                                                                                <option value="febrero" {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'febrero' ? 'selected' : '' }}>Febrero</option>
                                                                                                <option value="marzo" {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'marzo' ? 'selected' : '' }}>Marzo</option>
                                                                                                <option value="abril" {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'abril' ? 'selected' : '' }}>Abril</option>
                                                                                                <option value="mayo" {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'mayo' ? 'selected' : '' }}>Mayo</option>
                                                                                                <option value="junio" {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'junio' ? 'selected' : '' }}>Junio</option>
                                                                                                <option value="julio" {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'julio' ? 'selected' : '' }}>Julio</option>
                                                                                                <option value="agosto" {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'agosto' ? 'selected' : '' }}>Agosto</option>
                                                                                                <option value="septiembre" {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'septiembre' ? 'selected' : '' }}>Septiembre</option>
                                                                                                <option value="octubre" {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'octubre' ? 'selected' : '' }}>Octubre</option>
                                                                                                <option value="noviembre" {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'noviembre' ? 'selected' : '' }}>Noviembre</option>
                                                                                                <option value="diciembre" {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'diciembre' ? 'selected' : '' }}>Diciembre</option>





                                                                                        </select>
                                                                                        @error('mes_programado')
                                                                                            <span class="invalid-feedback"
                                                                                                role="alert">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>


                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="FMantenimiento">Fecha de
                                                                                            mantenimiento</label>
                                                                                        <input type="date"
                                                                                            placeholder="dd/mm/aaaa"
                                                                                            name="fecha_de_mantenimiento"
                                                                                            id="edit-FMantenimiento"
                                                                                            class="form-control @error('fecha_de_mantenimiento') is-invalid @enderror"
                                                                                            value="">
                                                                                        @error('fecha_de_mantenimiento')
                                                                                            <span class="invalid-feedback"
                                                                                                style="color: red">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>


                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="FInicio">Hora
                                                                                            inicio</label>
                                                                                        <input type="time"
                                                                                            placeholder="Hora inicio"
                                                                                            name="hora_inicio"
                                                                                            id="edit-FInicio"
                                                                                            class="form-control @error('hora_inicio') is-invalid @enderror"
                                                                                            value="">
                                                                                        @error('hora_inicio')
                                                                                            <span class="invalid-feedback"
                                                                                                style="color: red">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="HFin">Hora fin</label>
                                                                                        <input type="time"
                                                                                            placeholder="Hora fin"
                                                                                            name="hora_fin" id="edit-HFin"
                                                                                            class="form-control @error('hora_fin') is-invalid @enderror"
                                                                                            value="">
                                                                                        @error('hora_fin')
                                                                                            <span class="invalid-feedback"
                                                                                                style="color: red">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>


                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="observaciónes">Observaciones</label>
                                                                                        <textarea name="observaciónes" id="edit-observaciónes" placeholder="Comentario de contrato" cols="30"
                                                                                            rows="5"></textarea>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="observacionesInternas">Observaciones
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
                                                                <div
                                                                    class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                                                                    <button type="submit"
                                                                        class="btn-gris btn-red mr-2">Guardar Cambios</button>
                                                                    <button type="button" class="btn-gris btn-border"
                                                                        data-dismiss="modal">Cancelar</button>
                                                                </div>
                                                            @endisset

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal for observation -->
                                            <div class="modal fade" id="observacion{{ $maint_in_rev->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content" style="border-radius: 10px;">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Observación</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    @isset($maint_in_rev->observaciónes)
                                                                        <p>{{ $maint_in_rev->observaciónes }}</p>
                                                                    @else
                                                                        <p>No hay observación disponible.</p>
                                                                    @endisset
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Eliminar-->
                                            <div class="modal fade" id="modalEliminar{{ $maint_in_rev->id }}"
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
                                                            @isset($maint_in_rev)
                                                                <form id="delete-form"
                                                                    action="{{ route('destroy.maint.in.review', $maint_in_rev->id) }}"
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
    </div>

    <!-- Modal Creando Mantenimiento-->
    <div class="modal left fade" id="crearMantenimiento" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-family-Outfit-SemiBold">Creando Mantenimiento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('insert.maint.in.review') }}" method="POST" class="formulario-modal"
                    id="createmaintreview">
                    @csrf
                    <div class="modal-body body_modal">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tipo_de_revisión">Tipo de revisión</label>
                                    <select class="custom-select" name="tipo_de_revisión" id="edit-tipo_de_revisión"
                                        class="form-control">
                                        <option value="">Seleccionar tipo de revisión</option>
                                        @foreach ($review_types as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="ascensor">Ascensor</label>
                                    <select class="custom-select" name="ascensor" id="ascensor" class="form-control"
                                        autocomplete="new-ascensor" autoFill="off">
                                        <option value="">Seleccionar opción</option>
                                        @foreach ($elevators as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="dirección">Dirección</label>
                                    <input type="text" placeholder="Dirección" name="dirección" id="dirección"
                                        class="form-control" autocomplete="new-dirección" autoFill="off">
                                    @error('dirección')
                                        <span class="invalid-feedback" style="color: red">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="provincia">Provincia</label>
                                    <select id="provincia" name="provincia" class="form-control"
                                        autocomplete="new-provincia" autoFill="off">
                                        <option value="">Select Province</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province }}">{{ $province }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="row"> --}}
                                    {{-- <div class="col-md-6"> --}}
                                        <div class="form-group">
                                            <label for="núm_certificado">Núm Certificado</label>
                                            <input type="number" placeholder="Núm Certificado" name="núm_certificado"
                                                id="núm_certificado" class="form-control">
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
                                    <label for="supervisor">Supervisor</label>
                                    <select class="custom-select" name="supervisor_id" id="supervisor_id">

                                    </select>
                                </div>

                                <div class="text-right w-100">
                                    <div class="form-group">
                                        <button type="button" data-toggle="modal" data-target="#crearSupervisor"
                                            class="btn-gris supervisorbtn" id="toggleMarcaInput">
                                            + Agregar Supervisor
                                        </button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="técnico">Técnico</label>
                                    <select class="custom-select" name="técnico" id="técnico">
                                        <option value="">Seleccionar opción</option>
                                        @foreach ($Personals as $Personal)
                                            <option value="{{ $Personal }}">{{ $Personal }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Mprogramado">Mes programado</label>
                                            <select class="custom-select" name="mes_programado" id="Mprogramado">
                                                <option value="">Seleccionar opción</option>
                                                <option value="enero">Enero</option>
                                                <option value="febrero" >Febrero</option>
                                                <option value="marzo" >Marzo</option>
                                                <option value="abril" >Abril</option>
                                                <option value="mayo" >Mayo</option>
                                                <option value="junio" >Junio</option>
                                                <option value="julio" >Julio</option>
                                                <option value="agosto">Agosto</option>
                                                <option value="septiembre" >Septiembre</option>
                                                <option value="octubre" >Octubre</option>
                                                <option value="noviembre" >Noviembre</option>
                                                <option value="diciembre">Diciembre</option>

                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="FMantenimiento">Fecha de mantenimiento</label>
                                            <input type="date" placeholder="dd/mm/aaaa" name="fecha_de_mantenimiento"
                                                id="FMantenimiento" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="FInicio">Hora inicio</label>
                                            <input type="time" placeholder="dd/mm/aaaa" name="hora_inicio"
                                                id="FInicio" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="HFin">Hora fin</label>
                                            <input type="time" placeholder="dd/mm/aaaa" name="hora_fin"
                                                id="HFin" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="observaciones">Observaciónes</label>
                                            <textarea name="observaciónes" id="observaciones" placeholder="Comentario de contrato" cols="30"
                                                rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="observacionesInternas">Observaciónes internas</label>
                                            <textarea name="observaciónes_internas" id="observacionesInternas" placeholder="Observaciónes internas"
                                                cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="solucion">Solución</label>
                                            <textarea name="solución" id="solucion" placeholder="Solución" cols="30" rows="5"
                                                class="form-control"></textarea>
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
            // Prevent form submission on Enter key press
            $('#SupervisorForm').on('keypress', function(e) {
                if (e.which === 13) { // 13 is the Enter key code
                    e.preventDefault();
                    return false;
                }
            });

            function getSupervisors(edit) {
                // Destroy existing Select2 instance if it exists
                if ($('#supervisor_id').data('select2')) {
                    $('#supervisor_id').select2('destroy');
                }
                if ($('#supervisor_id1').data('select2')) {
                    $('#supervisor_id1').select2('destroy');
                }

                // Perform the AJAX call to get supervisor data
                $.ajax({
                    type: "GET",
                    url: "{{ route('supervisors') }}", // Ensure this route is correct
                    dataType: "JSON",
                    success: function(response) {
                        // Clear the current options and append the retrieved options to the select element
                        $("#supervisor_id,#supervisor_id1").empty();
                        $("#supervisor_id,supervisor_id1").append(
                            '<option value="" class="d-none">Seleccionar Supervisor</option>'
                        ); // Add placeholder option

                        $.each(response, function() {
                            $("#supervisor_id,#supervisor_id1").append(
                                `<option value='${this.id}'>${this.nomber}</option>`
                            );
                        });

                        // Initialize Select2 on the select element
                        $('#supervisor_id').select2({
                            placeholder: "Seleccionar Supervisor",
                            allowClear: true
                        });

                        $('#supervisor_id1').select2({
                            placeholder: "Seleccionar Supervisor",
                            allowClear: true
                        });

                        // If edit is true and has a valid ID, set the selected value
                        if (edit) {
                            $('#supervisor_id1').val(edit).trigger('change');
                            console.log('Selected supervisor set to:', edit);
                        }
                    },
                    error: function(xhr) {
                        console.error('Error fetching supervisors:', xhr.responseText);
                    }
                });
            }

            // Call the function when needed, e.g., when opening the modal
            const editValue = '{{ $editValue ?? '' }}'; // Replace with actual edit value if available
            getSupervisors(editValue);

            // Handle form submission
            $('#submitSupervisor').click(function(e) {
                e.preventDefault(); // Prevent default form submission
                var formData = new FormData();
                formData.append('nomber', $('#nomber').val());

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
                    url: "{{ route('insert.supervisor') }}", // Make sure to create this route
                    success: function(response) {
                        getSupervisors();
                        $('#cancelSupervisor').click();
                    },
                    error: function(xhr) {
                        console.error('Error creating supervisor:', xhr.responseText);
                        // Handle error (e.g., show error message to user)
                    }
                });
            });

            // Handle modal close on cancel button click
            $('#cancelSupervisor').click(function() {
                $("#crearSupervisor").modal('hide');
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
            // $("#miTabla_filter").css('float', 'left');

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

            $("#createmaintreview").validate({
                rules: {
                    tipo_de_revisión: "required",
                    ascensor: "required",
                    dirección: "required",
                    provincia: "required",
                    núm_certificado: "required",
                    máquina: "required",
                    // supervisor: "required",
                    técnico: "required",
                    // mes_programado: "required",
                    fecha_de_mantenimiento: "required",
                    hora_inicio: "required",
                    hora_fin: "required",
                    observaciónes: "required",
                    // solución: "required"
                },
                messages: {
                    // Specify validation error messages
                    tipo_de_revisión: "Por favor, seleccione el tipo de revisión.",
                    ascensor: "Por favor, seleccione el ascensor.",
                    dirección: "Por favor, ingrese la dirección.",
                    provincia: 'Por favor, selecciona la provincia',
                    núm_certificado: "Por favor, ingrese el número de certificado.",
                    // máquina: "Por favor, ingrese el número de máquina.",
                    // supervisor: "Por favor, seleccione el supervisor.",
                    técnico: "Por favor, seleccione el técnico.",
                    // mes_programado: "Por favor, seleccione el mes programado.",
                    fecha_de_mantenimiento: "Por favor, ingrese la fecha de mantenimiento.",
                    hora_inicio: "Por favor, ingrese la hora de inicio.",
                    hora_fin: "Por favor, ingrese la hora de fin.",
                    observaciónes: "Por favor, ingrese las observaciones.",
                    // solución: "Por favor, ingrese la solución."
                },
                errorElement: "span",
                errorPlacement: function(error, element) {
                    // Add the `invalid-feedback` class to the error element
                    error.addClass("invalid-feedback");
                    // Add error message after the invalid element
                    error.insertAfter(element);
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

            $("#editmaintreview").validate({
                rules: {
                    tipo_de_revisión: "required",
                    dirección: "required",
                    provincia: "required",
                    núm_certificado: "required",
                    máquina: "required",
                    // supervisor: "required",
                    técnico: "required",
                    // mes_programado: "required",
                    fecha_de_mantenimiento: "required",
                    hora_inicio: "required",
                    hora_fin: "required",
                    observaciónes: "required",
                    // solución: "required",
                },
                messages: {
                    tipo_de_revisión: "Por favor, seleccione el tipo de revisión.",
                    dirección: "Por favor, ingrese la dirección.",
                    provincia: 'Por favor, selecciona la provincia',
                    núm_certificado: "Por favor, ingrese el número de certificado.",
                    // máquina: "Por favor, ingrese el número de máquina.",
                    // supervisor: "Por favor, seleccione el supervisor.",
                    técnico: "Por favor, seleccione el técnico.",
                    // mes_programado: "Por favor, seleccione el mes programado.",
                    fecha_de_mantenimiento: "Por favor, ingrese la fecha de mantenimiento.",
                    hora_inicio: "Por favor, ingrese la hora de inicio.",
                    hora_fin: "Por favor, ingrese la hora de fin.",
                    observaciónes: "Por favor, ingrese las observaciones.",
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
                $('#supervisor_id1').val(mantenimiento.supervisor_id).trigger('change');
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

            $('#crearMantenimiento').on('hidden.bs.modal', function() {
                var form = $('#createmaintreview');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            });
            $('#editorMantenimiento').on('hidden.bs.modal', function() {
                var form = $('#editmaintreview');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            });

        });
    </script>
@endpush
