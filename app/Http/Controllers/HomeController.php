<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Kyslik\ColumnSortable\Sortable;
use App\Log;

class HomeController extends Controller
{
    public function index(Request $request)
    {   
        $user = $request->session()->get('user');
        $userId = $user->id;     
        $search = $request->search;
        $log = Log::join('kategori', 'log.id_kategori', '=', 'kategori.id')
                    ->join('sub_kategori', 'log.id_sub_kategori', '=', 'sub_kategori.id')
                    ->join('status', 'log.id_status', '=', 'status.id')
                    ->sortable()
                    ->where('log.dosen_id',$userId);
        $log = $log->where(function($query) use ($search) {
            $query->where('judul','like','%' . $search . '%')
                ->orWhere('kategori.nama_kategori','like','%' . $search . '%')
                ->orWhere('sub_kategori.nama_sub_kategori','like','%' . $search . '%')
                ->orWhere('deskripsi','like','%' . $search . '%')
                ->orWhere('file','like','%' . $search . '%')
                ->orWhere('status','like','%' . $search . '%');
        })->paginate(5);
        $kategori = DB::table('kategori')->get();
        $sub_kategori = DB::table('sub_kategori')->get();
        $status = DB::table('status')->get();

        return view('home',['log'=> $log, 'kategori'=> $kategori , 'sub_kategori'=>$sub_kategori, 'status'=> $status]);
    }

}