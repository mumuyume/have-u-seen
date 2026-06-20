@extends('layouts.app')

@section('body-class', 'flex items-center justify-center')

@section('content')
<div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow p-8">
    <h1 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-1">{{ config('app.name', 'Laravel') }}</h1>
    <p class="text-center text-sm text-gray-500 dark:text-gray-400 mb-6">アカウントを作成する</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        <div>
            <label for="name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">ユーザー名</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="山田太郎"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
            <label for="email" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="name@example.com"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div>
            <label for="password" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">パスワード</label>
            <input type="password" id="password" name="password" required autocomplete="new-password" placeholder="••••••••"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div>
            <label for="password_confirmation" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">パスワード（確認）</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <button type="submit"
            class="block text-center w-full text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5">
            新規登録
        </button>
        <p class="text-sm text-center text-gray-500 dark:text-gray-400">
            すでにアカウントをお持ちの方は
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline dark:text-blue-400">ログイン</a>
        </p>
    </form>
</div>
@endsection