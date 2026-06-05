<h1>Selamat datang, {{ Auth::guard('student')->user()->name }}</h1>

<a href="{{ route('student.logout') }}">Logout</a>