@extends('layouts.main')

@section('content')
    <!-- title dan icon tambah -->
    <div class="col-md-8 mt-3">
        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
    </div>

    <div class="col-md-8">
        <form method="post" action="/pelanggan_tambah">
            @csrf
            <div class="mb-2">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="name"
                    value="{{ old('name') }}" required>
                @error('nama')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2">
                <label for="slug" class="form-label">Email</label>
                <input type="email" class="form-control @error('slug') is-invalid @enderror" id="slug" name="email"
                    value="{{ old('email') }}" required>
                @error('email')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2">
                <label for="slug" class="form-label">Telephone</label>
                <input type="number" class="form-control @error('telephone') is-invalid @enderror" id="slug"
                    name="telephone" value="{{ old('telephone') }}" min="0" required>
                @error('telephone')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2">
                <label for="slug" class="form-label">Alamat</label>
                <textarea type="number" class="form-control @error('alamat') is-invalid @enderror" id="slug" name="alamat"
                    min="1000" required>
                    {{ old('alamat') }}
                    </textarea>
                @error('alamat')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Tambah Pelangan</button>
        </form>
    </div>
@endsection
