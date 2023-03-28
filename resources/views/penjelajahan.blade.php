@extends('layouts.layout')
@section('container')
<form action="" method="GET" id="cari_spesifikasi">
    <div class="row">
        <div class="col-md-4">
            <div class="input-group mb-3">
                <label class="input-group-text">Kriteria</label>
                <select class="form-control" aria-label="Default select example" id="browse" name="browse">
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
{{-- @dd($data) --}}
{{-- @dd($data['resp'], $data['jumlahbrowse']) --}}
@if($data['resp']>=1 && $data['data']['penjelajahan'] == 'banjar') 
<div class="row">
    <div class="col-lg-12 mb-1 mt-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" id="headBanjar">Banjar</h6>
            </div>
            <div class="card-body" id="bodyBanjar">
                <div class="row">
                 @foreach ($data['data']['listBanjar'] as $item)
                <div class="col-md-3 d-inline-block">
                <ul class="list-group list-group-flush">
                    <a href="/jelajah/{{'Banjar'}}/{{$item['banjar']}}" class="list-group-item list-group-item-action">{{ str_replace('_',' ',$item['banjar']) }}</li></a>
                </ul>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@elseif($data['resp']>=1 && $data['data']['penjelajahan'] == 'desa')  
<div class="row">
    <div class="col-lg-12 mb-1 mt-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" id="headDesa">Desa</h6>
            </div>
            <div class="card-body" id="bodyDesa">
                <div class="row">
                 @foreach ($data['data']['listDesa'] as $item)
                <div class="col-md-3 d-inline-block">
                <ul class="list-group list-group-flush">
                    <a href="/jelajah/{{'Desa'}}/{{$item['desa']}}" class="list-group-item list-group-item-action">{{ str_replace('_',' ',$item['desa']) }}</li></a>
                </ul>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@elseif($data['resp']>=1 && $data['data']['penjelajahan'] == 'kecamatan')  
<div class="row">
    <div class="col-lg-12 mb-1 mt-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" id="headKecamatan">Kecamatan</h6>
            </div>
            <div class="card-body" id="bodyKecamatan">
                <div class="row">
                 @foreach ($data['data']['listKecamatan'] as $item)
                <div class="col-md-3 d-inline-block">
                <ul class="list-group list-group-flush">
                    <a href="/jelajah/{{'Kecamatan'}}/{{$item['kecamatan']}}" class="list-group-item list-group-item-action">{{ str_replace('_',' ',$item['kecamatan']) }}</li></a>
                </ul>
                </div>
                @endforeach  
                </div>
            </div>
        </div>
    </div>
</div>
@elseif($data['resp']>=1 && $data['data']['penjelajahan'] == 'kabupaten') 
<div class="row">
    <div class="col-lg-12 mb-1 mt-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" id="headKabupaten">Kabupaten</h6>
            </div>
            <div class="card-body" id="bodyKabupaten">
                <div class="row">
                @foreach ($data['data']['listKabupaten'] as $item)
                <div class="col-md-3 d-inline-block">
                <ul class="list-group list-group-flush">
                    <a href="/jelajah/{{'Kabupaten'}}/{{$item['kabupaten']}}" class="list-group-item list-group-item-action">{{ str_replace('_',' ',$item['kabupaten']) }}</li></a>
                </ul>
                </div>
                @endforeach              
                </div>
            </div>
        </div>
    </div>
</div>
@endif 

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        //Banjar
        $('#bodyBanjar').hide();
        $('#bodyBanjar').slideDown('slow').delay(1500);
        $('#headBanjar').click(function(){
            $('#bodyBanjar').slideToggle();
        })

        //Desa
        $('#bodyDesa').hide();
        $('#bodyDesa').slideDown('slow').delay(1500);
        $('#headDesa').click(function(){
            $('#bodyDesa').slideToggle();
        })

        //Kecamatan
        $('#bodyKecamatan').hide();
        $('#bodyKecamatan').slideDown('slow').delay(1500);
        $('#headKecamatan').click(function(){
            $('#bodyKecamatan').slideToggle();
        })

        //Kabupaten
        $('#bodyKabupaten').hide();
        $('#bodyKabupaten').slideDown('slow').delay(1500);
        $('#headKabupaten').click(function(){
            $('#bodyKabupaten').slideToggle();
        })   
        
    })
</script>
@endsection