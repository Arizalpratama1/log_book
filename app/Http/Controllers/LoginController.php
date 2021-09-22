<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Session;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function doLogin(Request $request){

        // $credentials = $request->only('nip', 'password');
        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();

        //     return redirect('/halaman/home');
        // }else{
        //     return redirect()->route('login');
        // }

        $url        = "http://localhost/api-itats/api/doLogin";
        $data       = array(
                        "nip"       => $request->nip,
                        "password"  => $request->password
                    );

        $options    = array(
                        "http"  => array(
                            "method"    => "POST",
                            "header"    => "Content-Type: application/x-www-form-urlencoded",
                            "content"   => http_build_query($data)
                        )
                    );

        $response   = file_get_contents($url,false,stream_context_create($options));

        $jsonData   = json_decode( $response );

        $status     = $jsonData->status;

        if($status === 'sukses'){

            $userData   = $jsonData->user;

            $user       = new User();

            $user->id      = $userData->id;
            $user->nip     = $userData->nip;
            $user->name    = $userData->nama_user;
            $user->email   = $userData->email_user;
            $user->phone   = $userData->no_hp;
            $user->role    = (int)$userData->admin;

            //create session
            session(['user' => $user]);

            if( $user->role == 0 )
                return redirect('/halaman/home');
            else if( $user->role == 2)
                return redirect('/logdosen');
            else 
                return redirect('/halaman/kategori');
        }else{
            return redirect()->route('login')->with('error','Gagal Login, cek N.I.P dan password');
        }
    }

    public function login(){
        if(Session::has('user')){
            return redirect('/halaman/home');
        }
        return view('login');
    }

    public function logout(Request $request)
    {
        Session::forget(['user']);

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return redirect('/');
    }
}
