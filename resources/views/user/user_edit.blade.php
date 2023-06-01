@extends('layouts.main')

@section('content')
    <!-- title dan icon tambah -->
    <div class="col-md-8">
        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="col-md-8">
        <form method="post" action="/profile_update" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="name"
                    value="{{ old('nama', $user->name) }}">
                @error('nama')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="telephone" class="form-label">telephone</label>
                <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone"
                    name="telephone" value="{{ old('telephone', $user->telephone) }}">
                @error('telephone')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label @error('photo_profil') is-invalid @enderror">Foto Profil</label>
                <br>
                <input type="hidden" name="photoProfilLama" value="{{ $user->photo_profile }}">

                @if ($user->photo_profile)
                    <img src="{{ asset('storage/' . $user->photo_profile) }}"
                        class="img-preview img-fluid mb-3 col-sm-5 d-blok">
                @else
                    <img src="{{ asset('img/profile.png') }}" class="img-preview img-fluid mb-3 col-sm-5 d-blok">
                @endif

                <input class="form-control" type="file" id="photo_profil" name="photo_profile" onchange="previewImage()">
                @error('photo_profil')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea type="number" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                    min="1000">
                    {{ old('alamat', $user->alamat) }}
                    </textarea>
                @error('alamat')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="input_password" class="form-label">password Baru</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="input_password"
                    name="password">

                @error('password')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" onclick="myFunction()" id="xampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Show Password</label>
                <script>
                    function myFunction() {
                        var x = document.getElementById("input_password");
                        if (x.type === "password") {
                            x.type = "text";
                        } else {
                            x.type = "password";
                        }
                    }
                </script>
            </div>


            <div class="mt-3">
                <button type="submit" class="btn btn-primary w-100">update Profil</button>
            </div>
        </form>
    </div>

    <script>
        // change Image
        const image = document.querySelector('#photo_profil')
        const imgPreview = document.querySelector('.img-preview')

        function previewImage() {
            console.log('meong');

            imgPreview.style.display = 'block'

            const oFReader = new FileReader();

            oFReader.readAsDataURL(image.files[0])

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result
            }
        }
    </script>
@endsection
