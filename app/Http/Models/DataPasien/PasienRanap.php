<?php

namespace App\Http\Models\DataPasien;

use Illuminate\Database\Eloquent\Model;

class PasienRanap extends Model
{
    protected $connection = 'ri';
    protected $table='View_PasienRawat';
    protected $fillable =['InpatientID'
    ,'JenisRawat'
    ,'Medrec'
    ,'NoMR'
    ,'PatientName'
    ,'NoEpisode'
    ,'NoRegRI'
    ,'TypePatient'
    ,'IDAsuransi'
    ,'IDJPK'
    ,'StartDate'
    ,'EndDate'
    ,'startTime'
    ,'EndTime'
    ,'drPenerima'
    ,'drKebidanan'
    ,'drAnastesi'
    ,'drAnak'
    ,'drBedah'
    ,'StatusID'
    ,'ResepFlag'
    ,'LabFlag'
    ,'RadiologiFlag'
    ,'materai'
    
    ,'operator'
    ,'Status Name'
    ,'DesName'
    ,'RoomID'
    ,'KodeLokasi'
    ,'Class'
    ,'RoomName'
    ,'Bed'
    ,'StatusActive'
    ,'NamaDokter'
    ,'JenisPasien'
    ,'Address'
    ,'Gander'
    ,'Date_of_birth'
    ,'Home Phone'
    ,'Mobile Phone'
    ,'E-mail Address'
    ,'Head_of_family'
    ,'Mate'
    ,'Discount'
    ,'BiayaPerawatan'
    ,'BiayaAdm'
    ,'GrandTotal'
    ,'TotalBiayaRawat'
    ,'TotalDP'
    ,'SaldoDP'
    ,'JPK'
    ,'Asuransi'
    ,'Piutang'
    ,'EksesPribadi'
    ,'Paket'
    ,'Billto'
    ,'NoRegisRwj'
    ,'KlsID'
    ,'PengembalianDP'
    ,'Pelunasan'
    ,'Pembayaran'
    ,'Fisioterapi'
    ,'TerapiWicara'
    ,'OkupasiTerapi'
    ,'paket_operasi'
    ,'HDFlag'
    ,'Usia'
    ,'NoPesertaBPJS'
    ,'ID_Card_number'
    ,'Golongandarah'
    ];
    protected $hidden = ['TS'];

    public function  getAvatarRI()
    {
        if($this->Gander=='Laki - Laki')
        {
            return asset('/assets/images/user/01.jpg');
        }
            return asset('/assets/images/user/02.jpg');
    }
}
