<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = DB::table('kategori')->get();

        return view('kategori',['kategori'=> $kategori]);
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'nama_kategori' => 'required|alpha|regex:/^[\pL\s\- ]+$/u'
        ]);

        DB::table('kategori')->insert([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect('/halaman/kategori');
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'id_kategori' => 'required|numeric',
            'nama_kategori' => 'required|regex:/^[\pL\s\- ]+$/u'
        ]);

        DB::table('kategori')->where('id', $request->id_kategori)->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect('/halaman/kategori');
    }

    public function delete(Request $request)
    {
        $this->validate($request,[
            'id_kategori' => 'required|numeric',
        ]);

        DB::table('kategori')->where('id', $request->id_kategori)->delete();

        return redirect('/halaman/kategori');
    }
}