<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class SessionLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $menuDosen = [
            '/halaman\/home/',
            '/halaman\/subkategori/',
            '/halaman\/subkategori\/simpan/',
            '/halaman\/subkategori\/edit/',
            '/halaman\/subkategori\/hapus/',
            '/list-aktifitas\/simpan/',
            '/list-aktifitas\/edit/',
            '/list-aktifitas\/hapus/',
            '/list-aktifitas\/[0-9]\/[0-9]/'
        ];

        $menuAdmin = [
            'halaman/kategori',
            'halaman/kategori/simpan',
            'halaman/kategori/hapus',
            'halaman/kategori/edit',
        ];

        $menuKajur = [
            'logdosen',
            'pending',
            'proses',
            'selesai',
            'semua',
            'filter',
            'download'
        ];

        if(Session::has('user')){

            $user = Session::get('user');

            $path = $request->path();
            $pathArray = explode('/', $request->path());

            if( $user->role == 1 && !in_array($request->path(), $menuAdmin ) )
                return redirect('/halaman/kategori');
            else if( $user->role == 2 && !in_array( $pathArray[0], $menuKajur ) )
                return redirect('/logdosen');
            else if( $user->role == 0 ){
                
                $status = false;

                foreach( $menuDosen as $menu ){
                    if( preg_match( $menu, $request->path() ) ){
                        $status = true;
                        break;
                    }
                }
                if( !$status )
                    return redirect('halaman/home'); 
            }
            return $next($request);
        }else{
            return redirect()->route('login');
        }
    }
}
