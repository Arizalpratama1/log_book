<?php

namespace App\Exports;

use App\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;


class HistoryExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $id;
    protected $status;

    function __construct($id, $status) {
        $this->id       = $id;
        $this->status   = $status;
    }

    public function collection()
    {
        if( $this->status != 0 )
            return Log::where('dosen_id',$this->id)->where('id_status', $this->status)->get();
        else
            return Log::where('dosen_id',$this->id)->get();
    }

    public function map($Log): array
    {
        return [
            $Log->kategori->nama_kategori,
            $Log->sub_kategori->nama_sub_kategori,
            $Log->judul,
            $Log->tanggal,
            $Log->status->status,
        ];
    }

    public function headings(): array
    {
        return [
            'KATEGORI',
            'SUB KATEGORI',
            'CATATAN',
            'TANGGAL',
            'STATUS'
        ];
    }
}
