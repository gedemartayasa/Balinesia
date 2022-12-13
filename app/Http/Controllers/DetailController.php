<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function detail($nama_wisata)
    {
        $detail = $this->sparql->query('SELECT * WHERE
        {VALUES ?wisata {wisata:'.$nama_wisata.'}.          
           ?wisata a ?jenis .
           ?jenis rdfs:subClassOf wisata:ObjekWisata .          
           OPTIONAL { ?wisata wisata:memilikiGambar ?gambar } .
           OPTIONAL { 
             ?wisata wisata:isLocatedAt ?banjar .
             ?banjar wisata:isPartOf ?desa .
             ?desa wisata:isPartOf ?kecamatan .
             ?kecamatan wisata:isPartOf ?kabupaten .
           }
           OPTIONAL { ?wisata wisata:memilikiJamBuka ?jamBuka } .
           OPTIONAL { ?wisata wisata:memilikiHargaTiketMasuk ?tiketMasuk } .
           OPTIONAL { ?wisata wisata:memilikiHargaSewaWahana ?hargaSewaWahana } .
           OPTIONAL { 
             ?wisata wisata:HargaSewaWahana ?hargaWahana .
             ?wisata wisata:memilikiHargaTiketMasuk ?tiketMasuk .
             ?tiketMasuk wisata:HargaTiketMasuk ?hargaTiketMasuk .
             BIND (?hargaTiketMasuk + ?hargaWahana AS ?budget) . 
           }
           OPTIONAL { ?wisata wisata:memilikiKecepatanAkses ?kecepatanAkses } .
           OPTIONAL { ?wisata wisata:memilikiDurasiSewa ?durasiSewaWahana } .
           OPTIONAL { ?wisata wisata:memilikiHargaParkirMobil ?parkirMobil } .
           OPTIONAL { ?wisata wisata:memilikiHargaParkirMotor ?parkirMotor } .
           OPTIONAL { ?wisata wisata:memilikiPopularitas ?popularitas } .
        }');

        $result=[];
        foreach ($detail as $dtl) {
            array_push($result, [
                'nama' => str_replace('_',' ',$this->parseData($dtl->wisata->getUri())),
                'banjar' => $this->parseData($dtl->banjar->getUri()),
                'desa' => $this->parseData($dtl->desa->getUri()),
                'kecamatan' => $this->parseData($dtl->kecamatan->getUri()),
                'kabupaten' => $this->parseData($dtl->kabupaten->getUri()),
                //'jambuka' => str_replace('_',' ',$this->parseData($dtl->JamBuka->getUri())),
                //'hargaparkirmotor' => str_replace('_',' ',$this->parseData($dtl->HargaParkirMotor->getUri())),
                //'hargaparkirmobil' => $this->parseData($dtl->HargaParkirMobil->getUri()),
                'hargasewa' =>str_replace('_',' ', $this->parseData($dtl->hargaSewaWahana->getUri())),
                'gambar' => $this->parseData($dtl->gambar->getValue())
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
