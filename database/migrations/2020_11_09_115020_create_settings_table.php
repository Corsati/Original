<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;
class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table -> string( 'key', 50 );
            $table -> longText( 'value' );
            $table->timestamps();
        });

        $data = [
            [ 'key' => 'help_ar'                            , 'value' => 'help arabic' ],
            [ 'key' => 'help_en'                            , 'value' => 'help eng' ],
            [ 'key' => 'about_ar'                           , 'value' => 'about arabic' ],
            [ 'key' => 'about_en'                           , 'value' => 'about english' ],
            [ 'key' => 'terms_ar'                           , 'value' => 'terms arabic' ],
            [ 'key' => 'terms_en'                           , 'value' => 'terms english' ],
            [ 'key' => 'facebook'                           , 'value' => 'facebook' ],
            [ 'key' => 'twitter'                            , 'value' => 'twitter' ],
            [ 'key' => 'youtube'                            , 'value' => 'youtube' ],
            [ 'key' => 'linked'                             , 'value' => 'linked' ],
            [ 'key' => 'lat'                                , 'value' => 0 ],
            [ 'key' => 'lng'                                , 'value' => 0 ],
            [ 'key' => 'address'                            , 'value' => 'address' ],
        ];

         // Setting ::insert( $data );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
