<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\MR_Dok_InformConsen;
use Illuminate\Support\Str;

class pdfuploadController extends Controller
{
    public function upload_pdf(Request $request)
    {
        $mrdokinfo=new MR_Dok_InformConsen();
        $mrdokinfo["NoMR"]=$request["NoMR"];
        $data_pdf=$request["data"];
            $exploded=explode(',',$data_pdf);
            $decoded=base64_decode($exploded[1]);

            $filename=$request["NoMR"]."_"."_".Str::random(5).'.pdf';
            $path = $_SERVER['DOCUMENT_ROOT'].'/uploads/pdf/'.$filename;
           // print $path;
            file_put_contents($path,$decoded);
        $mrdokinfo["pathFile"]=$filename;
        $mrdokinfo->save();
    }
    public function get_all_pdf(Request $request)
    {
        $data=MR_Dok_InformConsen::where('NoMR',$request['nomr'])->get();
        return response()->json(
            ['data' => $data]
        );
    }
}
