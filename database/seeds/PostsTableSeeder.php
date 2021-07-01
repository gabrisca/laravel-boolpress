<?php

use App\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; // importo l'helper delle stringhe per lo slug

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10 ; $i++) {
            $new_post = new Post();
            $new_post->title = 'titolo post'.($i + 1);
            $new_post->slug = Str::slug($new_post->title, '-'); // slug
            $new_post->content = ($i + 1).'lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum ';
            $new_post->save();
        }
    }
}
