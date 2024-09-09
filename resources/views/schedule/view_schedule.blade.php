@extends('layouts.main')
<style>
    .error {
        color: red;
    }

    /* .fc-time{
        display: none !important;
    } */
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
                                        @foreach ($provinces as $key => $province)
                                            <option value="{{ $key }}">{{ $province }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
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
                                            <select name="ascensor" id="ascensor" class="form-control">
                                                <option value="">Seleccione un ascensor</option>
                                                @foreach ($elevators as $elevator)
                                                    <option value="{{ $elevator }}">{{ $elevator }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="TipoRevision">Tipo de revisión</label>
                                            <select class="custom-select" name="revisar" id="revisar">
                                                <option value="">Seleccione un tipo de reseña</option>
                                                @foreach ($reviewtypes as $reviewtype)
                                                    <option value="{{ $reviewtype }}">{{ $reviewtype }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="Técnico">Técnico</label>
                                            <select class="custom-select" name="técnico" id="técnico">
                                                <option value="">Seleccione Técnico</option>
                                                @foreach ($staffs as $staff)
                                                    <option value="{{ $staff }}">
                                                        {{ $staff }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mantenimiento">Fecha de mantenimiento</label>
                                            <input type="date" placeholder="Fecha de mantenimiento" name="mantenimiento"
                                                id="mantenimiento" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hora_de_inicio">Hora inicio</label>
                                            <input type="time" placeholder="Hora inicio" name="hora_de_inicio"
                                                class="form-control" id="hora_de_inicio">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="HoraFin">Hora fin</label>
                                            <input type="time" name="hora_de_finalización" id="hora_de_finalización"
                                                placeholder="Hora fin" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="Estado">Estado</label>
                                            <select class="custom-select form-control" name="estado" id="estado">
                                                <option selected disabled>Seleccionar opción</option>
                                                <option value="activo">Activo</option>
                                                <option value="no_activo">No activo</option>
                                            </select>

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
        <div class="modal left fade" id="editCronograma{{ $schedule->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modelTitleId" aria-hidden="true" data-event-id="">
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
                                                    <select name="ascensor" id="ascensor" class="form-control">
                                                        <option value="">Seleccione un ascensor</option>
                                                        @foreach ($elevators as $elevator)
                                                            <option value="{{ $elevator }}"
                                                                {{ $elevator == old('ascensor', $schedule->ascensor) ? 'selected' : '' }}>
                                                                {{ $elevator }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="TipoRevision">Tipo de revisión</label>
                                                    <select name="revisar" id="revisar" class="custom-select">
                                                        <option value="">Seleccione un tipo de reseña</option>
                                                        @foreach ($reviewtypes as $reviewtype)
                                                            <option value="{{ $reviewtype }}"
                                                                {{ $reviewtype == old('revisar', $schedule->revisar) ? 'selected' : '' }}>
                                                                {{ $reviewtype }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">

                                                <div class="form-group">
                                                    <label for="tecnico">Técnico</label>
                                                    <select name="técnico" id="edit-técnico" class="custom-select">
                                                        <option value="">Seleccionar Técnico</option>
                                                        @foreach ($staffs as $staff)
                                                            <option value="{{ $staff }}"
                                                                {{ $schedule->técnico == $staff ? 'selected' : '' }}>
                                                                {{ $staff }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mantenimiento">Fecha de mantenimiento</label>
                                                    <input type="date" placeholder="Fecha de mantenimiento"
                                                        name="mantenimiento" id="mantenimiento" class="form-control"
                                                        value="{{ old('mantenimiento', isset($schedule) ? $schedule->mantenimiento : '') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12"></div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="hora_de_inicio">Hora inicio</label>
                                                    <input type="time" placeholder="Hora inicio" name="hora_de_inicio"
                                                        class="form-control" id="hora_de_inicio"
                                                        value="{{ old('hora_de_inicio', isset($schedule) ? $schedule->hora_de_inicio : '') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="HoraFin">Hora fin</label>
                                                    <input type="time" name="hora_de_finalización"
                                                        id="hora_de_finalización" placeholder="Hora fin" class="form-control"
                                                        value="{{ old('hora_de_finalización', isset($schedule) ? $schedule->hora_de_finalización : '') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="Estado">Estado</label>
                                                    <select name="estado" id="estado" class="custom-select form-control">
                                                        <option value="" disabled>Seleccionar opción</option>
                                                        <option value="activo"
                                                            {{ old('estado', isset($schedule) && $schedule->estado == 'activo' ? 'selected' : '') }}>
                                                            Activo</option>
                                                        <option value="no_activo"
                                                            {{ old('estado', isset($schedule) && $schedule->estado == 'no_activo' ? 'selected' : '') }}>
                                                            No activo</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                                <button type="submit" class="btn-gris btn-red mr-2"
                                    id="submitFormButton">Actualizar</button>
                                <button type="button" class="btn-gris btn-red mr-2" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn-gris btn-red mr-2 delete-schedule" data-id="{{ $schedule->id}}" data-toggle="modal"
                                    data-target="#modalEliminar">
                                    Eliminar
                                </button>
                            </div>
                        </form>
                    @endisset

                </div>
            </div>
        </div>
        <!-- Modal Eliminar-->
        <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog"
            aria-labelledby="modelTitleId" aria-hidden="true">
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
                        <form id="delete-form" action="" method="POST">
                            @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-gris btn-red" onclick="this.disabled=true;this.form.submit();">Sí</button>
                            </form>
                        <button type="button" class="btn-gris btn-border" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/es.js"></script>
    <script>
        $(document).ready(function() {
            function resetForm() {
                // Clear the form fields
                $('#eventForm').find('input[type="text"], input[type="date"], input[type="time"], select').val('');
                // Set the default value for the <select> elements
                // $('#ascensor, #revisar, #estado').prop('selectedIndex', 0);
            }
           
            $('#province, #ascensor').on('change', function() {
                calendar.fullCalendar('refetchEvents');
            });
            // Initialize FullCalendar
            var calendar = $('#calendar').fullCalendar({
                locale: 'es', // Add this line to set the locale to Spanish
                themeSystem: 'bootstrap4',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay',
                },
                editable: true,
                eventLimit: true,
                height: 'auto',
                views: {
                    week: {
                        slotLabelFormat: 'HH:mm'
                    },
                    day: {
                        slotLabelFormat: 'HH:mm'
                    }
                },
                events: function(start, end, timezone, callback) {
                    var selectedProvince = $('#province').val();

                    $.ajax({
                        url: '/get-events',
                        method: 'GET',
                        data: {
                            province: selectedProvince,
                        },
                        dataType: 'json',
                        success: function(response) {
                            var formattedEvents = response.map(function(event) {
                                // Safely ensure 'event.ascensor' is a string before using it
                                var ascensorName = event.ascensor ? event.ascensor
                                    .toString().toUpperCase() : '';

                                return {
                                    id: event.id,
                                    title: ascensorName,
                                    tipoRevision: event.revisar,
                                    técnico: event.técnico,
                                    start: moment(event.mantenimiento + ' ' + event
                                        .hora_de_inicio).format(),
                                    end: moment(event.mantenimiento + ' ' + event
                                        .hora_de_finalización).format(),
                                    estado: event.estado
                                };
                            });
                            callback(formattedEvents);
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
                    jsEvent.preventDefault(); // Prevent the default action
                    var eventId = calEvent.id;
                    console.log(calEvent);

                    $('#editCronograma' + eventId).attr('data-event-id',
                        eventId); // Update to use the correct modal ID
                    $('#ascensor').val(calEvent.title);
                    $('#revisar').val(calEvent.tipoRevision);
                    $('#edit-técnico').val(calEvent.técnico);
                    $('#mantenimiento').val(moment(calEvent.start).format('YYYY-MM-DD'));
                    $('#horah_de_finalización').val(moment(calEvent.hora_de_inicio).format('HH:mm'));
                    $('#hora_de_inicio').val(moment(calEvent.horah_de_finalización).format('HH:mm'));
                    $('#estado').val(calEvent.estado);
                    $('#editCronograma' + eventId).modal('show'); // Show the modal
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
                        window.location.reload();
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
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                    $(element).closest('.form-group').find('.invalid-feedback').remove();
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
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                    $(element).closest('.form-group').find('.invalid-feedback').remove();
                }
            });
            $('#crearCronograma').on('hidden.bs.modal', function() {
                var form = $('#eventForm');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
                // location.reload();
            });

            $('#editCronograma').on('hidden.bs.modal', function() {
                var form = $('#editeventForm');
                form.validate().resetForm();
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');
            });

            $(document).on('click', '.delete-schedule', function() {
                var scheduleId = $(this).data('id'); // Get the elevator ID
                $('#modalEliminar').modal('show'); // Show the modal
                $('#delete-form').attr('action', '/cronograma/destruir/' + scheduleId); // Set the form action to the DELETE route
            });

        });
    </script>
@endpush
