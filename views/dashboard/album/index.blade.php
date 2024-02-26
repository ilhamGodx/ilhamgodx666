@extends('dashboard.layout.main')
@section('title', 'Dashboard | Album')

@section('content')
    <h1>Album</h1>

    <a href="/dashboard/album/create" class="btn btn-danger">Create Album</a>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <table class="table table-striped">
        <tr>
            <th>Nama Album</th>
            <th>Deskripsi</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        @foreach ($albums as $album)


        <tr>
            <td>{{ $album->nama_album }}</td>
            <td>{{ $album->deskripsi }}</td>
            <td>{{ $album->created_at->diffForHumans() }}</td>
            <td>
                <a href="/dashboard/album/edit/{{ $album->album_id }}" class="btn btn-warning">Edit</a>
                <form action="/dashboard/album/delete/{{ $album->album_id }}" method="post" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>

            </td>
        </tr>
        @endforeach
    </table>
@endsection
