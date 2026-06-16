<?php

namespace Database\Seeders;

use App\Models\Impression;
use App\Models\Work;
use Illuminate\Database\Seeder;

class ImpressionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $works = Work::all();

        $data = [
            ['status' => 4, 'rating' => 4.5, 'comment' => 'とても良かった。特にラストが感動的だった。'],
            ['status' => 2, 'rating' => null, 'comment' => null],
            ['status' => 3, 'rating' => null, 'comment' => null],
        ];

        foreach ($works as $i => $work) {
            if (!isset($data[$i])) {
                continue;
            }

            Impression::create([
                'user_id' => 1,
                'work_id' => $work->id,
                'status' => $data[$i]['status'],
                'rating' => $data[$i]['rating'],
                'comment' => $data[$i]['comment'],
            ]);
        }
    }
}
