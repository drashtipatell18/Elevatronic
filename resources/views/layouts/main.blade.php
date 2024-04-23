<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Elevatronic</title>

    <link rel="stylesheet" href="{{ asset('css/menu.css') }}?v={{ uniqid() }}">
    <!--    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">-->
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
    <!--    <link href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.css' rel='stylesheet'>-->
<!-- Include Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
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
                <a href="{{ route('customer')}}">
                    <i class="iconoir-group"></i> Clientes
                </a>
            </li>
            <li class="">
                <a href="{{ route('elevatortypes') }}"><i class="iconoir-view-grid"></i> Tipos de ascensor</a>
            </li>
            <li class="">
                <a href="ascensores.php"><i class="iconoir-app-window"></i> Ascensores</a>
            </li>
            <li class="">
                <a href="mantenimiento-revision.php" class="position-relative">
                    <i class="iconoir-search-window"></i> Mant. en revisión <span class="adorno-num">3</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('province')}}"><i class="iconoir-maps-arrow-diagonal"></i> Provincias</a>
            </li>
            <li class="">
                <a href="tipos-de-revision.php"><i class="iconoir-apple-shortcuts"></i> Tipos de revisión</a>
            </li>
            <li class="">
                <a href="repuestos.php"><i class="iconoir-wrench"></i> Repuestos</a>
            </li>
            <li class="">
                <a href="personal.php"><i class="iconoir-suitcase"></i> Personal</a>
            </li>
            <li class="">
                <a href="usuarios.php"><i class="iconoir-user-star"></i> Usuarios</a>
            </li>
            <li class="">
                <a href="cronograma.php"><i class="iconoir-bed"></i> Cronograma</a>
            </li>
            <li class="">
                <a href="carga-archivos.php"><i class="iconoir-multiple-pages-empty"></i> Carga de archivos</a>
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
                                        <img src=" {{ asset('img/perfil.png') }}" alt="perfil">
                                        <div class="">
                                            <p class="mb-0">Anghela</p>
                                            <span>Administrador</span>
                                        </div>
                                    </div>
                                    <!-- cuadro oculto -->
                                    <div class="perfil_abs" id="perfil_abs" style="display: none;">
                                        <div class="d-flex align-items-center justify-content-between con_perfil">
                                            <div class="">
                                                <img src=" {{ asset('img/perfil.png') }}" alt="perfil">
                                            </div>
                                            <div class="">
                                                <p>Danfrin Rodriguez</p>
                                                <span class="m-0">ejemplo@gmail.com</span>
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
                <p> Created by⭐<a href="https://kalathiyainfotech.com/">Kalathiya Infotech</a></p>
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

<!-- Modal cerrar sesion-->
<div class="modal fade" id="modalcerrar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-radius-12">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <div class="box2">
                            <img src="img/iconos/icono-cerrar.svg" alt="cerrar" width="76">
                            <p class="mt-3 mb-0">
                                ¿Seguro que quieres cerrar sesión?
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer align-items-center justify-content-center">
                <button type="button" class="btn-gris btn-red">Si</button>
                <button type="button" class="btn-gris btn-border" data-dismiss="modal">No</button>
            </div>
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

<!-- Modal Crear Tipo de Revisión-->
<div class="modal left fade" id="CrearTipoRevision" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-family-Outfit-SemiBold">Crear Tipo de Revisión</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body body_modal">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" class="formulario-modal">
                            <div class="form-group">
                                <label for="nombreTipoRevision">Nombre de Tipo de Revisión</label>
                                <input type="text" placeholder="Nombre de Tipo de Revisión"
                                    name="nombreTipoRevision" id="nombreTipoRevision">
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

