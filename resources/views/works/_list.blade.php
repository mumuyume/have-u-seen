@extends('layouts.app')

@php
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
@endphp

@section('content')
<main class="max-w-6xl mx-auto px-4 py-6">
    <h1 class="text-xl font-bold text-gray-900 dark:text-white mb-4">@yield('h1')</h1>

    <button onclick="document.getElementById('filter-panel').classList.toggle('hidden')"
    class="lg:hidden w-full flex items-center justify-between text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2.5 mb-4">
    <span>絞り込み条件を表示する</span><span class="text-gray-400">▼</span>
    </button>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

    <aside id="filter-panel" class="hidden lg:block lg:col-span-1">
        <form action="{{ route('works.search') }}" method="GET">
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-4 lg:sticky lg:top-4">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-sm font-bold text-gray-900 dark:text-white">絞り込み</h2>
                <button type="button" onclick="document.getElementById('filter-panel').classList.add('hidden')" class="lg:hidden text-xs text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">閉じる ✕</button>
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-xs font-medium text-gray-700 dark:text-gray-300">作品名で検索</label>
                <input type="text" name="title" value="{{ request('title') }}" placeholder="タイトルを入力..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white w-full" />
            </div>

            @auth
            <div class="mb-4">
                <label class="block mb-2 text-xs font-medium text-gray-700 dark:text-gray-300">視聴ステータス</label>
                <div class="space-y-2">
                    <label class="flex items-center text-sm text-gray-600 dark:text-gray-300"><input name="status[]" value="1" type="checkbox" class="w-4 h-4 mr-2 text-blue-600 rounded" {{ in_array('1', (array) request('status', [])) ? 'checked' : '' }}><span class="px-2 py-0.5 rounded-full text-xs font-medium bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300">未視聴</span></label>
                    <label class="flex items-center text-sm text-gray-600 dark:text-gray-300"><input name="status[]" value="2" type="checkbox" class="w-4 h-4 mr-2 text-blue-600 rounded" {{ in_array('2', (array) request('status', [])) ? 'checked' : '' }}><span class="px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300">気になる</span></label>
                    <label class="flex items-center text-sm text-gray-600 dark:text-gray-300"><input name="status[]" value="3" type="checkbox" class="w-4 h-4 mr-2 text-blue-600 rounded" {{ in_array('3', (array) request('status', [])) ? 'checked' : '' }}><span class="px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">視聴中</span></label>
                    <label class="flex items-center text-sm text-gray-600 dark:text-gray-300"><input name="status[]" value="4" type="checkbox" class="w-4 h-4 mr-2 text-blue-600 rounded" {{ in_array('4', (array) request('status', [])) ? 'checked' : '' }}><span class="px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">視聴済み</span></label>
                </div>
            </div>
            @endauth

            <div class="mb-4">
                <label class="block mb-2 text-xs font-medium text-gray-700 dark:text-gray-300">タグで絞り込み（複数選択可）</label>
                <div class="flex flex-wrap gap-1.5">
                @foreach($tags as $tag)
                <label class="tag-btn px-2.5 py-1 text-xs font-medium rounded-full border border-gray-300 text-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:text-gray-300 cursor-pointer has-[:checked]:border-blue-600 has-[:checked]:bg-blue-600 has-[:checked]:text-white">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                        {{ in_array($tag->id, (array) request('tags', [])) ? 'checked' : '' }}
                        class="hidden">
                    {{ $tag->name }}
                </label>
                @endforeach
                </div>
                <div class="flex flex-col gap-1.5 mt-3 text-xs text-gray-500 dark:text-gray-400">
                <span>絞り込み方法：</span>
                <label class="flex items-center"><input type="radio" value="and" name="tagcond" class="w-3.5 h-3.5 mr-1 text-blue-600" {{ request('tagcond', 'and') === 'and' ? 'checked' : '' }}>選んだタグを全部含む作品</label>
                <label class="flex items-center"><input type="radio" value="or" name="tagcond" class="w-3.5 h-3.5 mr-1 text-blue-600" {{ request('tagcond') === 'or' ? 'checked' : '' }}>選んだタグのどれかを含む作品</label>
                </div>
            </div>

            <button type="submit" class="block text-center w-full text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg px-4 py-2">
                この条件で絞り込む
            </button>
            </div>
        </form>
    </aside>

    <section class="lg:col-span-3">
        
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
            @foreach($works as $work)
            <a href="{{ route('works.show', $work->id) }}" class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition block">
                <div class="relative">
                <div class="h-36 bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-400 text-xs">サムネイル画像</div>
                <!-- 視聴ラベル -->
                @php $impression = $work->impressions->first(); @endphp
                @if ($impression?->status == 1)
                @elseif ($impression)
                <span class="absolute top-2 left-2 {{ $status['classes'][$impression->status] }} text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $status['labels'][$impression->status] }}</span>
                @endif
                </div>
                <div class="p-3">
                <h3 class="font-semibold text-gray-900 dark:text-white text-sm mb-1.5">{{ $work->title }}</h3>
                <!-- タグ -->
                <div class="flex flex-wrap gap-1 mb-1.5">
                    @foreach($work->tags as $tag)
                    <span class="text-[11px] px-2 py-0.5 rounded-full bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300">{{ $tag->name }}</span>
                    @endforeach
                </div>
                <!-- 評価 -->
                @php
                    $rating = $impression?->rating ?? null;
                    $fullStars = $rating ? (int) floor($rating) : 0;
                    $fraction = $rating ? $rating - $fullStars : 0; // 0.0〜0.9
                    $hasPartial = $fraction > 0;
                    $emptyStars = 5 - $fullStars - ($hasPartial ? 1 : 0);
                @endphp

                @if ($rating)
                    <div class="flex items-center text-sm">
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
                        <span class="text-gray-500 dark:text-gray-400 text-xs ml-1">({{ number_format($rating, 1) }})</span>
                    </div>
                @else
                    <div class="flex items-center text-gray-300 text-sm">☆☆☆☆☆ <span class="text-gray-400 dark:text-gray-500 text-xs ml-1">未評価</span></div>
                @endif
                <!--  -->
                </div>
            </a>
            @endforeach
        </div>

    <div class="flex justify-center mt-6">
        {{ $works->links() }}
    </div>
    </section>
    </div>
</main>
@endsection

@section('script')
    <script>
        // タグボタンをクリックすると選択中(青)⇄未選択(グレー)を切り替える
        function toggleTag(btn) {
        const selectedClasses = ['border-blue-600', 'bg-blue-600', 'text-white'];
        const unselectedClasses = ['border-gray-300', 'text-gray-700', 'hover:bg-gray-100', 'dark:border-gray-600', 'dark:text-gray-300'];

        if (btn.classList.contains('is-selected')) {
            btn.classList.remove('is-selected', ...selectedClasses);
            btn.classList.add(...unselectedClasses);
        } else {
            btn.classList.add('is-selected', ...selectedClasses);
            btn.classList.remove(...unselectedClasses);
        }
        }
    </script>
@endsection

