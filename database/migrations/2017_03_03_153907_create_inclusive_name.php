<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInclusiveName extends Migration
{
    public function up()
    {
        if(Schema::hasTable('inclusive_name')){
            return true;
        }
        Schema::create('inclusive_name', function (Blueprint $table) {
            $table->increments('id');
            $table->text('route_no');
            $table->text('user_id');
            $table->text('status');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('inclusive_name');
    }
}
