@extends('layouts.main')

@section('content')
    <div class="d-flex align-items-center">
        <div class="h2 mb-2 text-gray-800 d-block">{{ $title }}</div>
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
                            <th>Jadwal</th>
                            <th>Pelangan</th>
                            <th>Layanan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Jadwal</th>
                            <th>Pelangan</th>
                            <th>Layanan</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($reservasi_all as $r)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $r['waktu_mulai'] . '-' . $r['waktu_selesai'] }}</td>
                                <td>{{ $r['pelangan'] }}</td>
                                <td>{{ $r['layanan'] }}</td>
                                @if ($r['status'] == false)
                                    <td>kosong</td>
                                @else
                                    <td>dibooking</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
