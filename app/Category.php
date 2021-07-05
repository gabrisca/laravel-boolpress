<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    // se faccio una query $category = Category::find($id)
    // alla proprietà categgory_post voglio avere un array di post in relazione

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
