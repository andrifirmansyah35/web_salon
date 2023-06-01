@extends('layouts.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-flex">
        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
        <div class="ml-auto p-2 bd-highlight">
            <a href="/layanan/create" class="btn btn-primary btn-lg mb-3 ml-auto d-block">
                <i class="fas fa-solid fa-plus mr-1"></i>
                <p class="d-inline">Tambah Data Layanan</p>
            </a>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success text-center" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($layanan as $lyn)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $lyn->nama }}</td>
                                <td>{{ $lyn->kategori_layanan->nama }}</td>
                                <td>{{ $lyn->harga }}</td>
                                <td>
                                    <p class="font-weight-bold text-{{ $lyn->status ? 'success' : 'danger' }}">
                                        {{ $lyn->status ? 'aktif' : 'non-aktif' }}
                                    </p>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modal-status-{{ $lyn->slug }}">
                                        Ubah Status
                                    </button>
                                    <a href="/layanan/{{ $lyn->slug }}"
                                        class="btn btn-info text-decoration-none">detail</a>
                                    <a href="/layanan/{{ $lyn->slug }}/edit" class="btn btn-warning">update</a>
                                    <form action="/layanan/{{ $lyn->slug }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger border-0"
                                            onclick="return confirm('Yakin Anda akan memnghapus?')"><span
                                                class="badge badge-danger">hapus</span></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal aktif status layanan -->
    @foreach ($layanan as $lyn)
        <div class="modal fade" id="modal-status-{{ $lyn->slug }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            {{ $lyn->status ? 'Aktifkan layanan' : 'Non-aktifkan layanan' }} {{ $lyn->nama }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ $lyn->status ? 'Klick aktifkan untuk mengaktifkan layanan ' : 'Klick non-aktifkan untuk menonaktifkan layanan' }}
                        {{ $lyn->nama }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="/layanan/status2/{{ $lyn->slug }}"
                            class="btn {{ $lyn->status ? 'btn-warning' : 'btn-success' }}">{{ $lyn->status ? 'non-aktifkan' : 'aktifkan' }}</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
