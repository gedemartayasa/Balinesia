<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenjelajahanController extends Controller
{
    public function browsing(Request $request)
    {
        $resp = 0;
        if (isset($_GET['browsing'])) 
        {
            $resp++;
            if ($request->browse != '') 
            {
                if($request->browse == 'banjar'){
                    $banjar = $this->sparql->query('SELECT * WHERE {?Tempat a wisata:Banjar}');
                    $resultBanjar = [];
                    foreach ($banjar as $item) {
                        array_push($resultBanjar, [
                            'banjar' => $this->parseData($item->Tempat->getUri())
                        ]);
                    }
                    $data = [
                        'listBanjar' => $resultBanjar,
                        'penjelajahan' => 'banjar'
                    ];
                }
                else if($request->browse == 'desa'){
                    $desa = $this->sparql->query('SELECT * WHERE {?Tempat a wisata:Desa}');
                    $resultDesa = [];
                    foreach ($desa as $item) {
                        array_push($resultDesa, [
                            'desa' => $this->parseData($item->Tempat->getUri())
                        ]);
                    }
                    $data = [
                        'listDesa' => $resultDesa,
                        'penjelajahan' => 'desa'
                    ];
                }
                else if($request->browse == 'kecamatan'){
                    $kecamatan = $this->sparql->query('SELECT * WHERE {?Tempat a wisata:Kecamatan}');
                    $resultKecamatan = [];
                    foreach ($kecamatan as $item) {
                        array_push($resultKecamatan, [
                            'kecamatan' => $this->parseData($item->Tempat->getUri())
                        ]);
                    }
                    $data = [
                        'listKecamatan' => $resultKecamatan,
                        'penjelajahan' => 'kecamatan'
                    ];
                }
                else if($request->browse == 'kabupaten'){
                    $kabupaten = $this->sparql->query('SELECT * WHERE {?Tempat a wisata:Kabupaten}');
                    $resultKabupaten = [];
                    foreach ($kabupaten as $item) {
                        array_push($resultKabupaten, [
                            'kabupaten' => $this->parseData($item->Tempat->getUri())
                        ]);
                    }
                    $data = [
                        'listKabupaten' => $resultKabupaten,
                        'penjelajahan' => 'kabupaten'
                    ];
                }             
            }
            else
            {
                $resp = 0;
                $data = [];
                echo "<script type='text/javascript'>alert('Silahkan masukan pilihan anda!');</script>";
                
            }
        } 
        else if (isset($_GET['reset'])) 
        {
            header('Location: /penjelajahan');
            $resp = 0;
            $data = [];
        }
        else{
            $data = [];
        }
        $data = [
            'resp' => $resp,
            // 'jumlahbrowse' => $jumlahbrowse,
            'data' => $data
        ];

        return view('penjelajahan', [
            'title' => 'Fitur Penjelajahan',
            'page' => 'penjelajahan',
            'data' => $data
        ]);
    }

    public function jelajah($kriteria, $jelajah){
        if($kriteria == 'Banjar'){
            $sql= 'SELECT * WHERE {
                ?wisata wisata:isLocatedAt wisata:'.$jelajah.' .
                ?wisata wisata:memilikiGambar ?memilikiGambar. 
                ?wisata wisata:HargaSewaWahana ?HargaSewaWahana.
                }';
            $wisata = $this->sparql->query($sql);
            
        }
        else{
            $sql= 'SELECT * WHERE {
                ?wisata wisata:isPartOf wisata:'.$jelajah.' .
                ?wisata wisata:memilikiGambar ?memilikiGambar. 
                ?wisata wisata:HargaSewaWahana ?HargaSewaWahana.
                }';
            $wisata = $this->sparql->query($sql);  
        }
        
        $resultWisata = [];
        foreach ($wisata as $item) {
            array_push($resultWisata, [
                'nama' => $this->parseData($item->wisata->getUri()),
                'gambar' => $this->parseData($item->memilikiGambar->getValue()),
                'harga' => $this->parseData($item->HargaSewaWahana->getValue())
            ]);
        }
        $data = [
            'listWisata' => $resultWisata,
            'count' => count($resultWisata),
            'sql' => $sql
        ];
        return view('jelajah', [
            'title' => 'Hasil Penjelajahan',
            'page' => 'Hasil Penjelajahan',
            'data' => $data
        ]);
    }   
}
?>
