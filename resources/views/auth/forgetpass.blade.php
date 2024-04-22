@extends('layouts.main')

@section('content')
               
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
                                Recupera tu contraseña
                            </h4>
                            <p>
                                Introduce tu correo y enviaremos instrucciones sobre cómo restablecerlo.
                            </p>
                        </div>
                        <form action="" method="post">
                            <div class="form-group mb-5">
                                <label for="correo">Correo electrónico</label>
                                <input type="text" name="correo" id="correo" placeholder="Correo electrónico">
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn-primario" id="envia">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
            
@endsection
