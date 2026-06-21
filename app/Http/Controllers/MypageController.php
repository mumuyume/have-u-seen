<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    // マイページ
        public function show()
    {
        //
        $user = auth()->user();
        $total = Work::all()->count();
        $watched = $user->impressions()->where('status', 4)->count();
        return view('mypages.show', compact(['user', 'total', 'watched']));
    }
}
