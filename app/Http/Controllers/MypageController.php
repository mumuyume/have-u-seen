<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    // マイページ
        public function show()
    {
        $user = auth()->user();

        $counts = $user->impressions()
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $watched    = $counts->get(4, 0); // 視聴済み
        $watching   = $counts->get(3, 0); // 視聴中
        $interested = $counts->get(2, 0); // 気になる
        $recordedUnwatched = $counts->get(1, 0); // status=1で明示登録された未視聴

        $totalWorks = Work::count();
        $recordedWorks = $user->impressions()->count();
        $unwatched = $totalWorks - $recordedWorks + $recordedUnwatched;

        return view('mypages.show', compact('user', 'watched', 'watching', 'interested', 'unwatched'));
    }
}
