<?php

namespace App\Http\Controllers;

use App\Models\KomentarFoto;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function komen(Request $request){

        $validatedData = $request->validate([
            'isi_komentar' => 'required|max:255'
        ]);

        $validatedData['user_id'] = auth()->user()->user_id;
        $validatedData['foto_id'] = $request->foto_id;

        KomentarFoto::create($validatedData);
        return redirect('/');
    }

    public function delete($komen){
        $komenId = KomentarFoto::findOrFail($komen);
        $komenId->delete();
        return redirect('/');
    }

    public function dashboard_delete($komen){
        $komenId = KomentarFoto::findOrFail($komen);
        $komenId->delete();
        return redirect('/dashboard/foto');
    }
}
