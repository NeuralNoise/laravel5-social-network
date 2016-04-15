<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create( 'statuses', function (Blueprint $table) {
            $table->increments( 'id' );
            $table->integer( 'user_id' )->unsigned();
            $table->foreign( 'user_id' )->referenses('id')->on( 'users' );
            $table->integer( 'parent_id' )->nullable();
            $table->text( 'body' );
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop( 'statuses' );
    }
}
