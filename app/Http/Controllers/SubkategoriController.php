<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class SubkategoriController extends Controller
{
    public function index()
    {
        $user = Session::get('user');
        $kategori = DB::table('kategori')->get();
        $sub_kategori = DB::table('sub_kategori')->where('id_dosen', $user->id)->get();

        return view('subkategori',['kategori'=> $kategori , 'subkategori'=>$sub_kategori]);
    }

    public function create(request $request){
        $this->validate($request,[
            'nama_sub_kategori' => 'required|regex:/^[\pL\s\- ]+$/u'
        ]);

        DB::table('sub_kategori')->insert([
            'id_kategori' => $request->id_kategori,
            'id_dosen' => $request->session()->get('user')->id,
            'nama_sub_kategori' => $request->nama_sub_kategori
        ]);

        return redirect('/halaman/subkategori');
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'id_kategori' => 'required|numeric',
            'id_subkategori' => 'required|numeric',
            'nama_sub_kategori' => 'required|regex:/^[\pL\s\- ]+$/u'
        ]);

        DB::table('sub_kategori')->where('id', $request->id_subkategori)->update([
            'id_kategori' => $request->id_kategori,
            'nama_sub_kategori' => $request->nama_sub_kategori
        ]);

        return redirect('/halaman/subkategori');
    }

    public function delete(Request $request)
    {
        $this->validate($request,[
            'id_subkategori' => 'required|numeric',
        ]);

        DB::table('sub_kategori')->where('id', $request->id_subkategori)->delete();

        return redirect('/halaman/subkategori');
    }
}