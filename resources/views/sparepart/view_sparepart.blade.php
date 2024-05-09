@extends('layouts.main')
@section('content')
    <style>
        .dt-head-center {
            text-align: center;
        }
    </style>
    <div class="w-100 contenido">
        <div class="container-fluid container-mod">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="titulo">
                        <h4>Repuestos</h4>
                        <span>Repuestos</span>
                    </div>
                </div>
                <div class="col-md-6 mb-4 text-right">
                    <button type="button" class="btn-primario w-auto pl-3 pr-3" data-toggle="modal"
                        data-target="#crearRepuesto">
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
                                <table id="TiposAscensores" class="table">
                                    <thead>
                                        <tr>
                                            <th>FOTO</th>
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                            <th>PRECIO</th>
                                            <th>LIMPIEZA</th>
                                            <th>LUBRICACIÓN</th>
                                            <th>AJUSTE</th>
                                            <th>REVISIÓN</th>
                                            <th>CAMBIO</th>
                                            <th>SOLICITUD</th>
                                            <th align="right" class="text-right">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($spareparts as $index => $sparepart)
                                            <tr class="td-head-center">
                                                <td><img src="{{ asset('images/' . $sparepart->foto_de_repuesto) }}"
                                                        alt="personal" width="52" height="52" class="img-table"></td>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <a href="{{ route('view.sparepart', $sparepart->id) }}"
                                                        class="text-blue">
                                                        {{ $sparepart->nombre }}
                                                    </a>
                                                </td>
                                                <td>{{ $sparepart->precio }}</td>
                                                <td>{{ $sparepart->frecuencia_de_limpieza }}</td>
                                                <td>{{ $sparepart->frecuencia_de_lubricación }}</td>
                                                <td>{{ $sparepart->frecuencia_de_ajuste }}</td>
                                                <td>{{ $sparepart->frecuencia_de_revisión }}</td>
                                                <td>{{ $sparepart->frecuencia_de_cambio }}</td>
                                                <td>{{ $sparepart->frecuencia_de_solicitud }}</td>
                                                <td align="right">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn-action dropdown-toggle"
                                                            data-toggle="dropdown">
                                                            Acción <i class="fas fa-chevron-down"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                                href="{{ route('view.sparepart', $sparepart->id) }}">Ver
                                                                detalles</a>
                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                data-toggle="modal" data-target="#editorRepuesto">Editar</a>
                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                data-toggle="modal"
                                                                data-target="#modalEliminar">Eliminar</a>
                                                        </div>
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

    <!-- Modal Crear Repuesto-->
    <div class="modal left fade" id="crearRepuesto" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-family-Outfit-SemiBold">Crear Repuesto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('insert.sparepart') }}" method="POST" class="formulario-modal"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body body_modal">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>Foto de repuesto</label>
                                        <div id="imagenPrevio">

                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="">
                                            <label for="imageUpload1" class="text-gris mt-4">Seleccione una
                                                imagen</label>
                                            <input type="file" id="imageUpload1" name="foto_de_repuesto"
                                                style="display: none;" accept="image/*" />
                                            <button type="button" id="cargarimagen" class="btn-gris">
                                                <i class="fas fa-arrow-to-top mr-2"></i>Subir Imagen
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="NombreRepuesto">Nombre</label>
                                            <input type="text" placeholder="Nombre"
                                                class="form-control @error('nombre') is-invalid @enderror" name="nombre"
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
                                                class="form-control @error('precio') is-invalid @enderror" name="precio"
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
                                            <textarea name="descripción" id="descripción" placeholder="Descripción" cols="30" rows="5"></textarea>
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
                                                class="form-control @error('frecuencia_de_limpieza') is-invalid @enderror">
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
                                                class="form-control @error('frecuencia_de_lubricación') is-invalid @enderror">
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
                                                class="form-control @error('frecuencia_de_ajuste') is-invalid @enderror">
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
                        <button type="submit" class="btn-gris btn-red mr-2">Guardar Cambios</button>
                        <button type="button" class="btn-gris btn-border" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>

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
                @isset($sparepart)
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
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="FCambio">Frecuencia de cambio (días)</label>
                                                <input type="text" placeholder="Frecuencia de cambio (días)"
                                                    class="form-control @error('frecuencia_de_cambio') is-invalid @enderror"
                                                    value="{{ old('frecuencia_de_cambio', $sparepart->frecuencia_de_cambio ?? '') }}"
                                                    name="frecuencia_de_cambio" id="frecuencia_de_cambio">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="FSolicitud">Frecuencia de solicitud (días)</label>
                                                <input type="text" placeholder="Frecuencia de solicitud (días)"
                                                    class="form-control @error('frecuencia_de_solicitud') is-invalid @enderror"
                                                    value="{{ old('frecuencia_de_solicitud', $sparepart->frecuencia_de_solicitud ?? '') }}"
                                                    name="frecuencia_de_solicitud" id="frecuencia_de_solicitud">
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
                @endisset
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
                    @isset($sparepart)
                        <form id="delete-form" action="{{ route('destroy.sparepart', $sparepart->id) }}" method="POST">
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
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            var table = $('#TiposAscensores').DataTable({
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
            $("#miTabla_filter").css('float', 'left');

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

            $('#cargarimagen').click(function() {
                $('#imageUpload1').click();
            });

            $('#imageUpload1').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagenPrevio').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagenPrevio').show();
                }
                reader.readAsDataURL(this.files[0]);
            });

            $('#editcargarimagen').click(function() {
                $('#editimageUpload1').click();
            });

            $('#editimageUpload1').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#editimagenPrevio').css('background-image', 'url(' + e.target.result + ')');
                    $('#ediimagenPrevio').show();
                }
                reader.readAsDataURL(this.files[0]);
            });

        });
    </script>
@endpush
