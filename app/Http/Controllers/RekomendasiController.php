<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    public function rekomendasi(Request $request)
    {
        if (isset($_GET['rekomendasi'])) {
            $resp = 1;
            // Get request kriteria wisata & bobot kriteria wisata
            $wisata = $this->getWahana($request->budget, $request->hargaWahana, $request->durasiSewa, $request->popularitas, $request->kecepatanAkses);
            $bobotUser = $this->getBobotUser($request->bobotBudget, $request->bobotHargaWahana, $request->bobotDurasiSewa, $request->bobotPopularitas, $request->bobotKecepatanAkses);

            // Get query & jumlahData 
            $sql = $wisata[1];
            $jumlahData = count($wisata[0]);

            if ($jumlahData == 0) {
                $resultDetailWisata = [];
                $resultBobot = [];
                $resultKriteria = [];
                $resultNormalisasi = [];
                $resultRanking = [];
                $resultSAW = [];
            } else {
                $resultDetailWisata = $this->getDetailWisata($wisata[0]);
                $resultBobot = $resultDetailWisata;
                $resultKriteria = $this->getKriteria();
                $resultNormalisasi = $this->getNormalisasi($resultBobot, $resultKriteria);
                $resultRanking = $this->getHasil($resultNormalisasi, $bobotUser);
                $resultSAW = $this->getRanking($resultRanking);
            }
        } else if (isset($_GET['reset'])) {
            header('Location: /rekomendasi');
            $resultBobot = [];
            $resultDetailWisata = [];
            $resultKriteria = [];
            $resultNormalisasi = [];
            $resultRanking = [];
            $resultSAW = [];
            $jumlahData = 0;
            $resp = 0;
            $sql = [];
        } else {
            $resultDetailWisata = [];
            $resultBobot = [];
            $resultKriteria = [];
            $resultNormalisasi = [];
            $resultRanking = [];
            $resultSAW = [];
            $jumlahData = 0;
            $resp = 0;
            $sql = [];
        }

        $data = [
            'resp' => $resp,
            'jumlahData' => $jumlahData,
            'resultDetailWisata' => $resultDetailWisata,
            'resultBobot' => $resultBobot,
            'resultKriteria' => $resultKriteria,
            'resultNormalisasi' => $resultNormalisasi,
            'resultRanking' => $resultRanking,
            'resultSAW' => $resultSAW,
            'sql' => $sql
        ];

        return view('rekomendasi', [
            'title' => 'Fitur Rekomendasi',
            'page' => 'rekomendasi',
            'kriteria' => $this->getKriteriaDropdown(),
            'data' => $data
        ]);
    }

    private function getKriteriaDropdown(): array
    {
        $listKriteria = [];
        $listKriteria['listHargaSewa'] = [];
        $listKriteria['listDurasiSewa'] = [];
        $listKriteria['listKecepatanAkses'] = [];
        $listKriteria['listPopularitas'] = [];

        // Harga Sewa Wahana
        $resultHargaSewaWahana = $this->sparql->query("SELECT * WHERE { ?hargaSewa a wisata:HargaSewaWahana ; wisata:HargaSewaWahana ?harga . }");
        foreach ($resultHargaSewaWahana as $item) {
            array_push($listKriteria['listHargaSewa'], [
                'hargaSewa' => $this->parseData($item->hargaSewa->getUri()),
                'value' => $item->harga->getValue()
            ]);
        }
        
        // Durasi Sewa Wahana
        $resultDurasiSewaWahana = $this->sparql->query("SELECT * WHERE { ?durasiSewa a wisata:DurasiSewaWahana ; wisata:nilaiDurasiSewa ?durasi . }");
        foreach ($resultDurasiSewaWahana as $item) {
            array_push($listKriteria['listDurasiSewa'], [
                'durasiSewa' => $this->parseData($item->durasiSewa->getUri()),
                'value' => $item->durasi->getValue()
            ]);
        }

        // Kecepatan Akses
        $resultKecepatanAkses = $this->sparql->query("SELECT * WHERE { ?kecepatanAkses a wisata:KecepatanAkses ; wisata:nilaiKecepatanAkses ?kecepatan . }");
        foreach ($resultKecepatanAkses as $item) {
            array_push($listKriteria['listKecepatanAkses'], [
                'kecepatanAkses' => $this->parseData($item->kecepatanAkses->getUri()),
                'value' => $item->kecepatan->getValue()
            ]);
        }

        // Popularitas
        $resultPopularitas = $this->sparql->query("SELECT DISTINCT * WHERE { ?popularitas a wisata:Popularitas ; wisata:nilaiPopularitas ?nilaiPopularitas . } ORDER BY ?popularitas");
        foreach ($resultPopularitas as $item) {
            array_push($listKriteria['listPopularitas'], [
                'popularitas' => str_replace('_', ' ', str_replace('Popularitas_', '', $this->parseData($item->popularitas->getUri()))),
                'value' => $item->nilaiPopularitas->getValue(),
            ]);
        }
        
        return $listKriteria;
    }

    public function getWahana($budget, $hargaWahana, $durasiSewa, $popularitas, $kecepatanAkses)
    {
        $sql = "SELECT ?wisata WHERE {
            ?tipeWisata rdfs:subClassOf+ wisata:ObjekWisata .
            ?wisata a ?tipeWisata .
            ";

        // Budget Travelling
        if ($budget != null) {
            $sql = $sql . "?wisata wisata:HargaSewaWahana ?hargaWahana .
            ?wisata wisata:memilikiHargaTiketMasuk ?tiketMasuk .
            ?tiketMasuk wisata:HargaTiketMasuk ?hargaTiketMasuk .
            FILTER ((?hargaTiketMasuk + ?hargaWahana) <= $budget) .";
        }

        // Harga Sewa Wahana
        if ($hargaWahana != null) {
            if ($budget != null) {
                $sql = $sql . "FILTER (?hargaWahana <= $hargaWahana) .";
            }elseif($hargaWahana == '100000') {
                $sql = $sql . "?wisata wisata:HargaSewaWahana ?hargaWahana .
                FILTER (?hargaWahana <= 100000) .\n";
            }elseif($hargaWahana == '200000') {
                $sql = $sql . "?wisata wisata:HargaSewaWahana ?hargaWahana .
                FILTER (?hargaWahana <= 200000) .\n";
            }elseif($hargaWahana == '300000') {
                $sql = $sql . "?wisata wisata:HargaSewaWahana ?hargaWahana .
                FILTER (?hargaWahana <= 300000) .\n";
            }elseif($hargaWahana == '400000') {
                $sql = $sql . "?wisata wisata:HargaSewaWahana ?hargaWahana .
                FILTER (?hargaWahana <= 400000) .\n";
            }elseif($hargaWahana == '500000') {
                $sql = $sql . "?wisata wisata:HargaSewaWahana ?hargaWahana .
                FILTER (?hargaWahana <= 500000) .\n";
            }elseif($hargaWahana == '600000') {
                $sql = $sql . "?wisata wisata:HargaSewaWahana ?hargaWahana .
                FILTER (?hargaWahana <= 600000) .\n";
            }elseif($hargaWahana == '700000') {
                $sql = $sql . "?wisata wisata:HargaSewaWahana ?hargaWahana .
                FILTER (?hargaWahana <= 700000) .\n";
            }elseif($hargaWahana == '800000') {
                $sql = $sql . "?wisata wisata:HargaSewaWahana ?hargaWahana .
                FILTER (?hargaWahana <= 800000) .\n";
            }
        }

        // Durasi Sewa Wahana
        if ($durasiSewa == '') {
            $sql = $sql;
        }elseif($durasiSewa == '60'){
            $sql = $sql . "?wisata wisata:memilikiDurasiSewa ?durasiSewa .
            ?durasiSewa wisata:nilaiDurasiSewa ?durasi .
            FILTER (?durasi <= 60) .\n";
        }elseif($durasiSewa == '120'){
            $sql = $sql . "?wisata wisata:memilikiDurasiSewa ?durasiSewa .
            ?durasiSewa wisata:nilaiDurasiSewa ?durasi .
            FILTER (?durasi <= 120) .\n";
        }elseif($durasiSewa == '180'){
            $sql = $sql . "?wisata wisata:memilikiDurasiSewa ?durasiSewa .
            ?durasiSewa wisata:nilaiDurasiSewa ?durasi .
            FILTER (?durasi <= 180) .\n";
        }elseif($durasiSewa == '240'){
            $sql = $sql . "?wisata wisata:memilikiDurasiSewa ?durasiSewa .
            ?durasiSewa wisata:nilaiDurasiSewa ?durasi .
            FILTER (?durasi <= 240) .\n";
        }elseif($durasiSewa == '300'){
            $sql = $sql . "?wisata wisata:memilikiDurasiSewa ?durasiSewa .
            ?durasiSewa wisata:nilaiDurasiSewa ?durasi .
            FILTER (?durasi <= 300) .\n";
        }elseif($durasiSewa == '360'){
            $sql = $sql . "?wisata wisata:memilikiDurasiSewa ?durasiSewa .
            ?durasiSewa wisata:nilaiDurasiSewa ?durasi .
            FILTER (?durasi <= 360) .\n";
        }elseif($durasiSewa == '420'){
            $sql = $sql . "?wisata wisata:memilikiDurasiSewa ?durasiSewa .
            ?durasiSewa wisata:nilaiDurasiSewa ?durasi .
            FILTER (?durasi <= 420) .\n";
        }elseif($durasiSewa == '480'){
            $sql = $sql . "?wisata wisata:memilikiDurasiSewa ?durasiSewa .
            ?durasiSewa wisata:nilaiDurasiSewa ?durasi .
            FILTER (?durasi <= 480) .\n";
        }elseif($durasiSewa == '540'){
            $sql = $sql . "?wisata wisata:memilikiDurasiSewa ?durasiSewa .
            ?durasiSewa wisata:nilaiDurasiSewa ?durasi .
            FILTER (?durasi <= 540) .\n";
        }elseif($durasiSewa == '600'){
            $sql = $sql . "?wisata wisata:memilikiDurasiSewa ?durasiSewa .
            ?durasiSewa wisata:nilaiDurasiSewa ?durasi .
            FILTER (?durasi <= 600) .\n";
        }

        // Popularitas Objek Wisata
        if ($popularitas == '') {
            $sql = $sql;
        }elseif($popularitas == '1'){
            $sql = $sql . "?wisata wisata:memilikiPopularitas ?popularitas .
            ?popularitas wisata:nilaiPopularitas ?nilaiPopularitas .
            FILTER (?nilaiPopularitas <= 1) .";
        }elseif($popularitas == '2'){
            $sql = $sql . "?wisata wisata:memilikiPopularitas ?popularitas .
            ?popularitas wisata:nilaiPopularitas ?nilaiPopularitas .
            FILTER (?nilaiPopularitas <= 2) .";
        }elseif($popularitas == '3'){
            $sql = $sql . "?wisata wisata:memilikiPopularitas ?popularitas .
            ?popularitas wisata:nilaiPopularitas ?nilaiPopularitas .
            FILTER (?nilaiPopularitas <= 3) .";
        }elseif($popularitas == '4'){
            $sql = $sql . "?wisata wisata:memilikiPopularitas ?popularitas .
            ?popularitas wisata:nilaiPopularitas ?nilaiPopularitas .
            FILTER (?nilaiPopularitas <= 4) .";
        }elseif($popularitas == '5'){
            $sql = $sql . "?wisata wisata:memilikiPopularitas ?popularitas .
            ?popularitas wisata:nilaiPopularitas ?nilaiPopularitas .
            FILTER (?nilaiPopularitas <= 5) .";
        }

        // Kecepatan Akses Lokasi
        if ($kecepatanAkses == '') {
            $sql = $sql;
        }elseif ($kecepatanAkses == '0.5'){
            $sql = $sql . "?wisata wisata:memilikiKecepatanAkses ?kecepatan .
            ?kecepatan wisata:nilaiKecepatanAkses ?kecepatanAkses .
            FILTER (?kecepatanAkses <= 0.5) .";
        }elseif ($kecepatanAkses == '1'){
            $sql = $sql . "?wisata wisata:memilikiKecepatanAkses ?kecepatan .
            ?kecepatan wisata:nilaiKecepatanAkses ?kecepatanAkses .
            FILTER (?kecepatanAkses <= 1) .";
        }elseif ($kecepatanAkses == '1.5'){
            $sql = $sql . "?wisata wisata:memilikiKecepatanAkses ?kecepatan .
            ?kecepatan wisata:nilaiKecepatanAkses ?kecepatanAkses .
            FILTER (?kecepatanAkses <= 1.5) .";
        }elseif ($kecepatanAkses == '2'){
            $sql = $sql . "?wisata wisata:memilikiKecepatanAkses ?kecepatan .
            ?kecepatan wisata:nilaiKecepatanAkses ?kecepatanAkses .
            FILTER (?kecepatanAkses <= 2) .";
        }elseif ($kecepatanAkses == '2.5'){
            $sql = $sql . "?wisata wisata:memilikiKecepatanAkses ?kecepatan .
            ?kecepatan wisata:nilaiKecepatanAkses ?kecepatanAkses .
            FILTER (?kecepatanAkses <= 2.5) .";
        }

        // Query closing
        $sql = $sql . "}";
        // dd($sql);

        // EksekusiQuery
        $rowQuery = [];
        $query = $this->sparql->query($sql);

        foreach ($query as $item) {
            array_push($rowQuery, [
                'wisata' => $this->parseData($item->wisata->getUri())
            ]);
        }

        // dd($rowQuery, $sql);
        return [$rowQuery, $sql];
    }

    public function getBobotUser($budget, $hargaWahana, $durasiSewa, $popularitas, $kecepatanAkses)
    {
        $bobotUser = [];

        // Budget
        $bobotUser['budget'] = $budget ? (int) $budget : 1;

        // Harga Wahana
        $bobotUser['hargaSewaWahana'] = $hargaWahana ? (int) $hargaWahana : 1;

        // Durasi Sewa
        $bobotUser['durasiSewaWahana'] = $durasiSewa ? (int) $durasiSewa : 1;

        // Popularitas
        $bobotUser['popularitas'] = $popularitas ? (int) $popularitas : 1;

        // Kecepatan Akses
        $bobotUser['kecepatanAkses'] = $kecepatanAkses ? (int) $kecepatanAkses : 1;

        return $bobotUser;
    }

    private function getKriteria()
    {
        $kriteria = [
            'tiketMasuk',
            'parkirMobil',
            'parkirMotor',
            'hargaSewaWahana',
            'budget',
            'durasiSewaWahana',
            'kecepatanAkses',
            'popularitas',
            /* Add more if needed! */
        ];

        return $kriteria;
    }

    private function getDetailWisata($list)
    {
        $resultWisata = [];

        foreach ($list as $item) {
            $result = $this->sparql->query("SELECT * WHERE {
                VALUES ?wisata { wisata:" . $item['wisata'] . " } .
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
            }");

            if ($result->numRows() > 0) {
                array_push($resultWisata, [
                    'nama' => str_replace('_',' ',$this->parseData($result[0]->wisata->getUri())),
                    'jenis' => property_exists($result[0], 'jenis') ? preg_replace("/([a-z])([A-Z])/s", "$1 $2", $this->parseData($result[0]->jenis->getUri())) : null,
                    'banjar' => property_exists($result[0], 'banjar') ? str_replace('Banjar_', '', $this->parseData($result[0]->banjar->getUri())) : null,
                    'desa' => property_exists($result[0], 'desa') ? str_replace('_', ' ', $this->parseData($result[0]->desa->getUri())) : null,
                    'kecamatan' => property_exists($result[0], 'kecamatan') ? str_replace('_', ' ', $this->parseData($result[0]->kecamatan->getUri())) : null,
                    'kabupaten' => property_exists($result[0], 'kabupaten') ? str_replace('Kabupaten_', '', $this->parseData($result[0]->kabupaten->getUri())) : null,
                    'jamBuka' => property_exists($result[0], 'jamBuka') ? str_replace('Jam_', '', $this->parseData($result[0]->jamBuka->getUri())) : null,
                    'gambar' => property_exists($result[0], 'gambar') ? $this->parseData($result[0]->gambar->getValue()) : null,
                    'tiketMasuk' => property_exists($result[0], 'tiketMasuk') ? str_replace('Harga_Tiket_', '', $this->parseData($result[0]->tiketMasuk->getUri())) : null,
                    'hargaSewaWahana' => property_exists($result[0], 'hargaSewaWahana') ? str_replace('Harga_Sewa_', '', $this->parseData($result[0]->hargaSewaWahana->getUri())) : null,
                    'budget' => property_exists($result[0], 'budget') ? $this->parseData($result[0]->budget->getValue()) : null,
                    'kecepatanAkses' => property_exists($result[0], 'kecepatanAkses') ? explode('_', $this->parseData($result[0]->kecepatanAkses->getUri()))[2] : null,
                    'durasiSewaWahana' => property_exists($result[0], 'durasiSewaWahana') ? explode('_', $this->parseData($result[0]->durasiSewaWahana->getUri()))[1] : null,
                    'parkirMobil' => property_exists($result[0], 'parkirMobil') ? str_replace('Harga_Parkir_', '', $this->parseData($result[0]->parkirMobil->getUri())) : null,
                    'parkirMotor' => property_exists($result[0], 'parkirMotor') ? str_replace('Harga_Parkir_', '', $this->parseData($result[0]->parkirMotor->getUri())) : null,
                    'popularitas' => property_exists($result[0], 'popularitas') ? str_replace('Popularitas_Bintang_', '', $this->parseData($result[0]->popularitas->getUri())) : null,
                ]);
            }
        }
        
        // dd($resultWisata);
        return $resultWisata;

    }

    public function getNormalisasi($data, $kriteria)
    {
        $resultNormalization = [];

        // dd($data, $kriteria);

        // Mencari nilai max tiap kriteria
        $listMax = null;
        foreach ($kriteria as $k) {
            $max = 0;
            foreach ($data as $item) {
                if ($item[$k] > $max) {
                    $max = $item[$k];
                }
            }
            $listMax[$k] = $max;
        }

        // Melakukan perhitungan normalisasi
        // Rumus : Norm(x) = nilai(x) / max(x)
        foreach ($data as $item) {
            $itemNorm = [];
            $itemNorm['nama'] = $item['nama'];
            foreach ($kriteria as $k) {
                if ($item[$k] > 0) {
                    $itemNorm[$k] = $item[$k] / $listMax[$k];
                } else {
                    $itemNorm[$k] = 0;
                }
            }
            array_push($resultNormalization, $itemNorm);
        }

        return $resultNormalization;
    }

    public function getHasil($data, $bobot)
    {
        $hasil = [];
        // dd($data, $bobot, $kriteria);

        // Menjumlahkan hasil normalisasi
        foreach ($data as $item) {
            $totalBobot = 0;
            foreach ($bobot as $key => $value) {
                $totalBobot += $item[$key] * $value;
            }
            array_push($hasil, [
                'nama' => $item['nama'],
                'bobot' => $totalBobot
            ]);
        }

        // dd($hasil);
        return $hasil;
    }

    private function getRanking($data)
    {
        $n = sizeof($data);
        
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                // Swap if element found is less
                if ($data[$j]['bobot'] < $data[$j+1]['bobot']) {
                    $temp = $data[$j];
                    $data[$j] = $data[$j+1];
                    $data[$j+1] = $temp;
                }
            }
        }

        return $data;
    }
}
