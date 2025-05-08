<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Mbizzica</title>
    </head>
    <body style="margin: 0; background:#333;">
        <div class="#" style="height:80vh; display:flex; flex-direction:column;justify-content:center; margin:auto; width:300px; border-style:solid; border-width:3px; padding:3em; margin-top:2.2em; background:whitesmoke;" >
        <form action="{{ route('login.submit') }}" method="POST">
            <h2>Login</h2>
            @csrf
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary">Accedi</button>
        </form>
        <div class="mb-3">
        Non hai una account?<a href="/register">Register</a>
        </div>
        <div class="mb-3">
        <a href="/email">Password dimentica?</a>
        </div>
        </div>
    </body>
</html>
