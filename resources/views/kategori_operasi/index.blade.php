@extends('layouts.main')

@section('content')
    <!-- title dan icon tambah -->
    <div class="d-flex align-items-center">
        <div class="h2 mb-2 text-gray-800 d-block">{{ $title }}</div>
        <div class="ml-auto p-2 bd-highlight d-block">
            <button data-toggle="modal" data-target="#modal-tambah-kategori-operasi"
                class="btn btn-primary btn-lg mb-3 ml-auto d-block">
                <i class="fas fa-solid fa-plus mr-1"></i>
                <p class="d-inline">Tambah Data Kategori Operasi</p>
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

    @error('nama')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @enderror

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
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($kategori_operasi as $ko)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ko->nama }}</td>
                                <td>
                                    <a href="/kategori_operasi/{{ $ko->slug }}"
                                        class="btn btn-info text-decoration-none">detail scema</a>

                                    <button data-toggle="modal" data-target="#modal-edit-kategori-{{ $ko->slug }}"
                                        class="btn btn-warning">
                                        edit
                                    </button>

                                    <form action="/kategori_operasi/{{ $ko->slug }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
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
    <div class="modal fade" id="modal-tambah-kategori-operasi" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Form penambahan kategori operasi
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/kategori_operasi">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Masukkan Nama kategori"
                                    name="nama">
                            </div>
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

    <!-- Modal Edit Kategori Operasi -->
    @foreach ($kategori_operasi as $ko)
        <div class="modal fade" id="modal-edit-kategori-{{ $ko->slug }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Form Edit Kategori Operasi
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="/kategori_operasi/{{ $ko->slug }}">
                        @method('put')
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Masukkan Nama kategori"
                                        name="nama" value="{{ $ko->nama }}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
