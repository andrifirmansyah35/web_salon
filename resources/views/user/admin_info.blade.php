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
            <h3 class="m-0 font-weight-bold text-primary">Profil Admin</h3>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-lg" placeholder="col-form-label"
                                value="{{ $admin->name }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-lg" placeholder="col-form-label"
                                value="{{ $admin->email }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label col-form-label">No. Telephone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-lg" placeholder="col-form-label"
                                value="{{ $admin->telephone }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control form-control-lg" rows="3" readonly>{{ $admin->alamat }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label col-form-label">Status Akun</label>
                        <div class="col-sm-10">
                            <input class="w-100 form-text form-control form-control-lg " value="{{ $admin->level }}"
                                readonly>
                            </input>

                            <small class="form-text text-muted">
                                {{ $admin->level == 'admin' ? 'Apakah anda ingin menonaktifkan akun admin?.' : 'Pulihakan kembali admin' }}
                                <button type="button" class=" btn btn-link form-text" data-toggle="modal"
                                    data-target="#modal-member">
                                    {{ $admin->level == 'admin' ? 'non-aktifkan' : 'pulihkan' }}
                                </button>

                            </small>
                        </div>
                    </div>

                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <img src="{{ asset('img/profile.png') }}" class="rounded mx-auto w-100" alt="...">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal Untuk mengaktifkan data layanan -->
    <div class="modal fade" id="modal-member" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Form aktivasi admin
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="email_admin" value="{{ $admin->email }}">

                    Apakah anda ingin <span class="font-weight-bold">
                        akun ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="/admin_status/{{ $admin->email }}"
                        class="btn btn-success">{{ $admin->level == 'admin' ? 'non-aktifkan' : 'aktifkan' }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
