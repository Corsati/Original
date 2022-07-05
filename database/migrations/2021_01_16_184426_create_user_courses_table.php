<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_courses', function (Blueprint $table) {
            $table->id();
            $table -> integer(  'user_id' ) -> unsigned() -> index();
            $table -> foreign(  'user_id' ) -> references( 'id' ) -> on( 'users' )
                -> onUpdate( 'cascade' )   -> onDelete( 'cascade' );

            $table -> integer(  'course_id' ) -> unsigned() -> index();
            $table -> foreign(  'course_id' ) -> references( 'id' ) -> on( 'courses' )
                -> onUpdate( 'cascade' )   -> onDelete( 'cascade' );

            $table->string('status')->default('NEW')->comment = '1-NEW 2->PROGRESS  -  3->FINISHED';

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
        Schema::dropIfExists('user_courses');
    }
}
