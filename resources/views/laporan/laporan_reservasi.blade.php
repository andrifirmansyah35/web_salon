@extends('layouts.main')

@section('content')
    <div class="d-flex">
        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>

        @if ($laporan_reservasi != null)
            <div class="ml-auto p-2 bd-highlight">
                <a href="/print_laporan_reservasi" class="btn btn-danger btn-lg mb-3 ml-auto" target="_blank">
                    <i class="fas fa-solid fa-print mr-1"></i>
                    <p class="d-inline">Print Laporan reservasi</p>
                </a>
            </div>
        @endif
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success text-center" role="alert">
            {{ session('success') }}
        </div>
    @endif


    @if (session()->has('fail'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('fail') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Setting Jarak Waktu</h6>
        </div>
        <div class="card-body">
            <form method="post" action="/reservasi_laporan_set_waktu" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <label>Tanggal Awal</label>
                        <input type="date" class="form-control"
                            value="{{ session()->get('laporan_reservasi_tanggal_awal') }}" placeholder="Tanggal Awal"
                            name="tanggal_awal" required>
                    </div>
                    <div class="col">
                        <label>Tanggal Akhir</label>
                        <input type="date" class="form-control"
                            value="{{ session()->get('laporan_reservasi_tanggal_akhir') }}" placeholder="Tanggal lama"
                            name="tanggal_akhir" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <label class="ml-2">Status Laporan</label>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="laporan_status" id="inlineRadio1"
                                value="reservasi selesai" {{ session()->has('laporan_status') ? '' : 'checked' }}
                                {{ session()->get('laporan_status') == 'reservasi selesai' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="inlineRadio1">reservasi selesai</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="laporan_status" id="inlineRadio2"
                                value="reservasi tidak datang"
                                {{ session()->get('laporan_status') == 'reservasi tidak datang' ? 'checked' : '' }}
                                required>
                            <label class="form-check-label" for="inlineRadio2">reservasi tidak datang</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="laporan_status" id="inlineRadio3"
                                value="semua" {{ session()->get('laporan_status') == 'semua' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="inlineRadio3">semua</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <button type="submit" class="btn btn-primary form-control">Terapkan</button>
                </div>
            </form>

        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            {{-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>

                        <tr>
                            <th>No</th>
                            <th>Tanggal dan Operasional</th>
                            <th>Member</th>
                            <th>layanan</th>
                            <th>Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Tanggal dan Operasional</th>
                            <th>Member</th>
                            <th>layanan</th>
                            <th>Harga</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($laporan_reservasi as $reservasi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $reservasi['jadwal_operasi_tanggal'] }}</td>
                                <td>{{ $reservasi['user_member_nama'] }}</td>
                                <td>{{ $reservasi['layanan_nama'] }}</td>
                                <td>{{ 'Rp ' . number_format($reservasi['harga'], 2, ',', '.') }}</td>
                                <td>{{ $reservasi['status'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!-2. Modal Jadwal Operasi ubah--->
    @endsection
