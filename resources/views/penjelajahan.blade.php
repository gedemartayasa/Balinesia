@extends('layouts.layout')
@section('container')
<form action="" method="GET" id="cari_spesifikasi">
    <div class="row">
        <div class="col-md-4">
            <div class="input-group mb-3">
                <label class="input-group-text">Kriteria</label>
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
{{-- @dd($data) --}}
{{-- @dd($data['resp'], $data['jumlahbrowse']) --}}
@if($data['resp']>=1 && $data['data']['penjelajahan'] == 'banjar') 
<div class="row">
    <div class="col-lg-12 mb-1 mt-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" id="headAplikasi">Banjar</h6>
            </div>
            <div class="card-body" id="bodyAplikasi">
                <div class="row">
                 @foreach ($data['data']['listAplikasi'] as $item)
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
                <h6 class="m-0 font-weight-bold text-primary" id="headAplikasi">Desa</h6>
            </div>
            <div class="card-body" id="bodyAplikasi">
                <div class="row">
                 @foreach ($data['data']['listAplikasi'] as $item)
                <div class="col-md-3 d-inline-block">
                <ul class="list-group list-group-flush">
                    <a href="/jelajah/{{'Aplikasi'}}/{{$item['aplikasi']}}" class="list-group-item list-group-item-action">{{ str_replace('_',' ',$item['aplikasi']) }}</li></a>
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
                <h6 class="m-0 font-weight-bold text-primary" id="headAplikasi">Kecamatan</h6>
            </div>
            <div class="card-body" id="bodyAplikasi">
                <div class="row">
                 @foreach ($data['data']['listAplikasi'] as $item)
                <div class="col-md-3 d-inline-block">
                <ul class="list-group list-group-flush">
                    <a href="/jelajah/{{'Aplikasi'}}/{{$item['aplikasi']}}" class="list-group-item list-group-item-action">{{ str_replace('_',' ',$item['aplikasi']) }}</li></a>
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
                <h6 class="m-0 font-weight-bold text-primary" id="headAplikasi">Kabupaten</h6>
            </div>
            <div class="card-body" id="bodyAplikasi">
                <div class="row">
                @foreach ($data['data']['listAplikasi'] as $item)
                <div class="col-md-3 d-inline-block">
                <ul class="list-group list-group-flush">
                    <a href="/jelajah/{{'Aplikasi'}}/{{$item['aplikasi']}}" class="list-group-item list-group-item-action">{{ str_replace('_',' ',$item['aplikasi']) }}</li></a>
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
        //Memori
        $('#bodyMemori').hide();
        $('#bodyMemori').slideDown('slow').delay(1500);
        $('#headMemori').click(function(){
            $('#bodyMemori').slideToggle();
        })

        //RAM
        $('#bodyRAM').hide();
        $('#bodyRAM').slideDown('slow').delay(1500);
        $('#headRAM').click(function(){
            $('#bodyRAM').slideToggle();
        })

        $('#bodyProsesor').hide();
        $('#bodyProsesor').slideDown('slow').delay(1500);
        $('#headProsesor').click(function(){
            $('#bodyProsesor').slideToggle();
        })

        $('#bodyKameraBelakang').hide();
        $('#bodyKameraBelakang').slideDown('slow').delay(1500);
        $('#headKameraBelakang').click(function(){
            $('#bodyKameraBelakang').slideToggle();
        })

        $('#bodyKameraDepan').hide();
        $('#bodyKameraDepan').slideDown('slow').delay(1500);
        $('#headKameraDepan').click(function(){
            $('#bodyKameraDepan').slideToggle();
        })

        $('#bodyUkuranLayar').hide();
        $('#bodyUkuranLayar').slideDown('slow').delay(1500);
        $('#headUkuranLayar').click(function(){
            $('#bodyUkuranLayar').slideToggle();
        })
        $('#bodySistemOperasi').hide();
        $('#bodySistemOperasi').slideDown('slow').delay(1500);
        $('#headSistemOperasi').click(function(){
            $('#bodySistemOperasi').slideToggle();
        })
        

        $('#bodyBaterai').hide();
        $('#bodyBaterai').slideDown('slow').delay(1500);
        $('#headBaterai').click(function(){
            $('#bodyBaterai').slideToggle();
        })

        $('#bodyMerek').hide();
        $('#bodyMerek').slideDown('slow').delay(1500);
        $('#headMerek').click(function(){
            $('#bodyMerek').slideToggle();
        })

        $('#bodyAplikasi').hide();
        $('#bodyAplikasi').slideDown('slow').delay(1500);
        $('#headAplikasi').click(function(){
            $('#bodyAplikasi').slideToggle();
        })
    })
</script>
@endsection