<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
    </head>
    <body>
        <h1>{{ Auth::user()->name }}</h1>

        <div>
            <a href="{{ route('announcements.index') }}">
                <button>Pengumuman</button>
            </a>
        </div>

            <!-- tombol matkul -->
            <div>
                <a href="{{ route('matkul.index') }}">
                    <button>Mata Kuliah</button>
                </a>
            </div>

            <!-- tombol logout -->
            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </body>
    </html>
        <div>
            <a href="{{ route('students.index') }}">
                <button>Student</button>
            </a>
        </div>

        <div>
            <a href="{{ url('/home/grades') }}">
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

        <div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </body>
</html>
