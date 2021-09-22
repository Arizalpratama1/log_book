<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Kyslik\ColumnSortable\Sortable;
use App\Dosen;
use App\Log;
use Carbon\carbon;
use App\Exports\HistoryExport;
use Maatwebsite\Excel\Facades\Excel;
//use Illuminate\Support\Facades\Hash;

class HistoryController extends Controller
{


    public function pending($id_dosen)
    {
        $id_status  = 1;
        $log        = Log::where('dosen_id', '=', $id_dosen)->where('id_status','=', $id_status)->get();

        return view('history',['log'=> $log, 'id_dosen'=> $id_dosen, 'id_status' => $id_status]);
    }

    public function proses($id_dosen)
    {
        $id_status  = 2;

        $log = Log::where('dosen_id', '=', $id_dosen)->where('id_status','=', $id_status)->get();

        return view('history',['log'=> $log, 'id_dosen'=> $id_dosen, 'id_status' => $id_status]);
    }

    public function selesai($id_dosen){

        $id_status  = 3;

        $log = Log::where('dosen_id', '=', $id_dosen)->where('id_status','=', $id_status)->get();

        return view('history',['log'=> $log, 'id_dosen'=> $id_dosen, 'id_status' => $id_status]);
    }

    public function semua($id_dosen){

        $id_status  = 0;

        $log = Log::where('dosen_id', '=', $id_dosen)->get();

        return view('history',['log'=> $log, 'id_dosen'=> $id_dosen, 'id_status' => $id_status]);
    }
    
    public function filter($id_status, Request $request){

        $fromDate = Carbon::parse($request->input('fromDate'));
        $toDate = Carbon::parse($request->input('toDate'));
        $id_dosen = $request->input('id_dosen');

        $log = Log::where('dosen_id', '=', $id_dosen)
            ->where('tanggal','>=', $fromDate->format('Y-m-d') ) 
            ->where('tanggal','<=', $toDate->format('Y-m-d') );

        if($id_status != 0 ){
            $log = Log::where('dosen_id', '=', $id_dosen)
            ->where('id_status','=', $id_status);
        }

        return view('history',['log'=> $log->get(),  'id_dosen'=> $id_dosen, 'id_status' => $id_status]);
    }

    public function export( $id_dosen, $id_status ) 
    {  
        return Excel::download(new HistoryExport( $id_dosen, $id_status ), 'History.xlsx');
    }

    public function pass(){
        //dd($request->user()->id);
        //return Hash::make('123');
    }

}