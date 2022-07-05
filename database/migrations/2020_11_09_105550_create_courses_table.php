<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
            $table->string('promotional_video');
            $table->string('promotional_video_id');
            $table->string('title');
            $table->string('steps');
            $table->text('description');
            $table->double('price');
            $table->double('discount')->nullable();
            $table->string('language')->default('ar');
            $table->string('status')->default('pending')->comment  = 'active  in_review  pending';
            $table -> bigInteger(  'level' ) -> unsigned() -> index();
            $table -> foreign(  'level' ) -> references( 'id' ) -> on( 'academic_levels' )
                -> onUpdate( 'cascade' )   -> onDelete( 'cascade' );
            $table -> bigInteger(  'total_hours' ) -> unsigned() -> index();
            $table -> foreign(  'total_hours' ) -> references( 'id' ) -> on( 'durations' )
                -> onUpdate( 'cascade' )   -> onDelete( 'cascade' );
            $table -> integer(  'user_id' ) -> unsigned() -> index();
            $table -> foreign(  'user_id' ) -> references( 'id' ) -> on( 'users' )
                -> onUpdate( 'cascade' )   -> onDelete( 'cascade' );
            $table -> integer(  'category_id' ) -> unsigned() -> index();
            $table -> foreign(  'category_id' ) -> references( 'id' ) -> on( 'categories' )
                -> onUpdate( 'cascade' )   -> onDelete( 'cascade' );
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
        Schema::dropIfExists('courses');
    }
}
