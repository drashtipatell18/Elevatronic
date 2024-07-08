@extends('layouts.main')
<style>
    .error {
        color: red;
    }
</style>
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
                                    <select id="province" name="province" class="form-control">
                                        <option value="">Seleccionar Provincia</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province }}">{{ $province }}</option>
                                        @endforeach
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
                                                <option value="">Seleccione un ascensor</option>
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
                                                <option value="">Seleccione un tipo de reseña</option>
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

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="Técnico">Técnico</label>
                                            <select class="custom-select  @error('técnico') is-invalid @enderror"
                                                name="técnico" id="técnico">
                                                <option value="">Seleccione un técnico</option>
                                                <option value="técnico_1">Técnico 1</option>
                                                <option value="técnico_2">Técnico 2</option>
                                                <option value="técnico_3">Técnico 3</option>
                                            </select>
                                            @error('técnico')
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
            aria-hidden="true" data-event-id="">
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
                            class="formulario-modal" id="editeventForm">
                            @csrf
                            <div class="modal-body body_modal">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="Ascensor">Ascensor</label>
                                                    <select name="ascensor" id="ascensor"
                                                        class="form-control @error('ascensor') is-invalid @enderror">
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
                                                    <select name="revisar" id="revisar"
                                                        class="custom-select @error('revisar') is-invalid @enderror">
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
                                            <div class="col-md-12">

                                                <div class="form-group">
                                                    <label for="tecnico">Técnico</label>
                                                    <select name="técnico" id="técnico"
                                                        class="custom-select @error('técnico') is-invalid @enderror">
                                                        <option value="">Seleccionar opción</option>
                                                        <option value="técnico_1"
                                                            {{ old('técnico') == 'técnico_1' ? 'selected' : ($schedule->técnico == 'técnico_1' ? 'selected' : '') }}>
                                                            Técnico 1</option>
                                                        <option value="técnico_2"
                                                            {{ old('técnico') == 'técnico_2' ? 'selected' : ($schedule->técnico == 'técnico_2' ? 'selected' : '') }}>
                                                            Técnico 2</option>
                                                        <option value="técnico_3"
                                                            {{ old('técnico') == 'técnico_3' ? 'selected' : ($schedule->técnico == 'técnico_3' ? 'selected' : '') }}>
                                                            Técnico 3</option>
                                                    </select>
                                                    @error('técnico')
                                                        <span class="invalid-feedback" role="alert">
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
                                                    <select name="estado" id="estado"
                                                        class="custom-select form-control @error('estado') is-invalid @enderror">
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
                                <button type="submit" class="btn-gris btn-red mr-2"
                                    id="submitFormButton">Actualizar</button>
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
                            // Iterate over each event in the response
                            var formattedEvents = response.map(function(event) {
                                return {
                                    id: event.id,
                                    title: event.ascensor,
                                    tipoRevision: event.revisar,
                                    técnico: event.técnico,
                                    start: event.mantenimiento,
                                    hora_de_inicio: event.hora_de_inicio,
                                    hora_de_finalización: event
                                        .hora_de_finalización,
                                    estado: event.estado
                                };
                            });
                            callback(
                                formattedEvents
                            ); // Pass the formatted events to FullCalendar

                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching events:', error);
                        }
                    });
                },

                dayClick: function(date, jsEvent, view) {
                    console.log('dayClick');
                    resetForm();
                    var formattedDate = date.format('YYYY-MM-DD');
                    $('#mantenimiento').val(formattedDate);
                    $("#editCronograma").modal();
                },
                eventClick: function(calEvent, jsEvent, view) {
                    jsEvent.preventDefault(); // Prevent the default action
                    var eventId = calEvent.id;
                    // window.reload();

                    $('#editCronograma').attr('data-event-id', eventId);
                    $('#ascensor').val(calEvent.title);
                    $('#revisar').val(calEvent.tipoRevision);
                    $('#técnico').val(calEvent.técnico);
                    $('#mantenimiento').val(moment(calEvent.start).format('YYYY-MM-DD'));
                    $('#horah_de_finalización').val(moment(calEvent.hora_de_inicio).format('HH:mm'));
                    $('#hora_de_inicio').val(moment(calEvent.horah_de_finalización).format('HH:mm'));
                    $('#estado').val(calEvent.estado);
                    $('#editCronograma').modal('show'); // Show the modal
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

            $("#eventForm").validate({
                rules: {
                    ascensor: {
                        required: true
                    },
                    revisar: {
                        required: true
                    },
                    técnico: {
                        required: true
                    },
                    mantenimiento: {
                        required: true
                    },
                    hora_de_inicio: {
                        required: true
                    },
                    hora_de_finalización: {
                        required: true
                    },
                    estado: {
                        required: true
                    }
                    // Add rules for other fields here
                },
                messages: {
                    // Specify custom messages for each field
                    ascensor: "Por favor, seleccione un ascensor.",
                    revisar: "Por favor, seleccione un tipo de revisión.",
                    técnico: "Por favor, seleccione un técnico.",
                    mantenimiento: "Por favor, ingrese una fecha de mantenimiento.",
                    hora_de_inicio: "Por favor, ingrese una hora de inicio.",
                    hora_de_finalización: "Por favor, ingrese una hora de finalización.",
                    estado: "Por favor, seleccione un estado."
                    // Add messages for other fields here
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
            $("#editeventForm").validate({
                rules: {
                    ascensor: {
                        required: true
                    },
                    revisar: {
                        required: true
                    },
                    técnico: {
                        required: true
                    },
                    mantenimiento: {
                        required: true
                    },
                    hora_de_inicio: {
                        required: true
                    },
                    hora_de_finalización: {
                        required: true
                    },
                    estado: {
                        required: true
                    }
                    // Add rules for other fields here
                },
                messages: {
                    // Specify custom messages for each field
                    ascensor: "Por favor, seleccione un ascensor.",
                    revisar: "Por favor, seleccione un tipo de revisión.",
                    técnico: "Por favor, seleccione un técnico.",
                    mantenimiento: "Por favor, ingrese una fecha de mantenimiento.",
                    hora_de_inicio: "Por favor, ingrese una hora de inicio.",
                    hora_de_finalización: "Por favor, ingrese una hora de finalización.",
                    estado: "Por favor, seleccione un estado."
                    // Add messages for other fields here
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

            $('#crearCronograma').on('hidden.bs.modal', function() {
                var form = $('#eventForm');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            });

            $('#editCronograma').on('hidden.bs.modal', function() {
                var form = $('#editeventForm');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            });
        });
    </script>
@endpush
