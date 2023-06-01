@extends('layouts.main')

@section('content')
    <!-- title dan icon tambah -->
    <div class="d-flex align-items-center">
        <div class="h2 mb-2 text-gray-800 d-block">{{ $title }}</div>
        <div class="ml-auto p-2 bd-highlight d-block">
            <a href="/kategori_layanan/create" class="btn btn-primary btn-lg mb-3 ml-auto d-block">
                <i class="fas fa-solid fa-plus mr-1"></i>
                <p class="d-inline">Tambah Data Kategori</p>
            </a>
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
                        @foreach ($kategori_layanan as $kl)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kl->nama }}</td>
                                <td>
                                    <a href="/kategori_layanan/{{ $kl->slug }}" class="btn btn-info">detail</a>
                                    <a href="/kategori_layanan/{{ $kl->slug }}/edit" class="btn btn-warning">edit</a>
                                    {{-- <form action="/kategori_layanan/{{ $kl->slug }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger border-0"
                                            onclick="return confirm('Are You sure?')">hapus</button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
