<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkController extends Controller
{
    // 作品一覧
        public function index()
    {
        //
        return view('work.index');
    }
    // 作品検索
        public function search()
    {
        //
    }
    // 作品詳細
        public function show()
    {
        //
        echo 'work.show';
    }
}
