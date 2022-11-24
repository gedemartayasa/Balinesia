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
                        {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count }}</div> --}}
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
{{-- @foreach($dataHandphone as $hp)
    <div class="col-lg-3 col-md-6 col-sm-6 mb-2 justify-content-center">
        <div class="card">
            <img src="img/handphone/{{ $hp['gambar'] }}" class="card-img-top mx-auto d-block py-1" alt="..." style="width:200px; height:200px;">
            <div class="card-body">
                <h5 class="card-title">{{ str_replace('_',' ',$hp['nama_handphone'])  }}</h5>
                <?php //$nama_handphone = str_replace(' ','_',$hp['nama_handphone']) ?>
                <p class="card-text">Rp.{{  $hp['harga'] }}</p>
                <a href="/detail_handphone/{{$hp['nama_handphone']}}" class="btn btn-primary">Detail</a>
            </div>
        </div>
    </div>
@endforeach  --}}
<div class="mt-4 d-flex justify-content-center">
    {{--  @if ($dataHandphone->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            @if ($dataHandphone->onFirstPage())
                <li class="page-item">
                    <a class="page-link disabled" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $dataHandphone->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            @endif
            @for ($i=1;$i<=$dataHandphone->lastPage();$i++)
                @if ($dataHandphone->currentPage() == $i)
                    <li class="page-item active"><a class="page-link" href="{{ $dataHandphone->url($i) }}">{{ $i }}</a></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $dataHandphone->url($i) }}">{{ $i }}</a></li>    
                @endif
            @endfor
            
            @if ($dataHandphone->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $dataHandphone->nextPageUrl() }}" aria-label="Next">
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
@endif--}}
</div>
</div> 

@endsection
