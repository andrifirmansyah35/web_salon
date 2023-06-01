@extends('layouts.main')

@section('content')
    <!-- Dropdown Card Example -->
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h3 class="m-0 font-weight-bold text-primary">Kategori Layanan : {{ $kategori_layanan->nama }}</h3>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="row">
                <div class="form-group">
                    <img src="{{ $kategori_layanan->gambar == '' ? asset('img/profile.png') : asset('storage/' . $kategori_layanan->gambar) }}"
                        class="rounded mx-auto col-sm-5 d-blok" alt="...">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <a href="/kategori_layanan/{{ $kategori_layanan->slug }}/edit" class="btn btn-warning w-100">Edit</a>
                </div>
            </div>
        </div>
    </div>
@endsection
