@extends('layouts.head')

@section('body')

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('works.index') }}" class="text-lg font-bold text-gray-900 dark:text-white">{{ config('app.name', 'Laravel') }}</a>
            <div class="flex items-center gap-4">
            @auth
                <a href="{{ route('mypage') }}" class="text-sm font-medium text-gray-600 hover:text-blue-600 dark:text-gray-300">マイページ</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-gray-600 hover:text-blue-600 dark:text-gray-300 bg-transparent border-0 p-0 cursor-pointer">
                        ログアウト
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-300 px-3 py-1.5">ログイン</a>
                <a href="{{ route('register') }}" class="text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg px-4 py-1.5">新規登録</a>
            @endauth
            </div>
        </div>
    </nav>
    <!-- ログインしていない場合のみバナーを表示 -->
    @auth
    @else
        <div class="bg-blue-50 dark:bg-gray-800 border-b border-blue-100 dark:border-gray-700">
            <div class="max-w-6xl mx-auto px-4 py-2.5 flex items-center justify-between flex-wrap gap-2">
                <p class="text-sm text-blue-800 dark:text-blue-300">ログインすると、作品ごとに視聴ステータスや感想・評価を記録できるようになります。</p>
                <a href="{{ route('login') }}" class="text-sm font-medium text-blue-700 hover:underline dark:text-blue-400 whitespace-nowrap">ログイン / 新規登録 →</a>
            </div>
        </div>
    @endauth

    @yield('content')
    @yield('script')
</body>
@endsection