<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; // importo l'helper delle stringhe per lo slug

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['HTML', 'CSS', 'JavaScript', 'PHP'];
        foreach ($data as $value) {
            $new_cat = new Category();
            $new_cat->name = $value;
            $new_cat->slug = Str::slug($value, '-');
            $new_cat->save();
        }
    }
}
