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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <section class="bg_login">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 col-12">
                        <div class="login">
                            <div class="form-recupera" id="form-recupera">
                                <div class="mb-2">
                                    <a href="">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </div>
                                <div class="mb-4">
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
                                    <h4 class="mb-1">
                                        Recupera tu contraseña
                                    </h4>
                                    <p>
                                        Introduce tu correo y enviaremos instrucciones sobre cómo restablecerlo.
                                    </p>
                                </div>
                                <form method="POST" action="{{ route('forget.password.email') }}" class="login" id="login">
                                    @csrf
                                    <div class="form-group mb-5">
                                        <label for="correo">Correo electrónico</label>
                                        <input type="email" name="email" id="email"
                                            class="form-control"
                                            placeholder="Correo electrónico">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn-primario" id="envia">Enviar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        $('#login').validate({ // Use .validate() method
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            email: {
                required: 'Por favor, ingresa un correo electrónico',
                email: 'Por favor, ingresa un correo electrónico válido'
            }
        },
        errorElement: "span",
        errorPlacement: function(error, element) {
            error.addClass("invalid-feedback");
            error.insertAfter(element);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass("is-invalid").addClass("is-valid");
        }
    });
        setTimeout(function() {
            $(".alert-success").fadeOut(1000);
        }, 1000);
        setTimeout(function() {
            $(".alert-danger").fadeOut(1000);
        }, 1000);
    });
</script>
