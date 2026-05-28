<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;


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
            return back()->withErrors(['email' => 'Invalid credentials.',
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
    }
