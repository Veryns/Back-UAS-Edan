<h1>{{ Auth::guard('student')->user()->name }}</h1>

<br>

<div>
    <a href="{{ route('matkul.index') }}">
        <button>Mata Kuliah</button>
</a>
</div>

        <!-- Menu Navigasi -->
        <ul class="sidebar-menu">
            <a href="{{ route('matkul.index') }}">
                <button class="menu-item">
                    <i class="fa-solid fa-book-bookmark"></i>
                    <span>Mata Kuliah</span>
                </button>
            </a>
            <a href="{{ route('student.grades') }}">
                <button class="menu-item">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <span>Grades (Nilai)</span>
                </button>
            </a>
            <a href="/uang-kuliah/menu">
                <button class="menu-item">
                    <i class="fa-solid fa-credit-card"></i>
                    <span>Uang Kuliah</span>
                </button>
            </a>
            <a href="{{ route('skpi.index') }}">
                <button class="menu-item">
                    <i class="fa-solid fa-file-invoice"></i>
                    <span>SKPI</span>
                </button>
            </a>
        </ul>

<br><br>

<form method="POST" action="{{ route('student.logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>