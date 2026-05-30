<h2>Buat Akun</h2>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('register.store') }}">
    @csrf

    <div>
        <input type="text" name="name" placeholder="Nama" value="{{ old('name') }}">
        @error('name')
            <span style="color: red;">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
        @error('email')
            <span style="color: red;">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <input type="password" name="password" placeholder="Password">
        @error('password')
            <span style="color: red;">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password">
    </div>

    <button type="submit">Daftar</button>

    <a href="{{ route('login') }}">
        <button type="button">Login Sekarang</button>
    </a>

</form>
