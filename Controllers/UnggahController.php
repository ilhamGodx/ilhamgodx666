<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;

class UnggahController extends Controller
{
    public function unggah(Request $request, Foto $foto)
    {
        $validatedData = $request->validate([
            'tanggal_unggah' => 'max:255'
        ]);

        $validatedData['tanggal_unggah'] = date('y-m-d h:i:s');
        Foto::where('foto_id', $foto->foto_id)
            ->update($validatedData);
        return redirect('/dashboard/foto')->with('success', 'Foto Berhasil Di Unggah');
    }
}
