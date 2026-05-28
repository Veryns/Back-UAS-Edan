<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
    </head>
        <body>
            <h1>Welcome, {{ Auth::user()->name }}</h1>

            <!-- tombol post -->
            <a href="{{ route('posts.index') }}">
                <button>Daftar Post</button>
            </a>

            <!-- tombol student -->
            <a href="{{ route('students.index') }}">
                <button>Student</button>
            </a>

            <br>

            <!-- grades -->
            <a href="{{ url('/home/grades') }}">
                <button>Grades</button>
            </a>

            <!-- tombol logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </body>
    </html>