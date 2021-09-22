<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = DB::table('dosen')->get();
        return view('dosen',['dosen'=> $dosen]);
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'nip' => 'required|numeric',
            'nama_dosen' => 'required|alpha',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        DB::table('dosen')->insert([
            'nip' => $request->nip,
            'nama_dosen' => $request->nama_dosen ,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return redirect('/halaman/dosen');
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'nip' => 'required|numeric',
            'nama_dosen' => 'required|alpha',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        DB::table('dosen')->where('id', $request->id_dosen)->update([
            'nip' => $request->nip,
            'nama_dosen' => $request->nama_dosen ,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return redirect('/halaman/dosen');
    }

    public function delete(Request $request)
    {
        $this->validate($request,[
            'id_dosen' => 'required|numeric',
        ]);

        DB::table('dosen')->where('id', $request->id_dosen)->delete();

        return redirect('/halaman/dosen');
    }

}