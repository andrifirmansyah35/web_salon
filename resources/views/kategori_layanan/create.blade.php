@extends('layouts.main')

@section('content')
    <!-- title dan icon tambah -->
    <div class="col-md-8 mt-3">
        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
    </div>

    <div class="col-md-8">
        <form method="post" action="/kategori_layanan" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                    value="{{ old('nama') }}">
                @error('nama')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                    readonly value={{ old('slug') }}>
                @error('slug')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label @error('gambar') is-invalid @enderror">Post Image</label>
                <img src="" class="img-preview img-fluid mb-3 col-sm-5" alt="">
                <input class="form-control" type="file" id="image" name="gambar" onchange="previewImage()">
                @error('gambar')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Tambah Kategori layanan</button>
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

        const image = document.querySelector('#image')
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
