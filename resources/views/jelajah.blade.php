@extends('layouts.layout')
@section('container')
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center px-3">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Data)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['count']}}</div> 
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="row">
        <div class="col-lg-6 mb-4 mt-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Proses SPARQL</h6>
                </div>
                <div class="card-body">
                     <h4 class="small">{{ $data['sql'] }}<span> </h4> 
                </div>
            </div>
        </div>
    </div>
@foreach($data['listWisata'] as $wisata)
    <div class="col-lg-3 col-md-6 col-sm-6 mb-2 justify-content-center">
        <div class="card">
            <img src="{{ asset('img/'.$wisata['gambar'])}}" class="card-img-top" alt="..." style="width:248,1px; height:200px; margin: auto;">
            <div class="card-body">
                <h5 class="card-title">{{ str_replace('_',' ',$wisata['nama'])  }}</h5>
                <?php $nama_wisata = str_replace(' ','_',$wisata['nama']) ?>
                <p class="card-text">{{  $wisata['harga'] }}</p>
                <a href="/detail/{{$wisata['nama']}}" class="btn btn-primary">Detail</a>
            </div>
        </div>
    </div>
@endforeach 
</div>
@endsection