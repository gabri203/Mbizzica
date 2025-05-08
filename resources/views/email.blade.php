<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Mbizzica</title>
    </head>
    <body style="margin:0;padding:0;background:#333;color:white;">
        <div style="width:400px;height:100vh;display:flex;flex-direction:column;justify-content:center;margin:auto;">
            <form action="{{ route('email.submit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <h2>Email</h2>
                    <input type="email" name="email" placeholder="Email" style="width:350px;">
                </div>
                <div class="mb-3">
                    <strong style="color:#FFA07A">Inserisce l'email cosi ti verrà inviato il link</strong>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" style="width:100px;">Invio</button>
                </div>
            </form>
        </div>
    </body>
</html>
