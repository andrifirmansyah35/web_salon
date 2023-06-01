@extends('layouts.main')

@section('content')
    <!-- Dropdown Card Example -->
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h3 class="m-0 font-weight-bold text-primary">Profil Member</h3>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-lg" placeholder="col-form-label"
                                value="{{ $member->name }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-lg" placeholder="col-form-label"
                                value="{{ $member->email }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label col-form-label">No. Telephone</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control form-control-lg" placeholder="col-form-label"
                                value="{{ $member->telephone }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control form-control-lg" rows="3" readonly>{{ $member->alamat }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label col-form-label">Status</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-lg" placeholder="col-form-label"
                                value="{{ $member->level }}" readonly>
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
                        Buat Member
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/member_jadi_member">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="email">Email Akun Member</label>
                            <input type="email" name="email" class="form-control" id="member"
                                placeholder="Enter email" value="{{ $member->email }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" id="myInput" class="form-control" name="password" required>
                        </div>

                        <div class="form-check">

                            <input type="checkbox" class="form-check-input" onclick="myFunction()" id="xampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Show Password</label>
                            <script>
                                function myFunction() {
                                    var x = document.getElementById("myInput");
                                    if (x.type === "password") {
                                        x.type = "text";
                                    } else {
                                        x.type = "password";
                                    }
                                }
                            </script>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Buat Member</button>
                    </div>
                    <div></div>
                </form>
            </div>
        </div>
    </div>
@endsection
