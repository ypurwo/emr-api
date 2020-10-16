<?php

namespace App\Http\Models\DataPasien;

use Illuminate\Database\Eloquent\Model;

class AntrianPoli extends Model
{
    protected $connection = 'rj';
    protected $table = 'View_AntrianPelayananPoli';
    protected $fillable=['Tgl'
      ,'NamaDokter'
      ,'JumlahPasien'
      ,'AntrianPoli'
      ,'AntrianKasir'
      ,'AntrianSelesai'
      ,'Spesialis'
      ,'ReponsTime'
    ];
}
