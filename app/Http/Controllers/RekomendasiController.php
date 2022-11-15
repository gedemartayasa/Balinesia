<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    public function rekomendasi(Request $request)
    {
        /*
        if(isset($_GET['rekomendasi']))
        {
            $resp=1;
            //INPUTAN USER
            $handphone = $this->getHandphone($request->cariUkuranLayar, $request->cariBaterai, $request->cariKamera, $request->cariHarga, $request->cariAplikasi);
            $bobotUser = $this->getBobotUser($request->bobotKamera, $request->bobotHarga, $request->bobotUl, $request->bobotBaterai, $request->bobotAplikasi);
            //END INPUTAN USER
            $sql = $handphone[1];
            $jumlahCari = count($handphone[0]);
            if($jumlahCari == 0)
            {
                $resultSpesifikasi = [];
                $resultBobot = [];
                $resultKriteria = [];
                $resultNormalisasi = [];
                $resultRanking = [];
                $resultSAW =[];
            }
            else 
            {
                $resultSpesifikasi = $this->getSpesifikasi($handphone[0]);
                $resultBobot = $this->getBobot($resultSpesifikasi);
                $resultKriteria = $this->getKriteria();
                $resultNormalisasi = $this->getNormalisasi($resultBobot, $resultKriteria);
                $resultRanking = $this->getHasil($resultNormalisasi, $resultKriteria, $bobotUser);
                $resultSAW = $this->getRanking($resultRanking);
            }
        }
        else if(isset($_GET['reset']))
        {
            header('Location: /rekomendasi');
            $resultBobot = [];
            $resultSpesifikasi=[];
            $resultKriteria = [];
            $resultNormalisasi = [];
            $resultRanking = [];
            $resultSAW = [];
            $jumlahCari = 0;
            $resp = 0;
            $sql = [];
        }
        else
        {
            $resultSpesifikasi = [];
            $resultBobot = [];
            $resultKriteria = [];
            $resultNormalisasi = [];
            $resultRanking = [];
            $resultSAW = [];
            $jumlahCari = 0;
            $resp = 0;
            $sql = [];
        }

        $rowAplikasi = $this->showAplikasi();

        $data = [
            'resp' => $resp,
            'jumlahCari' => $jumlahCari,
            'resultSpesifikasi' => $resultSpesifikasi,
            'resultBobot' => $resultBobot,
            'resultKriteria' => $resultKriteria,
            'resultNormalisasi' => $resultNormalisasi,
            'resultRanking' => $resultRanking,
            'resultSAW' => $resultSAW,
            'rowAplikasi' => $rowAplikasi,
            'sql' => $sql
        ];
        */
        return view('rekomendasi', [
            'title' => 'Fitur Rekomendasi',
            'page' => 'rekomendasi',
            //'data' => $data
        ]);
    }
    /*
    public function getHandphone($ukuranKenyamanan,$lamaTravelling,$hobiFotografi,$budgetPembelian,$aplikasiSehari)
    {
        $sql = 'SELECT * WHERE {?hp a handphone:Handphone';
        $i = 0;
        //Query untuk mencari ukuran kenyamanan
        if($ukuranKenyamanan == '')
        {
            $sql = $sql;
        }
        else if ($ukuranKenyamanan == 'besar') 
        {
            $sql = $sql . '.?hp handphone:memilikiUkuranLayar ?ul .?ul handphone:nilaiUkuranLayar ?nilaiUl FILTER( ?nilaiUl >= 6.7 )';
        } 
        else if ($ukuranKenyamanan == 'sedang') 
        {
            $sql = $sql . '.?hp handphone:memilikiUkuranLayar ?ul .?ul handphone:nilaiUkuranLayar ?nilaiUl FILTER( ?nilaiUl >= 6.5 && ?nilaiUl < 6.7 )';
        }
        else 
        {
            $sql = $sql . '.?hp handphone:memilikiUkuranLayar ?ul .?ul handphone:nilaiUkuranLayar ?nilaiUl FILTER( ?nilaiUl < 6.5 )';
        }

        //Query untuk mencari lama travelling
        if ($lamaTravelling != '')
        {
            $sql = $sql . '.?hp handphone:nilaiDayaTahan ?dayaTahan FILTER (?dayaTahan > ' . $lamaTravelling . ')';
        }
        else
        {
            $sql = $sql;
        }

        //Query untuk mencari hobi fotografi
        if ($hobiFotografi == '') 
        {
            $sql = $sql;
        } 
        else if ($hobiFotografi == '0') 
        {
            $sql = $sql . '.?hp handphone:memilikiKameraBelakang ?kb .?kb handphone:nilaiKameraBelakang ?nilaiKb FILTER(?nilaiKb >= 48)';
        } 
        else if ($hobiFotografi == '1') 
        {
            $sql = $sql . '.?hp handphone:memilikiKameraDepan ?kd .?kd handphone:nilaiKameraDepan ?nilaiKd FILTER(?nilaiKd >= 20)';
        } 
        else if ($hobiFotografi == '2') 
        {
            $sql = $sql . '.?hp handphone:memilikiKameraBelakang ?kb.?hp handphone:memilikiKameraDepan ?kd .?kb handphone:nilaiKameraBelakang ?nilaiKb FILTER(?nilaiKb >= 48).?kd handphone:nilaiKameraDepan ?nilaiKd FILTER(?nilaiKd >= 20)';
        } 
        else if ($hobiFotografi == '3') {
            $sql = $sql . '.?hp handphone:memilikiKameraBelakang ?kb.?kb handphone:nilaiKameraBelakang ?nilaiKb FILTER(?nilaiKb < 48)';
        } 
        else 
        {
            $sql = $sql . '.?hp handphone:memilikiKameraDepan ?kd. ?kd handphone:nilaiKameraDepan ?nilaiKd FILTER(?nilaiKd < 20)';
        }

        //Query untuk mencari budget pembelian
        if($budgetPembelian == '')
        {
            $sql = $sql;
        }
        else 
        {
            $sql = $sql . '.?hp handphone:nilaiHarga ?harga FILTER(?harga < '.$budgetPembelian.')';
        }
        
        //Query untuk aplikasi sehari hari
        if ($aplikasiSehari == '') 
        {
            $sql = $sql;
        }
        else
        {
            $aplikasi = $aplikasiSehari;
            $rowapp = [];
            foreach ($aplikasi as $item) {
                array_push($rowapp, [
                    'req' => $this->sparql->query('SELECT * WHERE{VALUES ?app {handphone:' . $item . '}.
                            ?app handphone:minRAM ?minRAM.
                            ?app handphone:minMemori ?minMemori.
                            ?app handphone:minProsesor ?minProsesor.
                            ?app handphone:minSistemOperasi ?minOS.
                        }')
                ]);
            }

            $minreq = [];
            foreach ($rowapp as $item) {
                array_push($minreq, [
                    'minRAM' => $this->parseData($item['req'][0]->minRAM->getValue()),
                    'minMemori' => $this->parseData($item['req'][0]->minMemori->getValue()),
                    'minOS' => $this->parseData($item['req'][0]->minOS->getValue()),
                    'minProsesor' => $this->parseData($item['req'][0]->minProsesor->getValue())
                ]);
            }
            $sumMemori = 0;
            for ($i = 0; $i < count($minreq); $i++) {
                $sumMemori = $sumMemori + $minreq[$i]['minMemori'];
            }

            $minRequirement = max($minreq);
            array_push($minRequirement, [
                'sumMemori' => $sumMemori
            ]);

            $sql = $sql . '.?hp handphone:memilikiRAM ?ram .?ram handphone:nilaiRAM ?nilaiRAM FILTER(?nilaiRAM >= '.$minRequirement['minRAM']. ').?hp handphone:memilikiMemori ?memori .?memori handphone:nilaiMemori ?nilaiMemori FILTER(?nilaiMemori >= ' . $minRequirement[0]['sumMemori'] . ').?hp handphone:memilikiProsesor ?prosesor .?prosesor handphone:nilaiProsesor ?nilaiProsesor FILTER(?nilaiProsesor >= ' . $minRequirement['minProsesor'] . ').?hp handphone:memilikiSistemOperasi ?so .?so handphone:nilaiSistemOperasi ?nilaiSO FILTER(?nilaiSO >= ' . $minRequirement['minOS'] . ')';
        }
        $sql = $sql .'}';

        //EksekusiQuery
        $rowQuery=[];
        $query = $this->sparql->query($sql);
        foreach ($query as $item) {
            array_push($rowQuery,[
                'namaHandphone' => $this->parseData($item->hp->getUri())
            ]);
        }

        return [$rowQuery,$sql];

    }

    public function getBobotUser($kamera, $harga, $ul, $baterai, $aplikasi)
    {
        $bobotUser = [];
        if ($baterai) {
            array_push($bobotUser, [
                'Baterai' => $baterai
            ]);
        } else {
            array_push($bobotUser, [
                'Baterai' => 1
            ]);
        }
        if ($aplikasi) {
            array_push($bobotUser, [
                'Memori' => $aplikasi
            ]);
        } else {
            array_push($bobotUser, [
                'Memori' => 1
            ]);
        }
        if ($aplikasi) {
            array_push($bobotUser, [
                'Prosesor' => $aplikasi
            ]);
        } else {
            array_push($bobotUser, [
                'Prosesor' => 1
            ]);
        }
        if ($aplikasi) {
            array_push($bobotUser, [
                'RAM' => $aplikasi
            ]);
        } else {
            array_push($bobotUser, [
                'RAM' => 1
            ]);
        }
        if ($harga) {
            array_push($bobotUser, [
                'Harga' => $harga
            ]);
        } else {
            array_push($bobotUser, [
                'Harga' => 1
            ]);
        }
        if ($kamera) {
            array_push($bobotUser, [
                'Kamera_Belakang' => $kamera
            ]);
        } else {
            array_push($bobotUser, [
                'Kamera_Belakang' => 1
            ]);
        }
        if ($kamera) {
            array_push($bobotUser, [
                'Kamera_Depan' => $kamera
            ]);
        } else {
            array_push($bobotUser, [
                'Kamera_Depan' => 1
            ]);
        }
        if ($aplikasi) {
            array_push($bobotUser, [
                'Sistem_Operasi' => $aplikasi
            ]);
        } else {
            array_push($bobotUser, [
                'Sistem_Operasi' => 1
            ]);
        }
        if ($ul) {
            array_push($bobotUser, [
                'Ukuran_Layar' => $ul
            ]);
        } else {
            array_push($bobotUser, [
                'Ukuran_Layar' => 1
            ]);
        }

        return $bobotUser;
    }

    public function showAplikasi()
    {
        $resultquery=[];
        $resultsql = $this->sparql->query('SELECT * WHERE {?app a handphone:Aplikasi} ORDER BY ?app');
        foreach($resultsql as $item){
            array_push($resultquery,[
                'aplikasi' => $this->parseData($item->app->getUri())
            ]);
        }

        return $resultquery;
    }
    
    public function getSpesifikasi($data)
    {
        $queryData = [];
        $jumlahData = count($data);
        for ($x = 0; $x < $jumlahData; $x++) {
            array_push($queryData, [
                'data' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $data[$x]['namaHandphone'] . '}
                .?hp handphone:memilikiBaterai ?baterai 
                .?hp handphone:nilaiDayaTahan ?nilaibaterai
                .?hp handphone:nilaiHarga ?harga
                .?hp handphone:memilikiRAM ?ram 
                .?hp handphone:memilikiMemori ?memori 
                .?hp handphone:memilikiKameraDepan ?kd 
                .?hp handphone:memilikiKameraBelakang ?kb 
                .?hp handphone:memilikiSistemOperasi ?so 
                .?hp handphone:memilikiProsesor ?prosesor 
                .?hp handphone:memilikiUkuranLayar ?ul 
            } ')
            ]);
        }
        $resultData = [];
        foreach ($queryData as $item) {
            array_push($resultData, [
                'nama' => $this->parseData($item['data'][0]->hp->getUri()),
                'harga' => $this->parseData($item['data'][0]->harga->getValue()),
                'ukuranlayar' => $this->parseData($item['data'][0]->ul->getUri()),
                'ram' => $this->parseData($item['data'][0]->ram->getUri()),
                'kb' => $this->parseData($item['data'][0]->kb->getUri()),
                'baterai' => $this->parseData($item['data'][0]->baterai->getUri()),
                'nbaterai' => $this->parseData($item['data'][0]->nilaibaterai->getValue()),
                'memori' => $this->parseData($item['data'][0]->memori->getUri()),
                'kd' => $this->parseData($item['data'][0]->kd->getUri()),
                'prosesor' => $this->parseData($item['data'][0]->prosesor->getUri()),
                'so' => $this->parseData($item['data'][0]->so->getUri()),

            ]);
        }

        return $resultData;
    }

    public function getKriteria ()
    {
        $resultQuery = [];
        $query = $this->sparql->query('SELECT * WHERE {?hp a handphone:Kriteria}');

        foreach($query as $item){
            array_push($resultQuery, [
                'kriteria' =>$this->parseData($item->hp->getUri()) 
            ]);
        }

        return $resultQuery;
    }

    public function getBobot ($bobot)
    {
        $queryNilai = [];
        $jumlahData = count($bobot);
        for ($x = 0; $x < $jumlahData; $x++) {
            array_push($queryNilai, [
                // 'nilaiprosesor' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $resultdata[$x]['prosesor'] . '}.?hp handphone:nilai_Prosesor ?prosesor}')
                'nilaiprosesor' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $bobot[$x]['prosesor'].'}.?hp handphone:nilaiProsesor ?prosesor}'),
                'nilairam' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $bobot[$x]['ram'] . '}.?hp handphone:nilaiRAM ?ram}'),
                'nilaiukuranlayar' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $bobot[$x]['ukuranlayar'] . '}.?hp handphone:nilaiUkuranLayar ?ul}'),
                'nilaikb' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $bobot[$x]['kb'] . '}.?hp handphone:nilaiKameraBelakang ?kb}'),
                'nilaibaterai' => $bobot[$x]['nbaterai'],
                'nilaimemori' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $bobot[$x]['memori'] . '}.?hp handphone:nilaiMemori ?memori}'),
                'nilaikd' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $bobot[$x]['kd'] . '}.?hp handphone:nilaiKameraDepan ?kd}'),
                'nilaiso' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $bobot[$x]['so'] . '}.?hp handphone:nilaiSistemOperasi ?so}'),
                'nilaiharga' => $bobot[$x]['harga'],
                'nama' => $bobot[$x]['nama']
            ]);
        }
        $nilai = [];
        foreach ($queryNilai as $item) {
            array_push($nilai, [
                'Prosesor' => $this->parseData($item['nilaiprosesor'][0]->prosesor->getValue()),
                'RAM' => $this->parseData($item['nilairam'][0]->ram->getValue()),
                'Ukuran_Layar' => $this->parseData($item['nilaiukuranlayar'][0]->ul->getValue()),
                'Kamera_Belakang' => $this->parseData($item['nilaikb'][0]->kb->getValue()),
                'Baterai' => $item['nilaibaterai'],
                'Memori' => $this->parseData($item['nilaimemori'][0]->memori->getValue()),
                'Kamera_Depan' => $this->parseData($item['nilaikd'][0]->kd->getValue()),
                'Sistem_Operasi' => $this->parseData($item['nilaiso'][0]->so->getValue()),
                'Harga' => $item['nilaiharga'],
                'nama' => $item['nama']
            ]);
        }
        return $nilai;
    }

    public function getNormalisasi($data, $kriteria)
    {
        $jumlahData = count($data);

        //inisialisasi array masing-masing nilai
        for($i=0;$i<count($kriteria);$i++)
        {
            for($j=0;$j<$jumlahData;$j++)
            {
                $bobot[$kriteria[$i]['kriteria']][$j] = $data[$j][$kriteria[$i]['kriteria']];
            }
        }

        //menentukan maksimum dan minimum masing-masing nilai
        for ($i = 0; $i < count($kriteria); $i++)
        {
            if($kriteria[$i]['kriteria']=='Harga'){
                $maxMin[$kriteria[$i]['kriteria']] = min($bobot[$kriteria[$i]['kriteria']]);
            }
            else
            {
                $maxMin[$kriteria[$i]['kriteria']] = max($bobot[$kriteria[$i]['kriteria']]);
            }
        }
        
        //melakukan perhitungan minimum dan maksimum
        for ($i = 0 ; $i < count($kriteria) ; $i++)
        {
            for($j = 0 ; $j < $jumlahData ; $j++)
            {
                if ($kriteria[$i]['kriteria'] == 'Harga') 
                {
                    $normal[$j][$kriteria[$i]['kriteria']] = round($maxMin[$kriteria[$i]['kriteria']]/$bobot[$kriteria[$i]['kriteria']][$j],3);
                }
                else{
                    $normal[$j][$kriteria[$i]['kriteria']] = round($bobot[$kriteria[$i]['kriteria']][$j] / $maxMin[$kriteria[$i]['kriteria']],3);
                }
            }
        }
        for ($i = 0; $i < $jumlahData ; $i++){
            $normal[$i]['nama'] = $data[$i]['nama']; 
        }
        return $normal;
    }

    public function getHasil($data, $kriteria, $bobotUser)
    {
        for($i=0;$i<count($kriteria);$i++)
        {
            for($j=0;$j<count($data);$j++)
            {
                $hasilKali[$j][$kriteria[$i]['kriteria']] = $data[$j][$kriteria[$i]['kriteria']] * $bobotUser[$i][$kriteria[$i]['kriteria']];
            }
        }
        $tempTotal = 0 ;
        for($i=0 ; $i<count($data) ; $i++)
        {
            for($j=0; $j<count($kriteria) ; $j++)
            {
                $tempTotal = $tempTotal + $hasilKali[$i][$kriteria[$j]['kriteria']];
            }
            $total[$i]['total'] = $tempTotal; 
            $tempTotal = 0;
        }
        for ($i = 0; $i < count($data); $i++) {
            $total[$i]['nama'] = $data[$i]['nama'];
        }

        return $total;
    }

    public function getRanking($data)
    {
        
        $hasil = [];

        //melakukan sorting dengan menggunakan bubblesort
        for ($i = 0; $i < count($data); $i++) 
        {
            for ($j = 0; $j < count($data)-1; $j++) 
            {
                if($data[$j]['total'] < $data[$j+1]['total']){

                    $tempNilai = $data[$j]['total'];
                    $data[$j]['total'] = $data[$j+1]['total'];
                    $data[$j+1]['total'] = $tempNilai;

                    $tempNama = $data[$j]['nama'];
                    $data[$j]['nama'] = $data[$j + 1]['nama'];
                    $data[$j + 1]['nama'] = $tempNama;
                }
            }
        }

        return $data;
    }
    */
        
} 