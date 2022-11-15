<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index($namaDestinasi)
    {
        /*
        $detail = $this->sparql->query('SELECT * WHERE {VALUES ?g {gender:'.$namaGender. '}.
            OPTIONAL {?g gender:memilikiTempo ?tempo}.
            OPTIONAL {?g gender:memilikiTingkatKesulitan ?tingkat}.
            OPTIONAL {?g gender:adalahGendingYangDigunakanPadaAcara ?upacara}.
            OPTIONAL {?upacara gender:dimilikiPancaYadnya ?yadnya}.
            OPTIONAL {?g gender:memilikiDurasi ?durasi}.
            OPTIONAL {?g gender:memilikiGenreFungsi ?fungsi}
        }');
        $default = 'http://www.semanticweb.org/asusbali/ontologies/2021/9/untitled-ontology-22#-';
        foreach ($detail as $dtl) {
            if (isset($dtl->tempo) === false) {
                $dtl->tempo = $default;
            }
            if (isset($dtl->yadnya) === false) {
                $dtl->yadnya = $default;
            }
            if (isset($dtl->tingkat) === false) {
                $dtl->tingkat = $default;
            }
            if (isset($dtl->upacara) === false) {
                $dtl->upacara = $default;
            }
            if (isset($dtl->durasi) === false) {
                $dtl->durasi = $default;
            }
            if (isset($dtl->fungsi) === false) {
                $dtl->fungsi = $default;
            }
        }
        $rowDetailLagu = [];
        foreach($detail as $item){
            array_push($rowDetailLagu,[
                'nama'=>$this->parseData($item->g->getUri()),
                'tempo' => $this->parseData($item->tempo->getUri()),
                'yadnya' => $this->parseData($item->yadnya->getUri()),
                'tingkat' => $this->parseData($item->tingkat->getUri()),
                'upacara' => $this->parseData($item->upacara->getUri()),
                'durasi' => $this->parseData($item->durasi->getUri()),
                'fungsi' => $this->parseData($item->fungsi->getUri()),
            ]);
        }
        */
        return view('detail', [
            'title' => 'Detail Lagu Gender',
            /*'data' => $rowDetailLagu*/
        ]);
    }
}
