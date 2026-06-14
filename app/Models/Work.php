<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        return $this->hasMany(WorkImage::class);
    }

    public function impressions()
    {
        return $this->hasMany(Impression::class);
    }

}
