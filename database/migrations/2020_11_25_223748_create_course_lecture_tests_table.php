<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseLectureTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_lecture_tests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file');
            $table->string('content_file_type')->comment =  'pdf  excel  video image  doc';
            $table -> integer(  'course_lecture_id' ) -> unsigned() -> index();
            $table -> foreign(  'course_lecture_id' ) -> references( 'id' ) -> on( 'course_lectures' )
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
        Schema::dropIfExists('course_lecture_tests');
    }
}
