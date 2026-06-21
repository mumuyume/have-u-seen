@extends('layouts.app')

@section('title', config('app.name').' - '.$work->title)

@section('content')
<main class="max-w-4xl mx-auto px-4 py-6">
    <a href="{{ route('works.index') }}" onclick="if(history.length > 1){history.back(); return false;}" class="text-sm text-blue-600 hover:underline dark:text-blue-400">← 戻る</a>

    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm mt-3 p-6 flex flex-col sm:flex-row gap-6">
        @if($work->images->first())
            <img src="{{ $work->images->first()->image_path }}" class="w-full sm:w-40 h-56 object-cover rounded-lg shrink-0" alt="{{ $work->title }}">
        @else
            <div class="w-full sm:w-40 h-56 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center text-gray-400 text-xs shrink-0">サムネイル画像</div>
        @endif
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $work->title }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">制作年：{{ $work->release_year }}</p>
                <div class="flex flex-wrap gap-1.5 mt-3">
                    @foreach($work->tags as $tag)
                        <span class="text-xs px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 dark:bg-blue-900 dark:text-blue-300">{{ $tag->name }}</span>
                    @endforeach
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-300 mt-3 leading-relaxed">{{ $work->description }}</p>

            @auth
            <div class="mt-5">
            <label class="block mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-300">視聴ステータス（クリックで切り替え）</label>
                @php 
                    $currentStatus = (int) ($work->impressions->first()?->status ?? 0);
                    $statusColors = [ 1 => 'bg-gray-500 text-white font-medium', 2 => 'bg-purple-600 text-white font-medium', 3 => 'bg-yellow-500 text-white font-medium', 4 => 'bg-green-600 text-white font-medium', ];
                @endphp
                <div class="inline-flex rounded-lg overflow-hidden border border-gray-300 dark:border-gray-600 text-sm">
                    @foreach([1 => '未視聴', 2 => '気になる', 3 => '視聴中', 4 => '視聴済み'] as $value => $label)
                    <form method="POST" action="{{ route('impressions.update', $work->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="{{ $value }}">
                        <button type="submit" class="px-3 py-1.5 {{ $loop->last ? '' : 'border-r border-gray-300 dark:border-gray-600' }} {{ $currentStatus === $value ? $statusColors[$value] : 'bg-white text-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-300' }}">{{ $label }}</button>
                    </form>
                    @endforeach
                </div>
            </div>
            @endauth
        </div>
    </div>

    @auth
    @php
        $impression = $work->impressions->first();
        $rating = $impression?->rating ?? null;
        $comment = $impression?->comment ?? null;
        $fullStars = $rating ? (int) floor($rating) : 0;
        $fraction = $rating ? $rating - $fullStars : 0;
        $hasPartial = $fraction > 0;
        $emptyStars = 5 - $fullStars - ($hasPartial ? 1 : 0);
    @endphp
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm mt-4 p-6">
        @if($rating)<!-- ログイン済み/評価ありの場合 -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-gray-900 dark:text-white">自分の感想・評価</h2>
            <a href="{{ route('impressions.edit', $work->id) }}" class="text-sm font-medium text-blue-600 border border-blue-600 hover:bg-blue-50 dark:hover:bg-gray-700 rounded-lg px-4 py-2">感想を編集する</a>
        </div>
        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
            <div class="flex items-center justify-between flex-wrap gap-2">
                <div class="flex items-center gap-2">

                    <span class="star-rating">
                        @for ($i = 0; $i < $fullStars; $i++)
                            <span class="filled">★</span>
                        @endfor
                        @if ($hasPartial)
                            <span class="half" style="--fraction: {{ $fraction * 100 }}%"></span>
                        @endif
                        @for ($i = 0; $i < $emptyStars; $i++)
                            <span>★</span>
                        @endfor
                    </span>
                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ number_format($rating, 1) }}（5点満点）</span>
                </div>
            </div>
            <p class="text-sm text-gray-700 dark:text-gray-300 mt-3 leading-relaxed">{{ $comment }}</p>
        </div>
        @else<!-- ログイン済み/評価なしの場合 -->
        <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">自分の感想・評価</h2>
        <div class="border border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-8 text-center">
            <p class="text-sm text-gray-400 dark:text-gray-500 mb-3">まだ感想は記録されていません</p>
            <a href="{{ route('impressions.edit', $work->id) }}" class="inline-block text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg px-5 py-2.5">感想を記録する</a>
        </div>
        @endif
    </div>
    @else<!-- 未ログインの場合 -->
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 border-dashed rounded-lg shadow-sm mt-4 p-8 text-center">
        <p class="text-base font-medium text-gray-700 dark:text-gray-200 mb-1">この作品を見たかどうかや、感想・評価を記録してみませんか？</p>
        <p class="text-sm text-gray-400 dark:text-gray-500 mb-4">ログインすると、視聴ステータスの管理や、自分だけの感想メモを残せるようになります。</p>
        <div class="flex items-center justify-center gap-3">
            <a href="{{ route('login') }}" class="text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg px-5 py-2.5">ログインする</a>
            <a href="{{ route('register') }}" class="text-sm font-medium text-blue-600 border border-blue-600 hover:bg-blue-50 dark:hover:bg-gray-700 rounded-lg px-5 py-2.5">新規登録する</a>
        </div>
    </div>
    @endauth

</main>
@endsection