<!-- Modal Asignar Repuesto-->
<div class="modal left fade" id="asignarRepuestos" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-family-Outfit-SemiBold">Asignar Repuesto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body body_modal">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" class="formulario-modal">
                            <div class="form-group">
                                <label for="NombreTipoAscensor">Nombre de Tipo de Ascensor</label>
                                <input type="text" placeholder="Nombre de Tipo de Ascensor"
                                    name="NombreTipoAscensor" id="NombreTipoAscensor">
                            </div>
                            <div class="form-group">
                                <label for="repuesto">Repuesto</label>
                                <select class="custom-select" name="repuesto" id="repuesto">
                                    <option selected class="d-none">Seleccionar opción</option>
                                    <option value="1">Repuesto 1</option>
                                    <option value="2">Repuesto 2</option>
                                    <option value="3">Repuesto 3</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-foojustify-content-start justify-content-start pl-4 pb-4">
                <button type="button" class="btn-gris btn-red mr-2">Asignar respuesto</button>
                <button type="button" class="btn-gris btn-border" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Ascensor-->
<div class="modal left fade" id="crearAscensor" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-family-Outfit-SemiBold">Crear Ascensor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body body_modal">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" class="formulario-modal">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Foto de Ascensor</label>
                                    <div id="imagePreview"></div>
                                </div>
                                <div
                                    class="align-items-start col-md-6 d-flex flex-column justify-content-between mb-3">
                                    <div class="">
                                        <label for="imageUpload" class="text-gris mt-4">Seleccione una imagen</label>
                                        <input type="file" id="imageUpload" style="display: none;"
                                            accept="image/*" />
                                        <button type="button" id="uploadButton" class="btn-gris">
                                            <i class="fas fa-arrow-to-top mr-2"></i>Subir Imagen
                                        </button>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="NumeroContrato"># de contrato</label>
                                        <input type="text" placeholder="# de contrato" name="NumeroContrato"
                                            id="NumeroContrato">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Nascensor">Nombre ascensor</label>
                                        <input type="text" placeholder="Nombre ascensor" name="Nascensor"
                                            id="Nascensor">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="codigo">Código</label>
                                        <input type="text" placeholder="Código" name="codigo" id="codigo">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="marca">Marca</label>
                                        <input type="text" placeholder="Marca" name="marca" id="marca">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="clienteAscensor">Cliente del ascensor</label>
                                        <select class="custom-select" name="clienteAscensor" id="clienteAscensor">
                                            <option selected class="d-none">Seleccionar opción</option>
                                            <option value="1">Cliente del ascensor 1</option>
                                            <option value="2">Cliente del ascensor 2</option>
                                            <option value="3">Cliente del ascensor 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fechaEntrega">Fecha de entrega</label>
                                        <input type="date" placeholder="dd/mm/aaaa" name="fechaEntrega"
                                            id="fechaEntrega">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="garantia">Garantía</label>
                                        <input type="text" placeholder="Garantía" name="garantia" id="garantia">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <input type="text" placeholder="Dirección" name="direccion"
                                            id="direccion">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ubigeo">Ubigeo</label>
                                        <input type="text" placeholder="Ubigeo" name="ubigeo" id="ubigeo">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="provincia">Provincia</label>
                                        <select class="custom-select" name="provincia" id="provincia">
                                            <option selected class="d-none">Seleccionar opción</option>
                                            <option value="1">Lima</option>
                                            <option value="2">Arequipa</option>
                                            <option value="3">Moquegua</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tecnicoInstalador">Técnico instalador</label>
                                        <select class="custom-select" name="tecnicoInstalador"
                                            id="tecnicoInstalador">
                                            <option selected class="d-none">Seleccionar opción</option>
                                            <option value="1">Tecnico 1</option>
                                            <option value="2">Tecnico 2</option>
                                            <option value="3">Tecnico 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tecnicoAjustador">Técnico ajustador</label>
                                        <select class="custom-select" name="tecnicoAjustador" id="tecnicoAjustador">
                                            <option selected class="d-none">Seleccionar opción</option>
                                            <option value="1">Tecnico 1</option>
                                            <option value="2">Tecnico 2</option>
                                            <option value="3">Tecnico 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tiposAscensor">Tipo de ascensor</label>
                                        <select class="custom-select" name="tiposAscensor" id="tiposAscensor">
                                            <option selected class="d-none">Seleccionar opción</option>
                                            <option value="1">Tipo 1</option>
                                            <option value="2">Tipo 2</option>
                                            <option value="3">Tipo 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tiposAscensor">Cantidad</label>
                                        <select class="custom-select" name="tiposAscensor" id="tiposAscensor">
                                            <option selected class="d-none">Seleccionar</option>
                                            <option value="1">Cantidad 1</option>
                                            <option value="2">Cantidad 2</option>
                                            <option value="3">Cantidad 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12"></div>
                                <div class="col-md-6">
                                    <div class="adornoinput mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="MGratuito"
                                                name="MGratuito">
                                            <label class="custom-control-label" for="MGratuito">Mantenimiento
                                                gratuito?</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="adornoinput mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="SinCuarto"
                                                name="SinCuarto">
                                            <label class="custom-control-label" for="SinCuarto">Sin cuarto de
                                                maquina?</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="adornoinput mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="ConCuarto"
                                                name="ConCuarto">
                                            <label class="custom-control-label" for="ConCuarto">Con cuarto de
                                                maquina?</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Npisos"># de pisos</label>
                                        <input type="text" placeholder="#" name="Npisos" id="Npisos">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Ncontacto">Nombre del Contacto</label>
                                        <input type="text" placeholder="Nombre del contacto" name="Ncontacto"
                                            id="Ncontacto">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" placeholder="Teléfono" name="telefono" id="telefono">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="correo">Correo electrónico</label>
                                        <input type="text" placeholder="Correo electrónico" name="correo"
                                            id="correo">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="correo">Correo electrónico</label>
                                        <input type="text" placeholder="Correo electrónico" name="correo"
                                            id="correo">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Descripcion1">Descripción 1</label>
                                        <textarea name="Descripcion1" id="Descripcion1" placeholder="Descripción" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 d-none position-relative" id="DAdicional">
                                    <div class="form-group">
                                        <label for="Descripcion2">Descripción 2</label>
                                        <textarea name="Descripcion2" id="Descripcion2" placeholder="Descripción" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn-gris" id="AgregarDescripcion">+ Agregar
                                        Descripción</button>
                                </div>
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
            <div class="modal-body body_modal">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" class="formulario-modal">
                            <div class="form-group">
                                <label for="TRevision">Tipo de revisión</label>
                                <input type="text" placeholder="Tipo de revisión" name="TRevision"
                                    id="TRevision">
                            </div>
                            <div class="form-group">
                                <label for="MAscensor">Ascensor</label>
                                <select class="custom-select" name="MAscensor" id="MAscensor">
                                    <option selected class="d-none">Seleccionar opción</option>
                                    <option value="1">Ascensor 1</option>
                                    <option value="2">Ascensor 2</option>
                                    <option value="3">Ascensor 3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Direccion">Dirección</label>
                                <input type="text" placeholder="Dirección" name="Direccion" id="Direccion">
                            </div>
                            <div class="form-group">
                                <label for="provinciaAs">Provincia</label>
                                <input type="text" placeholder="Provincia" name="provinciaAs" id="provinciaAs">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="NCertificado">Núm Certificado</label>
                                        <input type="text" placeholder="Núm Certificado" name="NCertificado"
                                            id="NCertificado">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="NMaquina">#Máquina</label>
                                        <input type="text" placeholder="#Máquina" name="NMaquina" id="NMaquina">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Supervisor">Supervisor</label>
                                <select class="custom-select" name="Supervisor" id="Supervisor">
                                    <option selected class="d-none">Seleccionar opción</option>
                                    <option value="1">Supervisor 1</option>
                                    <option value="2">Supervisor 2</option>
                                    <option value="3">Supervisor 3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tecnico">Técnico</label>
                                <select class="custom-select" name="tecnico" id="tecnico">
                                    <option selected class="d-none">Seleccionar opción</option>
                                    <option value="1">Técnico 1</option>
                                    <option value="2">Técnico 2</option>
                                    <option value="3">Técnico 3</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Mprogramado">Mes programado</label>
                                        <select class="custom-select" name="Mprogramado" id="Mprogramado">
                                            <option selected class="d-none">Seleccionar opción</option>
                                            <option value="1">Mes programado 1</option>
                                            <option value="2">Mes programado 2</option>
                                            <option value="3">Mes programado 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="FMantenimiento">Fecha de mantenimiento</label>
                                        <input type="date" placeholder="dd/mm/aaaa" name="FMantenimiento"
                                            id="FMantenimiento">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="FInicio">Hora inicio</label>
                                        <input type="time" placeholder="dd/mm/aaaa" name="FInicio"
                                            id="FInicio">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="HFin">Hora fin</label>
                                        <input type="time" placeholder="dd/mm/aaaa" name="HFin"
                                            id="HFin">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="observaciones">Observaciónes</label>
                                        <textarea name="observaciones" id="observaciones" placeholder="Comentario de contrato" cols="30"
                                            rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="observacionesInternas">Observaciónes internas</label>
                                        <textarea name="observacionesInternas" id="observacionesInternas" placeholder="Observaciónes internas"
                                            cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="solucion">Solución</label>
                                        <textarea name="solucion" id="solucion" placeholder="Solución" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
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
            <div class="modal-body body_modal">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" class="formulario-modal">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Foto de repuesto</label>
                                    <div id="imagenPrevio"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="">
                                        <label for="imageUpload1" class="text-gris mt-4">Seleccione una
                                            imagen</label>
                                        <input type="file" id="imageUpload1" style="display: none;"
                                            accept="image/*" />
                                        <button type="button" id="cargarimagen" class="btn-gris">
                                            <i class="fas fa-arrow-to-top mr-2"></i>Subir Imagen
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="NombreRepuesto">Nombre</label>
                                        <input type="text" placeholder="Nombre" name="NombreRepuesto"
                                            id="NombreRepuesto">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="precioRepuesto">Precio</label>
                                        <input type="text" placeholder="Precio" name="precioRepuesto"
                                            id="precioRepuesto">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="DescripcionRepuesto">Descripción</label>
                                        <textarea name="DescripcionRepuesto" id="DescripcionRepuesto" placeholder="Descripción" cols="30"
                                            rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Flimpieza">Frecuencia de limpieza (días)</label>
                                        <input type="text" placeholder="Frecuencia de limpieza (días)"
                                            name="Flimpieza" id="Flimpieza">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Flubricacion">Frecuencia de lubricación (días)</label>
                                        <input type="text" placeholder="Frecuencia de lubricación (días)"
                                            name="Flubricacion" id="Flubricacion">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="FAjustes">Frecuencia de ajuste (días)</label>
                                        <input type="text" placeholder="Frecuencia de ajuste (días)"
                                            name="FAjustes" id="FAjustes">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="FRevision">Frecuencia de revisión (días)</label>
                                        <input type="text" placeholder="Frecuencia de revisión (días)"
                                            name="FRevision" id="FRevision">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="FCambio">Frecuencia de cambio (días)</label>
                                        <input type="text" placeholder="Frecuencia de cambio (días)"
                                            name="FCambio" id="FCambio">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="FSolicitud">Frecuencia de solicitud (días)</label>
                                        <input type="text" placeholder="Frecuencia de solicitud (días)"
                                            name="FSolicitud" id="FSolicitud">
                                    </div>
                                </div>
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

