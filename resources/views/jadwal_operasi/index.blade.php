@extends('layouts.main')

@section('content')
    <!-- title dan icon tambah -->
    <div class="d-flex align-items-center">
        <div class="h2 mb-2 text-gray-800 d-block">{{ $title }}</div>
        <div class="ml-auto p-2 bd-highlight d-block">
            <button data-toggle="modal" data-target="#modal-tambah-jadwal-operasi"
                class="btn btn-primary btn-lg mb-3 ml-auto d-block">
                <i class="fas fa-solid fa-plus mr-1"></i>
                <p class="d-inline">Buat Jadwal Operasi</p>
            </button>
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

    @if (count($errors->all()) >= 1)
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
                            <th>Tanggal</th>
                            <th>Kategori Operasi</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kategori Operasi</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($jadwal_operasi_all as $jo)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $jo->tanggal }}</td>
                                <td>{{ $jo->kategori_operasi }}</td>
                                <td>
                                    <p class="btn text-{{ $jo->status ? 'success' : 'danger' }} font-weight-bold"
                                        data-toggle="modal" data-target="#modal-status-{{ $jo->tanggal }}">
                                        {{ $jo->status ? 'public' : 'ditutup' }}
                                    </p>
                                </td>

                                <td>

                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                        data-target="#modal-jadwal-ubah-{{ $jo->tanggal }}">
                                        ubah status
                                    </button>


                                    <a href="/jadwal_operasi_detail/{{ $jo->tanggal }}"
                                        class="btn btn-info border-0">detail</a>

                                    <form action="/jadwal_operasi_hapus/{{ $jo->tanggal }}" method="POST"
                                        class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger border-0"
                                            onclick="return confirm('Yakin Anda akan memnghapus?')"><span>hapus</span></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- 1. Modal Tambah Kategori Operasi -->
    <div class="modal fade" id="modal-tambah-jadwal-operasi" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Form Jadwal Operasi
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/jadwal_operasi">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="date" class="col-form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="date" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Kategori Operasi</label>
                            <select class="form-control" id="input_kategori" name="kategori_operasi_id" required>
                                @foreach ($kategori_operasi_all as $ko)
                                    <option value="{{ $ko->id }}">{{ $ko->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Tambahkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-2. Modal Jadwal Operasi ubah--->
        @foreach ($jadwal_operasi_all as $jo)
            <div class="modal fade" id="modal-jadwal-ubah-{{ $jo->tanggal }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                {{ $jo->status ? 'Menutup' : 'Mempublik' }} {{ $jo->nama }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{ $jo->status ? 'Klick untuk mempublik jadwal operasi ' : 'Klick untuk menutup jadwal operasi' }}
                            {{ $jo->tanggal }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <a href="/jadwal_operasi_status/{{ $jo->tanggal }}"
                                class="btn {{ $jo->status ? 'btn-warning' : 'btn-success' }}">{{ $jo->status ? 'non-aktifkan' : 'aktifkan' }}</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endsection
