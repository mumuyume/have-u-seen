<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Work;
use Illuminate\Database\Seeder;

class WorkSeeder extends Seeder
{
    public function run(): void
    {
        $works = [
            ['title' => '清律都市 シビュラの夜', 'release_year' => 2022, 'description' => '犯罪係数を可視化する管理社会で、執行官たちが人間の心の闇と向き合うダークSF。', 'tags' => ['SF', 'バトル']],
            ['title' => 'メーリの旅', 'release_year' => 2019, 'description' => '喋るバイクと共に奇妙な国々を渡り歩く、一話完結の少女の旅物語。', 'tags' => ['ファンタジー', '日常']],
            ['title' => 'アオウミ大学ダイビング部', 'release_year' => 2023, 'description' => '海辺の大学に入学した主人公が、個性的な先輩たちとバカ騒ぎする青春コメディ。', 'tags' => ['コメディ', '日常']],
            ['title' => '星屑のリフレイン', 'release_year' => 2021, 'description' => '記憶を失った少女が、星の欠片を追って宇宙を旅するSFファンタジー。', 'tags' => ['SF', 'ファンタジー', '感動']],
            ['title' => '蒼穹のアルカディア', 'release_year' => 2019, 'description' => '滅びた文明の遺跡を巡る冒険譚。仲間との友情が試される。', 'tags' => ['アクション', 'バトル']],
            ['title' => '日々のかけら', 'release_year' => 2022, 'description' => '田舎町で暮らす高校生たちの何気ない日常を描く群像劇。', 'tags' => ['日常', '感動']],
            ['title' => '雨上がりのmelody', 'release_year' => 2018, 'description' => '音楽を通じて再会する幼馴染たちの恋愛模様。', 'tags' => ['恋愛', '日常']],
            ['title' => 'クロノファクター', 'release_year' => 2023, 'description' => '時間操作能力を持つ主人公が、運命に抗うタイムリープ作品。', 'tags' => ['SF', 'バトル']],
            ['title' => '紅蓮の継承者', 'release_year' => 2020, 'description' => '炎を操る一族の末裔が、国を救うために立ち上がる王道バトル。', 'tags' => ['アクション', 'バトル', '感動']],
            ['title' => 'パラレル・コメディクラブ', 'release_year' => 2022, 'description' => '平行世界を行き来するドタバタギャグコメディ。', 'tags' => ['コメディ', '日常']],
            ['title' => '深海のラプソディ', 'release_year' => 2017, 'description' => '海底都市を舞台にした幻想的なファンタジー大作。', 'tags' => ['ファンタジー', '感動']],
            ['title' => '放課後シンドローム', 'release_year' => 2021, 'description' => '部活仲間との青春を描くハートフルコメディ。', 'tags' => ['コメディ', '日常', '恋愛']],
            ['title' => 'エンドレス・サマー', 'release_year' => 2016, 'description' => '夏休みに起きる不思議な出来事を描くひと夏の物語。', 'tags' => ['感動', '日常']],
            ['title' => 'ノクターン・ギルド', 'release_year' => 2023, 'description' => '夜の街で活動する傭兵ギルドの抗争を描くダークファンタジー。', 'tags' => ['ファンタジー', 'バトル']],
            ['title' => '銀河鉄道のかなた', 'release_year' => 2015, 'description' => '宇宙を走る列車に乗り合わせた乗客たちの人生模様。', 'tags' => ['SF', '感動']],
            ['title' => '恋する図書委員', 'release_year' => 2019, 'description' => '図書室を舞台にしたじれったい恋愛コメディ。', 'tags' => ['恋愛', 'コメディ']],
            ['title' => '黎明のヴァルキリー', 'release_year' => 2024, 'description' => '異世界に召喚された主人公が女神とともに戦う王道ファンタジー。', 'tags' => ['ファンタジー', 'バトル', 'アクション']],
            ['title' => '街角のレシピ', 'release_year' => 2020, 'description' => '小さな食堂を営む家族の絆を描くハートウォーミングな日常劇。', 'tags' => ['日常', '感動']],
            ['title' => 'リトル・タイムマシン', 'release_year' => 2017, 'description' => '小学生が偶然作ったタイムマシンで巻き起こる、ほのぼのドタバタ劇。', 'tags' => ['コメディ', '日常', 'SF']],
            ['title' => '幽霊画家のアトリエ', 'release_year' => 2021, 'description' => '死んでも筆を置けない画家の霊と、彼を見える少女との交流を描くファンタジー。', 'tags' => ['ファンタジー', '感動']],
            ['title' => '鋼鉄のレクイエム', 'release_year' => 2018, 'description' => '巨大兵器のパイロットとなった少年たちが戦争の現実に向き合う重厚なSFドラマ。', 'tags' => ['SF', 'バトル', '感動']],
            ['title' => '恋文の届け方', 'release_year' => 2020, 'description' => '手紙でしか気持ちを伝えられない不器用な二人の往復書簡ラブストーリー。', 'tags' => ['恋愛', '感動']],
            ['title' => 'ギルドマスターは伝説の元勇者', 'release_year' => 2024, 'description' => '正体を隠して冒険者ギルドを運営する元勇者の、のんびり異世界スローライフ。', 'tags' => ['ファンタジー', '日常', 'コメディ']],
            ['title' => '真夜中のドーナツ屋さん', 'release_year' => 2022, 'description' => '深夜だけ開く不思議なドーナツ屋に集まる人々の小さな物語を描くオムニバス。', 'tags' => ['日常', '感動']],
        ];

        foreach ($works as $data) {
            $work = Work::create([
                'title' => $data['title'],
                'release_year' => $data['release_year'],
                'description' => $data['description'],
            ]);

            $tagIds = Tag::whereIn('name', $data['tags'])->pluck('id');
            $work->tags()->attach($tagIds);
        }
    }
}