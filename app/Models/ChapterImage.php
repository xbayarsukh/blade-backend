<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChapterImage extends Model
{
    public function chapter(){
        return $this->belongsTo(Chapter::class);
    }
}
