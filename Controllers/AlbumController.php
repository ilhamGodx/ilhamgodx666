<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;

class AlbumController extends Controller
{
    public function index() {
        return view('dashboard.album.index', [
            'albums' => Album::latest()->get()
        ]);
    }

    public function create(){
        return view('dashboard.album.create');
    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'nama_album' => 'required|max:255|unique:albums',
            'deskripsi' => 'required'
        ]);

        $validatedData['user_id'] = auth()->user()->user_id;

        Album::create($validatedData);

        return redirect('/dashboard/album')->with('success', 'Album baru berhasil dibuat');
    }

    public function delete($id){
        $id_album = Album::find($id);
        $id_album->delete();
        return redirect('/dashboard/album')->with('success', 'Album berhasil dihapus');
    }

    public function edit(Album $album){
        return view('dashboard.album.edit', [
            'album' => $album
        ]);
    }

    public function update(Album $album, Request $request) {
        $validatedData = $request->validate([
            'nama_album' => 'required|max:255',
            'deskripsi' => 'required'
        ]);

        Album::where('album_id', $album->album_id)
            ->update($validatedData);

        return redirect('/dashboard/album')->with('success', 'Album berhasil diUpdate');
    }
}
