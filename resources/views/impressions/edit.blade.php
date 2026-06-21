@extends('layouts.app')

@section('title', config('app.name').' - '.$work->title.' の感想')


@section('content')
    <main class="max-w-2xl mx-auto px-4 py-6">
        <a href="{{ route('works.show', $work->id) }}" class="text-sm text-blue-600 hover:underline dark:text-blue-400">← 戻る</a>

        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm mt-3 p-6">
            <div class="flex items-center gap-3 mb-5">
                @if($work->images->first())
                    <img src="{{ $work->images->first()->image_path }}" class="w-12 h-16 object-cover rounded shrink-0" alt="{{ $work->title }}">
                @else
                    <div class="w-12 h-16 bg-gray-200 dark:bg-gray-700 rounded flex items-center justify-center text-gray-400 text-[10px] shrink-0">画像</div>
                @endif
                <div>
                    <p class="text-xs text-gray-400 dark:text-gray-500">対象作品</p>
                    <h1 class="text-lg font-bold text-gray-900 dark:text-white">{{ $work->title }} の感想</h1>
                </div>
            </div>

            <form action="{{ route('impressions.update', $work->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">視聴ステータス</label>
                        <input type="hidden" id="status-value" name="status" value="{{ $impression?->status ?? 1 }}">
                        <div class="inline-flex rounded-lg overflow-hidden border border-gray-300 dark:border-gray-600 text-sm">
                            <button type="button" data-status="1" onclick="selectStatus(this)" class="status-btn px-3 py-1.5 border-r border-gray-300 dark:border-gray-600 bg-gray-500 text-white font-medium">未視聴</button>
                            <button type="button" data-status="2" onclick="selectStatus(this)" class="status-btn px-3 py-1.5 border-r border-gray-300 dark:border-gray-600 bg-white text-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-300">気になる</button>
                            <button type="button" data-status="3" onclick="selectStatus(this)" class="status-btn px-3 py-1.5 border-r border-gray-300 dark:border-gray-600 bg-white text-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-300">視聴中</button>
                            <button type="button" data-status="4" onclick="selectStatus(this)" class="status-btn px-3 py-1.5 bg-white text-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-300">視聴済み</button>
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">評価（5点満点・0.1刻み）</label>
                        <div class="flex items-center gap-4">
                            <!-- 星表示：JSでスコアに応じてリアルタイムに塗りつぶし幅を変える -->
                            <div class="flex items-center text-3xl leading-none">
                                <span class="relative inline-block text-gray-300 dark:text-gray-600">
                                    ★★★★★
                                    <span id="star-fill" class="absolute inset-0 top-0 left-0 overflow-hidden text-yellow-400" style="width: 90%;">★★★★★</span>
                                </span>
                            </div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">（星表示はスコアに応じて自動で塗りつぶされます）</span>
                        </div>
                        <div class="mt-4 flex items-center gap-3">
                            <!-- スライダー：ドラッグすると数値・星表示にリアルタイム反映 -->
                            <input id="score-range" type="range" min="0" max="5" value="{{ $impression?->rating ?? 4.0 }}" step="0.1"
                                oninput="syncScore('range', this.value)"
                                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700 accent-blue-600" />
                            <div class="flex items-center shrink-0">
                                <!-- 数値入力：直接入力すると スライダー・星表示にリアルタイム反映 -->
                                <input id="score-number" type="number" name="rating" min="0" max="5" step="0.1" value="{{ $impression?->rating ?? 4.0 }}"
                                    oninput="syncScore('number', this.value)"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2 w-20 text-center dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                                <span class="ml-1 text-sm text-gray-500 dark:text-gray-400">点 / 5.0点</span>
                            </div>
                        </div>
                        <p class="text-[11px] text-gray-400 dark:text-gray-500 mt-1">スライダーのドラッグと数値入力のどちらからでも調整でき、もう一方の値と星表示が常に連動します（例：4.5点 → ★4.5）</p>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">感想メモ</label>
                        <textarea name="comment" rows="6" placeholder="見て感じたことを自由に書いてください..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $impression?->comment }}</textarea>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                    @if($impression)
                    <!-- 削除ボタン -->
                    <button type="button" onclick="document.getElementById('delete-modal').classList.remove('hidden')" class="text-sm font-medium text-red-600 hover:underline dark:text-red-400">この感想を削除する</button>
                    @else
                    <div></div>
                    @endif

                        <div class="flex gap-2">
                            <!-- キャンセル → 詳細に戻る -->
                            <a href="{{ session()->previousUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600">キャンセル</a>
                            <!-- 保存する → 詳細へ（保存後に戻る想定） -->
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">保存する</button>
                        </div>
                    </div>
                </div>
            </form>
            
            <!-- 削認モーダル -->
            <div id="delete-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 max-w-sm w-full mx-4">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">感想を削除しますか？</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">削除すると元に戻せません。</p>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="document.getElementById('delete-modal').classList.add('hidden')"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600">キャンセル</button>
                        <form method="POST" action="{{ route('impressions.destroy', $work->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">削除する</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        const statusColors = {
            '1': ['bg-gray-500',     'text-white', 'font-medium'],
            '2': ['bg-purple-600', 'text-white', 'font-medium'],
            '3': ['bg-yellow-500', 'text-white', 'font-medium'],
            '4': ['bg-green-600',   'text-white', 'font-medium'],
        };
        const inactiveClasses = ['bg-white', 'text-gray-600', 'hover:bg-gray-100', 'dark:bg-gray-700', 'dark:text-gray-300'];

        function selectStatus(btn) {
            document.querySelectorAll('.status-btn').forEach(b => {
                b.classList.remove(...Object.values(statusColors).flat());
                b.classList.add(...inactiveClasses);
            });
            const status = btn.dataset.status;
            btn.classList.remove(...inactiveClasses);
            btn.classList.add(...statusColors[status]);
            document.getElementById('status-value').value = status;
        }

        // スライダー・数値入力・星表示の3つを常に同期させる
        function syncScore(source, value) {
            let score = parseFloat(value);
            if (isNaN(score)) score = 0;
            score = Math.min(5, Math.max(0, score));
            // 0.1刻みに丸める（誤差対策）
            score = Math.round(score * 10) / 10;

            const range   = document.getElementById('score-range');
            const number = document.getElementById('score-number');
            const starFill = document.getElementById('star-fill');

            if (source !== 'range')   range.value   = score;
            if (source !== 'number') number.value = score;

            // 星5つ分=100%として、スコアに応じた塗りつぶし幅(%)を計算して反映
            starFill.style.width = (score / 5 * 100) + '%';
        }
        document.addEventListener('DOMContentLoaded', function () {
            const initialStatus = document.querySelector(`.status-btn[data-status="{{ $impression?->status ?? 1 }}"]`);
            if (initialStatus) selectStatus(initialStatus);
            const initialScore = {{ $impression?->rating ?? 4.0 }};
            syncScore('range', initialScore);
        });
    </script>
@endsection

