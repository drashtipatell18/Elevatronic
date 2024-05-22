@extends('layouts.app')

@section('content')
    <style>
        .form-control {
            width: 100%;
            min-height: 28px !important;
        }

        .text-center {
            text-align: center;
        }
    </style>
    <section class="form-02-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="_lk_de">
                        <div class="form-03-main">
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
                            <h3 class="text-center">Reset Password</h3>

                            <form method="POST" action="{{ route('post_reset', ['token' => $token]) }}" class="login">
                                @csrf
                                <div class="form-group">
                                    <input type="password" name="newpassword" value=""
                                        class="form-control @error('newpassword') is-invalid @enderror"
                                        placeholder="New Password">
                                    @error('newpassword')
                                        <span class="invalid-feedback" style="color: red">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password"
                                        class="form-control @error('confirmpassword') is-invalid @enderror"
                                        name="confirmpassword" value="" placeholder="Confirm Password">
                                    @error('confirmpassword')
                                        <span class="invalid-feedback" style="color: red">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="_btn_04">{{ __('Submit') }}</button>
                                </div>
                            </form>

                            <div class="form-group pt-0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $(".alert-success").fadeOut(1000);
            }, 1000);
        });
    </script>
@endpush
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
                            <div class="form-recupera" id="form-recupera">
                                <div class="mb-2">
                                    <a href="">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </div>
                                <div class="mb-4">
                                    <h4 class="mb-1">
                                        Restablecer la contraseña
                                    </h4>
                                </div>
                                <form method="POST" action="{{ route('post_reset', ['token' => $token]) }}"
                                    class="login">
                                    @csrf
                                    <div class="form-group">
                                        <input type="password" name="newpassword" value=""
                                            class="form-control @error('newpassword') is-invalid @enderror"
                                            placeholder="New Password">
                                        @error('newpassword')
                                            <span class="invalid-feedback" style="color: red">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password"
                                            class="form-control @error('confirmpassword') is-invalid @enderror"
                                            name="confirmpassword" value="" placeholder="Confirm Password">
                                        @error('confirmpassword')
                                            <span class="invalid-feedback" style="color: red">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn-primario">{{ __('Submit') }}</button>
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
  $.validator.addMethod("passwordFormat", function(value, element) {
            // Password must contain at least one uppercase letter, one special character, and be at least 8 characters long
            return this.optional(element) || /^(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value);
        }, "La contraseña debe tener al menos 8 caracteres, comenzar con una letra mayúscula y contener al menos un carácter especial.");

        $(document).ready(function () {
            $('form.login').validate({
                rules: {
                    newpassword: {
                        required: true,
                        passwordFormat: true
                    },
                    confirmpassword: {
                        required: true,
                        equalTo: 'input[name="newpassword"]'
                    }
                },
                messages: {
                    newpassword: {
                        required: "Please enter a new password",
                        passwordFormat: "La contraseña debe tener al menos 8 caracteres, comenzar con una letra mayúscula y contener al menos un carácter especial."
                    },
                    confirmpassword: {
                        required: "Please confirm your new password",
                        equalTo: "The confirmation password does not match"
                    }
                },
                errorElement: 'span',
                errorClass: 'invalid-feedback',
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                }
            });
        });
</script>

