<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use Illuminate\Contracts\Support\ValidatedData;

class AlbumController extends Controller
{
    public function index(){
        return view('dashboard.album.index',[
            'albums' => Album::latest()->get()
        ]);
    }
    public function create(){
        return view('dashboard.album.create');
    }
    public function store(Request $request){
        $validateData = $request->validate([
            'nama_album' => 'required|unique:albums',
            'deskripsi' => 'required'
        ]);
        $validateData['user_id']= auth()->user()->user_id;
        Album::create($validateData);
        return redirect('/dashboard/album');
    }
    public function delete($id){
        $id_album = Album::find($id);
        $id_album->delete();
        return redirect('/dashboard/album');
    }
    public function edit(Album $album){
        return view('dashboard.album.edit',[
            'album' => $album
        ]);
    }
    public function update(Album $album, Request $request){
        $validateData = $request->validate([
            'nama_album' => 'required|unique:albums',
            'deskripsi' => 'required'
        ]);
        Album::where('album_id', $album->album_id)->update($validateData);
        return redirect('/dashboard/album');
    }
}
