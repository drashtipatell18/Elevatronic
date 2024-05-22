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
                                <div class="row">
                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
                                        <div class="custom-control custom-radio iconSelect">
                                            <input type="radio" id="mantenimiento" name="tipoArchivos" value="1"
                                                class="custom-control-input" checked>
                                            <label class="custom-control-label" for="mantenimiento">
                                                Mantenimientos
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
                                        <div class="custom-control custom-radio iconSelect">
                                            <input type="radio" id="contratos" name="tipoArchivos" value="2"
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="contratos">
                                                Contratos
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
                                        <div class="custom-control custom-radio iconSelect">
                                            <input type="radio" id="repuestos" name="tipoArchivos" value="3"
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="repuestos">
                                                Repuestos
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <!--                                            <input type="file" id="fileInput" style="display: none;">-->
                                        <!--                                            <button id="cargarArchivo" class="boton btn-red"><i class="fas fa-upload"></i> Cargar archivos</button>-->

                                        <button id="carga" class="boton btn-red"><i class="fas fa-upload"></i>
                                            Cargar archivos</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $('#cargarArchivo').on('click', function() {
        // Dispara el clic en el input file oculto
        $('#fileInput').click();
    });
</script>
@endpush
