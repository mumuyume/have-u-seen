@extends('layouts.app')

@section('title', config('app.name').' - マイページ')


@section('content')
  <main class="max-w-3xl mx-auto px-4 py-6 space-y-6">
    <h1 class="text-xl font-bold text-gray-900 dark:text-white">マイページ</h1>

    <!-- 統計 -->
    <div class="grid grid-cols-3 gap-4">
      <a href="{{ route('works.index') }}" class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-4 text-center hover:shadow-md transition">
        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $total }}</p>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">登録作品数</p>
      </a>
      <a href="{{ route('works.index') }}" class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-4 text-center hover:shadow-md transition">
        <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $watched }}</p>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">視聴済み</p>
      </a>
      <a href="{{ route('works.index') }}" class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-4 text-center hover:shadow-md transition">
        <p class="text-2xl font-bold text-gray-400 dark:text-gray-500">{{ ($total-$watched) }}</p>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">未視聴</p>
      </a>
    </div>

    <!-- セクション1：プロフィール情報 -->
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6">
      <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-1">プロフィール情報</h2>
      <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">ユーザー名とメールアドレスを変更できます。</p>
      <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
        @csrf
        @method('patch')
        <div>
          <label for="name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">ユーザー名</label>
          <input type="text" id="name" name="name" value="{{ $user->name }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
        </div>
        <div>
          <label for="email" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">メールアドレス</label>
          <input type="email" id="email" name="email" value="{{ $user->email }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
        </div>
        <div class="flex justify-end">
          <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">保存する</button>
        </div>
      </form>
    </div>

    <!-- セクション2：パスワード更新 -->
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6">
      <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-1">パスワード更新</h2>
      <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">安全のため、長くランダムなパスワードを使用してください。</p>
      <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
        @csrf
        @method('put')
        <div>
          <label for="current_password" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">現在のパスワード</label>
          <input type="password" id="current_password" name="current_password" placeholder="••••••••"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>
        <div>
          <label for="password" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">新しいパスワード</label>
          <input type="password" id="password" name="password" placeholder="••••••••"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>
        <div>
          <label for="password_confirmation" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">新しいパスワード（確認）</label>
          <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="flex justify-end">
          <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">パスワードを更新する</button>
        </div>
      </form>
    </div>

    <!-- セクション3：アカウント削除 -->
    <div class="bg-white dark:bg-gray-800 border border-red-200 dark:border-red-900 rounded-lg shadow-sm p-6">
      <h2 class="text-lg font-bold text-red-700 dark:text-red-400 mb-2">アカウントの削除</h2>
      <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">アカウントを削除すると、登録した感想データも全て削除され元に戻せません。</p>
      <button type="button" onclick="document.getElementById('delete-account-modal').classList.remove('hidden')"
        class="inline-block px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">アカウントを削除する</button>
    </div>

  </main>

  <!-- アカウント削除確認モーダル -->
  <div id="delete-account-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 max-w-sm w-full mx-4">
      <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">本当に削除しますか？</h3>
      <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">アカウントを削除する前にパスワードを入力してください。</p>
      <input type="password" placeholder="パスワード"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white mb-4" />
      <div class="flex justify-end gap-3">
        <button type="button" onclick="document.getElementById('delete-account-modal').classList.add('hidden')"
          class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600">キャンセル</button>
        <a href="login.html" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">削除する</a>
      </div>
    </div>
  </div>
@endsection
