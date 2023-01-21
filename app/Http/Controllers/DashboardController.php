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
        $wisata = $this->sparql->query('SELECT * WHERE{?wisata wisata:memilikiGambar ?memilikiGambar. 
        ?wisata wisata:HargaSewaWahana ?HargaSewaWahana .
        ?wisata wisata:isLocatedAt ?banjar .
        ?banjar wisata:isPartOf ?desa .
        ?desa wisata:isPartOf ?kecamatan .
        ?kecamatan wisata:isPartOf ?kabupaten . } ORDER BY ?wisata LIMIT '.$limit.'');
        $result = [];
        foreach ($wisata as $data) {
            array_push($result, [
                'nama' => $this->parseData($data->wisata->getUri()),
                //'harga' => $this->parseData($data->HargaSewaWahana->getValue()),
                'gambar' => $this->parseData($data->memilikiGambar->getValue()),
                'kecamatan' => $this->parseData($data->kecamatan->getUri()),
                'kabupaten' => $this->parseData($data->kabupaten->getUri()),
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
