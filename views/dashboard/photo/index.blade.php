@extends('dashboard.layout.main')
@section('title', 'Dashboard | Photos')

@section('content')
    <h1>Photos</h1>
    @php
        use App\Models\LikeFoto;
    @endphp
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <a href="/dashboard/foto/create" class="btn btn-danger">Create Photo</a>
    <table class="table table-striped">
        <tr>
            <th>Judul Foto</th>
            <th>Album</th>
            <th>Tanggal Buat</th>
            <th>Action</th>
        </tr>
        @foreach ($fotos as $foto)
            @php
                $likes = $foto->like;
            @endphp
            <tr>
                <td>{{ $foto->judul_foto }}</td>
                <td>{{ $foto->album->nama_album }}</td>
                <td>{{ $foto->created_at->diffForHumans() }}</td>
                <td>
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop{{ $foto->foto_id }}">Detail</a>
                    <a href="/dashboard/foto/{{ $foto->foto_id }}/edit" class="btn btn-warning">Edit</a>
                    <form action="/dashboard/foto/{{ $foto->foto_id }}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    @if (!$foto->tanggal_unggah)
                        <form action="/unggah/{{ $foto->foto_id }}" method="post" class="d-inline">
                            @csrf
                            <input type="hidden" name="tanggal_unggah">
                            <button type="submit" class="btn btn-success">Unggah</button>
                        </form>
                    @endif
                </td>
            </tr>

            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop{{ $foto->foto_id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $foto->judul_foto }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row d-flex flex-wrap ">
                                <div class="image pb-2">
                                    <img style="width: 100%" src="{{ asset('storage/' . $foto->lokasi_file) }}"
                                        class="img-fluid mb-2" alt="" srcset="">
                                    <span style="font-size: 1rem;">{{ $foto->deskripsi_foto }}</span>

                                </div>

                                <div class="komen-dashboard">
                                    <div class="komentar-dashboard py-3">


                                        @foreach ($foto->komentar()->latest()->get() as $komen)
                                            
                                                <div class="isi-komen d-flex mb-3">
                                                    <span class="icon-profile fs-3 "><i class="fa-solid fa-user"></i></span>
                                                    <span class="isi ms-2">
                                                        <span class="nama"><b>{{ $komen->user->nama_lengkap }}</b>
                                                            <small>{{ $komen->created_at->diffForHumans() }}</small>
                                                        </span><br>
                                                        <span class="content">{{ $komen->isi_komentar }}</span><br>
                                                        <form action="/dashboard/komen/hapus/{{ $komen->komentar_id }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit" class="text-danger fw-bold p-0"
                                                                style="border:none; background:transparent;">Hapus</button>
                                                        </form>
                                                    </span>
                                                </div>
                                            
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            @php
                                $has_like = $foto->like()->where('user_id', auth()->user()->user_id)->exists();
                            @endphp
                            @if ($has_like)
                                <form action="/dislike/dashboard/{{ $foto->foto_id }}" method="post">
                                @csrf
                                <button class="p-0 bg-transparent border-0 fs-4"><i
                                    class="fa-solid fa-heart"></i>{{ $likes->count() }}</button>
                                </form>
                            @else
                            <form action="/like/dashboard" method="post">
                                @csrf
                                <input type="hidden" name="foto_id" value="{{ $foto->foto_id }}">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->user_id }}">
                                <button class="p-0 bg-transparent border-0 fs-4"><i
                                        class="fa-regular fa-heart"></i>{{ $likes->count() }}</button>
                            </form>
                            @endif
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </table>
@endsection


<!-- Modal -->
