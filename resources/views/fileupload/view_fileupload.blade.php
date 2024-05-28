@extends('layouts.main')
@section('content')
    <div class="w-100 contenido">
        <div class="container-fluid container-mod">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="titulo">
                        <h4>Carga de Archivos</h4>
                        <span>Carga de Archivos</span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="box-contenido contenido-elevatronic">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="titulo">
                                    <h4>Archivos desde Excel</h4>
                                    <span>Selecciona el tipo de archivo que cargarás</span>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
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
                                <form id="uploadForm" method="POST" action="{{ route('upload.excel') }}"
                                    enctype="multipart/form-data">

                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
                                            <div class="custom-control custom-radio iconSelect">
                                                <input type="radio" id="mantenimiento" name="tipoArchivos"
                                                    value="mantenimiento" class="custom-control-input">
                                                <label class="custom-control-label"
                                                    for="mantenimiento">Mantenimientos</label>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
                                            <div class="custom-control custom-radio iconSelect">
                                                <input type="radio" id="contratos" name="tipoArchivos" value="contratos"
                                                    class="custom-control-input">
                                                <label class="custom-control-label" for="contratos">Contratos</label>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
                                            <div class="custom-control custom-radio iconSelect">
                                                <input type="radio" id="repuestos" name="tipoArchivos" value="repuestos"
                                                    class="custom-control-input">
                                                <label class="custom-control-label" for="repuestos">Repuestos</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-4">
                                            <input type="file" id="fileInput" name="file" style="display: none;">
                                            <input type="hidden" id="selectedTipoArchivo" name="tipoArchivo"
                                                value="mantenimiento">
                                            <button type="submit" id="cargarArchivo" class="boton btn-red">
                                                <i class="fas fa-upload"></i> Cargar archivos
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#cargarArchivo').on('click', function(event) {
                event.preventDefault();
                $('#fileInput').click();
            });

            $('#fileInput').on('change', function() {
                // Create FormData object to store form data
                var formData = new FormData($('#uploadForm')[0]);

                // Send AJAX request
                $.ajax({
                    url: $('#uploadForm').attr('action'),
                    method: $('#uploadForm').attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                        // You can redirect or show a success message here
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                        // You can display an error message here
                    }
                });
            });
        });
    </script>
@endpush
