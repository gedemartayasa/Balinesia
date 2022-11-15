<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function landingPage()
    {
        return view('home', [
            "title" => 'BALINESIA',
            "page" => "balinesia",
        ]);
    }

    public function index()
    {  
        /*
        $lagu = $this->sparql->query('SELECT * WHERE{?g a gender:LaguGender. OPTIONAL{?g gender:memilikiSipnosis ?s}}');
        $rowLagu = [];
        $default = '...';
        foreach ($lagu as $dtl) {
            if (isset($dtl->s) === false) {
                $dtl->s = $default;
            }
        }
        foreach($lagu as $item){
            array_push($rowLagu,[
                'nama' => $this->parseData($item->g->getUri()),
                'sinopsis' => $this->parseData($item->s)
            ]);
        }
        $data = [
            'rowLagu' => $rowLagu
        ];
        */
        return view('dashboard',[
            'title' => 'Dashboard',
            /*'data' => $data,
            'count' => count($rowLagu)*/
        ]);
    }
}
