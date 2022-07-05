<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_lectures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table -> integer(  'course_id' ) -> unsigned() -> index();
            $table -> foreign(  'course_id' ) -> references( 'id' ) -> on( 'courses' )
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
        Schema::dropIfExists('course_lectures');
    }
}