<!-- Modal Crear Personal-->
<div class="modal left fade" id="crearPersonal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-family-Outfit-SemiBold">Crear Personal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body body_modal">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" class="formulario-modal">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Foto de Personal</label>
                                    <div id="imagenPrevioPersonal"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="">
                                        <label for="imageUpload10" class="text-gris mt-4">Seleccione una
                                            imagen</label>
                                        <input type="file" id="imageUpload10" style="display: none;"
                                            accept="image/*" />
                                        <button type="button" id="cargarimagenpersonal" class="btn-gris">
                                            <i class="fas fa-arrow-to-top mr-2"></i>Subir Imagen
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="NombrePersonal">Nombre</label>
                                        <input type="text" placeholder="Nombre" name="NombrePersonal"
                                            id="NombrePersonal">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="posicionPersonal">Posición</label>
                                        <select class="custom-select" name="posicionPersonal"
                                            id="posicionPersonal">
                                            <option selected class="d-none">Seleccionar opción</option>
                                            <option value="1">Posición 1</option>
                                            <option value="2">Posición 2</option>
                                            <option value="3">Posición 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="correoPersonal">Correo</label>
                                        <input type="text" placeholder="Correo" name="correoPersonal"
                                            id="correoPersonal">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="telefonoPersonal">Teléfono</label>
                                        <input type="text" name="telefonoPersonal" id="telefonoPersonal"
                                            placeholder="Teléfono">
                                    </div>
                                </div>
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

