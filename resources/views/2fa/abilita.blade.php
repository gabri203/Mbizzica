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
        <div class="#" style="margin:auto; height:100vh; width:300px; display:flex;flex-direction:column;justify-content:center;">
            <h2>Qr code</h2>
            <p>Scansiona il qrcode</p>
            <div id="qrImage">{!! $qrImage !!}</div>{{-- Mostra il QrCode --}}

            <strong>Codice manuale da inserire su google authenticator</strong><div>{{$secret}}</div>
            <form action="{{ route('2fa.submit') }}" method="POST">
                <h2>Inserisce il codice manualmente OTP</h2>
                @csrf
                <input type="text" name="otp" placeholder="Codice OTP">
                <button type="submit">Verifica</button>
            </form>
        </div>
    </body>
</html>
