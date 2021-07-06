<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   // FK
        Schema::table('posts', function (Blueprint $table) {
            // creo la colonna per il Foreign Key
            $table->unsignedBigInteger('category_id')->nullable()->after('id');
            // setto la colonna per FK
            $table->foreign('category_id')
            ->references('id') // in riferimento a id
            ->on('categories') // della tabella categories
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // elimino la FK
            $table->dropForeign(['category_id']);
            // elimino la colonna
            $table->dropColumn('category_id');
        });
    }
}
