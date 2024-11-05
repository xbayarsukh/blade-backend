<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    public function mangas(){
        return $this->belongsTo(Manga::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }
}
