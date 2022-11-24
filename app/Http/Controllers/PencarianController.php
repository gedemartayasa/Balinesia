<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PencarianController extends Controller
{
    public function searching (Request $request)
    {
        /*$ram = $this -> sparql -> query('SELECT * WHERE{?ram a handphone:RAM} ORDER BY ?ram');
        $memori = $this -> sparql -> query('SELECT * WHERE{?memori a handphone:Memori} ORDER BY ?memori');
        $baterai = $this -> sparql -> query('SELECT * WHERE{?baterai a handphone:Baterai} ORDER BY ?baterai');
        $kameraDepan =$this->sparql->query('SELECT * WHERE{?kameraDepan a handphone:KameraDepan} ORDER BY ?kameraDepan');
        $kameraBelakang =$this->sparql->query('SELECT * WHERE{?kameraBelakang a handphone:KameraBelakang} ORDER BY ?kameraBelakang');
        $sistemOperasi =$this->sparql->query('SELECT * WHERE{?sistemOperasi a handphone:SistemOperasi} ORDER BY ?sistemOperasi');
        $ukuranLayar =$this->sparql->query('SELECT * WHERE{?ukuranLayar a handphone:UkuranLayar}ORDER BY ?ukuranLayar');

        //prosesor
        $prosesor = $this->sparql->query('SELECT * WHERE {
            {?prosesor a handphone:Exynos}
            UNION {?prosesor a handphone:MediaTek}
            UNION {?prosesor a handphone:Qualcomm}
            UNION {?prosesor a handphone:Kirin}
        }');


        $resultRAM=[];
        $resultMemori=[];
        $resultBaterai = [];
        $resultKameraDepan = [];
        $resultKameraBelakang = [];
        $resultProsesor = [];
        $resultSistemOperasi = [];
        $resultUkuranLayar = [];

        foreach($ram as $item){
            array_push($resultRAM, [
                'ram' => $this->parseData($item->ram->getUri())
            ]);
        }
        foreach ($memori as $item) {
            array_push($resultMemori, [
                'memori' => $this->parseData($item->memori->getUri())
            ]);
        }
        foreach ($baterai as $item) {
            array_push($resultBaterai, [
                'baterai' => $this->parseData($item->baterai->getUri())
            ]);
        }
        foreach ($kameraDepan as $item) {
            array_push($resultKameraDepan, [
                'kameraDepan' => $this->parseData($item->kameraDepan->getUri())
            ]);
        }
        foreach ($kameraBelakang as $item) {
            array_push($resultKameraBelakang, [
                'kameraBelakang' => $this->parseData($item->kameraBelakang->getUri())
            ]);
        }
        
        foreach ($sistemOperasi as $item) {
            array_push($resultSistemOperasi, [
                'sistemOperasi' => $this->parseData($item->sistemOperasi->getUri())
            ]);
        }
        foreach ($ukuranLayar as $item) {
            array_push($resultUkuranLayar, [
                'ukuranLayar' => $this->parseData($item->ukuranLayar->getUri())
            ]);
        }
        foreach ($prosesor as $item) {
            array_push($resultProsesor, [
                'prosesor' => $this->parseData($item->prosesor->getUri())
            ]);
        }
        
        if(isset($_GET['cariSpesifikasi'])){
            $resp = 1;
            $sql = 'SELECT * WHERE {';
            $i = 0;
            if($request->cariRAM != ''){
                if ( $i == 0 ){
                    $sql = $sql . '?hp handphone:memilikiRAM handphone:' . $request->cariRAM;
                    $i++;
                }
                else{
                    $sql = $sql . '. ?hp handphone:memilikiRAM handphone:' . $request->cariRAM;
                }
            }
            else{
                $sql = $sql;
            }
            if ($request->cariBaterai!= '') {
                if ($i == 0) {
                    $sql = $sql . '?hp handphone:memilikiBaterai handphone:' . $request->cariBaterai;
                    $i++;
                }
                else{
                    $sql = $sql . '. ?hp handphone:memilikiBaterai handphone:' . $request->cariBaterai;
                } 
            } 
            else {
                $sql = $sql;
            }
            if ($request->cariKameraDepan!= '') {
                if ($i == 0) {
                    $sql = $sql . '?hp handphone:memilikiKameraDepan handphone:' . $request->cariKameraDepan;
                    $i++;
                } 
                else {
                    $sql = $sql . '. ?hp handphone:memilikiKameraDepan handphone:' . $request->cariKameraDepan;
                }   
            } 
            else {
                $sql = $sql;
            }
            if ($request->cariKameraBelakang!= '') {
                if ($i == 0) {
                    $sql = $sql . '?hp handphone:memilikiKameraBelakang handphone:' . $request->cariKameraBelakang;
                    $i++;
                } 
                else {
                    $sql = $sql . '. ?hp handphone:memilikiKameraBelakang handphone:' . $request->cariKameraBelakang;
                }  
            } 
            else {
                $sql = $sql;
            }
            if ($request->cariMemori!= '') {
                if ($i == 0) {
                    $sql = $sql . '?hp handphone:memilikiMemori handphone:' . $request->cariMemori;
                    $i++;
                } 
                else {
                    $sql = $sql . '. ?hp handphone:memilikiMemori handphone:' . $request->cariMemori;
                }  
            } 
            else {
                $sql = $sql;
            }
            if ($request->cariSistemOperasi!= '') {
                if ($i == 0) {
                    $sql = $sql . '?hp handphone:memilikiSistemOperasi handphone:' . $request->cariSistemOperasi;
                    $i++;
                } 
                else {
                    $sql = $sql . '. ?hp handphone:memilikiSistemOperasi handphone:' . $request->cariSistemOperasi;
                }  
            } 
            else {
                $sql = $sql;
            }
            if ($request->cariUkuranLayar!= '') {
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
            }
            if ($request->cariHarga != '') {
                if ($i == 0) {
                    $sql = $sql . '?hp handphone:nilaiHarga ?harga FILTER(?harga <' . $request->cariHarga.')';
                    $i++;
                } else {
                    $sql = $sql .'. ?hp handphone:nilaiHarga ?harga FILTER(?harga <' . $request->cariHarga . ')';
                }
            } else {
                $sql = $sql;
            }
            $sql = $sql . '}';
            $queryData = $this->sparql->query($sql);
            $resultHandphone = [];
            if ($i === 0) {
                $resultHandphone = [];
            } else {
                foreach ($queryData as $item) {
                    array_push($resultHandphone, [
                        'nama' => $this->parseData($item->hp->getUri())
                    ]);
                }
            }
            $jumlahHandphone = count($resultHandphone);
        }
        else if(isset($_GET['reset'])){
            header('Location: /pencarian');
            $resultHandphone = [];
            $jumlahHandphone = 0;
            $resp = 0;
            $sql=[];
        }
        else{
            $resultHandphone = [];
            $jumlahHandphone = 0;
            $resp = 0;
            $sql=[];
        }
        
        $data = [
            'listRAM' => $resultRAM,
            'listMemori' => $resultMemori,
            'listBaterai' => $resultBaterai,
            'listKameraDepan' => $resultKameraDepan,
            'listKameraBelakang' => $resultKameraBelakang,
            'listProsesor' => $resultProsesor,
            'listSistemOperasi' => $resultSistemOperasi,
            'listUkuranLayar' => $resultUkuranLayar,
            'searching1' => $resultHandphone,
            'jumlahHandphone' => $jumlahHandphone,
            'resp' => $resp,
            'sql' => $sql
        ];*/
            
        return view('pencarian', [
            'title' => 'Fitur Pencarian',
            'page' => 'pencarian', 
            //'list' =>  $data
        ]);
    }
}
?>
