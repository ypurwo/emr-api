<?php

namespace App\Http\Controllers;

use App\Http\Models\ModelCharts\DataVitalSignIGD;
use Illuminate\Http\Request;

class ControllerAPI extends Controller
{
    public function getDataVitalSignIGD($NoEpisode)
    {
        $DataVitalSignIGD = DataVitalSignIGD::where('NoEpisode', '=',$NoEpisode)
                                      ->OrderBy('ID','Asc')->get();
        //dd($LastVitalSign);     
        return response()->json(
            [
                'status' => 'sucsess',
                'data' => $DataVitalSignIGD
            ]);                           
    }

    public function getDataVitalSignPOLI(Request $request)
    {
        $DataVitalSignPOLI = DataVitalsignIGD::where('NoEpisode', '=', $request->NoEpisode)
                                      ->OrderBy('ID','Asc')->get();
        //dd($LastVitalSign);     
        return response()->json(
            [
                'status' => 'sucsess',
                'data' => $DataVitalSignPOLI
            ]);                           
    }

    public function getDataVitalSignRANAP(Request $request)
    {
        $DataVitalSignRANAP = DataVitalsignIGD::where('NoEpisode', '=', $request->NoEpisode)
                                      ->OrderBy('ID','Asc')->get();
        //dd($LastVitalSign);     
        return response()->json(
            [
                'status' => 'sucsess',
                'data' => $DataVitalSignRANAP
            ]);                           
    }

    // Public function getDataVitalsignICU(Request $request){

    //     $DataVitalSignsICU = DataVitalSignICU::where('NoEpisode', '=', $request->NoEpisode)
    //     ->OrderBy('ID','Asc')->get();
    
    //     return response()->json([
    //         'status' => 'sucsess', 
    //         'data' => $DataVitalSignsICU
    //         ]);
        
    // }

    // public function getDataCPPT(Request $request){
    //     $DataCPPT =DataCPPT::where('NoEpisode','=',$request->NoEpisode)->OrderBy('ID','Asc')->get();

    //     return response()->json([
    //         'status' => 'sucsess',
    //         'data' => $DataCPPT
    //     ]);

    // }

    // public function getDataPasien($NoEpisode){
    //     $pasien = \App\DataPasien\PasienRajal::where('NoEpisode','=',$NoEpisode)->get();
    //     //dd($pasien);
    //     return response()->json([
    //         'status' => 'sucsess',
    //         'data' => $pasien
    //     ]);
    // }

    // public function getNusingAssesmenIGD($NoEpisode){
    //     $NrAssIGD = \App\EMRIGD\NursingAssesment::where('NoEpisode','=',$NoEpisode)->OrderBy('ID','Asc')->take(1)->get();
    //     //dd($NrAssIGD);
    //     return response()->json([
    //         'status' => 'Sucsess',
    //         'data' => $NrAssIGD
    //     ]);

    // }
}
