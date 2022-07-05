<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->integer('s_id')-> unsigned()-> index();
            $table->foreign('s_id')-> references( 'id' )-> on( 'users' )-> onUpdate( 'cascade' )-> onDelete( 'cascade' );
            $table->integer('r_id')-> unsigned()-> index();
            $table->foreign('r_id')-> references( 'id' )-> on( 'users' )-> onUpdate( 'cascade' )-> onDelete( 'cascade' );
            $table->integer('course_id')-> unsigned()-> index();
            $table->foreign('course_id')-> references( 'id' )-> on( 'courses' )-> onUpdate( 'cascade' )-> onDelete( 'cascade' );
            $table->boolean('status')->default(0);
            $table -> softDeletes();
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
        Schema::dropIfExists('rooms');
    }
}
