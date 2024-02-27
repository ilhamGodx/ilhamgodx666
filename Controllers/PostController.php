<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;
use App\Models\KomentarFoto;
use App\Models\LikeFoto;
use App\Models\User;

class PostController extends Controller
{
    public function index(){

        
        if (isset(auth()->user()->user_id)) {
            $user_id = auth()->user()->user_id;
        }else{
            $user_id = '';
        }

        $title = '';

        if (request('author')) {
            $author = User::firstWhere('username', request('author'));
            $title = 'by ' . $author->nama_lengkap;
        }

        return view('posts', [
            'posts' => Foto::latest()->filter(request(['search', 'author']))->get(),
            'title' => 'All Post ' . $title,
            'user_id' => $user_id,
        ]);
    }
}
