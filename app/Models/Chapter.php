<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    public function images(){
        return $this->hasMany(ChapterImage::class);
    }
    
    public function manga(){
        return $this->belongsTo(Manga::class);
    }
}
