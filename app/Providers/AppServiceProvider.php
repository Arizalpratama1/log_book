<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Session;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view){
            if(Session::has('user')){
                $user = Session::get('user');

                $kategori_sidebar = DB::table('kategori')->get();
                $subkategori_sidebar = DB::table('sub_kategori')->where('id_dosen', $user->id)->get();
                $view->with('kategori_sidebar', $kategori_sidebar);
                $view->with('subkategori_sidebar', $subkategori_sidebar);
            }
        });
    }
}
