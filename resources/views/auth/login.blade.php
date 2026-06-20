@extends('layouts.head')

@section('body')
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow p-8">
        <h1 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-1">{{ config('app.name', 'Laravel') }}</h1>
        <p class="text-center text-sm text-gray-500 dark:text-gray-400 mb-6">見た作品と感想を記録しよう</p>

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">メールアドレス</label>
                <input type="email" name="email" placeholder="name@example.com" id="email" required autofocus autocomplete="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div>
                <label for="password" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">パスワード</label>
                <input id="password" name="password" required autocomplete="current-password" type="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                    <input id="remember_me" name="remember" type="checkbox" class="w-4 h-4 mr-2 text-blue-600 bg-gray-100 border-gray-300 rounded">
                    ログイン状態を保持
                </label>
                <a href="#" class="text-sm text-blue-600 hover:underline dark:text-blue-400">パスワードをお忘れですか？</a>
            </div>
            <!-- ログインボタン → 一覧画面へ遷移（ログイン成功を想定） -->
            <button type="submit" class="block text-center w-full text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5">ログイン</button>
            <p class="text-sm text-center text-gray-500 dark:text-gray-400">
                アカウントをお持ちでない方は
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline dark:text-blue-400">新規登録</a>
            </p>
        </form>
    </div>
</body>

@endsection