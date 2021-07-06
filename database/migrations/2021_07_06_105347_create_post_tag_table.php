<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
            // creo la colonna per la Fk di posts
            $table->unsignedBigInteger('post_id');
            // creo la Fk della colonna post_id
            $table->foreign('post_id')
                ->references('id') // riferimento alla colonna id
                ->on('posts') // tabella
                ->onDelete('cascade');
            // $table->timestamps();

             // creo la colonna per la Fk di tags
             $table->unsignedBigInteger('tag_id');
             // creo la Fk della colonna post_id
             $table->foreign('tag_id')
                 ->references('id')
                 ->on('tags')
                 ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}
