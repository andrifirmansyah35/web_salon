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
            <h3 class="m-0 font-weight-bold text-primary">Profil user</h3>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-lg" placeholder="col-form-label"
                                value="{{ $user->name }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-lg" placeholder="col-form-label"
                                value="{{ $user->email }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label col-form-label">No. Telephone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-lg" placeholder="col-form-label"
                                value="{{ $user->telephone }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control form-control-lg" rows="3" readonly>{{ $user->alamat }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label col-form-label">Status Akun</label>
                        <div class="col-sm-10">
                            <p class="btn btn-warning w-100 form-text form-control form-control-lg ">{{ $user->level }}
                            </p>

                            <small class="form-text text-muted">Klick untuk mengubah data profil anda.

                                <a href="/profile_edit" type="button" class=" btn btn-link form-text">
                                    Edit Profil
                                </a>

                            </small>
                        </div>
                    </div>

                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        @if ($user->photo_profile)
                            <img src="{{ asset('storage/' . $user->photo_profile) }}" class="rounded mx-auto w-100"
                                alt="">
                        @else
                            <img src="{{ asset('img/profile.png') }}" class="rounded mx-auto w-100" alt="">
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal Untuk mengaktifkan data layanan -->

@endsection
