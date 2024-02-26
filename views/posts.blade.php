@extends('layout.main')
@section('title', 'Photos')

@section('content')

    @if ($posts->count())
        @foreach ($posts as $post)
            @if ($post->tanggal_unggah)
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="image position-relative">
                            <span class="bg-dark text-light">{{ $post->album->nama_album }}</span>
                            <img src="{{ asset('storage/' . $post->lokasi_file) }}" alt="" class="img-fluid">
                            <button type="button"
                                style="position: absolute; left:0; right:0;
                    top:0; bottom:0; background:transparent; border:0;"
                                data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $post->foto_id }}"></button>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><span class="text-danger"><a
                                        href="/posts?author={{ $post->user->username }}"
                                        class="text-decoration-none text-danger">{{ $post->user->nama_lengkap }}</a></span>
                                <br>
                                {{ $post->judul_foto }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">

                                    @php
                                        $likes = $post->like;
                                    @endphp
                                    @auth
                                        @php
                                            $has_like = $post
                                                ->like()
                                                ->where('user_id', $user_id)
                                                ->exists();
                                        @endphp
                                        @if ($has_like)
                                            <form action="/dislike/{{ $post->foto_id }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-sm me-2 p-0 fs-3"><i
                                                        class="fa-solid fa-heart"></i></button>
                                                <span class="ms-0">{{ $likes->count() }}</span>
                                            </form>
                                        @else
                                            <form action="/like" method="post" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="user_id">
                                                <input type="hidden" name="foto_id" value="{{ $post->foto_id }}">
                                                <button type="submit" class="btn btn-sm me-2 p-0 fs-3 "><i
                                                        class="fa-regular fa-heart"></i></button>
                                                <span class="ms-0">{{ $likes->count() }}</span>
                                            </form>
                                        @endif
                                    @else
                                        <a onclick="return confirm('Please Login!');" class="btn btn-sm me-2 p-0 fs-3 "><i
                                                class="fa-regular fa-heart"></i></a>
                                        <span class="ms-0">{{ $likes->count() }}</span>
                                    @endauth



                                </div>
                                <small class="text-body-secondary"> {{ $post->tanggal_unggah }} </small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="staticBackdrop{{ $post->foto_id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $post->judul_foto }}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row d-flex flex-wrap ">
                                    <div class="image pb-2">
                                        <img style="width: 100%" src="{{ asset('storage/' . $post->lokasi_file) }}"
                                            class="img-fluid mb-3" alt="" srcset="">
                                        <span style="font-size: 1rem;">{{ $post->deskripsi_foto }}</span>
                                    </div>

                                    <div class="komen-dashboard">
                                        <div class="komentar-dashboard py-3">

                                            @foreach ($post->komentar()->latest()->get() as $komen)
                                                <div class="isi-komen d-flex mb-3">
                                                    <span class="icon-profile fs-2 "><i class="fa-solid fa-user"></i></span>
                                                    <span class="isi ms-2">
                                                        <span class="nama"><b>{{ $komen->user->nama_lengkap }}</b>
                                                            <small
                                                                class="text-primary fw-bold">{{ $post->user_id == $komen->user_id ? 'Author' : '' }}</small>
                                                            <small>{{ $komen->created_at->diffForHumans() }}</small>
                                                        </span><br>
                                                        <span class="content"
                                                            style="font-size:0.9rem;">{{ $komen->isi_komentar }}</span><br>
                                                        @auth
                                                            @if ($komen->user_id == auth()->user()->user_id)
                                                                <form action="/komen/hapus/{{ $komen->komentar_id }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <button type="submit" class="text-danger fw-bold p-0"
                                                                        style="border:none; background:transparent;">Hapus</button>
                                                                </form>
                                                            @endif
                                                        @endauth
                                                    </span>

                                                </div>
                                            @endforeach


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-komentar">
                                @auth
                                    <form action="/komen" method="post" class="d-inline">
                                        @csrf
                                        <div class="mt-2 d-flex justify-content-lg-between ">
                                            <input type="hidden" name="foto_id" value="{{ $post->foto_id }}">
                                            <textarea name="isi_komentar" id="" maxlength="255"
                                                class="form-control w-80 border-3 @error('isi_komentar') is-invalid  @enderror"
                                                style="box-shadow:none; resize:none;" placeholder="Comment"></textarea>
                                            <button type="submit" class="btn btn-danger"
                                                style="border-radius: 0;">Kirim</button>
                                        </div>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @else
        <h1 class="position-absolute">Postingan Tidak ada</h1>
    @endif
@endsection
