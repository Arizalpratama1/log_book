<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LogDosenController extends Controller
{
    public function index(){

        $url        = "http://localhost/api-itats/api/listDosen";
    
        $options    = array(
                        "http"  => array(
                            "method"    => "GET",
                            "header"    => "Content-Type: application/x-www-form-urlencoded"
                        )
                    );

        $response   = file_get_contents($url,false,stream_context_create($options));

        $jsonData   = json_decode( $response ); 

        $dosen = $jsonData->data;
        return view('/logdosen',['dosen'=> $dosen]);
    }
}
