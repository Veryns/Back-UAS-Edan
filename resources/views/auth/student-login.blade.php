<h1>Login Mahasiswa</h1>

<form method="POST" action="{{ route('student.login') }}">
    @csrf
    Email:
    <br>
    <input type="email" name="email" required>
    <br><br>
    Password:
    <br>
    <input type="password" name="password" required>
    <br><br>
    <button type="submit">Login</button>
</form>

<a href="{{ route('student.credential') }}">
    <button type="button">Lupa password</button>
</a>