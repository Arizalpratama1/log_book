<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Log extends Model
{
    
    use Sortable;

    protected $table = 'log';
    public $timestamps = false;
    
    Protected $fillable = ['id_kategori','id_sub_kategori','judul','deskripsi','file','tanggal','id_status'];

    public $sortable = ['id_kategori','id_sub_kategori','judul','deskripsi','file','tanggal','id_status'];

    public function kategori(){
        return $this->hasOne(Kategori::class, 'id', 'id_kategori');
    }

    public function sub_kategori(){
        return $this->hasOne(SubKategori::class, 'id', 'id_sub_kategori');
    }

    public function status(){
        return $this->hasOne(Status::class, 'id', 'id_status');
    }
}