<!-- Modal Crear Usuario-->
<div class="modal left fade" id="crearUsuario" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-family-Outfit-SemiBold">Crear Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body body_modal">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" class="formulario-modal">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Foto de usuario</label>
                                    <div id="imagenPrevioUsuario"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="">
                                        <label for="imageUploadUsuario" class="text-gris mt-4">Seleccione una
                                            imagen</label>
                                        <input type="file" id="imageUploadUsuario" style="display: none;"
                                            accept="image/*" />
                                        <button type="button" id="cargarimagenUsuario" class="btn-gris">
                                            <i class="fas fa-arrow-to-top mr-2"></i>Subir Imagen
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Username">Username</label>
                                        <input type="text" placeholder="Username" name="Username"
                                            id="Username">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="NombreUsuario">Nombre</label>
                                        <input type="text" placeholder="Nombre" name="NombreUsuario"
                                            id="NombreUsuario">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="correoUsuario">Correo</label>
                                        <input type="text" placeholder="Correo" name="correoUsuario"
                                            id="correoUsuario">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="telefonoUsuario">Teléfono</label>
                                        <input type="text" name="telefonoUsuario" id="telefonoUsuario"
                                            placeholder="Teléfono">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Empleado">Empleado</label>
                                        <select class="custom-select" name="Empleado" id="Empleado">
                                            <option selected class="d-none">Seleccionar opción</option>
                                            <option value="1">Empleado 1</option>
                                            <option value="2">Empleado 2</option>
                                            <option value="3">Empleado 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="contrasenaUser">Contraseña</label>
                                        <input type="text" name="contrasenaUser" id="contrasenaUser"
                                            placeholder="Contraseña">
                                    </div>
                                </div>
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

