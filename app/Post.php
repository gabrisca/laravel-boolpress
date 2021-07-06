<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id' // aggiungo category_id
    ];

    // all'interno del Controller faremo una query di questo tipo:
    // $post = Post::find($id)
    // $post->category
    // la creo attraverso una funzione pubblica

    // creo la relazione tra entità Post ed endità Category
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    // creo la relazione ManyToMany tra entità Post ed endità Tag
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
