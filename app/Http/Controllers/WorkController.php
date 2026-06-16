<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    // 1ページで表示する作品数
    private const PER_PAGE = 20;

    // 作品一覧
        public function index()
    {
        //
        $tags = Tag::all();
        $userId = auth()->id();
        $works = Work::with(['tags', 'impressions' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])->paginate(self::PER_PAGE);
        return view('works.index', compact('tags', 'works'));
    }
    // 作品検索
        public function search(Request $request)
    {
        #dd($request->title);
        $tags = Tag::all();
        $userId = auth()->id();

        $query = Work::with(['tags', 'impressions' => function ($q) use ($userId) {
            $q->where('user_id', $userId);
        }]);
        
        // タイトル検索
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        // タグ絞り込み
        if ($request->filled('tags')) {
            $tagIds = $request->tags;
            if ($request->tagcond === 'or') {
                $query->whereHas('tags', function ($q) use ($tagIds) {
                    $q->whereIn('tags.id', $tagIds);
                });
            } else {
                // and条件：選んだタグを全部含む
                foreach ($tagIds as $tagId) {
                    $query->whereHas('tags', function ($q) use ($tagId) {
                        $q->where('tags.id', $tagId);
                    });
                }
            }
        }

        // ステータス絞り込み（ログイン時のみ）
        if ($userId && $request->filled('status')) {
            $query->whereHas('impressions', function ($q) use ($userId, $request) {
                $q->where('user_id', $userId)
                ->whereIn('status', $request->status);
            });
        }

        $works = $query->paginate(self::PER_PAGE);
        return view('works.search', compact('tags', 'request', 'works'));
    }
    // 作品詳細
        public function show(Work $work)
    {
        //
        $work->load(['tags', 'impressions' => function ($query) {
            $query->where('user_id', auth()->id());
        }]);

        return view('works.show', compact('work'));
    }
}
