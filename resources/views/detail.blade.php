@extends('layouts.layout')
@section('container')
<div class="card">
  <div class="card-body">
    <strong>Destinasi Wisata : </strong> {{-- {{ str_replace('_',' ',$data[0]['nama']) }} --}}
  </div>
</div>
    <ol class="list-group list-group-numbered">
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Lokasi Wisata</div>
      @foreach($data as $item)
          {{ str_replace('_',' ',$item['upacara']) }} ( {{ str_replace('_',' ',$item['yadnya']) }})
      @endforeach
      @php $count=count($data)@endphp
    </div>
    <span class="badge bg-primary rounded-pill">{{ $count }}</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Jam Buka</div>
      {{ $data[0]['fungsi'] }}
    </div>
    <span class="badge bg-primary rounded-pill">14</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Harga Tiket Masuk</div>
      {{ $data[0]['tingkat'] }}
    </div>
    <span class="badge bg-primary rounded-pill">14</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Harga Sewa Wahana</div>
      {{ $data[0]['durasi'] }}
    </div>
    <span class="badge bg-primary rounded-pill">14</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Harga Parkir Motor</div>
      {{ $data[0]['tempo'] }}
    </div>
    <span class="badge bg-primary rounded-pill">14</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Harga Parkir Mobil</div>
      {{ $data[0]['tempo'] }}
    </div>
    <span class="badge bg-primary rounded-pill">14</span>
  </li>
</ol>
@endsection