<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = ['SF', 'ファンタジー', '感動', '恋愛', 'アクション', 'バトル', '日常', 'コメディ'];

        foreach ($tags as $name) {
            Tag::create(['name' => $name]);
        }
    }
}
