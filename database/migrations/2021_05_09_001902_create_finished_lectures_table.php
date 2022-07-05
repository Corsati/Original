<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishedLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finished_lectures', function (Blueprint $table) {
            $table->id();
            $table->string('progress');
            $table->boolean('completed')->default(0);
            $table->bigInteger('course_lecture_file_id')->unsigned()->nullable();
            $table->foreign('course_lecture_file_id')->references('id')->on('course_lecture_files')->onDelete('cascade');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('finished_lectures');
    }
}
