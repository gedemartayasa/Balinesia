<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PencarianController extends Controller
{
    public function searching (Request $request)
    {
        $jenisWisata = $this -> sparql -> query('SELECT * WHERE{?jenis rdfs:subClassOf wisata:ObjekWisata} ORDER BY ?jenis');
        $jamBuka = $this -> sparql -> query('SELECT * WHERE{?Kriteria a wisata:JamBuka} ORDER BY ?JamBuka');
        $hargaTiket = $this -> sparql -> query('SELECT * WHERE{?Kriteria a wisata:HargaTiketMasuk} ORDER BY ?HargaTiketMasuk');
        $hargaSewa =$this->sparql->query('SELECT * WHERE{?Kriteria a wisata:HargaSewaWahana} ORDER BY ?HargaSewaWahana');
        $hargaParkirMotor =$this->sparql->query('SELECT * WHERE{?Kriteria a wisata:HargaParkirMotor} ORDER BY ?HargaParkirMotor');
        $hargaParkirMobil =$this->sparql->query('SELECT * WHERE{?Kriteria a wisata:HargaParkirMobil} ORDER BY ?HargaParkirMobil');
        //$ukuranLayar =$this->sparql->query('SELECT * WHERE{?ukuranLayar a handphone:UkuranLayar}ORDER BY ?ukuranLayar');

        //prosesor
        /*$prosesor = $this->sparql->query('SELECT * WHERE {
            {?prosesor a handphone:Exynos}
            UNION {?prosesor a handphone:MediaTek}
            UNION {?prosesor a handphone:Qualcomm}
            UNION {?prosesor a handphone:Kirin}
        }');*/


        $resultJenis=[];
        $resultJamBuka=[];
        $resultHargaTiket = [];
        $resultHargaSewa = [];
        $resultHargaParkirMotor = [];
        $resultHargaParkirMobil = [];
        //$resultSistemOperasi = [];
        //$resultUkuranLayar = [];

        foreach($jenisWisata as $item){
            array_push($resultJenis, [
                'jenis' => $this->parseData($item->jenis->getUri())
            ]);
        }
        foreach ($jamBuka as $item) {
            array_push($resultJamBuka, [
                'jamBuka' => $this->parseData($item->Kriteria->getUri())
            ]);
        }
        foreach ($hargaTiket as $item) {
            array_push($resultHargaTiket, [
                'hargaTiket' => $this->parseData($item->Kriteria->getUri())
            ]);
        }
        foreach ($hargaSewa as $item) {
            array_push($resultHargaSewa, [
                'hargaSewa' => $this->parseData($item->Kriteria->getUri())
            ]);
        }
        foreach ($hargaParkirMotor as $item) {
            array_push($resultHargaParkirMotor, [
                'hargaParkirMotor' => $this->parseData($item->Kriteria->getUri())
            ]);
        }
        
        foreach ($hargaParkirMobil as $item) {
            array_push($resultHargaParkirMobil, [
                'hargaParkirMobil' => $this->parseData($item->Kriteria->getUri())
            ]);
        }
        /*foreach ($ukuranLayar as $item) {
            array_push($resultUkuranLayar, [
                'ukuranLayar' => $this->parseData($item->ukuranLayar->getUri())
            ]);
        }
        foreach ($prosesor as $item) {
            array_push($resultProsesor, [
                'prosesor' => $this->parseData($item->prosesor->getUri())
            ]);
        }*/
        
        if(isset($_GET['cariWisata'])){
            $resp = 1;
            $sql = 'SELECT * WHERE {';
            $i = 0;
            if($request->cariJenis != ''){
                if ( $i == 0 ){
                    $sql = $sql . '?wisata a ?jenis .?jenis rdfs:subClassOf wisata:' . $request->cariJenis;
                    $i++;
                }
                else{
                    $sql = $sql . '. ?wisata a ?jenis .?jenis rdfs:subClassOf wisata:' . $request->cariJenis;
                }
            }
            else{
                $sql = $sql;
            }
            if ($request->cariJamBuka!= '') {
                if ($i == 0) {
                    $sql = $sql . '?wisata wisata:memilikiJamBuka wisata:' . $request->cariJamBuka;
                    $i++;
                }
                else{
                    $sql = $sql . '. ?wisata wisata:memilikiJamBuka wisata:' . $request->cariJamBuka;
                } 
            } 
            else {
                $sql = $sql;
            }
            if ($request->cariHargaTiket!= '') {
                if ($i == 0) {
                    $sql = $sql . '?wisata wisata:memilikiHargaTiketMasuk wisata:' . $request->cariHargaTiket;
                    $i++;
                } 
                else {
                    $sql = $sql . '. ?wisata wisata:memilikiHargaTiketMasuk wisata:' . $request->cariHargaTiket;
                }   
            } 
            else {
                $sql = $sql;
            }
            if ($request->cariHargaSewa!= '') {
                if ($i == 0) {
                    $sql = $sql . '?wisata wisata:memilikiHargaSewaWahana wisata:' . $request->cariHargaSewa;
                    $i++;
                } 
                else {
                    $sql = $sql . '. ?wisata wisata:memilikiHargaSewaWahana wisata:' . $request->cariHargaSewa;
                }  
            } 
            else {
                $sql = $sql;
            }
            if ($request->cariHargaParkirMotor!= '') {
                if ($i == 0) {
                    $sql = $sql . '?wisata wisata:memilikiHargaParkirMotor wisata:' . $request->cariHargaParkirMotor;
                    $i++;
                } 
                else {
                    $sql = $sql . '. ?wisata wisata:memilikiHargaParkirMotor wisata:' . $request->cariHargaParkirMotor;
                }  
            } 
            else {
                $sql = $sql;
            }
            if ($request->cariHargaParkirMobil!= '') {
                if ($i == 0) {
                    $sql = $sql . '?wisata wisata:memilikiHargaParkirMobil wisata:' . $request->cariHargaParkirMobil;
                    $i++;
                } 
                else {
                    $sql = $sql . '. ?wisata wisata:memilikiHargaParkirMobil wisata:' . $request->cariHargaParkirMobil;
                }  
            } 
            else {
                $sql = $sql;
            }
            /*if ($request->cariUkuranLayar!= '') {
                if ($i == 0) {
                    $sql = $sql . '?hp handphone:memilikiUkuranLayar handphone:' . $request->cariUkuranLayar;
                    $i++;
                } 
                else {
                    $sql = $sql . '. ?hp handphone:memilikiUkuranLayar handphone:' . $request->cariUkuranLayar;
                }  
                
            } 
            else {
                $sql = $sql;
            }
            if ($request->cariProsesor != '') {
                if ($i == 0) {
                    $sql = $sql . '?hp handphone:memilikiProsesor handphone:' . $request->cariProsesor;
                    $i++;
                } else {
                    $sql = $sql . '. ?hp handphone:memilikiProsesor handphone:' . $request->cariProsesor;
                }
            } else {
                $sql = $sql;
            }*/
            if ($request->cariHarga != '') {
                if ($i == 0) {
                    $sql = $sql . '?wisata wisata:HargaSewaWahana ?hargaWahana .
                    ?wisata wisata:memilikiHargaTiketMasuk ?tiketMasuk .
                    ?tiketMasuk wisata:HargaTiketMasuk ?hargaTiketMasuk .
                    FILTER ((?hargaTiketMasuk + ?hargaWahana) <='. $request->cariHarga.')';
                    $i++;
                } else {
                    $sql = $sql . '?wisata wisata:HargaSewaWahana ?hargaWahana .
                    ?wisata wisata:memilikiHargaTiketMasuk ?tiketMasuk .
                    ?tiketMasuk wisata:HargaTiketMasuk ?hargaTiketMasuk .
                    FILTER ((?hargaTiketMasuk + ?hargaWahana) <='. $request->cariHarga.')';
                }
            } else {
                $sql = $sql;
            }
            $sql = $sql . '}';
            $queryData = $this->sparql->query($sql);
            $resultWisata = [];
            if ($i === 0) {
                $resultWisata = [];
            } else {
                foreach ($queryData as $item) {
                    array_push($resultWisata, [
                        'nama' => $this->parseData($item->wisata->getUri())
                    ]);
                }
            }
            $jumlahWisata = count($resultWisata);
        }
        else if(isset($_GET['reset'])){
            header('Location: /pencarian');
            $resultWisata = [];
            $jumlahWisata = 0;
            $resp = 0;
            $sql=[];
        }
        else{
            $resultWisata = [];
            $jumlahWisata = 0;
            $resp = 0;
            $sql=[];
        }
        
        $data = [
            'listJenisWisata' => $resultJenis,
            'listJamBuka' => $resultJamBuka,
            'listHargaTiket' => $resultHargaTiket,
            'listHargaSewa' => $resultHargaSewa,
            'listHargaParkirMotor' => $resultHargaParkirMotor,
            'listHargaParkirMobil' => $resultHargaParkirMobil,
            /*'listSistemOperasi' => $resultSistemOperasi,
            'listUkuranLayar' => $resultUkuranLayar,*/
            'searching1' => $resultWisata,
            'jumlahWisata' => $jumlahWisata,
            'resp' => $resp,
            'sql' => $sql
        ];
            
        return view('pencarian', [
            'title' => 'Fitur Pencarian',
            'page' => 'pencarian', 
            'data' =>  $data
        ]);
    }
}
?>
