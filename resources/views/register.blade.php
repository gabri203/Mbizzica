<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Mbizzica</title>
    </head>
    <body style="margin: 0; background:#333;">
        <div class="#" style="height:80vh; display:flex; flex-direction:column;justify-content:center; margin:auto; width:300px; border-style:solid; border-width:3px; padding:3em; margin-top:2.2em; background:whitesmoke;">
            <form action="{{ route('register.submit') }}" method="POST">
                <h3>Register</h3>
                @csrf
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" placeholder="Name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Conferma Password</label>
                    <input type="password" name="password_confirmation" placeholder="Conferma Password" required>
                </div>
                    <button type="submit" class="btn btn-primary">Conferma</button>
            </form>

        </div>
    </body>
</html>
