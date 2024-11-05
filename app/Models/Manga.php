<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    public function chapters(){
        return $this->hasMany(Chapter::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function slides(){
        return $this->hasMany(Slide::class);
    }

    public function favourites(){
        return $this->hasMany(Favourite::class);
    }
}
