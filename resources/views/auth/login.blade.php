@extends('layouts.main')

@section('content')
               
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
                        <form action="{{ route('login') }}" method="post">
                            <div class="form-group">
                                <label for="correo">Correo electrónico</label>
                                <input type="text" name="correo" id="correo" placeholder="Correo electrónico">
                            </div>
                            <div class="form-group mb-4">
                                <label for="pass">Contraseña</label>
                                <input type="password" name="pass" id="pass" placeholder="Contraseña">
                            </div>
                            <div class="form-group mb-4">
                                <button type="button" class="btn-primario">Iniciar Sesión</button>
                            </div>
                            <div class="line-form"></div>
                            <div class="form-group">
                                <p>¿Olvidaste tu contraseña?</p>
                                <a href="{{ route('forgetpass')}}" class="btn-lineal">Recuperar contraseña</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
            
@endsection
