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
        $data=$this->showCardWisata(1000);
        $totalData=count($data);
        $dataWisata = $this->paginate($data)->withQueryString()->withPath('/dashboard');
        return view('dashboard', [
            "title" => 'Dashboard',
            "page" => "dashboard",
            "wisata" => $data,
            "dataWisata" => $dataWisata,
            "count" => $totalData
        ]);
    }

    public function landingPage()
    {
        $data = $this->showCardWisata(8);
        $totalData = count($data);
        return view('main', [
            "title" => 'BALINESIA',
            "page" => "balinesia",
            "wisata" => $data,
            "count" => $totalData
        ]);
    }

    public function showCardWisata($limit)
    {
        $wisata = $this->sparql->query('SELECT * WHERE{?wisata wisata:memilikiGambar ?memilikiGambar. ?wisata wisata:HargaSewaWahana ?HargaSewaWahana } ORDER BY ?wisata LIMIT '.$limit.'');
        $result = [];
        foreach ($wisata as $hp) {
            array_push($result, [
                'nama' => $this->parseData($hp->wisata->getUri()),
                'harga' => $this->parseData($hp->HargaSewaWahana->getValue()),
                'gambar' => $this->parseData($hp->memilikiGambar->getValue())
            ]);
        }
        return $result;
    }

    public function paginate($items, $perPage = 9, $page = null, $options = [])
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
    }
}
?>
