<?php

namespace App\Http\Controllers;
use App\Http\Models\DataPasien\AntrianPoli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class poliController extends Controller
{
    public function get_allvisit(Request $request)
    {
        $name = $request['search'];
        $extra = "";
        $extra2 = "";
        if (strlen($name) > 2) {
        }
        if ($request['dok'] != null) {
            $extra = " AND ([MasterdataSQL].[dbo].[Doctors].ID = " . $request['dok'] . ") ";
        }
        if ($request->exists('tgl')) {
            $extra = $extra . " AND (CAST([PerawatanSQL].[dbo].[Visit].TglKunjungan as Date) = '" . $request['tgl'] . "') ";
        }

        $result = DB::select(DB::raw("
        SELECT  CAST([PerawatanSQL].[dbo].[Visit].TglKunjungan as Date) TglKunjungan, [PerawatanSQL].[dbo].[Visit].NoRegistrasi,  [PerawatanSQL].[dbo].[Visit Status].[Status Name],[MasterdataSQL].[dbo].[Admision].ID, [MasterdataSQL].[dbo].[Admision].PatientName, [MasterdataSQL].[dbo].[Doctors].First_Name, [MasterdataSQL].[dbo].[Doctors].Last_Name,[MasterdataSQL].[dbo].[Doctors].foto, [MasterdataSQL].[dbo].[Doctors].Spesialis,[MasterdataSQL].[dbo].[MstrUnitPerwatan].NamaUnit,[MasterdataSQL].[dbo].[MstrUnitPerwatan].codeBPJS, [PerawatanSQL].[dbo].[Visit].NoMR, [PerawatanSQL].[dbo].[Visit].Antrian, [PerawatanSQL].[dbo].[Visit].Selesai
        FROM ((( [PerawatanSQL].[dbo].[Visit] LEFT JOIN [MasterdataSQL].[dbo].[Admision] ON [PerawatanSQL].[dbo].[Visit].NoMR = [MasterdataSQL].[dbo].[Admision].NoMR) LEFT JOIN  [PerawatanSQL].[dbo].[Visit Status] ON [PerawatanSQL].[dbo].[Visit].[Status ID] =  [PerawatanSQL].[dbo].[Visit Status].[Status ID]) LEFT JOIN [MasterdataSQL].[dbo].[Doctors] ON [PerawatanSQL].[dbo].[Visit].Doctor_1 = [MasterdataSQL].[dbo].[Doctors].ID) LEFT JOIN [MasterdataSQL].[dbo].[MstrUnitPerwatan] ON [PerawatanSQL].[dbo].[Visit].Unit = [MasterdataSQL].[dbo].[MstrUnitPerwatan].ID
        WHERE ((([MasterdataSQL].[dbo].[Admision].PatientName is not null) and ( [PerawatanSQL].[dbo].[Visit].[Status ID])<4) " . $extra2 . " " . $extra . " AND (( [PerawatanSQL].[dbo].[Visit].Unit) Not In (9,10))) order by CAST([PerawatanSQL].[dbo].[Visit].TglKunjungan as Date) desc, [PerawatanSQL].[dbo].[Visit].Antrian asc,[PerawatanSQL].[dbo].[Visit].[Status ID] desc;
       "));
        return response()->json(
            [
                "list_visit" => $result
            ],
            200
        );
    }

    public function getAntrianPoli(Request $request){
        $Antripoli = AntrianPoli::all();
        // dd($Antripoli);
        return response()->json(
            ['list_Antrian' => $Antripoli]
        );
    }


}
