<?php

namespace App\Http\Controllers\EMR;

use Illuminate\Http\Request;
use App\EMRIGD\IntegratedNote;
use App\DataPasien\PasienRajal;
use App\DataPasien\PasienRanap;
use App\EMRIGD\NursingAssesment;
use App\DataPasien\RiwayatAlergi;
use App\Http\Controllers\Controller;
use App\ModelCharts\DataVitalSignIGD;

class EMRController extends Controller
{
    function pasienrajal($NoEpisode){
        $pasien = PasienRajal::where('NoEpisode','=',$NoEpisode)->get();
        if(count($pasien)<>0){$pasien=$pasien->take(1);}

        $LastTTV = DataVitalSignIGD::where('NoEpisode','=',$NoEpisode)->get();
        if(count($LastTTV)<>0){
            $LastTTV = DataVitalSignIGD::where('NoEpisode','=',$NoEpisode)->OrderBy('ID','Desc')->take(2)->get();
        }
        
        $NrAssIGD = NursingAssesment::where('NoEpisode','=',$NoEpisode)->OrderBy('ID','Asc')->first();
        $Alergi = RiwayatAlergi::where('NoMR','=',$pasien[0]->NoMR)->get();
        $iNote = IntegratedNote::where('NoEpisode','=',$NoEpisode)->take(5)->get();
        
        
        //dd($NrAssIGD);
        
        if(count($LastTTV)!= 0) {
            $array_lastTTV=[
                'data'=>$LastTTV,
                'BPSistol_icon'=>
                    [
                        'value'=>$LastTTV[0]["BPSistol"],
                        'icon'=>'up',
                        'difference'=>0
                    ],
                'Temperature_icon' => [
                        'value'=>$LastTTV[0]["Temperature"],
                        'icon'=>'up',
                        'difference'=>0
                ],
                'HeartRate_icon' => [
                        'value'=>$LastTTV[0]["HeartRate"],
                        'icon'=>'up',
                        'difference'=>0
                ],
                'RespiratoriRate_icon' => [
                    'value'=>$LastTTV[0]["RespiratoryRate"],
                    'icon'=>'up',
                    'difference'=>0
                ],
                ];
            } else{
                $array_lastTTV=[
                    'data'=>$LastTTV,
                    'BPSistol_icon'=>
                        [
                            'value'=>0,
                            'icon'=>'up',
                            'difference'=>0
                        ],
                    'Temperature_icon' => [
                            'value'=>0,
                            'icon'=>'up',
                            'difference'=>0
                    ],
                    'HeartRate_icon' => [
                            'value'=>0,
                            'icon'=>'up',
                            'difference'=>0
                    ],
                    'RespiratoriRate_icon' => [
                        'value'=>0,
                        'icon'=>'up',
                        'difference'=>0
                    ],
                    ];
            }
            
        if(count($LastTTV)>1){
            $array_lastTTV["BPSistol_icon"]["difference"]= round((($LastTTV[0]["BPSistol"]-$LastTTV[1]["BPSistol"])/$LastTTV[1]["BPSistol"])*100);
            $array_lastTTV["BPSistol_icon"]["icon"]=$array_lastTTV["BPSistol_icon"]["difference"]>0?'up':'down';
    
            $array_lastTTV["Temperature_icon"]["difference"]= round((($LastTTV[0]["Temperature"]-$LastTTV[1]["Temperature"])/$LastTTV[1]["Temperature"])*100);
            $array_lastTTV["Temperature_icon"]["icon"]=$array_lastTTV["Temperature_icon"]["difference"]>0?'up':'down';
    
            $array_lastTTV["HeartRate_icon"]["difference"]= round((($LastTTV[0]["HeartRate"]-$LastTTV[1]["HeartRate"])/$LastTTV[1]["HeartRate"])*100);
            $array_lastTTV["HeartRate_icon"]["icon"]=$array_lastTTV["HeartRate_icon"]["difference"]>0?'up':'down';
    
            $array_lastTTV["RespiratoriRate_icon"]["difference"]= round((($LastTTV[0]["RespiratoryRate"]-$LastTTV[1]["RespiratoryRate"])/$LastTTV[1]["RespiratoryRate"])*100);
            $array_lastTTV["RespiratoriRate_icon"]["icon"]=$array_lastTTV["RespiratoriRate_icon"]["difference"]>0?'up':'down';
        }
        
        // dd($LastTTV);
    
        return view('Dashboard.pasien',[
            'data_pasien' => $pasien[0],
            'lastTTV'=>$array_lastTTV,
            'nrAssIGD'=>$NrAssIGD,
            'Alergi'=>$Alergi,
            'iNote'=>$iNote
            ]);
       }

