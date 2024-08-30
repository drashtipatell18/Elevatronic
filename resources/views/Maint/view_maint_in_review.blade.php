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
                                            <th>FECHA</th>
                                            <th>HOR. INI</th>
                                            <th>HOR. FIN</th>
                                            <th>TÉCNICO</th>
                                            <th>OBSERVACIÓN</th>
                                            <th align="right" class="text-right">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>

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
                                        @foreach ($provinces as $key => $province)
                                            <option value="{{ $key }}">{{ $province }}</option>
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
                                        @foreach ($Personals as $key => $Personal)
                                            <option value="{{ $key }}">{{ $Personal }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Mprogramado">Mes programado</label>
                                            <select class="custom-select" name="mes_programado" id="Mprogramado">
                                                @foreach ($months as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
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

    <!-- Modal for observation -->
    <div class="modal fade" id="observacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <div class="col-md-12" id="observationContent">
                            {{-- @isset($maint_in_rev->observaciónes)
                                <p>{{ $maint_in_rev->observaciónes }}</p>
                            @else
                                <p>No hay observación disponible.</p>
                            @endisset --}}
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
                    @csrf
                    @method('PUT')
                    <div class="modal-body body_modal">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="TRevision">Tipo de revisión</label>
                                    <select class="custom-select @error('tipo_de_revisión') is-invalid @enderror"
                                        name="tipo_de_revisión" id="edit-tipo_de_revisión">
                                        <option disabled>Seleccionar tipo de
                                            revisión</option>

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
                                        <option value="">Seleccionar
                                            Provincia
                                        </option>

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
                                        <button type="button" data-toggle="modal" data-target="#crearSupervisor"
                                            class="btn-gris supervisorbtn" id="toggleMarcaInput">
                                            + Agregar Supervisor
                                        </button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="técnico">Técnico</label>
                                    <select class="custom-select" name="técnico" id="edit-técnico">
                                        <option value="">Seleccionar opción
                                        </option>

                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Mprogramado">Mes
                                                programado</label>
                                            <select class="custom-select @error('mes_programado') is-invalid @enderror"
                                                name="mes_programado" id="edit-Mprogramado">
                                                <option value="">Seleccionar opción</option>

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
                    {{-- @isset($maint_in_rev) --}}
                    <form id="delete-form" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-gris btn-red">Sí</button>
                        <button type="button" class="btn-gris btn-border" data-dismiss="modal">No</button>
                    </form>
                    {{-- @endisset --}}
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
            // Call the function when needed, e.g., when opening the modal
            const editValue = '{{ $editValue ?? '' }}'; // Replace with actual edit value if available
            getSupervisors(editValue);
            getDataMain();
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
                            columns: ':not(:last-child(-n+2))' // Excluye las dos últimas columnas
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excluye las dos últimas columnas
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':not(:nth-last-child(-n+2))' // Excluye las dos últimas columnas
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excluye las dos últimas columnas
                        },
                        customize: function(doc) {
                            // Remove the last column from the table body
                            doc.content[1].table.body.forEach(function(row) {
                                row.pop(); // Remove the last column from each row
                            });
                            doc.content[1].table.widths = Array(doc.content[1].table.body[0]
                                .length + 1).join('*').split('');
                            var columnCount = doc.content[1].table.body[0].length;
                            doc.content[1].table.body.forEach(function(row) {
                                row[0].alignment =
                                    'center'; // Center align the first column
                                row[1].alignment =
                                    'center'; // Center align the second column
                                row[2].alignment =
                                    'center'; // Center align the third column
                                row[columnCount - 1].alignment =
                                    'center'; // Center align the last column
                            });
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(:nth-last-child(-n+2))' // Excluye las dos últimas columnas
                        }
                    }
                    // 'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            function fetchData() {
                $.ajax({
                    url: "{{ route('maint_in_review') }}", // Ensure this route is correct
                    method: "GET",
                    dataType: "json",
                    success: function(data) {
                        // console.log("Fetched Data:", data.maint_in_reviews); // Log the fetched data

                        // Check if the expected property exists
                        if (data.maint_in_reviews && Array.isArray(data.maint_in_reviews)) {
                            table.clear(); // Clear existing data
                            var baseUrl = "{{ url('/') }}"; // Define base URL

                            // Populate the DataTable with new data
                            $.each(data.maint_in_reviews, function(index, maint_in_review) {
                                table.row.add([
                                    maint_in_review.id || '', // Column 0
                                    maint_in_review.reviewtype ? maint_in_review.reviewtype.nombre : '', // Column 1
                                    maint_in_review.elevator.nombre || '', // Column 1
                                    maint_in_review.fecha_de_mantenimiento ||
                                    '', // Column 1
                                    maint_in_review.hora_inicio || '', // Column 1
                                    maint_in_review.hora_fin || '', // Column 1
                                    maint_in_review.staff.nombre || '', // Column 1
                                    `   <a class="text-blue view-observation" href="#" data-id="${maint_in_review.id}" data-toggle="modal" data-target="#observacion">Ver observación</a>`,
                                    `<td align="right">
                                        <div class="dropdown">
                                            <button type="button" class="btn-action dropdown-toggle" data-toggle="dropdown">
                                                Acción <i class="fas fa-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ route('details.maint.in.review', '') }}/${maint_in_review.id}">Ver detalles</a>
                                                <a class="dropdown-item edit-maint_in_review" href="#" data-maint_in_review='${JSON.stringify(maint_in_review)}' data-toggle="modal" data-target="#editorMantenimiento">Editar</a>
                                                <a class="dropdown-item delete-maint_in_review" href="#" data-id="${maint_in_review.id}" data-toggle="modal" data-target="#modalEliminar">Eliminar</a>                                        </div>
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
            $(document).on('click', '.view-observation', function(e) {

                e.preventDefault(); // Prevent default action
                var observationId = $(this).data('id'); // Ensure you have a data-id attribute
                // Fetch the observation data using AJAX
                $.ajax({
                    url: `/get-observation/${observationId}`, // Adjust the URL to your route
                    method: 'GET',
                    success: function(data) {
                        console.log(data);
                        $('#observationContent').text(data
                            .observaciónes); // Set the observation text
                    },
                    error: function(xhr) {
                        console.error('Error fetching observation:', xhr
                            .responseText);
                    }
                });
            });

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
            $(document).on('click', '.delete-maint_in_review', function() {
                var itemId = $(this).data('id');
                $('#item-name').text(itemId); // Set the item name in the modal
                // Set the form action for deletion
                $('#delete-form').attr('action', '/mant/en/revisión/destruir/' + itemId);
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
