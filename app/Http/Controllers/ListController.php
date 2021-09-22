<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Kyslik\ColumnSortable\Sortable;
use Carbon\carbon;
use App\Log;
use Redirect;
use Session;


class ListController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->session()->get('user');
        $idKategori = $request->id_kategori;
        $idSubKategori = $request->id_sub_kategori;
        $search = $request->search;
        $userId = $user->id;

        $log = Log::select(['log.id', 'judul', 'deskripsi', 'id_status', 'tanggal', 'file'])
                    ->join('kategori', 'log.id_kategori', '=', 'kategori.id')
                    ->join('sub_kategori', 'log.id_sub_kategori', '=', 'sub_kategori.id')
                    ->join('status', 'log.id_status', '=', 'status.id')
                    ->sortable()
                    ->where('log.dosen_id',$userId)
                    ->where('id_sub_kategori', '=', $idSubKategori);
        $log = $log->where(function($query) use ($search) {
                $query->where('judul','like','%' . $search . '%')
                ->orWhere('deskripsi','like','%' . $search . '%')
                ->orWhere('file','like','%' . $search . '%')
                ->orWhere('status','like','%' . $search . '%');
        })->paginate(5, array('log.id', 'log.judul', 'log.deskripsi', 'log.tanggal', 'status.status'));
        $status = DB::table('status')->get();
        $nama_kategori = DB::table('kategori')->where('id', '=', $idKategori)->value('nama_kategori');
        $nama_sub_kategori = DB::table('sub_kategori')->where('id', '=', $idSubKategori)->value('nama_sub_kategori');

        return view('list-aktifitas', ['idKategori' => $idKategori, 'idSubKategori' => $idSubKategori, 'log'=> $log, 'status'=> $status, 'namaKategori' => $nama_kategori, 'namaSubKategori' => $nama_sub_kategori]);
    }

    public function create(request $request){
        
        $this->validate($request,[
            'judul' => 'required|regex:/^[A-Za-z][\w\s\-\(\)]+$/u',
        ]);


        DB::table('log')->insert([
            'dosen_id' => $request->session()->get('user')->id,
            'id_kategori' => $request->id_kategori,
            'id_sub_kategori' => $request->id_sub_kategori,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => null,
            'tanggal' => now(),
            'id_status' => 1
        ]);

        return redirect('/list-aktifitas/' . $request->id_kategori . '/' . $request->id_sub_kategori);
    }

    public function update(Request $request){

        $this->validate($request,[
            'judul'     => 'regex:/^[A-Za-z][\w\s\-\(\)]+$/u',
            'id_log'    => 'required|numeric',
            'id_status' => 'required|numeric',
            'file'      => 'required_if:id_status,==,3|',

        ]);

        DB::table('log')->where('id',$request->id_log)->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => ( $request->file == null ? null : $request->file ),
            'id_status' => $request->id_status,
        ]);

        if( $request->id_status == 3 )
            return response()->json(['status' => 'sukses']);
        else
            return Redirect::back();

    }

    public function delete(Request $request)
    {
        $this->validate($request,[
            'id_log' => 'required|numeric',
            'id_kategori' => 'required|numeric',
            'id_sub_kategori' => 'required|numeric'
        ]);

        DB::table('log')->where('id', $request->id_log)->delete();

        return Redirect::back();
    }

}