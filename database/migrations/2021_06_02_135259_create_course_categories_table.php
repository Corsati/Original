<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_categories', function (Blueprint $table) {
            $table->id();
            $table -> integer('course_id')->unsigned()-> index();
            $table -> foreign(  'course_id' ) -> references( 'id' ) -> on( 'courses' )
                -> onUpdate( 'cascade' )   -> onDelete( 'cascade' );
            $table -> integer('category_id')->unsigned()-> index();
            $table -> foreign(  'category_id' ) -> references( 'id' ) -> on( 'categories' )
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
        Schema::dropIfExists('course_categories');
    }
}
