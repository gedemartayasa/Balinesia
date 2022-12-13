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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count }}</div>
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
@foreach($dataWisata as $wisata)
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
<div class="mt-4 d-flex justify-content-center">
    @if ($dataWisata->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            @if ($dataWisata->onFirstPage())
                <li class="page-item">
                    <a class="page-link disabled" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $dataWisata->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            @endif
            @for ($i=1;$i<=$dataWisata->lastPage();$i++)
                @if ($dataWisata->currentPage() == $i)
                    <li class="page-item active"><a class="page-link" href="{{ $dataWisata->url($i) }}">{{ $i }}</a></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $dataWisata->url($i) }}">{{ $i }}</a></li>    
                @endif
            @endfor
            
            @if ($dataWisata->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $dataWisata->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
            @else
                <li class="page-item">
                    <a class="page-link disabled" aria-label="Previous">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
</div>
</div> 

@endsection
