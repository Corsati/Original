<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table -> integer('category_id')->unsigned()-> index();
            $table -> foreign(  'category_id' ) -> references( 'id' ) -> on( 'categories' )
                -> onUpdate( 'cascade' )    -> onDelete( 'cascade' );
            $table -> integer('user_id')->unsigned()-> index();
            $table -> foreign(  'user_id' ) -> references( 'id' ) -> on( 'users' )
                -> onUpdate( 'cascade' )    -> onDelete( 'cascade' );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
