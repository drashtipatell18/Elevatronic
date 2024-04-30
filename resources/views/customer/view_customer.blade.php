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
                        <h4>Clientes</h4>
                        <span>Clientes</span>
                    </div>
                </div>
                <div class="col-md-6 mb-4 text-right">
                    <button type="button" class="btn-primario w-auto pl-3 pr-3" data-toggle="modal"
                        data-target="#crearCliente">
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
                                        <img src="img/iconos/export.svg" alt="icono" class="mr-2"> Exportar Datos <i
                                            class="iconoir-nav-arrow-down"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <button class="dropdown-item" id="export_excel">Excel</button>
                                        <button class="dropdown-item" id="export_pdf">PDF</button>
                                        <button class="dropdown-item" id="export_copy">Copiar</button>
                                        <button class="dropdown-item" id="export_print">Imprimir</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table id="clientes" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>RAZÓN SOCIAL</th>
                                            <th>TIPO DE CLIENTE</th>
                                            <th>RUC O DNI</th>
                                            <th>DIRECCIÓN</th>
                                            <th>PROVINCIA</th>
                                            <th align="right" class="text-right">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $index => $customer)
                                            <tr class="">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $customer->nombre }}</td>
                                                <td>{{ $customer->tipo_de_cliente }}</td>
                                                <td>{{ $customer->ruc }}</td>
                                                <td>{{ $customer->dirección }}</td>
                                                <td>{{ $customer->provincia }}</td>
                                                <td align="right">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn-action dropdown-toggle"
                                                            data-toggle="dropdown">
                                                            Acción <i class="fas fa-chevron-down"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                                href="{{ route('view.customer', $customer->id) }}">Ver
                                                                detalles</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('edit.customer', $customer->id) }}"
                                                                data-toggle="modal" data-target="#editarCliente">Editar</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('destroy.customer', $customer->id) }}"
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

                <!-- Modal agregar/editar clientes-->
                <div class="modal left fade" id="crearCliente" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-family-Outfit-SemiBold">
                                    Crear Cliente</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body body_modal">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form
                                            action="/clientes/insertar"
                                            method="POST" class="formulario-modal" id="customerForm">
                                            @csrf
                                            <div class="form-group">
                                                <label for="nombreRuc">Nombre o Razón Social</label>
                                                <input type="text" placeholder="Nombre o Razón Social" name="nombre"
                                                    id="nombre" 
                                                    class="form-control @error('nombre') is-invalid @enderror">
                                                @error('nombre')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="tipo_de_cliente">Tipo de Cliente</label>
                                                <select
                                                    class="custom-select form-control @error('tipo_de_cliente') is-invalid @enderror"
                                                    name="tipo_de_cliente" id="Tcliente">
                                                    <option selected disabled>Seleccionar opción</option>
                                                    <option value="person1"
                                                        >Cliente 1</option>
                                                    <option value="person2"
                                                       >Cliente 2</option>
                                                    <option value="person3"
                                                       >Cliente 3</option>
                                                </select>

                                                @error('tipo_de_cliente')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="RUC">RUC o DNI</label>
                                                <input type="text" placeholder="RUC o DNI" name="ruc"
                                                    id="ruc" 
                                                    class="form-control @error('ruc') is-invalid @enderror">
                                                @error('ruc')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="pais">País</label>
                                                <select
                                                    class="custom-select form-control @error('país') is-invalid @enderror"
                                                    name="país" id="país">
                                                    <option selected disabled>Seleccionar opción</option>
                                                    <option value="perú"
                                                        >Perú</option>
                                                    <option value="chile"
                                                        >Chile</option>
                                                    <option value="argentina"
                                                        >Argentina</option>
                                                </select>
                                                @error('país')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="provincia">Provincia</label>
                                                <select
                                                    class="custom-select form-control @error('provincia') is-invalid @enderror"
                                                    name="provincia" id="provincia">
                                                    <option selected disabled>Seleccionar opción</option>
                                                    <option value="lima"
                                                       >Lima</option>
                                                    <option value="arequipa"
                                                      >Arequipa</option>
                                                    <option value="moquegua"
                                                        >Moquegua
                                                    </option>
                                                </select>

                                                @error('provincia')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="dirección">Dirección</label>
                                                <input type="text" placeholder="Dirección" name="dirección"
                                                    id="dirección"
                                                    class="form-control @error('dirección') is-invalid @enderror">
                                                @error('dirección')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="teléfono">Teléfono</label>
                                                <input type="text" placeholder="Teléfono" name="teléfono"
                                                    id="teléfono"
                                                    class="form-control @error('teléfono') is-invalid @enderror">
                                                @error('teléfono')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="teléfono_móvil">Teléfono Móvil</label>
                                                <input type="text" placeholder="Teléfono Móvil" name="teléfono_móvil"
                                                    id="teléfono_móvil"
                                                    class="form-control @error('teléfono_móvil') is-invalid @enderror">
                                                @error('teléfono_móvil')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="correo">Correo electrónico</label>
                                                <input type="text" placeholder="Correo electrónico"
                                                    name="correo_electrónico" id="correo_electrónico"
                                                    class="form-control @error('correo_electrónico') is-invalid @enderror">
                                                @error('correo_electrónico')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="Ncontacto">Nombre del conctacto</label>
                                                <input type="text" placeholder="Nombre del conctacto"
                                                    name="nombre_del_contacto" id="nombre_del_contacto"
                                                    class="form-control @error('nombre_del_contacto') is-invalid @enderror">
                                                @error('nombre_del_contacto')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="posición">Posición</label>
                                                <input type="text" placeholder="Posición" name="posición"
                                                    id="posición"
                                                    class="form-control @error('posición') is-invalid @enderror">
                                                @error('posición')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                                                <button type="submit" class="btn-gris btn-red mr-2">
                                                        Guardar Cambios
                                                </button>
                                                <button type="button" class="btn-gris btn-border"
                                                    data-dismiss="modal">Cancelar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal agregar/editar clientes-->
                <div class="modal left fade" id="editarCliente" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-family-Outfit-SemiBold">editar Cliente</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body body_modal">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="/clientes/actualizar/<?php echo $customer->id ?>" method="POST" class="formulario-modal" id="customerForm">
                                            @csrf
                                            <div class="form-group">
                                                <label for="nombreRuc">Nombre o Razón Social</label>
                                                <input type="text" placeholder="Nombre o Razón Social" name="nombre"
                                                    id="nombre" value="{{ old('nombre', $customer->nombre ?? '') }}"
                                                    class="form-control @error('nombre') is-invalid @enderror">
                                                @error('nombre')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="tipo_de_cliente">Tipo de Cliente</label>
                                                <select
                                                    class="custom-select form-control @error('tipo_de_cliente') is-invalid @enderror"
                                                    name="tipo_de_cliente" id="Tcliente">
                                                    <option selected disabled>Seleccionar opción</option>
                                                    <option value="person1"
                                                        @if (old('tipo_de_cliente', $customer->tipo_de_cliente ?? '') == 'person1') selected @endif>Cliente 1</option>
                                                    <option value="person2"
                                                        @if (old('tipo_de_cliente', $customer->tipo_de_cliente ?? '') == 'person2') selected @endif>Cliente 2</option>
                                                    <option value="person3"
                                                        @if (old('tipo_de_cliente', $customer->tipo_de_cliente ?? '') == 'person3') selected @endif>Cliente 3</option>
                                                </select>

                                                @error('tipo_de_cliente')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="RUC">RUC o DNI</label>
                                                <input type="text" placeholder="RUC o DNI" name="ruc"
                                                    id="ruc" value="{{ old('ruc', $customer->ruc ?? '') }}"
                                                    class="form-control @error('ruc') is-invalid @enderror">
                                                @error('ruc')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="pais">País</label>
                                                <select
                                                    class="custom-select form-control @error('país') is-invalid @enderror"
                                                    name="país" id="país">
                                                    <option selected disabled>Seleccionar opción</option>
                                                    <option value="perú"
                                                        @if (old('país', $customer->país ?? '') == 'perú') selected @endif>Perú</option>
                                                    <option value="chile"
                                                        @if (old('país', $customer->país ?? '') == 'chile') selected @endif>Chile</option>
                                                    <option value="argentina"
                                                        @if (old('país', $customer->país ?? '') == 'argentina') selected @endif>Argentina</option>
                                                </select>
                                                @error('país')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="provincia">Provincia</label>
                                                <select
                                                    class="custom-select form-control @error('provincia') is-invalid @enderror"
                                                    name="provincia" id="provincia">
                                                    <option selected disabled>Seleccionar opción</option>
                                                    <option value="lima"
                                                        @if (old('provincia', $customer->provincia ?? '') == 'lima') selected @endif>Lima</option>
                                                    <option value="arequipa"
                                                        @if (old('provincia', $customer->provincia ?? '') == 'arequipa') selected @endif>Arequipa</option>
                                                    <option value="moquegua"
                                                        @if (old('provincia', $customer->provincia ?? '') == 'moquegua') selected @endif>Moquegua
                                                    </option>
                                                </select>

                                                @error('provincia')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="dirección">Dirección</label>
                                                <input type="text" placeholder="Dirección" name="dirección"
                                                    id="dirección"
                                                    value="{{ old('dirección', $customer->dirección ?? '') }}"
                                                    class="form-control @error('dirección') is-invalid @enderror">
                                                @error('dirección')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="teléfono">Teléfono</label>
                                                <input type="text" placeholder="Teléfono" name="teléfono"
                                                    id="teléfono"
                                                    value="{{ old('teléfono', $customer->teléfono ?? '') }}"
                                                    class="form-control @error('teléfono') is-invalid @enderror">
                                                @error('teléfono')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="teléfono_móvil">Teléfono Móvil</label>
                                                <input type="text" placeholder="Teléfono Móvil" name="teléfono_móvil"
                                                    id="teléfono_móvil"
                                                    value="{{ old('teléfono_móvil', $customer->teléfono_móvil ?? '') }}"
                                                    class="form-control @error('teléfono_móvil') is-invalid @enderror">
                                                @error('teléfono_móvil')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="correo">Correo electrónico</label>
                                                <input type="text" placeholder="Correo electrónico"
                                                    name="correo_electrónico" id="correo_electrónico"
                                                    value="{{ old('correo_electrónico', $customer->correo_electrónico ?? '') }}"
                                                    class="form-control @error('correo_electrónico') is-invalid @enderror">
                                                @error('correo_electrónico')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="Ncontacto">Nombre del conctacto</label>
                                                <input type="text" placeholder="Nombre del conctacto"
                                                    name="nombre_del_contacto" id="nombre_del_contacto"
                                                    value="{{ old('nombre_del_contacto', $customer->nombre_del_contacto ?? '') }}"
                                                    class="form-control @error('nombre_del_contacto') is-invalid @enderror">
                                                @error('nombre_del_contacto')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="posición">Posición</label>
                                                <input type="text" placeholder="Posición" name="posición"
                                                    id="posición"
                                                    value="{{ old('posición', $customer->posición ?? '') }}"
                                                    class="form-control @error('posición') is-invalid @enderror">
                                                @error('posición')
                                                    <span class="invalid-feedback" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                                                <button type="submit" class="btn-gris btn-red mr-2">
                                                        Actualizar Cambios
                                                  
                                                </button>
                                                <button type="button" class="btn-gris btn-border"
                                                    data-dismiss="modal">Cancelar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
                                            <img src="{{ asset('img/iconos/trash.svg') }}" alt="trash"
                                                width="76">
                                            <p class="mt-3 mb-0">
                                                ¿Seguro que quieres eliminar <span id="item-name"></span>?
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer align-items-center justify-content-center">
                                <form id="delete-form" action="{{ route('destroy.customer', $customer->id) }}"
                                    method="POST">
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
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            var table = $('#clientes').DataTable({
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
            setTimeout(function() {
                $(".alert-success").fadeOut(1000);
            }, 1000);
            setTimeout(function() {
                $(".alert-danger").fadeOut(1000);
            }, 1000);
        });
    </script> 
@endpush

