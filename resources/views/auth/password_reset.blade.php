<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enlace para restablecer contraseña</title>
</head>

<body>
    <p>Hola {{ $user->name }} </p>

    <p>Está recibiendo este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.</p>

    <p>Por favor haga clic en el siguiente enlace para restablecer su contraseña:</p>

    @component('mail::button', ['url' => url('reset/' . $user->remember_token)])
    Restablecer su contraseña
    @endcomponent


    <p>Si no solicitó un restablecimiento de contraseña, no es necesario realizar ninguna otra acción.</p>

    <p>¡Gracias!</p>
</body>

</html>
