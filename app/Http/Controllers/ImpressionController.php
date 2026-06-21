<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\Impression;
use Illuminate\Http\Request;

class ImpressionController extends Controller
{
    // 感想編集
        public function edit(Work $work)
    {
        $work->load(['images', 'impressions' => function ($query) {
            $query->where('user_id', auth()->id());
        }]);

        $impression = $work->impressions->first();

        return view('impressions.edit', compact('work', 'impression'));
    }
    // 感想更新処理
        public function update(Request $request, Work $work)
    {
        $validated = $request->validate([
            'status'  => 'required|integer|in:1,2,3,4',
            'rating'  => 'nullable|numeric|min:0|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $impression = Impression::firstOrNew([
            'user_id' => auth()->id(),
            'work_id' => $work->id,
        ]);
        // 視聴ステータス
        $impression->status = $validated['status'];
        // 評価
        if(array_key_exists('rating', $validated) && $validated['rating'] !== null){
            $impression->rating = $validated['rating'];
        }
        // コメント
        if(array_key_exists('comment', $validated) && $validated['comment'] !== null){
            $impression->comment = $validated['comment'];
        }

        $impression->save();

        if($request->filled('rating')){
            return redirect()->route('works.show', $work->id);
        }
        return redirect()->back();
    }
    // 感想削除処理
        public function destroy(Work $work)
    {
        $impression = Impression::where('user_id', auth()->id())
            ->where('work_id', $work->id)
            ->first();
        // $impressionがnullの場合のエラー回避
        if($impression){
            $impression->delete();
        }
        return redirect()->route('works.show', $work->id);
    }
}
