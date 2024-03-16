<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EliTest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function viewRegister() {
        return view('auth.daftar');
    }
    
    public function viewLogin() {
        return view('auth.masuk');
    }

    public function viewForgotPassword() {
        return view('auth.lupaSandi');
    }

    public function viewResetPassword($user_id) {
        return view('auth.resetSandi', [
            'userId'=>$user_id
        ]);
    }

    public function register(Request $request) {
        $rules = [
            'name'=>['required', 'max:100'],
            'password'=>['required', 'max:20', 'min:5'],
            'email'=>['required', 'email:dns', 'max:100'],
            'gender'=>['required', 'max:10'],
            'born'=>['required'],
            'address'=>['required', 'max:100'],
            'phone'=>['required', 'max:15', 'unique:users'],
            'province'=>['required', 'max:100'],
            'city'=>['required', 'max:100'],
            'subdistrict'=>['required', 'max:100'],
            'postal_code'=>['required', 'max:10'],
            'image'=>['required', 'max:4096']
        ];

        $messages = [
            'required'=>'Kolom harus diisi!',
            'max'=>'Maksimal :max karakter!',
            'min'=>'Minimal :min karakter!',
            'email'=>'Format email tidak sesuai',
            'unique'=>'Data sudah terdaftar',
            'max:4096'=>'Maksimal 4 MB'
        ];

        $validatedData = $request->validate($rules, $messages);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->password = Hash::make($validatedData['password']); 
        $user->email = $validatedData['email'];
        $user->gender = $validatedData['gender'];
        $user->born = $validatedData['born'];
        $user->address = $validatedData['address'];
        $user->phone = '62'.$validatedData['phone'];
        $user->province = $validatedData['province'];
        $user->city = $validatedData['city'];
        $user->subdistrict = $validatedData['subdistrict'];
        $user->postal_code = $validatedData['postal_code'];
        
        $path = 'assets/users/profile';
        $imgFile = $request->file('image');

        if ($imgFile != null) {
            $fileName = time().'-'.str_replace(' ', '-', $imgFile->getClientOriginalName());
            $imgFile->move($path, $fileName);

            $user->image = $fileName;
        }

        $user->save();

        return redirect()->back()->with('success', 'Berhasil mendaftar.');
    }

    public function login(Request $request) {
        $rules = [
            'email'=>['required', 'max:100', 'email:dns'],
            'password'=>['required', 'max:20'],
        ];

        $messages = [
            'required'=>'Kolom harus diisi!',
            'max'=>'Maksimal :max karakter',
            'email:dns'=>'Format tidak sesuai',
        ];

        $credentials = $request->validate($rules, $messages);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek user role
            if (Auth::user()->role == 'admin') {
                return redirect()->route('dashboard');
            } elseif (Auth::user()->role == 'user') {
                return redirect()->route('home');
            } 
        }

        return back()->with('error', 'Terdapat kesalahan, mohon cek kembali email dan kata sandi Anda.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->guest('/karuniamotor/login');
    }

    public function checkUserEmail(Request $request) {
        $validatedData = $request->validate([
            'email'=>['required', 'email:dns']
        ], [
            'email.required'=>'Kolom harus diisi!',
            'email.emaik'=>'Format tidak sesuai.'
        ]);

        $user = User::where('email', $validatedData['email'])->first();

        if ($user) {
            return redirect()->route('resetPassword', ['user_id'=>$user->id]);
        }

        return back()->with('error', 'Email tidak valid, mohon periksa kembali.');
    }

    function updatePassword(Request $request) {
        $validatedData = $request->validate([
            'password'=>['required', 'min:5', 'max:20', 'same:password_confirmation'],
            'password_confirmation'=>['required', 'min:5', 'max:20'],
        ]);

        $user = User::where('id', $request->userId)->first();

        if ($user) {
            $validatedData['password'] = Hash::make($validatedData['password']);
            $user->password = $validatedData['password'];
            $user->save();
            return back()->with('success', 'Pembaharuan kata sandi berhasil.');
        }

        return back()->with('error', 'Terjadi kesalahan sistem.');
    }
}
