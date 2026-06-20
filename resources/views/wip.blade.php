@extends('layouts.app')

@section('body-class', 'flex items-center justify-center')

@section('content')
<div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow p-8 text-center">
    <p class="text-4xl mb-4">🚧</p>
    <h1 class="text-xl font-bold text-gray-900 dark:text-white mb-2">この機能は未実装です</h1>
    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">現在このページはポートフォリオ用のデモのため実装されていません。</p>
    <a href="javascript:history.back()" class="inline-block px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg">戻る</a>
</div>
@endsection
