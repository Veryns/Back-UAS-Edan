<h1>Selamat datang, {{ Auth::guard('student')->user()->name }}</h1>

<br>

<div>
<a href="{{ route('matkul.index') }}">
    <button>Mata Kuliah</button>
</a>
</div>

<div>
<a href="{{ route('student.grades') }}">
    <button>Grades</button>
</a>
</div>

<div>
<a href="/uang-kuliah/menu">
    <button>Uang Kuliah</button>
</a>
</div>

<div>
<a href="{{ route('skpi.index') }}">
    <button>SKPI</button>
</a>
</div>

<br><br>

<form method="POST" action="{{ route('student.logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>