<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Album;
use App\Models\KomentarFoto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $user = User::findOrFail(auth()->user()->user_id);

        return view('dashboard.photo.index', [
            'fotos' => $user->foto
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::findOrFail(auth()->user()->user_id);

        return view('dashboard.photo.create', [
            'albums' => $user->album
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul_foto' => 'required|max:255',
            'lokasi_file' => 'required|image|file|max:1000000',
            'deskripsi_foto' => 'required',
            'album_id' => 'required'
        ]);

        $validatedData['lokasi_file'] = $request->file('lokasi_file')->store('foto');
        $validatedData['user_id'] = auth()->user()->user_id;


        Foto::create($validatedData);
        return redirect('/dashboard/foto')->with('success', 'Foto Baru Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Foto $foto)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Foto $foto)
    {
        return view('dashboard.photo.edit', [
            'foto' => $foto,
            'albums' => Album::where('user_id', auth()->user()->user_id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Foto $foto)
    {
        $validatedData = $request->validate([
            'judul_foto' => 'required|max:255',
            'lokasi_file' => 'image|file|max:2004',
            'deskripsi_foto' => 'required',
            'album_id' => 'required'
        ]);


        if ($request->file('lokasi_file')) {
            if ($foto->lokasi_file) {
                Storage::delete($foto->lokasi_file);
            }
            $validatedData['lokasi_file'] = $request->file('lokasi_file')->store('user-foto');
        } else {
            $validatedData['lokasi_file'] = $foto->lokasi_file;
        }


        $validatedData['user_id'] = auth()->user()->user_id;

        Foto::where('foto_id', $foto->foto_id)
            ->update($validatedData);

        return redirect('/dashboard/foto')->with('success', 'Foto Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Foto $foto)
    {
        Storage::delete($foto->lokasi_file);
        Foto::destroy($foto->foto_id);
        return redirect('/dashboard/foto')->with('success', 'Foto Berhasil Di Hapus');
    }

    
}
