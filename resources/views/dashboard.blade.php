@extends('layouts.layout')
@section('container')
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center px-3">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Jumlah Destinasi </div>
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
    {{--  
    @foreach($data['rowLagu'] as $item)
    <div class="col-md-3 mb-3">
        <div class="card detail" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{ $item['nama'] }}</h5>
                <p class="card-text">{{ substr($item['sinopsis'],0,50) }}...</p>
                <a href="/detail-gender/{{ $item['nama'] }}" class="btn btn-dark">Detail</a>
            </div>
        </div>
    </div>
    @endforeach
    --}}
</div>
@endsection