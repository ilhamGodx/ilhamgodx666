
@extends('dashboard.layout.main')
@section('title', 'Dashboard | Create Album')

@section('content')
<h2 class="mb-3">Create Foto</h2>
<form action="/dashboard/foto" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="judul_foto">Judul Foto</label>
        <input type="text" id="judul_foto" name="judul_foto" class="form-control @error('judul_foto') is-invalid @enderror" >
        @error('judul_foto')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="image">Foto</label>
        <img class="img-preview img-fluid mb-3" style="width:40%;">
        <input type="file" id="image" name="lokasi_file" class="form-control @error('lokasi_file') is-invalid @enderror" onchange="imgPreview()">
    </div>

    <div class="mb-3">
        <label for="album">Album</label>
        <select name="album_id" id="album" class="form-select ms-0 @error('album_id') is-invalid @enderror">
            <option value="" disabled selected>-- Select Your Album --</option>
            @foreach ($albums as $album)
            <option value="{{ $album->album_id }}">{{ $album->nama_album }}</option>
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
        <textarea name="deskripsi_foto" id="deskripsi" class="form-control @error('deskripsi_foto') is-invalid @enderror"></textarea>
        @error('deskripsi_foto')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Tambah Foto</button>
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
