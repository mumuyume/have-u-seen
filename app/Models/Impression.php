<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Impression extends Model
{
    //
    const STATUS_UNWATCHED  = 1; // 未視聴
    const STATUS_INTERESTED = 2; // 気になる
    const STATUS_WATCHING   = 3; // 視聴中
    const STATUS_WATCHED    = 4; // 視聴済み

    protected $fillable = ['user_id', 'work_id', 'status', 'rating', 'comment'];

    protected $casts = [
        'rating' => 'decimal:1',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function work()
    {
        return $this->belongsTo(Work::class);
    }
}
