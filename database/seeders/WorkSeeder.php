<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Work;
use Illuminate\Database\Seeder;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $works = [
            [
                'title' => '作品タイトルA',
                'release_year' => 2020,
                'description' => 'ここに作品の概要・あらすじが入ります。',
                'tags' => ['SF', '感動', 'バトル'],
            ],
            [
                'title' => '作品タイトルB',
                'release_year' => 2018,
                'description' => 'ファンタジー世界を舞台にした物語。',
                'tags' => ['ファンタジー'],
            ],
            [
                'title' => '作品タイトルC',
                'release_year' => 2022,
                'description' => '恋愛模様を描いた作品。',
                'tags' => ['恋愛'],
            ],
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

        // factory
        $tags = Tag::all();

        Work::factory(30)->create()->each(function ($work) use ($tags) {
            $work->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')
            );
        });
    }
}