<!-- alerta carga-->
<div id="alertaCarga" class="alert alert-elevatronic alert-dismissible" style="display: none;">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong class="mr-2"><img src="img/iconos/check.svg" alt="icono"></strong> Carga de archivo exitosa
</div>

<!-- alerta envio-->
<div id="alertaEnvio" class="alert alert-elevatronic alert-dismissible" style="display: none;">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong class="mr-2"><img src="img/iconos/check.svg" alt="icono"></strong> Envio Exitoso
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

<script src="https://fullcalendar.io/releases/fullcalendar/3.10.0/fullcalendar.min.js"></script>
<script src="{{ asset('js/es.js') }}"></script>
<script src="https://fullcalendar.io/releases/fullcalendar/3.10.0/lib/moment.min.js"></script>
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

    $('#uploadButton').click(function() {
        $('#imageUpload').click();
    });

    $('#imageUpload').change(function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview').show();
        }
        reader.readAsDataURL(this.files[0]);
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

    $('#cargarimagenpersonal').click(function() {
        $('#imageUpload10').click();
    });

    $('#imageUpload10').change(function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagenPrevioPersonal').css('background-image', 'url(' + e.target.result + ')');
            $('#imagenPrevioPersonal').show();
        }
        reader.readAsDataURL(this.files[0]);
    });


    $('#cargarimagenUsuario').click(function() {
        $('#imageUploadUsuario').click();
    });

    $('#imageUploadUsuario').change(function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagenPrevioUsuario').css('background-image', 'url(' + e.target.result + ')');
            $('#imagenPrevioUsuario').show();
        }
        reader.readAsDataURL(this.files[0]);
    });
</script>
@stack('scripts')

</body>



</html>
<!-- end document-->
