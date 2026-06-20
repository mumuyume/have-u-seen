<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Work extends Model
{
    //
    protected $fillable = ['title', 'release_year', 'description'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function images()
    {
        return $this->hasMany(WorkImage::class)->orderBy('sort_order');
    }

    public function impressions()
    {
        return $this->hasMany(Impression::class);
    }

    use HasFactory;
}
