<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    // 作品一覧
        public function index()
    {
        //
        $tags = Tag::all();
        $userId = auth()->id();
        $works = Work::with(['tags', 'impressions' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])->get();
        // 視聴ステータスラベル用
        $status = [
            'labels' => [1 => '未視聴', 2 => '気になる', 3 => '視聴中', 4 => '視聴済み'],
            'classes' => [
                1 => 'bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
                2 => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
                3 => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                4 => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
            ],
        ];
        return view('works.search', compact('tags', 'works', 'status'));
    }
    // 作品検索
        public function search(Request $request)
    {
        #dd($request->title);
        $tags = Tag::all();
        return view('works.search', compact('tags', 'request'));

        //
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
