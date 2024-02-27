<?php

namespace App\Http\Controllers;

use App\Models\LikeFoto;
use Illuminate\Http\Request;


class LikeController extends Controller
{
   
    public function like(Request $request){
        
        $validateData['user_id'] = auth()->user()->user_id;
        $validateData['foto_id'] = $request->foto_id;

        LikeFoto::create($validateData);
        return redirect('/');
    }
    public function like_in_dashboard(Request $request){
        
        $validateData['user_id'] = $request->user_id;
        $validateData['foto_id'] = $request->foto_id;

        LikeFoto::create($validateData);
        return redirect('/dashboard/foto');
    }

    public function dislike($like){
        $dislike = LikeFoto::where('foto_id', $like)->where('user_id', auth()->user()->user_id);
        $dislike->delete();
        return redirect('/');
     }
     
    public function dislike_in_dashboard($like){
        $dislike = LikeFoto::where('foto_id', $like)->where('user_id', auth()->user()->user_id);
        $dislike->delete();
        return redirect('/dashboard/foto');
     }
}
