<?php

namespace App\Http\Models\DataPasien;

use Illuminate\Database\Eloquent\Model;

class RiwayatAlergi extends Model
{
    protected $connection = 'mr';
    protected $table = 'MR_RiwayatAlergi';
    protected $fillable=[
        'ID'
        ,'NoMR'
        ,'Kategori'
        ,'Alergen'
        ,'Keterangan'
        ,'KeluhanUtama'
        ,'ReaksiAlergi'
        ,'Saverity'
        ,'OnsetDate'
        ,'AlasanPerubaha'
        ,'DateEntry'
        ,'DateUpdate'
        ,'UserUpdate'
        ,'StatusAktif'
        ,'KeteranganOnsetDate'
        ];

        public function  getDot()
        {
        if($this->Kategori=='Obat')
        {
            return 'timeline-dots border-danger';
        } 
        elseif($this->Kategori=='Makanan'){
            return 'timeline-dots';
        } 
            return 'timeline-dots border-success';
        }
    }
