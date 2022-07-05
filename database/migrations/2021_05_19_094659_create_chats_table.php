<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->integer('s_id')-> unsigned()-> index();
            $table->foreign('s_id')-> references( 'id' )-> on( 'users' )-> onUpdate( 'cascade' )-> onDelete( 'cascade' );
            $table->text('message');
            $table->text('type')->nullable();
            $table->bigInteger('room')-> unsigned()-> index();
            $table->foreign('room')-> references( 'id' )-> on( 'rooms' )-> onUpdate( 'cascade' )-> onDelete( 'cascade' );
            $table->boolean('seen')->default(0);
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
        Schema::dropIfExists('chats');
    }
}
