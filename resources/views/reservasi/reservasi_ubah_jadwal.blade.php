@extends('layouts.main')

@section('content')
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

    @if (session()->has('fail'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('fail') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Dropdown Card Example -->
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h3 class="m-0 font-weight-bold text-primary">Ubah Jadwal Reservasi</h3>
        </div>
        <!-- Card Body -->
        <form method="post" action="/reservasi_ubah_jadwal_simpan" enctype="multipart/form-data">
            @method('post')
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-lg" placeholder="col-form-label"
                                        value="{{ $reservasi->user_member->name }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-lg" placeholder="col-form-label"
                                        value="{{ $reservasi->user_member->email }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label col-form-label">Layanan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-lg" placeholder="col-form-label"
                                        value="{{ $reservasi->layanan->nama }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label col-form-label">Harga</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-lg" placeholder="col-form-label"
                                        value="{{ $reservasi->layanan->harga }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label col-form-label">Tanggal Layanan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-lg" placeholder="col-form-label"
                                        value="{{ $reservasi->jadwal_operasi->tanggal }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label col-form-label">Jadwal Dipilih</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-lg" placeholder="col-form-label"
                                        value="{{ $reservasi->operasi->waktu_mulai . '-' . $reservasi->operasi->waktu_selesai }}"
                                        readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label">Tanggal </label>
                                <div class="col-sm-8 col-form-label col-form-label">
                                    {{ $reservasi->jadwal_operasi->tanggal }}
                                </div>
                            </div>
                            @if ($jadwal_kosong == 'kosong')
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label">Jadwal Tersedia </label>
                                    <div class="alert alert-warning" role="alert">
                                        Jadwal tidak ada yang kosong
                                    </div>
                                </div>
                            @endif


                            @if ($jadwal_kosong != 'kosong')
                                <div class="form-group row">
                                    <input type="hidden" name="reservasi_id" value="{{ $reservasi->id }}">
                                    <input type="hidden" name="reservasi_operasi_id_lampau"
                                        value="{{ $reservasi->operasi_id }}">
                                    <label class="col-sm-4 col-form-label col-form-label">Jadwal Tersedia : </label>
                                    <div class="col-sm-8 col-form-label col-form-label">
                                        @foreach ($jadwal_kosong as $jk)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="operasi_id"
                                                    id="op-{{ $jk->id }}" value="{{ $jk->id }}" checked>
                                                <label class="form-check-label" for="exampleRadios1">
                                                    {{ $jk->waktu_mulai . '-' . $jk->waktu_selesai }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button type="submit" class="btn btn-primary w-100">Ubah Jadwal Layanan</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection
