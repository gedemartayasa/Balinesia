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
                /*else if($request->browse == 'merek'){
                    $merek = $this->sparql->query('SELECT * WHERE {?merek a handphone:Merek}');
                    $resultMerek =[];
                    foreach ($merek as $item) {
                        array_push($resultMerek, [
                            'merek' => $this->parseData($item->merek->getUri())
                        ]);
                    }
                    $data = [
                        'listMerek' => $resultMerek,
                        'penjelajahan' => 'merek'
                    ];
                }*/
                /*else if($request->browse == 'handphone'){
                    $ram = $this->sparql->query('SELECT * WHERE{?ram a handphone:RAM} ORDER BY ?ram');
                    $memori = $this->sparql->query('SELECT * WHERE{?memori a handphone:Memori} ORDER BY ?memori');
                    $baterai = $this->sparql->query('SELECT * WHERE{?baterai a handphone:Baterai} ORDER BY ?baterai');
                    $kameraDepan = $this->sparql->query('SELECT * WHERE{?kameraDepan a handphone:KameraDepan} ORDER BY ?kameraDepan');
                    $kameraBelakang = $this->sparql->query('SELECT * WHERE{?kameraBelakang a handphone:KameraBelakang} ORDER BY ?kameraBelakang');
                    $sistemOperasi = $this->sparql->query('SELECT * WHERE{?sistemOperasi a handphone:SistemOperasi} ORDER BY ?sistemOperasi');
                    $ukuranLayar = $this->sparql->query('SELECT * WHERE{?ukuranLayar a handphone:UkuranLayar}ORDER BY ?ukuranLayar');
                    $prosesor = $this->sparql->query('SELECT * WHERE {
                        {?prosesor a handphone:Exynos}
                        UNION {?prosesor a handphone:MediaTek}
                        UNION {?prosesor a handphone:Qualcomm}
                        UNION {?prosesor a handphone:Kirin}
                    }');
                    $resultRAM = [];
                    $resultMemori = [];
                    $resultBaterai = [];
                    $resultKameraDepan = [];
                    $resultKameraBelakang = [];
                    $resultProsesor = [];
                    $resultSistemOperasi = [];
                    $resultUkuranLayar = [];

                    foreach ($ram as $item) {
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

                    $data = [
                        'listRAM' => $resultRAM,
                        'listMemori' => $resultMemori,
                        'listBaterai' => $resultBaterai,
                        'listKameraDepan' => $resultKameraDepan,
                        'listKameraBelakang' => $resultKameraBelakang,
                        'listProsesor' => $resultProsesor,
                        'listSistemOperasi' => $resultSistemOperasi,
                        'listUkuranLayar' => $resultUkuranLayar,
                        'penjelajahan' => 'handphone' 
                    ];
                }*/
                
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

    public function jelajah($jelajah){
        $sql= 'SELECT * WHERE {
            ?ObjekWisata wisata:isLocatedAt ?'.$jelajah.' .
            ?ObjekWisata wisata:memilikiGambar ?memilikiGambar. 
            ?ObjekWisata wisata:HargaSewaWahana ?HargaSewaWahana.
            }';
        $wisata = $this->sparql->query($sql);
        
        $resultWisata = [];
        foreach ($wisata as $item) {
            array_push($resultWisata, [
                'nama' => $this->parseData($item->ObjekWisata->getUri()),
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
