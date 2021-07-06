<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
     // creo la relazione ManyToMany tra entità Tag ed endità Post
     public function posts()
     {
         return $this->belongsToMany('App\Post');
     }
}
