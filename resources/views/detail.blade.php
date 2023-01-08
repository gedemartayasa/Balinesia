@extends('layouts.layout')
@section('container')

@foreach ($detail as $dtl)
<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4 mb-3">
        <img src="{{ asset('img/image/'.$dtl['gambar'])}}" class="img-fluid rounded-start mt-4 px-2 " alt="..."> 
        </div>
        <div class="col-md-7">
        <div class="card-body">
            <h3 class="card-title mb-4">{{ $dtl['nama']}}</h3>
            <h5 class="mb-3">Detail Wisata </h5>
            <p class="card-text">
                {{ str_replace('_',' ',$dtl['banjar'])}} 
            </p>
            <p class="card-text"> 
                {{ str_replace('_',' ',$dtl['desa']) }} 
            </p>
            <p class="card-text">  
                {{ str_replace('_',' ',$dtl['kecamatan']) }} 
            </p>
            <p class="card-text">
                {{ str_replace('_',' ',$dtl['kabupaten']) }} 
            </p>
            <p class="card-text">
                {{ $dtl['hargasewa']}}
            </p>
        </div>
        </div>
    </div>
</div>
@endforeach
@endsection
