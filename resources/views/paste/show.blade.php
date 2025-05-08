<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Mbizzica</title>
    </head>
    <body>
        <div class="#" style="height:100vh; width:300px; display:flex; flex-direction:column; justify-content:center; margin:auto; ">
        <h1>Slug: {{ $paste->slug }}</h1>{{-- quando scrivo $paste->slug gli sto praticamento dicendo di prendere dall'oggetto $paste il contenuto di slug cioè del token univoco --}}
        <h2>Contenuto: {{ $paste->content }}</h2>{{-- $paste->content gli sto dicendo di accedere al contenuto dell'oggetto $paste e stamparlo con il tag h2 --}}

        @if($paste->expires_at){{-- se nell'oggetto $paste c'è expires_at mi stampa l'expires_at --}}
        <p>Expires_at: {{ $paste->expires_at->format('d/m/Y H:i') }}</p>{{-- quando scrivo $paste->expires_at praticamente gli sto dicendop di prende le informazioni dall'oggetto $paste specificandogli quali informazioni,in questo caso ->expires_at che li prende dal DB --}}
        @endif
        </div>

    </body>
</html>
