<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function detail($nama_wisata)
    {
        $detail = $this->sparql->query('SELECT * WHERE
        {VALUES ?ObjekWisata{wisata:'.$nama_wisata.'}.          
            ?ObjekWisata wisata:memilikiGambar ?memilikiGambar.
            ?ObjekWisata wisata:isLocatedAt ?Banjar.
            ?Banjar wisata:isPartOf ?Desa.
            ?Desa wisata:isPartOf ?Kecamatan.
            ?Kecamatan wisata:isPartOf ?Kabupaten.
            ?ObjekWisata wisata:HargaSewaWahana ?HargaSewaWahana
        }');

        $result=[];
        foreach ($detail as $dtl) {
            array_push($result, [
                'nama' => str_replace('_',' ',$this->parseData($dtl->ObjekWisata->getUri())),
                'banjar' => $this->parseData($dtl->Banjar->getUri()),
                'desa' => $this->parseData($dtl->Desa->getUri()),
                'kecamatan' => $this->parseData($dtl->Kecamatan->getUri()),
                'kabupaten' => $this->parseData($dtl->Kabupaten->getUri()),
                //'jambuka' => str_replace('_',' ',$this->parseData($dtl->JamBuka->getUri())),
                //'hargaparkirmotor' => str_replace('_',' ',$this->parseData($dtl->HargaParkirMotor->getUri())),
                //'hargaparkirmobil' => $this->parseData($dtl->HargaParkirMobil->getUri()),
                'hargasewa' => $this->parseData($dtl->HargaSewaWahana->getValue()),
                'gambar' => $this->parseData($dtl->memilikiGambar->getValue())
                // 'pros' => $this->parseData($dtl->pros->getValue())
            ]);
        }
        
        return view('detail', [
            "title" => 'Detail Wisata',
            "page" => "detail",
            "detail" => $result
        ]);
    }
}
?>
