<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login Admin</h2>

    @if ($errors->any())
        <div>
            <strong>Error!</strong> {{ $errors->first('email') }}
        </div>
        <br>
    @endif

    <form method="POST" action="/login">
        @csrf
        <label>Email:</label><br>
        <input type="email" name="email"><br><br>

        <label>Password:</label><br>
        <input type="password" name="password"><br><br>

        <button type="submit">Login</button><br><br>
    </form>

    <a href="{{ route('welcome') }}">
        <button type="button">Kembali</button>
    </a>

</body>
</html>