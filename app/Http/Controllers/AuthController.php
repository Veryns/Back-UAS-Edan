<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Models\User;


    class AuthController extends Controller{
        public function showLogin(){
            return view('login');   
        }

        public function login(Request $request){
            $credentials = $request->validate(['email' => ['required', 'email'],'password' => ['required'],
            ]);
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/home');
            }
            return back()->withErrors(['email' => 'Email atau Password yang anda masukkan salah',
            ]);
        }

        // fungsi buat logout
        public function logout(Request $request){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login');
        }

        // fungsi buat home
        public function home(){
            return view('home');
        }

        // fungsi untuk register
        public function showRegister()
        {
            return view('auth.register');
        }

        public function register(Request $request)
        {
            $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
            ], [
                'name.required'      => 'Nama wajib diisi!', // error handling ketika user tidak mengisi
                'email.required'     => 'Email wajib diisi!', // error handling ketika user tidak mengisi
                'email.email'        => 'Format email tidak valid!', // error handling ketika user tidak mengisi email dengan benar
                'email.unique'       => 'Email sudah terdaftar.',   // error handling ketika user tidak mengisi
                'password.required'  => 'Password wajib diisi!', // error handling ketika user tidak mengisi
                'password.confirmed' => 'Password dan konfirmasi password harus sama!', // error handling jika password dan konfirmasi password tidak sama
                'password.min' => 'Minimal password adalah 6 karakter.', // error handling jika password kurang dari 6 karakter
            ]);


            User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => $request->password,
            ]);

            return redirect()->back()->with('success', 'Akun berhasil dibuat.');
        }
    }
