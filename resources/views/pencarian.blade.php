@extends('layouts.layout')
@section('container')
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Kriteria</button>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
      <p class="mt-2 font-weight-bold">Pencarian berdasarkan Kriteria</p>
      <form action="" method="GET" id="cariGender">
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group mb-3" >
                        <label class="input-group-text">Jenis Wisata</label>
                        <select class="form-control" aria-label="Default select example" id="cariJenis" name="cariJenis">
                            <option value="">Pilihlah salah satu</option>
                            @foreach($data['listJenisWisata'] as $item)
                                <option value="{{ $item['jenis'] }}">{{ str_replace('_',' ',$item['jenis'])}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group mb-3" >
                        <label class="input-group-text">Lokasi</label>
                        <select class="form-control" aria-label="Default select example" id="cariLokasi" name="cariLokasi">
                            <option value="">Pilihlah salah satu</option>
                            @foreach($data['listLokasi'] as $item)
                                <option value="{{ $item['lokasi'] }}">{{ str_replace('_',' ',$item['lokasi']) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group mb-3" >
                        <label class="input-group-text">Jam Buka</label>
                        <select class="form-control" aria-label="Default select example" id="cariJamBuka" name="cariJamBuka">
                            <option value="">Pilihlah salah satu</option>
                            @foreach($data['listJamBuka'] as $item)
                                <option value="{{ $item['jamBuka'] }}">{{ str_replace('_',' ',$item['jamBuka']) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>          
            </div>
            <div class="row">
                <div class="col-md-4">   
                    <div class="input-group mb-3">
                        <label class="input-group-text">Harga Tiket Masuk</label>
                        <select class="form-control" aria-label="Default select example"id="cariHargaTiket" name="cariHargaTiket">
                            <option value="">Pilihlah salah satu</option>
                            @foreach($data['listHargaTiket'] as $item)
                                <option value="{{ $item['hargaTiket'] }}"><span>Rp. </span>{{ str_replace('Harga_Tiket_',' ',$item['hargaTiket'])}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> 
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <label class="input-group-text">Harga Sewa Wahana</label>
                        <select class="form-control" aria-label="Default select example"id="cariHargaSewa" name="cariHargaSewa">
                            <option value="">Pilihlah salah satu</option>
                            @foreach($data['listHargaSewa'] as $item)
                                <option value="{{ $item['hargaSewa'] }}"><span>Rp. </span>{{ str_replace('Harga_Sewa_',' ',$item['hargaSewa'])}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <label class="input-group-text">Harga Parkir Motor</label>
                        <select class="form-control" aria-label="Default select example" id="cariHargaParkirMotor" name="cariHargaParkirMotor">
                            <option value="">Pilihlah salah satu</option>
                            @foreach($data['listHargaParkirMotor'] as $item)
                                <option value="{{ $item['hargaParkirMotor'] }}"><span>Rp. </span>{{ str_replace('Harga_Parkir_',' ',$item['hargaParkirMotor']) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <label class="input-group-text">Harga Parkir Mobil</label>
                        <select class="form-control" aria-label="Default select example" id="cariHargaParkirMobil" name="cariHargaParkirMobil">
                            <option value="">Pilihlah salah satu</option>
                            @foreach($data['listHargaParkirMobil'] as $item)
                            <option value="{{ $item['hargaParkirMobil'] }}"><span>Rp. </span>{{ str_replace('Harga_Parkir_',' ',$item['hargaParkirMobil']) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <label class="input-group-text">Budget Travelling</label>
                        <input type="text" class="form-control" id="cariHarga" name="cariHarga">
                    </div>
                </div>
            </div>
            <input type="submit" name="cariWisata" value="Cari" class="btn btn-dark">
            <input type="submit" name="reset" value="Reset" class="btn btn-danger">
        </form>
        <div class="row">
        <div class="col-lg-6 mb-4 mt-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Hasil Pencarian</h6>
                </div>
                <div class="card-body">   
                    @if($data['resp'] == 0)
                        <h4 class="small font-weight-bold">Belum terdapat pencarian data<span> </h4>
                    @elseif($data['resp'] == 1 && $data['jumlahWisata'] == 0)
                        <h4 class="small font-weight-bold">Data tidak ditemukan<span></h4>
                    @else
                        @foreach ($data['searching1'] as $item)
                        <ul class="list-group list-group-flush">
                            <a href="/detail/{{$item['nama']}}" class="list-group-item list-group-item-action">{{ str_replace('_',' ',$item['nama']) }}</li></a>
                        </ul>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        @if($data['resp']==1 && $data['jumlahWisata']>=1)
        <div class="col-lg-6 mb-4 mt-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Proses SPARQL</h6>
                </div>
                <div class="card-body">
                    <h4 class="small">{{ $data['sql'] }}</h4>
                </div>
            </div>
        </div>
        @endif
    </div>
    </div>
</div>
@endsection

