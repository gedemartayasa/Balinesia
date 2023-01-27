<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PencarianController extends Controller
{
    public function searching (Request $request)
    {
        $jenisWisata = $this -> sparql -> query('SELECT * WHERE{?jenis rdfs:subClassOf wisata:ObjekWisata} ORDER BY ?jenis');
        $jamBuka = $this -> sparql -> query('SELECT * WHERE{?Kriteria a wisata:JamBuka} ORDER BY ?JamBuka');
        $hargaTiket = $this -> sparql -> query('SELECT * WHERE{?Kriteria a wisata:HargaTiketMasuk ; wisata:HargaTiketMasuk ?tiket .} ORDER BY ?tiket');
        $hargaSewa =$this->sparql->query('SELECT * WHERE{?Kriteria a wisata:HargaSewaWahana ; wisata:HargaSewaWahana ?harga .} ORDER BY ?harga');
        $hargaParkirMotor =$this->sparql->query('SELECT * WHERE{?Kriteria a wisata:HargaParkirMotor ; wisata:HargaParkirMotor ?parkirMotor .} ORDER BY ?parkirMotor');
        $hargaParkirMobil =$this->sparql->query('SELECT * WHERE{?Kriteria a wisata:HargaParkirMobil ; wisata:HargaParkirMobil ?parkirMobil .} ORDER BY ?parkirMobil');
        $lokasi =$this->sparql->query('SELECT * WHERE{?Tempat a wisata:Kabupaten } ORDER BY ?Kabupaten');

        $resultJenis=[];
        $resultJamBuka=[];
        $resultHargaTiket = [];
        $resultHargaSewa = [];
        $resultHargaParkirMotor = [];
        $resultHargaParkirMobil = [];
        $resultLokasi=[];

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

        foreach ($lokasi as $item) {
            array_push($resultLokasi, [
                'lokasi' => $this->parseData($item->Tempat->getUri())
            ]);
        }
        
        if(isset($_GET['cariWisata'])){
            $resp = 1;
            $sql = 'SELECT * WHERE {';
            $i = 0;
            if($request->cariJenis != ''){
                if ( $i == 0 ){
                    $sql = $sql . '?wisata rdf:type wisata:' . $request->cariJenis;
                    $i++;
                }
                else{
                    $sql = $sql . '. ?wisata rdf:type wisata:' . $request->cariJenis;
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

            if ($request->cariLokasi!= '') {
                if ($i == 0) {
                    $sql = $sql . '?wisata wisata:memilikiKabupaten wisata:' . $request->cariLokasi;
                    $i++;
                } 
                else {
                    $sql = $sql . '. ?wisata wisata:memilikiKabupaten wisata:' . $request->cariLokasi;
                }  
            } 
            else {
                $sql = $sql;
            }
            
            if ($request->cariHarga != '') {
                if ($i == 0) {
                    $sql = $sql . '?wisata wisata:HargaSewaWahana ?hargaWahana .
                    ?wisata wisata:memilikiHargaTiketMasuk ?tiketMasuk .
                    ?tiketMasuk wisata:HargaTiketMasuk ?hargaTiketMasuk .
                    ?wisata wisata:memilikiHargaParkirMotor ?parkirMotor .
                    ?parkirMotor wisata:HargaParkirMotor ?hargaParkirMotor .
                    ?wisata wisata:memilikiHargaParkirMobil ?parkirMobil .
                    ?parkirMobil wisata:HargaParkirMobil ?hargaParkirMobil .
                    FILTER ((?hargaTiketMasuk + ?hargaWahana + ((?hargaParkirMotor + ?hargaParkirMobil) / 2)) <=' .$request->cariHarga.')';
                    $i++;
                } else {
                    $sql = $sql .'. ?wisata wisata:HargaSewaWahana ?hargaWahana .
                    ?wisata wisata:memilikiHargaTiketMasuk ?tiketMasuk .
                    ?tiketMasuk wisata:HargaTiketMasuk ?hargaTiketMasuk .
                    ?wisata wisata:memilikiHargaParkirMotor ?parkirMotor .
                    ?parkirMotor wisata:HargaParkirMotor ?hargaParkirMotor .
                    ?wisata wisata:memilikiHargaParkirMobil ?parkirMobil .
                    ?parkirMobil wisata:HargaParkirMobil ?hargaParkirMobil .
                    FILTER ((?hargaTiketMasuk + ?hargaWahana + ((?hargaParkirMotor + ?hargaParkirMobil) / 2)) <='. $request->cariHarga.')';
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
            'listLokasi' => $resultLokasi,
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
