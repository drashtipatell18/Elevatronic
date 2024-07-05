<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Elevatronic</title>

    <link rel="stylesheet" href="{{ asset('css/menu.css') }}?v={{ uniqid() }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}?v={{ rand() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/iconoir-icons/iconoir@main/css/iconoir.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.4.0/css/fixedHeader.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet">
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Include jQuery -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style>
  .spacing{
    margin-left: 13px;
  }
</style>
<div class="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header" style="background: white;">
            <!-- id -->
            <a href="javascript:void(0);" class="mr-4 sidebarCollapse" id="oculta">
                <img src="{{ asset('img/menu.png') }}" alt="menu">
            </a>
            <img src="{{ asset('img/logo-sidebar.svg') }}" alt="logo">
        </div>

        <ul class="list-unstyled components">
            <li class="">
                <a href="{{ route('customer') }}">
                    <i class="iconoir-group"></i> Clientes
                </a>
            </li>
            <li class="">
                <a href="{{ route('elevatortypes') }}"><i class="iconoir-view-grid"></i> Tipos de ascensor</a>
            </li>
            <li class="">
                <a href="{{ route('elevator') }}"><i class="iconoir-app-window"></i> Ascensores</a>
            </li>
            <li class="">
                <a href="{{ route('maint_in_review') }}" class="position-relative">
                    <i class="iconoir-search-window"></i> Mant. en revisión <span class="adorno-num">{{ $totalRecordCount }}</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('province') }}"><i class="iconoir-maps-arrow-diagonal"></i> Provincias</a>
            </li>
            <li class="">
                <a href="{{ route('reviewtype') }}"><i class="iconoir-apple-shortcuts"></i> Tipos de revisión</a>
            </li>
            <li class="">
                <a href="{{ route('sparepart') }}"><i class="iconoir-wrench"></i> Repuestos</a>
            </li>
            <li class="">
                <a href="{{ route('staff') }}"><i class="iconoir-suitcase"></i> Personal</a>
            </li>
            <li class="">
                <a href="{{ route('user') }}"><i class="iconoir-user-star"></i> Usuarios</a>
            </li>
            <li class="">
                <a href="{{ route('schedule') }}"><i class="iconoir-bed"></i> Cronograma</a>
            </li>
            <li class="">
                <a href="{{ route('fileupload') }}"><i class="iconoir-multiple-pages-empty"></i> Carga de archivos</a>
            </li>
        </ul>
    </nav>
    <div id="content">

        <div class="menu-header sticky-top">
            <div class="container-fluid container-mod h-100">
                <div class="row h-100 align-items-center justify-content-start">
                    <div class="col-auto d-flex align-items-center justify-content-start">
                        <a href="javascript:void(0);" id="sidebarCollapse" class="btn-menu sidebarCollapse mr-3"
                            style="display: none;">
                            <i class="iconoir-menu"></i>
                        </a>
                        <img src="{{ asset('img/logo.svg') }}" alt="logo" width="190">
                    </div>
                    <div class="col-auto ml-auto">
                        <div class="row">
                            <div class="col-auto d-flex align-items-center justify-content-center" id="noMobil">
                                <div id="toggle-search" class="position-relative"></div>
                                <!-- Input de búsqueda inicialmente oculto -->
                                <div id="search-container" style="display: none;">
                                    <input type="text" id="search-input" placeholder="Escribe para buscar...">
                                </div>
                            </div>
                            <div class="col-auto d-flex align-items-center justify-content-center">
                                <div class="alerta_mensajes position-relative" data-toggle="modal"
                                    data-target="#modalalerta">
                                    <img src="{{ asset('img/iconos/alerta.png') }}" alt="alerta">
                                    <span>2</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="perfil position-relative">
                                    <!-- cuadro para hacer click ocultar / aparecer -->
                                    <div class="d-flex align-items-center justify-content-start" id="abrirperfil">
                                        <i class="iconoir-nav-arrow-down"></i>
                                        @if (auth()->user())
                                            <img src="{{ asset('images/' . auth()->user()->image) }}"
                                                alt="User Image" width="100" height="50px"
                                                class="img-circle profile_img">
                                        @else
                                            <p>No user image available</p>
                                        @endif
                                        <div class="">
                                            <p class="mb-0">{{ auth()->user()->name }}</p>
                                            <span>Administradora</span>
                                        </div>
                                    </div>
                                    <!-- cuadro oculto -->
                                    <div class="perfil_abs" id="perfil_abs" style="display: none;">
                                        <div class="d-flex align-items-center justify-content-between con_perfil">
                                            <div class="">
                                                @if (auth()->user())
                                                <img src="{{ asset('images/' . auth()->user()->image) }}"
                                                    alt="User Image" width="100" height="50px"
                                                    class="img-circle profile_img">
                                            @else
                                                <p>No user image available</p>
                                            @endif                                            </div>
                                            <div class="spacing">
                                                <p>{{ auth()->user()->name }}</p>
                                                <span class="m-0">{{ auth()->user()->email }}</span>
                                            </div>
                                        </div>
                                        <div class="salir">
                                            <a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#modalcerrar">
                                                <i class="iconoir-log-in"></i> Cerrar Sesión
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <main class="main-content">
                    @yield('content')
                </main>
            </div>
            <div class="copyright text-center">
            </div>
        </div>
    </div>