       function pasienranap($NoEpisode)
       {
        $pasien = PasienRanap::where('NoEpisode','=',$NoEpisode)->get();
        if(count($pasien)<>0){$pasien=$pasien->take(1);}

        $LastTTV = DataVitalSignIGD::where('NoEpisode','=',$NoEpisode)->get();
        if(count($LastTTV)<>0){
            $LastTTV = DataVitalSignIGD::where('NoEpisode','=',$NoEpisode)->OrderBy('ID','Desc')->take(2)->get();
        }

        $NrAssIGD = NursingAssesment::where('NoEpisode','=',$NoEpisode)->OrderBy('ID','Asc')->first();
        $Alergi = RiwayatAlergi::where('NoMR','=',$pasien[0]->NoMR)->get();
        $iNote = IntegratedNote::where('NoEpisode','=',$NoEpisode)->take(5)->get();
        
        
        //dd($LastTTV);

        if(count($LastTTV)!= 0) {
            $array_lastTTV=[
                'data'=>$LastTTV,
                'BPSistol_icon'=>
                    [
                        'value'=>$LastTTV[0]["BPSistol"],
                        'icon'=>'up',
                        'difference'=>0
                    ],
                'Temperature_icon' => [
                        'value'=>$LastTTV[0]["Temperature"],
                        'icon'=>'up',
                        'difference'=>0
                ],
                'HeartRate_icon' => [
                        'value'=>$LastTTV[0]["HeartRate"],
                        'icon'=>'up',
                        'difference'=>0
                ],
                'RespiratoriRate_icon' => [
                    'value'=>$LastTTV[0]["RespiratoryRate"],
                    'icon'=>'up',
                    'difference'=>0
                ],
                ];
            } else{
                $array_lastTTV=[
                    'data'=>$LastTTV,
                    'BPSistol_icon'=>
                        [
                            'value'=>0,
                            'icon'=>'up',
                            'difference'=>0
                        ],
                    'Temperature_icon' => [
                            'value'=>0,
                            'icon'=>'up',
                            'difference'=>0
                    ],
                    'HeartRate_icon' => [
                            'value'=>0,
                            'icon'=>'up',
                            'difference'=>0
                    ],
                    'RespiratoriRate_icon' => [
                        'value'=>0,
                        'icon'=>'up',
                        'difference'=>0
                    ],
                    ];
            }
        
        if(count($LastTTV)>1){
            $array_lastTTV["BPSistol_icon"]["difference"]= round((($LastTTV[0]["BPSistol"]-$LastTTV[1]["BPSistol"])/$LastTTV[1]["BPSistol"])*100);
            $array_lastTTV["BPSistol_icon"]["icon"]=$array_lastTTV["BPSistol_icon"]["difference"]>0?'up':'down';
    
            $array_lastTTV["Temperature_icon"]["difference"]= round((($LastTTV[0]["Temperature"]-$LastTTV[1]["Temperature"])/$LastTTV[1]["Temperature"])*100);
            $array_lastTTV["Temperature_icon"]["icon"]=$array_lastTTV["Temperature_icon"]["difference"]>0?'up':'down';
    
            $array_lastTTV["HeartRate_icon"]["difference"]= round((($LastTTV[0]["HeartRate"]-$LastTTV[1]["HeartRate"])/$LastTTV[1]["HeartRate"])*100);
            $array_lastTTV["HeartRate_icon"]["icon"]=$array_lastTTV["HeartRate_icon"]["difference"]>0?'up':'down';
    
            $array_lastTTV["RespiratoriRate_icon"]["difference"]= round((($LastTTV[0]["RespiratoryRate"]-$LastTTV[1]["RespiratoryRate"])/$LastTTV[1]["RespiratoryRate"])*100);
            $array_lastTTV["RespiratoriRate_icon"]["icon"]=$array_lastTTV["RespiratoriRate_icon"]["difference"]>0?'up':'down';
        }

        // dd($array_lastTTV);
    
        return view('Dashboard.pasien_ranap',[
            'data_pasien' => $pasien[0],
            'lastTTV'=>$array_lastTTV,
            'nrAssIGD'=>$NrAssIGD,
            'Alergi'=>$Alergi,
            'iNote'=>$iNote
            ]);
       }
}
