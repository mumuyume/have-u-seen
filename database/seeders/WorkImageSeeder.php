<?php

namespace Database\Seeders;

use App\Models\Work;
use App\Models\WorkImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $works = Work::all();

        foreach ($works->take(17) as $index => $work) {
            WorkImage::create([
                'work_id' => $work->id,
                'image_path' => "https://picsum.photos/seed/work{$index}/400/300",
                'sort_order' => 0,
            ]);
        }
    }
}
