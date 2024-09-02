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
    <!-- Include jQuery Validation Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <section class="bg_login">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 col-12">
                        <div class="login">
                            <div class="text-center">
                                <img src="img/logo.svg" alt="logo">
                            </div>
                            <div class="text-center">
                                <h4>
                                    Bienvenido, Inicia sesión
                                </h4>
                            </div>

                            <div class="message">
                            </div>

                            <form action="{{ route('login') }}" method="post" id="login">
                                @csrf <!-- CSRF Protection -->
                                <div class="form-group">
                                    <label for="email">Correo electrónico</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Correo electrónico">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password">Contraseña</label>
                                    <input type="password" name="password" id="password"
                                        class="form-control"placeholder="Contraseña">
                                </div>
                                <div class="form-group mb-4">
                                    <button type="submit" class="btn-primario">Iniciar Sesión</button>
                                </div>
                                <div class="line-form"></div>
                                <div class="form-group">
                                    <p>¿Olvidaste tu contraseña?</p>
                                    <button type="button" class="btn-lineal" onclick="checkEmail()">Recuperar
                                        contraseña</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</body>

</html>
<script>
    function checkEmail() {
        var email = document.getElementById('email').value;
        if (email) {
            // Check if email exists via AJAX
            $.ajax({
                url: "{{ route('check.email') }}", // New route for checking email
                type: "POST",
                data: {
                    email: email,
                    _token: '{{ csrf_token() }}' // Include CSRF token
                },
                success: function(response) {
                    if (response.exists) { // Assuming response contains 'exists' key
                        $.ajax({
                            url: "{{ route('forget.password.email') }}",
                            type: "POST",
                            data: {
                                email: email,
                                _token: '{{ csrf_token() }}' // Include CSRF token
                            },
                            success: function(response) {
                                console.log(response);
                                // Handle success response
                                $('.message').prepend(
                                    '<div class="alert alert-success">Enlace de restablecimiento de contraseña enviado con éxito</div>'
                                );
                                setTimeout(function() {
                                    $(".message").fadeOut(1000); // Fades out success message
                                    window.location.href = "{{ route('session') }}"; // Redirect to session route
                                }, 1000); // Timeout for 1 second
                            },
                            error: function(xhr) {
                                $('.message').prepend(
                                    '<div class="alert alert-danger">Error en la solicitud.</div>'
                                );
                                setTimeout(function() {
                                    $(".message").fadeOut(1000);
                                }, 1000);
                            }
                        });
                    } else {
                        $('.message').prepend(
                            '<div class="alert alert-danger">Usuario no encontrado.</div>'
                        );
                        setTimeout(function() {
                            $(".message").fadeOut(1000); 
                        }, 3000); 
                    }
                },
                error: function(xhr) {
                    $('.message').prepend(
                        '<div class="alert alert-danger">Error en la solicitud.</div>'
                    );
                    setTimeout(function() {
                        $(".message").fadeOut(1000); 
                    }, 1000); 
                }
            });
        } else {
            window.location.href = "{{ route('session') }}"; // Redirect if email is blank
        }
    }
    $(document).ready(function() {
        $('#login').validate({ // Use .validate() method
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8 // Added minlength rule
                }
            },
            messages: {
                email: {
                    required: 'Por favor, ingresa un correo electrónico',
                    email: 'Por favor, ingresa un correo electrónico válido'
                },
                password: {
                    required: "Por favor, ingrese la contraseña",
                    minlength: "La contraseña debe tener al menos 8 caracteres"
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
    });
</script>
