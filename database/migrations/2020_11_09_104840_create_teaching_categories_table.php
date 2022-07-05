<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachingCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teaching_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('experience_years');
            $table -> bigInteger(  'experience_level' ) -> unsigned() -> index();
            $table -> foreign(  'experience_level' ) -> references( 'id' ) -> on( 'academic_levels' );
            $table->text('description');
            $table -> integer( 'user_id' ) -> unsigned() -> index();
            $table -> foreign( 'user_id' ) -> references( 'id' ) -> on( 'users' )
                   -> onUpdate( 'cascade' ) -> onDelete( 'cascade' );
            $table -> integer( 'category_id' ) -> unsigned() -> index();
            $table -> foreign( 'category_id' ) -> references( 'id' ) -> on( 'categories' )
                   -> onUpdate( 'cascade' ) -> onDelete( 'cascade' );
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
        Schema::dropIfExists('teaching_categories');
    }
}
