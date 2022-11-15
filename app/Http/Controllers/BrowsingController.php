<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrowsingController extends Controller
{
    public function browsing(Request $request){
        /*
        $resp = 0;
        if (isset($_GET['browsing'])) {
            $resp++;
            if ($request->browse == 'laguGender') {
                $lagu = $this->sparql->query('SELECT * WHERE {?g a gender:LaguGender}');
                $resultLagu = [];
                foreach ($lagu as $item) {
                    array_push($resultLagu, [
                        'nama' => $this->parseData($item->g->getUri())
                    ]);
                }
                $data = [
                    'resultLagu' => $resultLagu,
                    'penjelajahan' => 'laguGender'
                ];
            }
            else if($request->browse == 'jenis'){
                $lagu = $this->sparql->query('SELECT * WHERE {?g a gender:Jenis}');
                $resultLagu = [];
                foreach ($lagu as $item) {
                    array_push($resultLagu, [
                        'nama' => $this->parseData($item->g->getUri())
                    ]);
                }
                $data = [
                    'resultJenis' => $resultLagu,
                    'penjelajahan' => 'jenis'
                ];
            } 
            else if ($request->browse == 'komponenPembentuk') {
                $lagu = $this->sparql->query('SELECT * WHERE {?g a gender:KomponenPembentuk}');
                $resultLagu = [];
                foreach ($lagu as $item) {
                    array_push($resultLagu, [
                        'nama' => $this->parseData($item->g->getUri())
                    ]);
                }
                $data = [
                    'resultKomponenPembentuk' => $resultLagu,
                    'penjelajahan' => 'komponenPembentuk'
                ];
            } 
            else if ($request->browse == 'teknikPermainan') {
                $lagu = $this->sparql->query('SELECT * WHERE {?g a gender:TeknikPermainan}');
                $resultLagu = [];
                foreach ($lagu as $item) {
                    array_push($resultLagu, [
                        'nama' => $this->parseData($item->g->getUri())
                    ]);
                }
                $data = [
                    'resultTeknikPermainan' => $resultLagu,
                    'penjelajahan' => 'teknikPermainan'
                ];
            } 
            else if ($request->browse == 'pancaYadnya') {
                $lagu = $this->sparql->query('SELECT * WHERE {?g a gender:PancaYadnya}');
                $resultLagu = [];
                foreach ($lagu as $item) {
                    array_push($resultLagu, [
                        'nama' => $this->parseData($item->g->getUri())
                    ]);
                }
                $data = [
                    'resultPancaYadnya' => $resultLagu,
                    'penjelajahan' => 'pancaYadnya'
                ];
            } 
            else if ($request->browse == 'upacaraYadnya') {
                $lagu = $this->sparql->query('SELECT * WHERE {?g a gender:UpacaraYadnya}');
                $resultLagu = [];
                foreach ($lagu as $item) {
                    array_push($resultLagu, [
                        'nama' => $this->parseData($item->g->getUri())
                    ]);
                }
                $data = [
                    'resultUpacaraYadnya' => $resultLagu,
                    'penjelajahan' => 'upacaraYadnya'
                ];
            } 
            else {
                $resp = 0;
                $data = [];
                echo "<script type='text/javascript'>alert('Silahkan masukan pilihan anda!');</script>";
            }
        }
        else{
            $resp =0;
            $data=[];
        }
        $data = [
            'resp' => $resp,
            // 'jumlahbrowse' => $jumlahbrowse,
            'data' => $data
        ];
        */
        return view('penjelajahan',[
            'title' => 'Fitur Penjelajahan',
            //'data' => $data*
        ]);
    }
}
