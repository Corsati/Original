<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('avatar')->default('default.png');
            $table->string('email')->unique();
            $table->string('phone')->unique()->nullable();;
            $table->string('password')->nullable();
            $table->boolean('active')->default(0);
            $table->boolean('banned')->default(0);
            $table->string('accepted')->default(1);
            $table->smallInteger('role_id')->nullable();
            $table->smallInteger('user_type')->default(2)->comment = '1-admin 2->student  -  3->instructor';

            $table -> integer('country_id')->nullable() -> unsigned() -> index();
            $table -> foreign('country_id') -> references( 'id' ) -> on( 'countries' )
                   -> onUpdate('cascade') -> onDelete( 'cascade' );

            $table -> integer('city_id')->nullable()->unsigned()-> index();
            $table -> foreign('city_id')-> references( 'id' ) -> on( 'cities' )
                   -> onUpdate('cascade')-> onDelete( 'cascade' );

            $table -> bigInteger('academic_level_id')->unsigned()->nullable()-> index();
             $table -> foreign('academic_level_id')-> references( 'id' ) -> on( 'academic_levels' )
                   -> onUpdate('cascade')-> onDelete( 'cascade' );

            $table->text('about')->nullable();
            $table->text('address')->nullable();
            $table->string('provider');
            $table->string('provider_id');
            $table->string('device_token')->nullable();
            $table->date('birth_date')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
