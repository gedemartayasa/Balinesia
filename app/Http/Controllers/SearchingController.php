<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchingController extends Controller
{
    public function searching(Request $request)
    {
    /*
    $durasi = $this->sparql->query('SELECT * WHERE{?g a gender:Durasi}');
    $genre = $this->sparql->query('SELECT * WHERE{?g a gender:GenreFungsi}');
    $tempo = $this->sparql->query('SELECT * WHERE{?g a gender:Tempo}');
    $tingkatKesulitan = $this->sparql->query('SELECT * WHERE{?g a gender:TingkatKesulitan}');
    $pancaYadnya = $this->sparql->query('SELECT * WHERE{?g a gender:PancaYadnya}');
    $upacaraYadnya = $this->sparql->query('SELECT * WHERE{?g a gender:UpacaraYadnya}');
    $materialPembentuk = $this->sparql->query('SELECT * WHERE{?g a gender:MaterialPembentuk}');
    

    $rowDurasi = [];
    $rowGenre = [];
    $rowTempo = [];
    $rowTingkatKesulitan = [];
    $rowPancaYadnya = [];
    $rowUpacaraYadnya = [];
    $rowMaterialPembentuk = [];
    foreach($durasi as $item){
        array_push($rowDurasi,[
            'nama' => $this->parseData($item->g->getUri())
        ]);
    }
    foreach ($genre as $item) {
        array_push($rowGenre, [
            'nama' => $this->parseData($item->g->getUri())
        ]);
    }
    foreach ($tempo as $item) {
        array_push($rowTempo, [
            'nama' => $this->parseData($item->g->getUri())
        ]);
    }
    foreach ($tingkatKesulitan as $item) {
        array_push($rowTingkatKesulitan, [
            'nama' => $this->parseData($item->g->getUri())
        ]);
    }
    foreach ($pancaYadnya as $item) {
        array_push($rowPancaYadnya, [
            'nama' => $this->parseData($item->g->getUri())
        ]);
    }
    foreach ($upacaraYadnya as $item) {
        array_push($rowUpacaraYadnya, [
            'nama' => $this->parseData($item->g->getUri())
        ]);
    }
    foreach ($materialPembentuk as $item) {
        array_push($rowMaterialPembentuk, [
            'nama' => $this->parseData($item->g->getUri())
        ]);
    }

    if (isset($_GET['cariLaguGender'])) {
        $resp = 1;
        $sql = 'SELECT * WHERE {';
        $i = 0;
        if ($request->cariDurasi != '') {
            if ($i == 0) {
                $sql = $sql . '?g gender:memilikiDurasi gender:' . $request->cariDurasi;
                $i++;
            } else {
                $sql = $sql . '. ?g gender:memilikiDurasi gender:' . $request->cariDurasi;
            }
        } else {
            $sql = $sql;
        }
        if ($request->cariGenre != '') {
            if ($i == 0) {
                $sql = $sql . '?g gender:memilikiGenreFungsi gender:' . $request->cariGenre;
                $i++;
            } else {
                $sql = $sql . '. ?g gender:memilikiGenreFungsi gender:' . $request->cariGenre;
            }
        } else {
            $sql = $sql;
        }
        if ($request->cariTempo != '') {
            if ($i == 0) {
                $sql = $sql . '?g gender:memilikiTempo gender:' . $request->cariTempo;
                $i++;
            } else {
                $sql = $sql . '. ?g gender:memilikiTempo gender:' . $request->cariTempo;
            }
        } else {
            $sql = $sql;
        }
        if ($request->cariTingkatKesulitan != '') {
            if ($i == 0) {
                $sql = $sql . '?g gender:memilikiTingkatKesulitan gender:' . $request->cariTingkatKesulitan;
                $i++;
            } else {
                $sql = $sql . '. ?g gender:memilikiTingkatKesulitan gender:' . $request->cariTingkatKesulitan;
            }
        } else {
            $sql = $sql;
        }
        if ($request->cariPancaYadnya != '') {
            if ($i == 0) {
                $sql = $sql . '?g gender:adalahGendingYangBisaDigunakanPada gender:' . $request->cariPancaYadnya;
                $i++;
            } else {
                $sql = $sql . '. ?g gender:adalahGendingYangBisaDigunakanPada gender:' . $request->cariPancaYadnya;
            }
        } else {
            $sql = $sql;
        }
        if ($request->cariUpacaraAdat != '') {
            if ($i == 0) {
                $sql = $sql . '?g gender:adalahGendingYangDigunakanPadaAcara gender:' . $request->cariUpacaraAdat;
                $i++;
            } else {
                $sql = $sql . '. ?g gender:adalahGendingYangDigunakanPadaAcara gender:' . $request->cariUpacaraAdat;
            }
        } else {
            $sql = $sql;
        }
        $sql= $sql . '}';
        $query = $this->sparql->query($sql);
        $rowLagu = [];
        if($i=== 0){
            $rowLagu=[];
        }
        else{
        foreach ($query as $item) {
            array_push($rowLagu, [
                'nama' => $this->parseData($item->g->getUri())
            ]);
        }
        }
    }
    elseif(isset($_GET['cariKomponen'])) {
        $resp = 1;
        $sql = 'SELECT * WHERE {';
        $i = 0;
        if ($request->cariUpacaraAdat != '') {
            if ($i == 0) {
                $sql = $sql . '?g gender:memiliki gender:' . $request->cariUpacaraAdat;
                $i++;
            } else {
                $sql = $sql . '. ?g gender:adalahGendingYangDigunakanPadaAcara gender:' . $request->cariUpacaraAdat;
            }
        } else {
            $sql = $sql;
        }
    } 
    else{
        $sql = [];
        $resp = 0;
        $rowLagu=[];
    }
    

    $data = [
        'rowDurasi' => $rowDurasi,
        'rowGenre' => $rowGenre,
        'rowTempo' => $rowTempo,
        'rowTingkatKesulitan' => $rowTingkatKesulitan,
        'rowPancaYadnya' => $rowPancaYadnya,
        'rowUpacaraYadnya' => $rowUpacaraYadnya,
        'rowMaterialPembentuk' => $rowMaterialPembentuk,
        'rowLagu' => $rowLagu,
        'jumlahLagu' => count($rowLagu),
        'sql' => $sql,
        'resp' => $resp
    ];
    */
    return view('pencarian',[
        'title'=>'Fitur Pencarian',
        /*'data' => $data*/
    ]);
    }
}
