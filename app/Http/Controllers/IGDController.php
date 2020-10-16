<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Models\EMRIGD\IntegratedNote;
use App\Http\Models\DataPasien\PasienRajal;
use App\Http\Models\EMRIGD\NursingAssesment;
use App\Http\Models\DataPasien\RiwayatAlergi;
use App\Http\Controllers\Controller;
use App\Http\Models\ModelCharts\DataVitalSignIGD;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use File;
class IGDController extends Controller
{
    function get_all_active_rj()
    {
        // $user = Auth::user();
        $pasien = PasienRajal::where('Unit', '=', 1)->get();
        // dd($pasien);
        return response()->json(
            ['list_pasien' => $pasien]
        );
    }
    function save_nrassigd(Request $request)
    {
        // $request["Gambar"] =(base64_decode($request["Gambar"]));
        $image = $request["Gambar"];
        $temp_filename=public_path().'\temp_'. $request["NoEpisode"].Str::random(15).'.png';
        file_put_contents($temp_filename, base64_decode($image));
        // $image = Image::make($request->get('imgBase64'));
        // $image->save('temp.png');
        // $url = public_path('temp.png');
        $finalResult = DB::update(DB::raw("UPDATE [MedicalRecord].[dbo].[EMR_UGD_Nursing]
            SET [Gambar] = BulkColumn FROM OPENROWSET (BULK '{$temp_filename}', SINGLE_BLOB) AS BLOB
            WHERE NoEpisode = '{$request['NoEpisode']}'"));
        
        
        
        $assesmen = NursingAssesment::where('ID', '=', $request['ID'])->first();
        $assesmen->fill($request->except('Gambar'));
        // dd($assesmen);
        $assesmen->save();
        // unlink($temp_filename);
    }
    function get_dashboard_data_episode(Request $request)
    {
        $NoEpisode = $request["NoEpisode"];
        $pasien = PasienRajal::where('NoEpisode', '=', $NoEpisode)->first();
        // print_r($pasien);
        if ($pasien == null) {
            return ["message" => "no data", "code" => "0"];
        }
        // if (count($pasien) <> 0) {
        //     $pasien = $pasien->take(1);
        // }
        $LastTTV = DataVitalSignIGD::where('NoEpisode', '=', $NoEpisode)->get();
        if (count($LastTTV) <> 0) {
            $LastTTV = DataVitalSignIGD::where('NoEpisode', '=', $NoEpisode)->OrderBy('ID', 'Desc')->take(2)->get();
        }
        $NrAssIGD = NursingAssesment::where('NoEpisode', '=', $NoEpisode)->OrderBy('ID', 'Asc')->first();
        // for ($i=0; $i<count($NrAssIGD)  ; $i++) { 
        // dd($NrAssIGD["Gambar"]);
        $NrAssIGD["Gambar"] = base64_encode($NrAssIGD["Gambar"]);
        // dd(base64_decode($NrAssIGD["Gambar"]));
        // }
        // dd($NrAssIGD);
        $Alergi = RiwayatAlergi::where('NoMR', '=', $pasien->NoMR)->get();
        $iNote = IntegratedNote::where('NoEpisode', '=', $NoEpisode)->take(5)->orderBy('tgl', 'desc')->get();
        $array_lastTTV = [
            'BPSistol_icon' =>
            [
                'img' => '06',
                'title' => 'Blood Pressure',
                'value' => 0,
                'icon' => 'up',
                'difference' => 0,
                'variant' => 'warning'
            ],
            'Temperature_icon' => [
                'img' => '06',
                'title' => 'Temparature',
                'value' => 0,
                'icon' => 'up',
                'difference' => 0,
                'variant' => 'success'
            ],
            'HeartRate_icon' => [
                'img' => '05',
                'title' => 'Heart Rate',
                'value' => 0,
                'icon' => 'up',
                'difference' => 0,
                'variant' => 'danger'
            ],
            'RespiratoriRate_icon' => [
                'img' => '04',
                'title' => 'Respiratori Rate',
                'value' => 0,
                'icon' => 'up',
                'difference' => 0,
                'variant' => 'primary'
            ],
        ];
        //dd($NrAssIGD);
        if (count($LastTTV) > 0) {
            $array_lastTTV["BPSistol_icon"]["value"] = $LastTTV[0]["BPSistol"];
            $array_lastTTV["Temperature_icon"]["value"] = $LastTTV[0]["Temperature"];
            $array_lastTTV["HeartRate_icon"]["value"] = $LastTTV[0]["HeartRate"];
            $array_lastTTV["RespiratoriRate_icon"]["value"] = $LastTTV[0]["RespiratoryRate"];
        }
        if (count($LastTTV) > 1) {
            $array_lastTTV["BPSistol_icon"]["difference"] = round((($LastTTV[0]["BPSistol"] - $LastTTV[1]["BPSistol"]) / $LastTTV[1]["BPSistol"]) * 100);
            $array_lastTTV["BPSistol_icon"]["icon"] = $array_lastTTV["BPSistol_icon"]["difference"] > 0 ? 'up' : 'down';
            $array_lastTTV["Temperature_icon"]["difference"] = round((($LastTTV[0]["Temperature"] - $LastTTV[1]["Temperature"]) / $LastTTV[1]["Temperature"]) * 100);
            $array_lastTTV["Temperature_icon"]["icon"] = $array_lastTTV["Temperature_icon"]["difference"] > 0 ? 'up' : 'down';
            $array_lastTTV["HeartRate_icon"]["difference"] = round((($LastTTV[0]["HeartRate"] - $LastTTV[1]["HeartRate"]) / $LastTTV[1]["HeartRate"]) * 100);
            $array_lastTTV["HeartRate_icon"]["icon"] = $array_lastTTV["HeartRate_icon"]["difference"] > 0 ? 'up' : 'down';
            $array_lastTTV["RespiratoriRate_icon"]["difference"] = round((($LastTTV[0]["RespiratoryRate"] - $LastTTV[1]["RespiratoryRate"]) / $LastTTV[1]["RespiratoryRate"]) * 100);
            $array_lastTTV["RespiratoriRate_icon"]["icon"] = $array_lastTTV["RespiratoriRate_icon"]["difference"] > 0 ? 'up' : 'down';
        }
        //dd($LastTTV);
        return response()->json([
            'data_pasien' => $pasien,
            'lastTTV' => $array_lastTTV,
            'nrAssIGD' => $NrAssIGD,
            'Alergi' => $Alergi,
            'iNote' => $iNote,
            'datattv' => $LastTTV
        ]);
    }
    public function empty()
    {
        return response()->json([
            "message" => 'No Data'
        ]);
    }
}
