@extends('layouts.layout')
@section('container')

@foreach ($detail as $dtl)
<div class="card" style="color:black">
	<img src="{{ asset('img/image/'.$dtl['gambar'])}}" class="img-fluid rounded-start mt-3 px-3" style='width: 100%; max-height: 500px; object-fit: cover; 'alt="...">
	<div class="card-body">
		<div class="card-title mb-4" style="text-align: center;"><h3>{{ $dtl['nama']}}</h3></div>
        <div class="card" style="width: 100%;">
            <div class="card-header"> Detail Lokasi </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">{{ $dtl['nama']}} terletak di {{ str_replace('_',' ',$dtl['banjar'])}}, {{ str_replace('_',' ',$dtl['desa']) }}, {{ str_replace('_',' ',$dtl['kecamatan']) }}, {{ str_replace('_',' ',$dtl['kabupaten']) }}. </li>
            </ul>
            <div class="card-body">
                <a href="{{ $dtl['linkMAP'] }}" target="_blank" class="btn btn-primary" ><i class="	fas fa-map-marker-alt"></i> Lihat di Peta</a>
              </div>
	    </div><br>
        <div class="card" style="width: 100%;">
            <div class="card-header"> Ringkasan </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><i class='fas fa-clock' style="color: #183153"></i>&nbsp Buka {{ str_replace('Jam_',' ',$dtl['jamBuka']) }} WITA </li>
              <li class="list-group-item"><i class='fas fa-tags' style="color: #183153"></i> Harga Sewa Wahana Rp.{{ str_replace('Harga_Sewa_',' ',$dtl['hargasewa']) }} </li>
              <li class="list-group-item"><i class='fas fa-tags' style="color: #183153"></i> Harga Parkir Motor Rp. {{ str_replace('Harga_Parkir_',' ',$dtl['parkirMotor']) }}</li>
              <li class="list-group-item"><i class='fas fa-tags' style="color: #183153"></i> Harga Parkir Mobil Rp. {{ str_replace('Harga_Parkir_',' ',$dtl['parkirMobil']) }} </li>
              <li class="list-group-item"><i class='fas fa-tachometer-alt' style="color: #183153"></i> {{ str_replace('_',' ',$dtl['kecepatanAkses']) }} dari Bandar Udara Internasional Ngurah Rai </li>
              <li class="list-group-item"><span class='fa fa-star' style="color: orange"></span> {{ str_replace('_',' ',$dtl['popularitas']) }} </li>
            </ul>
	</div>
</div>
@endforeach
@endsection
