<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;

class ImpressionController extends Controller
{
    // 感想編集
        public function edit(Work $work)
    {
        $work->load(['impressions' => function ($query) {
            $query->where('user_id', auth()->id());
        }]);

        $impression = $work->impressions->first();

        return view('impressions.edit', compact('work', 'impression'));
    }
    // 感想更新処理
        public function update()
    {
        //
    }
    // 感想削除処理
        public function destroy()
    {
        //
    }
}
