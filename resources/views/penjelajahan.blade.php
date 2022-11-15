@extends('layouts.layout')
@section('container')
<form action="" method="GET" id="cari_spesifikasi">
    <div class="row">
        <div class="col-md-4">
            <div class="input-group mb-3">
                <label class="input-group-text">Lokasi Wisata</label>
                <select class="form-select" aria-label="Default select example" id="browse" name="browse">
                    <option value="">Pilihlah salah satu</option>
                        <option value="banjar">Banjar</option>
                        <option value="desa">Desa</option>
                        <option value="kecamatan">Kecamatan</option>
                        <option value="kabupaten">Kabupaten</option>
                </select>
            </div>
        </div>
    </div>
    <input type="submit" name="browsing" value="Jelajah" class="btn btn-dark" id="submit">
    <input type="submit" name="reset" value="Reset" class="btn btn-danger">
</form>
{{-- @if($data['resp']>=1 && $data['data']['penjelajahan'] == 'banjar') --}}
<div class="row">
    <div class="col-lg-12 mb-1 mt-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" id="headBanjar">Banjar</h6>
            </div>
            <div class="card-body" id="bodyBanjar">
                <div class="row">
                {{-- 
                @foreach ($data['data']['resultLagu'] as $item) 
                <div class="col-md-3 d-inline-block">
                <ul class="list-group list-group-flush">
                    <a href="/jelajah/{{'Aplikasi'}}/{{$item['nama']}}" class="list-group-item list-group-item-action">{{ str_replace('_',' ',$item['nama']) }}</li></a>
                </ul>
                </div>
                @endforeach
                --}}
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @elseif($data['resp']>=1 && $data['data']['penjelajahan'] == 'desa') --}}
<div class="row">
    <div class="col-lg-12 mb-1 mt-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" id="headDesa">Desa</h6>
            </div>
            <div class="card-body" id="bodyDesa">
                <div class="row">
                {{-- 
                @foreach ($data['data']['resultJenis'] as $item)
                <div class="col-md-3 d-inline-block">
                <ul class="list-group list-group-flush">
                    <a href="/jelajah/{{'Aplikasi'}}/{{$item['nama']}}" class="list-group-item list-group-item-action">{{ str_replace('_',' ',$item['nama']) }}</li></a>
                </ul>
                </div>
                @endforeach
                --}}
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @elseif($data['resp']>=1 && $data['data']['penjelajahan'] == 'kecamatan') --}}
<div class="row">
    <div class="col-lg-12 mb-1 mt-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" id="headKecamatan">Kecamatan</h6>
            </div>
            <div class="card-body" id="bodyKecamatan">
                <div class="row">
                {{-- 
                @foreach ($data['data']['resultKomponenPembentuk'] as $item)
                <div class="col-md-3 d-inline-block">
                <ul class="list-group list-group-flush">
                    <a href="/jelajah/{{ 'Merek' }}/{{$item['nama']}}" class="list-group-item list-group-item-action">{{ str_replace('_',' ',$item['nama']) }}</li></a>
                </ul>
                </div>
                @endforeach 
                --}}
                </div>  
            </div>
        </div>
    </div>
</div>
{{-- @elseif($data['resp']>=1 && $data['data']['penjelajahan'] == 'kabupaten') --}}
<div class="row">
    <div class="col-lg-12 mb-1 mt-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" id="headKabupaten">Kabupaten</h6>
            </div>
            <div class="card-body" id="bodyKabupaten">
                <div class="row">
                {{-- 
                @foreach ($data['data']['resultUpacaraYadnya'] as $item)
                <div class="col-md-3 d-inline-block">
                <ul class="list-group list-group-flush">
                    <a href="/jelajah/{{ 'Merek' }}/{{$item['nama']}}" class="list-group-item list-group-item-action">{{ str_replace('_',' ',$item['nama']) }}</li></a>
                </ul>
                </div>
                @endforeach 
                 --}}
                </div>  
            </div>
        </div>
    </div>
</div>

{{-- @endif --}}
@endsection