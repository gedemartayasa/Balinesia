@extends('layouts.layout')
@section('container')
    <form action="" method="GET" id="rekomendasi">
        <div class="row">
            <div class="col-lg-5 col-md-9 col-sm-9">
                <div class="input-group mb-3">
                    <label class="input-group-text">Budget Travelling</label>
                    <input type="text" class="form-control" name="budget">
                </div>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-3 mb-3">
                <input type="text" class="form-control" placeholder="Bobot"name="bobotBudget">
            </div>
            <div class="col-lg-5 col-md-9 col-sm-9">
                <div class="input-group mb-3">
                    <label class="input-group-text">Harga Sewa Wahana</label>
                    <select class="form-control" aria-label="Default select example" id="hargaWahana" name="hargaWahana">
                        <option value="">Pilihlah salah satu</option>
                        @foreach ($kriteria['listHargaSewa'] as $item)
                            <option value="{{ $item['value'] }}"><span>Rp. </span>{{ str_replace('Harga_Sewa_', ' ', $item['hargaSewa']) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-3 mb-3">
                <input type="text" class="form-control" placeholder="Bobot" name="bobotHargaWahana">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-md-9 col-sm-9">
                <div class="input-group mb-3">
                    <label class="input-group-text">Durasi Sewa Wahana</label>
                    <select class="form-control" aria-label="Default select example" id="durasiSewa" name="durasiSewa">
                        <option value="">Pilihlah salah satu</option>
                        @foreach ($kriteria['listDurasiSewa'] as $item)
                            <option value="{{ $item['value'] }}">{{ str_replace('_', ' ', $item['durasiSewa']) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-3 mb-3">
                <input type="text" class="form-control" name="bobotDurasiSewa" placeholder="Bobot">
            </div>
            <div class="col-lg-5 col-md-9 col-sm-9">
                <div class="input-group mb-3">
                    <label class="input-group-text">Popularitas Objek Wisata</label>
                    <select class="form-control" aria-label="Default select example" name="popularitas">
                        <option value="">Pilihlah salah satu</option>
                        @foreach ($kriteria['listPopularitas'] as $item)
                            <option value="{{ $item['value'] }}">
                                {{ str_replace('_', ' ', $item['popularitas']) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-3 mb-3">
                <input type="text" class="form-control text-align-center" name="bobotPopularitas" placeholder="Bobot">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-md-9 col-sm-9">
                <div class="input-group mb-3">
                    <label class="input-group-text">Kecepatan Akses Lokasi</label>
                    <select class="form-control" aria-label="Default select example" id="kecepatanAkses"
                        name="kecepatanAkses">
                        <option value="">Pilihlah salah satu</option>
                        @foreach ($kriteria['listKecepatanAkses'] as $item)
                            <option value="{{ $item['value'] }}">
                                {{ str_replace('_', ' ', $item['kecepatanAkses']) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-1 col-md-3 col-sm mb-3">
                <input type="text" class="form-control" placeholder="Bobot"name="bobotKecepatanAkses">
            </div>
        </div>
        <input type="submit" name="rekomendasi" value="Rekomendasi" class="btn btn-dark">
        <input type="submit" name="reset" value="Reset" class="btn btn-danger">
        @if ($data['jumlahData'] == 0 && $data['resp'] == 0)
            <div class="row">
                <div class="col-lg-5 col-md-9 mb-4 mt-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Hasil Pencarian</h6>
                        </div>
                        <div class="card-body">
                            <h4 class="small font-weight-bold">Belum terdapat pencarian data<span> </h4>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($data['resp'] == 1 && $data['jumlahData'] == 0)
            <div class="row">
                <div class="col-lg-6 mb-4 mt-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Hasil Pencarian</h6>
                        </div>
                        <div class="card-body">
                            <h4 class="small font-weight-bold">Tidak terdapat pencarian data<span> </h4>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-lg-6 mb-4 mt-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Proses SPARQL</h6>
                        </div>
                        <div class="card-body">
                            <h4 class="small">{{ $data['sql'] }}<span> </h4>
                        </div>
                    </div>
                </div>
            </div>
            <h6 class="mb-3">1. Tabel Destinasi Wisata</h6>
            <table class="table table-hover">
                <thead>
                    <tr style="background-color: #6c757d; color:white; text-center" class="">
                        <th scope="col">No</th>
                        <th scope="col">Nama Objek Wisata</th>
                        <th scope="col">Jenis Wisata</th>
                        <th scope="col">Banjar</th>
                        <th scope="col">Desa</th>
                        <th scope="col">Kecamatan</th>
                        <th scope="col">Kabupaten</th>
                        <th scope="col">Jam Buka</th>
                        <th scope="col">Harga Tiket Masuk</th>
                        <th scope="col">Harga Sewa Wahana</th>
                        <th scope="col">Kecepatan Akses</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['resultDetailWisata'] as $index => $item)
                        <tr class="table-{{ $index % 2 == 0 ? 'secondary' : 'light' }}">
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $item['nama'] }}</td>
                            <td>{{ $item['jenis'] ?: '-' }}</td>
                            <td>{{ $item['banjar'] }}</td>
                            <td>{{ $item['desa'] ?: '-' }}</td>
                            <td>{{ $item['kecamatan'] ?: '-' }}</td>
                            <td>{{ $item['kabupaten'] ?: '-' }}</td>
                            <td>{{ $item['jamBuka'] ?: '-' }}</td>
                            <td>{{ $item['tiketMasuk'] ?: '-' }}</td>
                            <td>{{ $item['hargaSewaWahana'] ?: '-' }}</td>
                            <td>{{ $item['kecepatanAkses'] ? $item['kecepatanAkses'] . ' Jam' : '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h6 class="mt-4 mb-3">2. Nilai Kriteria Destinasi Wisata</h6>
            <table class="table table-hover">
                <thead>
                    <tr style="background-color: #6c757d; color:white; text-center">
                        <th scope="col">No</th>
                        <th scope="col">Nama Objek Wisata</th>
                        <th scope="col">Harga Tiket Masuk</th>
                        <th scope="col">Harga Parkir Mobil</th>
                        <th scope="col">Harga Parkir Motor</th>
                        <th scope="col">Harga Sewa Wahana</th>
                        <th scope="col">Total Budget</th>
                        <th scope="col">Durasi Sewa Wahana</th>
                        <th scope="col">Kecepatan Akses</th>
                        <th scope="col">Popularitas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['resultBobot'] as $index => $item)
                        <tr class="table-{{ $index % 2 == 0 ? 'secondary' : 'light' }}">
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $item['nama'] }}</td>
                            <td>{{ $item['tiketMasuk'] ?: 0 }}</td>
                            <td>{{ $item['parkirMobil'] ?: 0 }}</td>
                            <td>{{ $item['parkirMotor'] ?: 0 }}</td>
                            <td>{{ $item['hargaSewaWahana'] ?: 0 }}</td>
                            <td>{{ $item['budget'] ?: 0 }}</td>
                            <td>{{ $item['durasiSewaWahana'] ?: 0 }}</td>
                            <td>{{ $item['kecepatanAkses'] ?: 0 }}</td>
                            <td>{{ $item['popularitas'] ?: 0 }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h6 class="mt-4 mb-3">3. Inputan Bobot Kriteria Destinasi Wisata</h6>
            <table class="table table-hover">
                <thead>
                    <tr style="background-color: #6c757d; color:white; text-center">
                        <th scope="col">No</th>
                        <th scope="col">Kriteria</th>
                        <th scope="col">Bobot</th>   
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $index = 1;
                    ?>
                    @foreach ($bobotUser as $idx => $bobot)
                        <tr class="table-{{ $index % 2 == 1 ? 'secondary' : 'light' }}">
                            <th scope="row">{{ $index ++ }}</th>
                            <td>{{ ucwords($idx) }}</td>
                            <td>{{ $bobot }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h6 class="mt-4 mb-3">4. Normalisasi</h6>
            <table class="table table-hover">
                <thead>
                    <tr style="background-color: #6c757d; color:white; text-center">
                        <th scope="col">No</th>
                        <th scope="col">Nama Objek Wisata</th>
                        <th scope="col">Harga Sewa Wahana</th>
                        <th scope="col">Total Budget</th>
                        <th scope="col">Durasi Sewa Wahana</th>
                        <th scope="col">Kecepatan Akses</th>
                        <th scope="col">Popularitas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['resultNormalisasi'] as $index => $item)
                        <tr class="table-{{ $index % 2 == 0 ? 'secondary' : 'light' }}">
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $item['nama'] }}</td>
                            <td>{{ $item['hargaSewaWahana'] ?: 0 }}</td>
                            <td>{{ $item['budget'] ?: 0 }}</td>
                            <td>{{ $item['durasiSewaWahana'] ?: 0 }}</td>
                            <td>{{ $item['kecepatanAkses'] ?: 0 }}</td>
                            <td>{{ $item['popularitas'] ?: 0 }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h6 class="mt-4 mb-3">5. Hasil Pembobotan</h6>
            <table class="table table-hover">
                <thead>
                    <tr style="background-color: #6c757d; color:white; text-center">
                        <th scope="col">No</th>
                        <th scope="col">Nama Objek Wisata</th>
                        <th scope="col">Bobot</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['resultRanking'] as $index => $item)
                        <tr class="table-{{ $index % 2 == 0 ? 'secondary' : 'light' }}">
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $item['nama'] }}</td>
                            <td>{{ $item['bobot'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h6 class="mt-4 mb-3">6. Ranking</h6>
            <table class="table table-hover">
                <thead>
                    <tr style="background-color: #6c757d; color:white; text-center">
                        <th scope="col">No</th>
                        <th scope="col">Nama Objek Wisata</th>
                        <th scope="col">Bobot</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['resultSAW'] as $index => $item)
                        <tr class="table-{{ $index % 2 == 0 ? 'secondary' : 'light' }}">
                            <th scope="row">{{ $index + 1 }}</th>
                            <td> <a style="text-decoration:none; color:black;"
                                href="/detail/{{str_replace(' ', '_', $item['nama']) }}">{{ $item['nama'] }}</a>
                            </td>
                            <td>{{ $item['bobot'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"
        integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
