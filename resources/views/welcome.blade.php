<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Mbizzica</title>
    </head>
    <body style="margin:0; background: #333; color:antiquewhite;">
        <div class="mt-1" style="height: 100vh;width: 413px;display: flex;flex-direction: column;justify-content: center;margin: auto;">
            <h1>Benvenuto su Mbizzica</h1>
            <div>
                <a href="{{ route('login') }}">Login</a>/<a href="{{ route('register') }}">Register</a>
            </div>
        </div>
    </body>
</html>
