@extends('layouts.main')

@section('content')
    <!-- title dan icon tambah -->
    <div class="d-flex align-items-center">
        <div class="h2 mb-2 text-gray-800 d-block">{{ $title }}</div>
        <div class="ml-auto p-2 bd-highlight d-block">
            <button data-toggle="modal" data-target="#modal-tambah-skema-operasi"
                class="btn btn-primary btn-lg mb-3 ml-auto d-block">
                <i class="fas fa-solid fa-plus mr-1"></i>
                <p class="d-inline">Tambah Data Skema Operasi</p>
            </button>
        </div>
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
                            <th>Waktu Operasi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Waktu Operasi</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @foreach ($kategori_operasi->skema_operasi as $ko)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ko->waktu_mulai }}-{{ $ko->waktu_selesai }}</td>
                                <td>
                                    <form action="/skema_operasi_hapus" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <input type="hidden" name="fungsi"
                                            value="ini adalah fungsi untuk menghapus skema operasi">
                                        <input type="hidden" name="kategori_operasi_id"
                                            value="{{ $kategori_operasi->id }}">
                                        <input type="hidden" name="kategori_operasi_slug"
                                            value="{{ $kategori_operasi->slug }}">
                                        <input type="hidden" name="skema_operasi_id" value="{{ $ko->id }}">
                                        <button class="btn btn-danger border-0"
                                            onclick="return confirm('Are You sure?')">hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kategori Operasi -->
    <div class="modal fade" id="modal-tambah-skema-operasi" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">
                        Form penambahan skema operasi
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/tambah_skema_operasi">
                    @csrf
                    <input type="hidden" name="kategori_operasi_id" value="{{ $kategori_operasi->id }}">
                    <input type="hidden" name="kategori_operasi_slug" value="{{ $kategori_operasi->slug }}">
                    <div class="modal-body">
                        <div class="row">
                            <label for="appt">Waktu mulai</label>
                            <input type="time" id="waktu_mulai" name="waktu_mulai" class="form-control">
                            @error('waktu_mulai')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row">
                            <label for="appt">Waktu selesai</label>
                            <input type="time" id="waktu_selesai" name="waktu_selesai" class="form-control">
                            @error('waktu_selesai')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Tambahkan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection




<!--
                                        <div class="row" class="mb-2">
                                            <div class="col">
                                                <p class="font-weight-bold">Mulai</p>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: -15px">
                                            <div class="col-5">
                                                <input type="number" class="form-control" placeholder="Jam" name="mulai_jam" min="0"
                                                    max="24">
                                            </div>
                                            <div class="col">
                                                <p class="text-center">:</p>
                                            </div>
                                            <div class="col-5">
                                                <input type="number" class="form-control" placeholder="Menit" name="mulai_menit"
                                                    min="0" max="60">
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col">
                                                <p class="font-weight-bold">Selesai</p>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: -15px">
                                            <div class="col-5">
                                                <input type="number" class="form-control" placeholder="Jam" name="selesai_jam"
                                                    min="0" max="24">
                                            </div>
                                            <div class="col-2">
                                                <p class="text-center">:</p>
                                            </div>
                                            <div class="col-5">
                                                <input type="number" class="form-control" placeholder="Menit" name="selesai_menit"
                                                    min="0" max="60">
                                            </div>
                                        </div>
                                    </div>
                                -->
