<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    public function manga(){
        return $this->belongsTo(Manga::class);
    }
}
