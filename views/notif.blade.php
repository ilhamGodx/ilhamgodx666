@extends('layout.main')
@section('title', 'Photos')

@section('content')
    @if ($fotos->count())

        @foreach ($fotos as $foto)
            @foreach ($foto->komentar()->latest()->get() as $komen)
                <div class="notif card w-100 p-2">
                    <span class="text-danger fw-bold ">{{ $komen->user->username }} <small
                            class=" text-secondary ">Comment</small></span>
                    <div class="card-body">
                        {{ $komen->isi_komentar }}
                    </div>
                </div>
            @endforeach
            @foreach ($foto->like()->latest()->get() as $like)
                <div class="notif card w-100 p-2">
                    <span class="text-danger fw-bold ">{{ $like->user->username }} <small
                            class=" text-secondary ">Like</small></span>
                    <div class="card-body">
                        <b>{{ $like->user->username }}</b> Menyukai <i class="fa-solid fa-heart text-danger"></i> Postingan Anda
                    </div>
                </div>
            @endforeach
        @endforeach
    @else
        <h1 class="text-center m-auto position-relative " style="top:5rem;">Tidak ada koment dan like</h1>
    @endif
@endsection
