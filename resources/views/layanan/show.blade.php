@extends('layouts.main')

@section('content')
    <!-- Dropdown Card Example -->
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h3 class="m-0 font-weight-bold text-primary">Detail : {{ $layanan->nama }}</h3>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label col-form-label">Kategori Layanan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-lg" placeholder="col-form-label"
                        value="{{ $layanan->Kategori_layanan->nama }}" readonly>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label col-form-label">harga</label>
                <div class="col-sm-10">
                    <input type="" class="form-control form-control-lg" placeholder="col-form-label"
                        value="{{ 'Rp ' . number_format($layanan->harga, 2, ',', '.') }}" readonly>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                    <textarea class="form-control form-control-lg" rows="3" readonly>{{ $layanan->deskripsi ? $layanan->deskripsi : '-' }}</textarea>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label col-form-label">Status Layanan</label>
                <div class="col-sm-10">
                    <button class="btn {{ $layanan->status ? 'btn-success' : 'btn-warning' }} btn-icon-split w-100"
                        data-toggle="modal" data-target="#modalAktivLayanan">
                        <span class="text">{{ $layanan->status ? 'aktif' : 'non-aktif' }}</span>
                    </button>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Untuk mengaktifkan data layanan -->
    <div class="modal fade" id="modalAktivLayanan" tabindex="-1" aria-labelledby="modalAktivLayananLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAktivLayananLabel">Layanan : {{ $layanan->nama }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda Ingin
                    <span class="font-weight-bold">{{ $layanan->status ? 'non-aktifkan' : 'aktifkan' }}</span> layanan
                    <span class="font-weight-bold">{{ $layanan->nama }} ?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="/layanan/status/{{ $layanan->slug }}"
                        class="btn {{ $layanan->status ? 'btn-warning' : 'btn-success' }}">{{ $layanan->status ? 'non-aktifkan' : 'aktifkan' }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
