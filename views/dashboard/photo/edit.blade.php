@extends('dashboard.layout.main')
@section('title', 'Dashboard | Create Album')

@section('content')
    <h2 class="mb-3">Create Foto</h2>
    <form action="/dashboard/foto/{{ $foto->foto_id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
       
        <div class="mb-3">
            <label for="judul_foto">Judul Foto</label>
            <input type="text" id="judul_foto" name="judul_foto"
                class="form-control @error('judul_foto') is-invalid @enderror"
                value="{{ old('judul_foto', $foto->judul_foto) }}">
            @error('judul_foto')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image">Foto</label>
            @if ($foto->lokasi_file)
                <img src="{{ asset('storage/' . $foto->lokasi_file) }}" alt="" srcset=""
                    class="img-preview img-fluid mb-3 d-block">
            @else
                <img class="img-preview img-fluid mb-3" style="width:40%;">
            @endif
            <input type="file" id="image" name="lokasi_file"
                class="form-control @error('lokasi_file') is-invalid @enderror" onchange="imgPreview()">
        </div>

        <div class="mb-3">
            <label for="album">Album</label>
            <select name="album_id" id="album" class="form-select ms-0 @error('album_id') is-invalid @enderror">
                <option value="" disabled selected>-- Select Your Album --</option>
                @foreach ($albums as $album)
                    <option value="{{ $album->album_id }}" {{ $foto->album_id == $album->album_id ? 'selected' : '' }}>
                        {{ $album->nama_album }}</option>
                @endforeach
            </select>
            @error('album_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi_foto" id="deskripsi" class="form-control @error('deskripsi_foto') is-invalid @enderror">{{ old('deskripsi_foto', $foto->deskripsi_foto) }}</textarea>
            @error('deskripsi_foto')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update Foto</button>
        </div>
    </form>

    <script>
        function imgPreview() {
            const image = document.querySelector('#image');
            const preview = document.querySelector('.img-preview');

            preview.style.display = 'block';

            const reader = new FileReader();
            reader.readAsDataURL(image.files[0]);

            reader.onload = function(e) {
                preview.src = e.target.result;
            }
        }
    </script>
@endsection
