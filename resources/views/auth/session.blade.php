@extends('layouts.main')

@section('content')
    <section class="bg_login">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 col-12">
                    <div class="login">
                        <form action="" method="post">
                            <div class="form-envia d-none" id="form-envia">
                                <div class="mb-2">
                                    <a href="">
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
                                <a href="" class="btn-primario mb-3 d-block text-white">Iniciar Sesión</a>
                                <a href="javascript:void(0);" class="btn-lineal mb-3" id="muestraRecupera">Reenviar</a>
                                <p class="text-center text-gris" id="cuentaRegresiva">Quedan 1:20 min</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
