<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Work;
use App\Models\Impression;
use Illuminate\Database\Seeder;

class ImpressionSeeder extends Seeder
{
    public function run(): void
    {
        $works = Work::all();

        $testUser = User::where('email', 'test@example.com')->first();

        if ($testUser) {
            $testPatterns = [
                ['status' => 4, 'rating' => 5.0, 'comment' => '最高の一本。何度も見返したくなる。'],
                ['status' => 4, 'rating' => 3.0, 'comment' => '普通に良かった。'],
                ['status' => 3, 'rating' => null, 'comment' => null],
                ['status' => 2, 'rating' => null, 'comment' => null],
                ['status' => 1, 'rating' => null, 'comment' => null],
            ];

            foreach ($works->skip(8)->take(5) as $i => $work) {
                $p = $testPatterns[$i % count($testPatterns)];
                Impression::create(['user_id' => $testUser->id, 'work_id' => $work->id, ...$p]);
            }
        }

        // demo: バランス良く視聴記録（一覧・検索デモ向け）
        $demo = User::where('email', 'demo@example.com')->first();
        $demoPatterns = [
            ['status' => 4, 'rating' => 4.5, 'comment' => '映像も音楽も素晴らしく、何度でも見たくなる作品。'],
            ['status' => 4, 'rating' => 3.5, 'comment' => 'テンポが良くて飽きずに見られた。'],
            ['status' => 3, 'rating' => null, 'comment' => null],
            ['status' => 2, 'rating' => null, 'comment' => null],
            ['status' => 1, 'rating' => null, 'comment' => null],
        ];
        foreach ($works->take(8) as $i => $work) {
            $p = $demoPatterns[$i % count($demoPatterns)];
            Impression::create(['user_id' => $demo->id, 'work_id' => $work->id, ...$p]);
        }

        // taro: バトル系を高評価で視聴済み多め
        $taro = User::where('email', 'taro@example.com')->first();
        $battleWorks = $works->filter(fn($w) => $w->tags->pluck('name')->intersect(['バトル', 'アクション'])->isNotEmpty());
        foreach ($battleWorks->take(5) as $i => $work) {
            Impression::create([
                'user_id' => $taro->id,
                'work_id' => $work->id,
                'status' => 4,
                'rating' => [5.0, 4.5, 4.0][$i % 3],
                'comment' => 'バトルシーンの作画が熱い。',
            ]);
        }

        // hanako: 日常・感動系を中心に、辛口採点も混ぜる
        $hanako = User::where('email', 'hanako@example.com')->first();
        $dramaWorks = $works->filter(fn($w) => $w->tags->pluck('name')->intersect(['感動', '日常'])->isNotEmpty());
        $hanakoPatterns = [4.0, 2.5, 3.5, 4.5, 3.0];
        foreach ($dramaWorks->take(5) as $i => $work) {
            Impression::create([
                'user_id' => $hanako->id,
                'work_id' => $work->id,
                'status' => 4,
                'rating' => $hanakoPatterns[$i % count($hanakoPatterns)],
                'comment' => $hanakoPatterns[$i % count($hanakoPatterns)] >= 4.0 ? '丁寧な人間描写が良かった。' : '悪くはないが期待しすぎた。',
            ]);
        }
    }
}