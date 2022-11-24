<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardController extends Controller
{
    public function index()
    {
        /*$data=$this->showCardHandphone(1000);
        $totalData=count($data);
        $dataHandphone = $this->paginate($data)->withQueryString()->withPath('/dashboard');*/
        return view('dashboard', [
            "title" => 'Dashboard',
            "page" => "dashboard",
            /*"handphone" => $data,
            "dataHandphone" => $dataHandphone,
            "count" => $totalData*/
        ]);
    }

    public function landingPage()
    {
        /*$data = $this->showCardHandphone(8);
        $totalData = count($data);*/
        return view('main', [
            "title" => 'BALINESIA',
            "page" => "balinesia",
            /*"handphone" => $data,
            "count" => $totalData*/
        ]);
    }

    /*public function showCardHandphone($limit)
    {
        $handphone = $this->sparql->query('SELECT * WHERE{?hp a handphone:Handphone .?hp handphone:nilaiHarga ?harga .?hp handphone:memilikiGambar ?gambar}ORDER BY ?hp LIMIT '.$limit.'');
        $result = [];
        foreach ($handphone as $hp) {
            array_push($result, [
                'nama_handphone' => $this->parseData($hp->hp->getUri()),
                'harga' => $this->parseData($hp->harga->getValue()),
                'gambar' => $this->parseData($hp->gambar->getValue())
            ]);
        }
        return $result;
    }*/

    /*public function paginate($items, $perPage = 12, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator(
            $items->forPage($page, $perPage),
            $items->count(),
            $perPage,
            $page,
            $options
        );
    }*/
}
?>
