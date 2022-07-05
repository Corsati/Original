<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->float('price')->default(0);
            $table -> integer('course_id')->unsigned()-> index();
            $table -> foreign(  'course_id' ) -> references( 'id' ) -> on( 'courses' )
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
        Schema::dropIfExists('carts');
    }
}
