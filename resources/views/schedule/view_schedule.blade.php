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
                        <h4>Cronograma</h4>
                        <span>Cronograma</span>
                    </div>
                </div>
                <div class="col-md-6 mb-4 text-right">
                    <button type="button" class="btn-primario w-auto pl-3 pr-3" data-toggle="modal"
                        data-target="#crearCronograma" id="addEventButton">
                        + Crear Nuevo
                    </button>
                </div>
                <div class="col-md-12">
                    <div class="box-contenido">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="Empleado">Seleccione la provincia que desea consulta</label>
                                    <select class="custom-select" name="Empleado" id="Empleado">
                                        <option selected class="d-none">Seleccionar opción</option>
                                        <option value="1">LIMA</option>
                                        <option value="2">AREQUIPA</option>
                                        <option value="3">TACNA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-6 mb-3 text-right">
                                <input type="file" id="fileInput" style="display: none;">
                                <button id="cargarArchivo" class="btn-gris"><i class="fas fa-upload"></i> Cargar
                                    cronograma</button>
                            </div>
                            <div class="col-md-12">
                                <div id='calendar'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Agregar Cromograma-->
    <div class="modal left fade" id="crearCronograma" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-family-Outfit-SemiBold">Creando programación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('insert.schedule') }}" method="POST" class="formulario-modal" id="eventForm">
                    @csrf
                    <div class="modal-body body_modal">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="Ascensor">Ascensor</label>
                                            <select name="ascensor" id="ascensor"
                                                class="form-control  @error('ascensor') is-invalid @enderror">
                                                <option value="">Select an elevator</option>
                                                @foreach ($elevators as $elevator)
                                                    <option value="{{ $elevator }}">{{ $elevator }}</option>
                                                @endforeach
                                            </select>
                                            @error('ascensor')
                                                <span class="invalid-feedback" style="color: red">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="TipoRevision">Tipo de revisión</label>
                                            <select class="custom-select  @error('revisar') is-invalid @enderror"
                                                name="revisar" id="revisar">
                                                <option value="">Select a review type</option>
                                                @foreach ($reviewtypes as $reviewtype)
                                                    <option value="{{ $reviewtype }}">{{ $reviewtype }}</option>
                                                @endforeach
                                            </select>
                                            @error('revisar')
                                                <span class="invalid-feedback" style="color: red">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mantenimiento">Fecha de mantenimiento</label>
                                            <input type="date" placeholder="Fecha de mantenimiento" name="mantenimiento"
                                                id="mantenimiento"
                                                class="form-control @error('mantenimiento') is-invalid @enderror">
                                            @error('mantenimiento')
                                                <span class="invalid-feedback" style="color: red">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hora_de_inicio">Hora inicio</label>
                                            <input type="time" placeholder="Hora inicio" name="hora_de_inicio"
                                                class="form-control @error('hora_de_inicio') is-invalid @enderror"
                                                id="hora_de_inicio">
                                            @error('hora_de_inicio')
                                                <span class="invalid-feedback" style="color: red">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="HoraFin">Hora fin</label>
                                            <input type="time" name="hora_de_finalización" id="hora_de_finalización"
                                                placeholder="Hora fin"
                                                class="form-control @error('hora_de_finalización') is-invalid @enderror">
                                            @error('hora_de_finalización')
                                                <span class="invalid-feedback" style="color: red">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="Estado">Estado</label>
                                            <select
                                                class="custom-select form-control @error('estado') is-invalid @enderror"
                                                name="estado" id="estado">
                                                <option selected disabled>Seleccionar opción</option>
                                                <option value="activo">Activo</option>
                                                <option value="no_activo">No activo</option>
                                            </select>
                                            @error('estado')
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
                        <button type="submit" class="btn-gris btn-red mr-2" id="submitFormButton">Agregar</button>
                        <button type="button" class="btn-gris btn-border" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @foreach ($schedules as $schedule)
        <!-- Modal Agregar Cromograma-->
        <div class="modal left fade" id="editCronograma" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-family-Outfit-SemiBold">Editar programación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @isset($schedule)
                        <form action="{{ route('update.schedule', ['id' => $schedule->id]) }}" method="POST"
                            class="formulario-modal" id="eventForm">
                            @csrf
                            <div class="modal-body body_modal">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="Ascensor">Ascensor</label>
                                                    <select name="ascensor" id="ascensor"
                                                        class="form-control  @error('ascensor') is-invalid @enderror">
                                                        <option value="">Select an elevator</option>
                                                        @foreach ($elevators as $elevator)
                                                            <option value="{{ $elevator }}"
                                                                {{ $elevator == old('ascensor', $schedule->ascensor) ? 'selected' : '' }}>
                                                                {{ $elevator }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                    @error('ascensor')
                                                        <span class="invalid-feedback" style="color: red">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="TipoRevision">Tipo de revisión</label>
                                                    <select class="custom-select  @error('revisar') is-invalid @enderror"
                                                        name="revisar" id="revisar">
                                                        <option value="">Select a review type</option>
                                                        @foreach ($reviewtypes as $reviewtype)
                                                            <option value="{{ $reviewtype }}"
                                                                {{ $reviewtype == old('revisar', $schedule->revisar) ? 'selected' : '' }}>
                                                                {{ $reviewtype }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                    @error('revisar')
                                                        <span class="invalid-feedback" style="color: red">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mantenimiento">Fecha de mantenimiento</label>
                                                    <input type="date" placeholder="Fecha de mantenimiento"
                                                        name="mantenimiento" id="mantenimiento"
                                                        class="form-control @error('mantenimiento') is-invalid @enderror"
                                                        value="{{ old('mantenimiento', isset($schedule) ? $schedule->mantenimiento : '') }}">
                                                    @error('mantenimiento')
                                                        <span class="invalid-feedback" style="color: red">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12"></div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="hora_de_inicio">Hora inicio</label>
                                                    <input type="time" placeholder="Hora inicio" name="hora_de_inicio"
                                                        class="form-control @error('hora_de_inicio') is-invalid @enderror"
                                                        id="hora_de_inicio"
                                                        value="{{ old('hora_de_inicio', isset($schedule) ? $schedule->hora_de_inicio : '') }}">
                                                    @error('hora_de_inicio')
                                                        <span class="invalid-feedback" style="color: red">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="HoraFin">Hora fin</label>
                                                    <input type="time" name="hora_de_finalización"
                                                        id="hora_de_finalización" placeholder="Hora fin"
                                                        class="form-control @error('hora_de_finalización') is-invalid @enderror"
                                                        value="{{ old('hora_de_finalización', isset($schedule) ? $schedule->hora_de_finalización : '') }}">
                                                    @error('hora_de_finalización')
                                                        <span class="invalid-feedback" style="color: red">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="Estado">Estado</label>
                                                    <select
                                                        class="custom-select form-control @error('estado') is-invalid @enderror"
                                                        name="estado" id="estado">
                                                        <option value="" disabled>Seleccionar opción</option>
                                                        <option value="activo"
                                                            {{ old('estado', isset($schedule) && $schedule->estado == 'activo' ? 'selected' : '') }}>
                                                            Activo</option>
                                                        <option value="no_activo"
                                                            {{ old('estado', isset($schedule) && $schedule->estado == 'no_activo' ? 'selected' : '') }}>
                                                            No activo</option>
                                                    </select>
                                                    @error('estado')
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
                                <button type="submit" class="btn-gris btn-red mr-2" id="submitFormButton">Agregar</button>
                                <button type="button" class="btn-gris btn-border" data-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    @endisset

                </div>
            </div>
        </div>
    @endforeach
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            function resetForm() {
                // Clear the form fields
                $('#eventForm').find('input[type="text"], input[type="date"], input[type="time"], select').val('');
                // Set the default value for the <select> elements
                $('#ascensor, #revisar, #estado').prop('selectedIndex', 0);
            }

            // Initialize FullCalendar
            var calendar = $('#calendar').fullCalendar({
                themeSystem: 'bootstrap4',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay',
                },
                editable: true,
                eventLimit: true,
                events: function(start, end, timezone, callback) {
                    // Retrieve events from the server
                    $.ajax({
                        url: '/get-events', // Change this URL to your server endpoint
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            console.log('Response from server:', response);

                            // Iterate over each event in the response
                            var formattedEvents = response.map(function(event) {
                                return {
                                    title: event.ascensor,
                                    start: event.mantenimiento,
                                    hora_de_inicio: event.hora_de_inicio,
                                    hora_de_finalización: event.hora_de_finalización,
                                    estado: event.estado
                                };
                            });

                            console.log('Formatted events:', formattedEvents);

                            callback(
                            formattedEvents); // Pass the formatted events to FullCalendar
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching events:', error);
                        }
                    });
                },

                dayClick: function(date, jsEvent, view) {
                    resetForm();
                    var formattedDate = date.format('YYYY-MM-DD');
                    $('#mantenimiento').val(formattedDate);
                    $("#editCronograma").modal();
                },
                eventClick: function(calEvent, jsEvent, view) {
                    $('#ascensor').val(calEvent.ascensor);
                    $('#revisar').val(calEvent.tipoRevision);
                    $('#mantenimiento').val(moment(calEvent.start).format('YYYY-MM-DD'));
                    $('#hora_de_inicio').val(moment(calEvent.start).format('HH:mm'));
                    $('#hora_de_finalización').val(moment(calEvent.end).format('HH:mm'));
                    $('#estado').val(calEvent.estado);
                    $("#editCronograma").modal();
                }
            });

            $('#submitFormButton').on('click', function(e) {
                e.preventDefault(); // Prevent the default behavior of the button
                $('#eventForm').submit(); // Submit the form
            });

            // Event handler for the form submission
            $('#eventForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission behavior

                // Collect form data
                var formData = $(this).serialize();

                // Submit the form data to the server
                $.ajax({
                    url: '{{ route('insert.schedule') }}',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        // If the form submission is successful, refresh the calendar
                        calendar.fullCalendar('refetchEvents');
                        // Close the modal and reset the form
                        $("#crearCronograma").modal('hide');
                        resetForm();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error submitting form:', error);
                    }
                });
            });

            $('#addEventButton').on('click', function() {
                // Clear the value of the maintenance date input
                $('#mantenimiento').val('');
                resetForm();
                // Open the modal
                $("#crearCronograma").modal();
            });

            $('#cargarArchivo').on('click', function() {
                // Trigger click on the hidden file input
                $('#fileInput').click();
            });

            setTimeout(function() {
                $(".alert-success").fadeOut(1000);
            }, 1000);
            setTimeout(function() {
                $(".alert-danger").fadeOut(1000);
            }, 1000);
        });
    </script>
@endpush
