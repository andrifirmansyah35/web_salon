@extends('layouts.main')

@section('content')
    <!-- title dan icon tambah -->
    <div class="col-md-8 mt-3">
        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
    </div>

    <div class="col-md-8">
        <form method="post" action="/layanan">
            @csrf
            <div class="mb-2">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                    value="{{ old('nama') }}">
                @error('nama')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2">
                <label for="slug" class="form-label">slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                    readonly value={{ old('slug') }}>
                @error('slug')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2">
                <label for="slug" class="form-label">Harga</label>
                <input type="number" class="form-control @error('slug') is-invalid @enderror" id="slug" name="harga"
                    value={{ old('harga') }} min="1000">
                @error('slug')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="input_kategori">Kategori</label>
                <select class="form-control" id="input_kategori" name="kategori_layanan_id">
                    @foreach ($kategori_layanan_all as $kl)
                        <option value="{{ $kl->id }}">{{ $kl->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="from-group mb-3">
                <label for="deskripsi" class="form-label">Body</label>
                @error('deskripsi')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
                <input type="hidden" id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}">
                <trix-editor input="deskripsi"></trix-editor>
            </div>

            <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
    </div>

    <script>
        const nama = document.querySelector('#nama');
        const slug = document.querySelector('#slug');

        nama.addEventListener('change', function() {
            fetch('/kategori_layanan/checkSlug?nama=' + nama.value)
                .then(response => response.json())
                //kita ambil isinya |responsenya kita jalankan dimethod json| json masih (promise)
                .then(data => slug.value = data.slug)
        })
    </script>
@endsection
