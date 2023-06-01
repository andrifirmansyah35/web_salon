@extends('layouts.main')

@section('content')
    <!-- title dan icon tambah -->
    <div class="d-flex align-items-center">
        <div class="h2 mb-2 text-gray-800 d-block">{{ $title }}</div>
    </div>

    <div class="row">
        <div class="col">
            <p class="font-italic">*Cek data pesanan untuk melihat data daftar pesananan <a href="">Click Disini</a>
            </p>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
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

    @if (count($errors->all()) > 1)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $message)
                <p><strong>{{ $message }}</strong></p>
            @endforeach
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
                            <th>Waktu Mulai</th>
                            <th>Waktu Selesai</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Selesai</th>
                            <th>status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($operasi_all as $op)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $op->waktu_mulai }}</td>
                                <td>{{ $op->waktu_selesai }}</td>
                                <td>
                                    {{ $op->status }}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
