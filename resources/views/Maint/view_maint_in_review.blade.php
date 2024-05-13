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
                                            <th>#CERTIFICADO</th>
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
                                                <td>{{ $maint_in_rev->núm_certificado }}</td>
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
                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                data-toggle="modal"
                                                                data-target="#editorMantenimiento{{ $maint_in_rev->id }}">Editar</a>
                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                data-toggle="modal"
                                                                data-target="#modalEliminar{{ $maint_in_rev->id }}">Eliminar</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Modal for observation -->
                                            <div class="modal fade" id="observacion{{ $maint_in_rev->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                            <!-- Modal Editor Mantenimiento-->
                                            <div class="modal left fade" id="editorMantenimiento{{ $maint_in_rev->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                                                aria-hidden="true">
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
                                                        @isset($maint_in_rev)
                                                            <form
                                                                action="{{ route('update.maint.in.review', $maint_in_rev->id) }}"
                                                                method="POST" class="formulario-modal" id="editmaintreview">

                                                                @csrf
                                                                <div class="modal-body body_modal">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="TRevision">Tipo de revisión</label>
                                                                                <select
                                                                                    class="custom-select @error('tipo_de_revisión') is-invalid @enderror"
                                                                                    name="tipo_de_revisión" id="TRevision">
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
                                                                                    name="ascensor" id="MAscensor">
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
                                                                                    name="dirección" id="dirección"
                                                                                    class="form-control @error('dirección') is-invalid @enderror"
                                                                                    value="{{ old('dirección', $maint_in_rev->dirección ?? '') }}">
                                                                                @error('dirección')
                                                                                    <span class="invalid-feedback"
                                                                                        style="color: red">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>


                                                                            <div class="form-group">
                                                                                <label for="provinciaAs">Provincia</label>
                                                                                <input type="text" placeholder="Provincia"
                                                                                    name="provincia" id="provincia"
                                                                                    class="form-control @error('provincia') is-invalid @enderror"
                                                                                    value="{{ old('provincia', $maint_in_rev->provincia ?? '') }}">
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
                                                                                        <input type="text"
                                                                                            placeholder="Núm Certificado"
                                                                                            name="núm_certificado"
                                                                                            id="NCertificado"
                                                                                            value="{{ old('núm_certificado', $maint_in_rev->provincia ?? '') }}"
                                                                                            class="form-control @error('núm_certificado') is-invalid @enderror">
                                                                                        @error('núm_certificado')
                                                                                            <span class="invalid-feedback"
                                                                                                role="alert">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="NMaquina">#Máquina</label>
                                                                                        <input type="text"
                                                                                            placeholder="#Máquina"
                                                                                            name="máquina" id="NMaquina"
                                                                                            value="{{ old('máquina', $maint_in_rev->máquina ?? '') }}"
                                                                                            class="form-control @error('máquina') is-invalid @enderror">
                                                                                        @error('máquina')
                                                                                            <span class="invalid-feedback"
                                                                                                role="alert">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                                            <div class="form-group">
                                                                                <label for="Supervisor">Supervisor</label>
                                                                                <select
                                                                                    class="custom-select  @error('máquina') is-invalid @enderror"
                                                                                    name="supervisor" id="Supervisor">
                                                                                    <option value="" class="d-none">
                                                                                        Seleccionar opción</option>
                                                                                    <option value="supervisor_1"
                                                                                        {{ old('supervisor') == 'supervisor_1' ? 'selected' : ($maint_in_rev->supervisor == 'supervisor_1' ? 'selected' : '') }}>
                                                                                        Supervisor 1</option>
                                                                                    <option value="supervisor_2"
                                                                                        {{ old('supervisor') == 'supervisor_2' ? 'selected' : ($maint_in_rev->supervisor == 'supervisor_2' ? 'selected' : '') }}>
                                                                                        Supervisor 2</option>
                                                                                    <option value="supervisor_3"
                                                                                        {{ old('supervisor') == 'supervisor_3' ? 'selected' : ($maint_in_rev->supervisor == 'supervisor_3' ? 'selected' : '') }}>
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
                                                                                <select class="custom-select" name="técnico"
                                                                                    id="tecnico">
                                                                                    <option value=""
                                                                                        class="d-none  @error('técnico') is-invalid @enderror">
                                                                                        Seleccionar opción</option>
                                                                                    <option value="técnico_1"
                                                                                        {{ old('técnico') == 'técnico_1' ? 'selected' : ($maint_in_rev->técnico == 'técnico_1' ? 'selected' : '') }}>
                                                                                        Técnico 1</option>
                                                                                    <option value="técnico_2"
                                                                                        {{ old('técnico') == 'técnico_2' ? 'selected' : ($maint_in_rev->técnico == 'técnico_2' ? 'selected' : '') }}>
                                                                                        Técnico 2</option>
                                                                                    <option value="técnico_3"
                                                                                        {{ old('técnico') == 'técnico_3' ? 'selected' : ($maint_in_rev->técnico == 'técnico_3' ? 'selected' : '') }}>
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
                                                                                        <select
                                                                                            class="custom-select @error('mes_programado') is-invalid @enderror"
                                                                                            name="mes_programado"
                                                                                            id="Mprogramado">
                                                                                            <option value=""
                                                                                                class="d-none">Seleccionar
                                                                                                opción</option>
                                                                                            <option value="mes_programado_1"
                                                                                                {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'mes_programado_1' ? 'selected' : '' }}>
                                                                                                Mes programado 1</option>
                                                                                            <option value="mes_programado_2"
                                                                                                {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'mes_programado_2' ? 'selected' : '' }}>
                                                                                                Mes programado 2</option>
                                                                                            <option value="mes_programado_3"
                                                                                                {{ old('mes_programado', $maint_in_rev->mes_programado ?? '') == 'mes_programado_3' ? 'selected' : '' }}>
                                                                                                Mes programado 3</option>
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
                                                                                            id="FMantenimiento"
                                                                                            class="form-control @error('fecha_de_mantenimiento') is-invalid @enderror"
                                                                                            value="{{ old('fecha_de_mantenimiento', $maint_in_rev->fecha_de_mantenimiento ?? '') }}">
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
                                                                                            name="hora_inicio" id="FInicio"
                                                                                            class="form-control @error('hora_inicio') is-invalid @enderror"
                                                                                            value="{{ old('hora_inicio', $maint_in_rev->hora_inicio ?? '') }}">
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
                                                                                            name="hora_fin" id="HFin"
                                                                                            class="form-control @error('hora_fin') is-invalid @enderror"
                                                                                            value="{{ old('hora_fin', $maint_in_rev->hora_fin ?? '') }}">
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
                                                                                        <textarea name="observaciónes" id="observaciónes" placeholder="Comentario de contrato" cols="30"
                                                                                            rows="5">{{ old('observaciónes', $maint_in_rev->observaciónes ?? '') }}</textarea>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="observacionesInternas">Observaciones
                                                                                            internas</label>
                                                                                        <textarea name="observaciónes_internas" id="observacionesInternas" placeholder="Observaciones internas"
                                                                                            cols="30" rows="5">{{ old('observaciónes_internas', $maint_in_rev->observaciónes_internas ?? '') }}</textarea>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="solucion">Solución</label>
                                                                                        <textarea name="solución" id="solucion" placeholder="Solución" cols="30" rows="5">{{ old('solución', $maint_in_rev->solución ?? '') }}</textarea>
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
                                                            </form>
                                                        @endisset
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
                                    <select class="custom-select" name="tipo_de_revisión" id="tipo_de_revisión"
                                        class="form-control">
                                        <option selected disabled>Seleccionar tipo de revisión</option>
                                        @foreach ($review_types as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="ascensor">Ascensor</label>
                                    <select class="custom-select" name="ascensor" id="ascensor" class="form-control">
                                        <option selected disabled>Seleccionar opción</option>
                                        @foreach ($elevators as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="dirección">Dirección</label>
                                    <input type="text" placeholder="Dirección" name="dirección" id="dirección"
                                        class="form-control">
                                    @error('dirección')
                                        <span class="invalid-feedback" style="color: red">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="provincia">Provincia</label>
                                    <input type="text" placeholder="Provincia" name="provincia" id="provincia"
                                        class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="núm_certificado">Núm Certificado</label>
                                            <input type="text" placeholder="Núm Certificado" name="núm_certificado"
                                                id="núm_certificado" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="máquina">#Máquina</label>
                                            <input type="text" placeholder="#Máquina" name="máquina" id="máquina"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="supervisor">Supervisor</label>
                                    <select class="custom-select" name="supervisor" id="supervisor">
                                        <option selected disabled class="d-none">Seleccionar opción</option>
                                        <option value="supervisor_1">Supervisor 1</option>
                                        <option value="supervisor_2">Supervisor 2</option>
                                        <option value="supervisor_3">Supervisor 3</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="técnico">Técnico</label>
                                    <select class="custom-select" name="técnico" id="técnico">
                                        <option selected disabled class="d-none">Seleccionar opción</option>
                                        <option value="técnico_1">Técnico 1</option>
                                        <option value="técnico_2">Técnico 2</option>
                                        <option value="técnico_3">Técnico 3</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Mprogramado">Mes programado</label>
                                            <select class="custom-select" name="mes_programado" id="Mprogramado">
                                                <option selected disabled class="d-none">Seleccionar opción</option>
                                                <option value="mes_programado_1">Mes programado 1</option>
                                                <option value="mes_programado_2">Mes programado 2</option>
                                                <option value="mes_programado_3">Mes programado 3</option>
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
                    supervisor: "required",
                    técnico: "required",
                    mes_programado: "required",
                    fecha_de_mantenimiento: "required",
                    hora_inicio: "required",
                    hora_fin: "required",
                    observaciónes: "required",
                    observaciónes_internas: "required",
                    solución: "required"
                },
                messages: {
                    // Specify validation error messages
                    tipo_de_revisión: "Por favor, seleccione el tipo de revisión.",
                    ascensor: "Por favor, seleccione el ascensor.",
                    dirección: "Por favor, ingrese la dirección.",
                    provincia: "Por favor, ingrese la provincia.",
                    núm_certificado: "Por favor, ingrese el número de certificado.",
                    máquina: "Por favor, ingrese el número de máquina.",
                    supervisor: "Por favor, seleccione el supervisor.",
                    técnico: "Por favor, seleccione el técnico.",
                    mes_programado: "Por favor, seleccione el mes programado.",
                    fecha_de_mantenimiento: "Por favor, ingrese la fecha de mantenimiento.",
                    hora_inicio: "Por favor, ingrese la hora de inicio.",
                    hora_fin: "Por favor, ingrese la hora de fin.",
                    observaciónes: "Por favor, ingrese las observaciones.",
                    observaciónes_internas: "Por favor, ingrese las observaciones internas.",
                    solución: "Por favor, ingrese la solución."
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
                    supervisor: "required",
                    técnico: "required",
                    mes_programado: "required",
                    fecha_de_mantenimiento: "required",
                    hora_inicio: "required",
                    hora_fin: "required",
                    observaciónes: "required",
                    observaciónes_internas: "required",
                    solución: "required",
                },
                messages: {
                    tipo_de_revisión: "Por favor, seleccione el tipo de revisión.",
                    dirección: "Por favor, ingrese la dirección.",
                    provincia: "Por favor, ingrese la provincia.",
                    núm_certificado: "Por favor, ingrese el número de certificado.",
                    máquina: "Por favor, ingrese el número de máquina.",
                    supervisor: "Por favor, seleccione el supervisor.",
                    técnico: "Por favor, seleccione el técnico.",
                    mes_programado: "Por favor, seleccione el mes programado.",
                    fecha_de_mantenimiento: "Por favor, ingrese la fecha de mantenimiento.",
                    hora_inicio: "Por favor, ingrese la hora de inicio.",
                    hora_fin: "Por favor, ingrese la hora de fin.",
                    observaciónes: "Por favor, ingrese las observaciones.",
                    observaciónes_internas: "Por favor, ingrese las observaciones internas.",
                    solución: "Por favor, ingrese la solución."
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

        });
    </script>
@endpush