</div>


<!-- Modal Notificaciones-->
<div class="modal left fade" id="modalalerta" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-family-Outfit-SemiBold">Notificaciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body body_modal">
                <h6 class="font-family-Inter-Light mb-3">Hoy <span>2</span></h6>
                <div class="mensaje_box d-flex align-items-start justify-content-start mb-3">
                    <div>
                        <i class="fas fa-circle"></i>
                    </div>
                    <div>
                        <p class="mb-0 font-family-Inter-Medium">Tienes un mensaje</p>
                        <span class="font-family-Inter-Regular">10 Nov 2023, 2:40 pm</span>
                    </div>
                </div>
                <div class="mensaje_box d-flex align-items-start justify-content-start mb-3">
                    <div>
                        <i class="fas fa-circle"></i>
                    </div>
                    <div>
                        <p class="mb-0 font-family-Inter-Medium">Ejemplo de Notificación</p>
                        <span class="font-family-Inter-Regular">10 Nov 2023, 2:40 pm</span>
                    </div>
                </div>
                <h6 class="font-family-Inter-Light mt-3 mb-3">Ayer</h6>
                <div class="mensaje_box d-flex align-items-start justify-content-start mb-3">
                    <div>
                        <i class="fas fa-circle leido"></i>
                    </div>
                    <div>
                        <p class="mb-0 font-family-Inter-Medium">Tienes un mensaje</p>
                        <span class="font-family-Inter-Regular">9 Nov 2023, 2:40 pm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Logout Modal -->
<div class="modal fade" id="modalcerrar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-radius-12">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <div class="box2">
                                <img src="{{ asset('img/iconos/icono-cerrar.svg') }}" alt="cerrar" width="76">
                                <p class="mt-3 mb-0">
                                    ¿Seguro que quieres cerrar sesión?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer align-items-center justify-content-center">
                    <button type="submit" class="btn-gris btn-red">Si</button>
                    <button type="button" class="btn-gris btn-border" data-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Crear Tipo de Ascensor-->
<div class="modal left fade" id="tiposAscensores" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-family-Outfit-SemiBold">Crear Tipo de Ascensor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body body_modal">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" class="formulario-modal">
                            <div class="form-group">
                                <label for="nombreAscensor">Nombre de Tipo de Ascensor</label>
                                <input type="text" placeholder="Nombre de Tipo de Ascensor" name="nombreAscensor"
                                    id="nombreAscensor">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                <button type="button" class="btn-gris btn-red mr-2">Guardar Cambios</button>
                <button type="button" class="btn-gris btn-border" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Creando Contrato-->
