<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
    </head>
        <body>
            <h1>Welcome, {{ Auth::user()->name }}</h1>

            <!-- tombol post -->
            <div>
                <a href="{{ route('posts.index') }}">
                    <button>Daftar Post</button>
                </a>
            </div>

            <!-- tombol student -->
            <div>
                <a href="{{ route('students.index') }}">
                    <button>Student</button>
                </a>
            </div>

            <!-- grades -->
            <div>
                <a href="{{ url('/home/grades') }}">
                    <button>Grades</button>
                </a>
            </div>

            <!-- tombol Uang Kuliah -->
            <div>
                <a href="/uang-kuliah/menu">
                    <button>Uang Kuliah</button>
                </a>
            </div>

            <!-- tombol skpi -->
            <div>
                <a href="{{ route('skpi.index') }}">
                    <button>SKPI</button>
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