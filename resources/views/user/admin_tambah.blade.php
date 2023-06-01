@extends('layouts.main')

@section('content')
    <!-- title dan icon tambah -->
    <div class="col-md-8 mt-3">
        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
    </div>

    <div class="col-md-8">
        <form method="post" action="/admin_tambah">
            @csrf
            <div class="mb-2">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="name"
                    value="{{ old('name') }}">
                @error('nama')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2">
                <label for="slug" class="form-label">Email</label>
                <input type="email" class="form-control @error('slug') is-invalid @enderror" id="slug" name="email"
                    value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" value="{{ old('password') }}">
                @error('password')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2">
                <label for="telephone" class="form-label">Telephone</label>
                <input type="number" class="form-control @error('telephone') is-invalid @enderror" id="telephone"
                    name="telephone" value="{{ old('telephone') }}" min="0">
                @error('telephone')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea type="number" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                    min="1000">
                    {{ old('alamat') }}
                    </textarea>
                @error('alamat')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Tambah Admin</button>
        </form>
    </div>
@endsection