<div class="modal left fade" id="crearContratos" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-family-Outfit-SemiBold">Creando Contrato</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body body_modal">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" class="formulario-modal">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Ascensor">Ascensor</label>
                                        <input type="text" placeholder="Ascensor" name="Ascensor" id="Ascensor">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fechaPropuesta">Fecha de propuesta</label>
                                        <input type="date" placeholder="dd/mm/aaaa" name="fechaPropuesta"
                                            id="fechaPropuesta">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Mpropuesta">Monto de propuesta</label>
                                        <input type="text" placeholder="S/ 300 mensual" name="Mpropuesta"
                                            id="Mpropuesta">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Mcontrato">Monto de contrato</label>
                                        <input type="text" placeholder="S/ 300 mensual" name="Mcontrato"
                                            id="Mcontrato">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="FechaInicio">Fecha de inicio</label>
                                        <input type="date" placeholder="dd/mm/aaaa" name="FechaInicio"
                                            id="FechaInicio">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="FechaFin">Fecha de fin</label>
                                        <input type="date" placeholder="dd/mm/aaaa" name="FechaFin"
                                            id="FechaFin">
                                    </div>
                                </div>
                                <div class="col-md-12"></div>
                                <div class="col-md-6">
                                    <div class="adornoinput mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="Renovacion"
                                                name="Renovacion">
                                            <label class="custom-control-label" for="Renovacion">Renovación</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Cmeses">Cada cuantos meses?</label>
                                        <input type="text" placeholder="Meses" name="Cmeses" id="Cmeses">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="observacion1">Observación</label>
                                        <textarea name="observacion1" id="observacion1" placeholder="Comentario de contrato" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Econtrato">Estado cuenta del contrato</label>
                                        <textarea name="Econtrato" id="Econtrato" placeholder="Estado cuenta del contrato" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="estado">Estado</label>
                                        <input type="text" placeholder="Activo" name="estado" id="estado">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                <button type="button" class="btn-gris btn-red mr-2">Asignar Respuesto</button>
                <button type="button" class="btn-gris btn-border" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>


<!-- alerta carga-->
<div id="alertaCarga" class="alert alert-elevatronic alert-dismissible" style="display: none;">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong class="mr-2"><img src=" {{ asset('img/iconos/check.svg') }}" alt="icono"></strong> Carga de archivo exitosa
</div>

<!-- alerta envio-->
<div id="alertaEnvio" class="alert alert-elevatronic alert-dismissible" style="display: none;">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong class="mr-2"><img src="{{ asset('img/iconos/check.svg') }}" alt="icono"></strong> Envio Exitoso
</div>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Popper.JS -->


<!-- Bootstrap JS -->

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>

<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>


<!-- jQuery Custom Scroller CDN -->
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js">
</script>

<script src="{{ asset('js/es.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.sidebarCollapse').on('click', function() {
            $('#sidebar, #content').toggleClass('active');
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
        $('#oculta').click(function() {
            $('#sidebarCollapse').css('display', 'inline-block');
        });
        $('#sidebarCollapse').click(function() {
            $(this).css('display', 'none');
        });
        $('#abrirperfil').click(function(event) {
            event.stopPropagation();
            $('#perfil_abs').toggle();
            $(this).toggleClass("activo");
            $(this).find("i").toggleClass("iconoir-nav-arrow-down iconoir-nav-arrow-up");
        });
        $(document).click(function(event) {
            var $trigger = $('#abrirperfil');
            if ($trigger !== event.target && !$trigger.has(event.target).length && !$('#perfil_abs')
                .has(event.target).length) {
                if ($('#perfil_abs').is(":visible")) {
                    $('#perfil_abs').hide();
                    $trigger.removeClass("activo");
                    $trigger.find("i").addClass("iconoir-nav-arrow-down").removeClass(
                        "iconoir-nav-arrow-up");
                }
            }
        });


        $('#toggle-search').click(function() {
            // Muestra u oculta el contenedor del input de búsqueda
            $('#search-container').toggle();
        });

        // Opcional: Cierra el input de búsqueda si se hace clic fuera de él
        $(document).click(function(e) {
            var searchContainer = $("#search-container");
            var toggleButton = $("#toggle-search");

            // Verifica si el clic fue fuera del input de búsqueda y del botón toggle
            if (!searchContainer.is(e.target) && searchContainer.has(e.target).length === 0 && !
                toggleButton.is(e.target)) {
                searchContainer.hide();
            }
        });


        $('#AgregarDescripcion').click(function() {
            $('#DAdicional').removeClass('d-none');
        });

        //js alerta carga archivos
        $('#carga').click(function() {
            $('#alertaCarga').show();
            setTimeout(function() {
                $('#alertaCarga').fadeOut('fast');
            }, 3000); // Ajusta este tiempo según necesites
        });

        //js alerta carga archivos
        $('#envioExitoso, #envia, #muestraRecupera').click(function() {
            $('#alertaEnvio').show();
            setTimeout(function() {
                $('#alertaEnvio').fadeOut('fast');
            }, 3000);
        });


        // new DataTable('#example');
        var table = $('#example').DataTable({
            responsive: true,
            dom: 'tp',
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

    });
</script>
@stack('scripts')

</body>



</html>
<!-- end document-->
