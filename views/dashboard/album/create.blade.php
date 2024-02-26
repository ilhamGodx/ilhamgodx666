
@extends('dashboard.layout.main')
@section('title', 'Dashboard | Create Album')

@section('content')
<h2 class="mb-3">Create Album</h2>
<form action="/dashboard/album/store" method="post">
@csrf
    <div class="mb-3">
        <label for="namaalbum">Nama Album</label>
        <input type="text" id="namaalbum" name="nama_album" class="form-control" >
    </div>
    <div class="mb-3">
        <label for="deskripsi">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Tambah Album</button>
    </div>
</form>
@endsection
