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
        <div class="" style="height:100vh; width:300px; margin:auto; display:flex; flex-direction:column; justify-content:center; ">
            <h2>Mbizzica</h2>
            <form action="{{ route('paste.store') }}" method="POST">
            @csrf
            <textarea name="content" rows="10" required>{{ old('content') }}</textarea>
            <input type="datetime-local" name="expires_at" value="{{ old('expires_at') }}">
            <button type="submit" class="btn btn-primary">Salva</button>
          </form>
          <div>
            <form action="{{ route('logout.submit') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Logout</button>
            </form>
        </div>
        </div>

    </body>
</html>
