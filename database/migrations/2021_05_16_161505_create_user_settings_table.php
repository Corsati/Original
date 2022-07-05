<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('course_status')->default(1);
            $table->boolean('admin')->default(1);
            $table->boolean('purchase')->default(1);
            $table->boolean('chat')->default(1);
            $table -> integer('user_id')->unsigned()-> index();
            $table -> foreign('user_id') -> references( 'id' ) -> on( 'users' )
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
        Schema::dropIfExists('user_settings');
    }
}
