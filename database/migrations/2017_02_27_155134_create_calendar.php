<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendar extends Migration
{
    public function up()
    {
        if(Schema::hasTable('calendar')){
            return true;
        }
        Schema::create('calendar', function (Blueprint $table) {
            $table->increments('id');
            $table->text('route_no');
            $table->text('title');
            $table->text('start');
            $table->text('end');
            $table->text('backgroundColor');
            $table->text('borderColor');
            $table->text('prepared_by');
            $table->text('status');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('calendar');
    }
}
