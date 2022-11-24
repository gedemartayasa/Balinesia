@extends('layouts.layout')
@section('container')

@foreach ($detail as $dtl)
<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4 mb-3">
        {{-- <img src="{{ asset('img/handphone/'.$dtl['gambar'])}}" class="img-fluid rounded-start mt-3 px-2" alt="..."> --}}
        </div>
        <div class="col-md-7">
        <div class="card-body">
            <h3 class="card-title mb-4">{{ $dtl['nama']}}</h3>
            <h5 class="mb-3">Spesification :</h5>
            <p class="card-text">
                <span>RAM :</span>
                {{ str_replace('RAM_','',$dtl['ram'])}} GB
            </p>
            <p class="card-text">
                <span>Baterai :</span>
                {{ str_replace('Baterai_','',$dtl['baterai']) }} mAh
            </p>
            <p class="card-text">
                <span>Memori :</span>
                {{ str_replace('Memori_','',$dtl['memori']) }} GB
            </p>
            <p class="card-text">
                <span>Prosesor :</span>
                {{ str_replace('Prosesor_','',$dtl['prosesor']) }} 
            </p>
            <p class="card-text">
                <span>Sistem Operasi :</span>
                {{ str_replace('SO_','',$dtl['sistemoperasi'])}} 
            </p>
            <p class="card-text">
                <span>Kamera Depan :</span>
                {{ str_replace('KD_','',$dtl['kameradepan'])}} MP 
            </p>
            <p class="card-text">
                <span>Kamera Belakang :</span>
                {{ str_replace('KB_','',$dtl['kamerabelakang'])}} MP
            </p>
            <p class="card-text">
                <span>Ukuran Layar :</span>
                {{ str_replace('UkuranLayar_','',$dtl['ukuranlayar'])}} inci
            </p>
            <p class="card-text">
                <span>Harga :</span>
                Rp.{{ $dtl['harga']}}
            </p>
        </div>
        </div>
    </div>
</div>
@endforeach
@endsection
