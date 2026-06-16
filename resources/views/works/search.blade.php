@extends('works._list')

@section('title', config('app.name') . ' - 検索結果')

@section('h1', $request?->title.' 検索結果')
