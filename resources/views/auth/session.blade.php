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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <section class="bg_login">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 col-12">
                        <div class="login">
                            <div class="form-envia" id="form-envia">
                                <div class="mb-2">
                                    <a href="{{ route('login') }}">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </div>
                                <div class="mb-5">
                                    <h4 class="mb-1">
                                        Enviamos con éxito el enlace
                                    </h4>
                                    <p>
                                        Te hemos enviado un enlace para restablecer la contraseña a tu correo. <br><br>
                                        No olvides de revisar tu carpeta de Correos no deseados o Spam.
                                    </p>
                                </div>
                                <a href="{{ route('login') }}" class="btn-primario mb-3 d-block text-white">Iniciar Sesión</a>
                                <a href="{{ route('forget.password') }}" class="btn-lineal mb-3" id="muestraRecupera">Reenviar</a>
                                <p class="text-center text-gris" id="cuentaRegresiva">Quedan 1:20 min</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
