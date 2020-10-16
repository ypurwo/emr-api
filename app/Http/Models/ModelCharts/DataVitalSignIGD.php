<?php

namespace App\Http\Models\ModelCharts;

use Illuminate\Database\Eloquent\Model;

class DataVitalSignIGD extends Model
{
    protected $connection = 'mr';
    protected $table = 'View_DataVitalSignsIGD';
    protected $fillable=[
      'ID'
      ,'NoMR'
      ,'NoEpisode'
      ,'Labels'
      ,'Jam'
      ,'LocationAssm'
      ,'KeadaanUmum'
      ,'BPSistol'
      ,'MAP'
      ,'BPDistol'
      ,'Temperature'
      ,'PainScore'
      ,'HeartRate'
      ,'RespiratoryRate'
      ,'SO2'
      ,'O2'
      ,'GCS'
      ,'Eye'
      ,'Verbal'
      ,'Motorik'
      ,'NamaObat'
      ,'Tetes'
      ,'HIS'
      ,'KetHIS'
      ,'DJJ'
      ,'RPatella'
      ,'KPatella'
      ,'BB'
      ,'BAB'
      ,'Keterangan'
      ,'Kesadaran'
    ];
}
