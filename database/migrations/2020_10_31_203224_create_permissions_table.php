<?php

use App\Models\Permission;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema ::create( 'permissions', function ( Blueprint $table ) {
            $table -> increments( 'id' );
            $table -> string( 'permission' );
            $table -> integer( 'role_id' ) -> unsigned() -> index();
            $table -> foreign( 'role_id' ) -> references( 'id' ) -> on( 'roles' )
                  -> onUpdate( 'cascade' ) -> onDelete( 'cascade' );

            $table -> timestamps();
        } );

        $input = [
            [ 'role_id' => 1, 'permission' => 'admin.dashboard' ],
            [ 'role_id' => 1, 'permission' => 'admin.roles.index' ],
            [ 'role_id' => 1, 'permission' => 'admin.roles.create' ],
            [ 'role_id' => 1, 'permission' => 'admin.roles.store' ],
            [ 'role_id' => 1, 'permission' => 'admin.roles.edit' ],
            [ 'role_id' => 1, 'permission' => 'admin.roles.update' ],
            [ 'role_id' => 1, 'permission' => 'admin.roles.delete' ],

        ];
        Permission ::insert( $input );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema ::dropIfExists( 'permissions' );
    }
}
