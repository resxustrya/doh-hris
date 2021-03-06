<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCdo extends Migration
{
    public function up()
    {
        if(Schema::hasTable('cdo')){
            return true;
        }
        Schema::create('cdo', function(Blueprint $table) {
            $table->increments('id');
            $table->string('route_no','40');
            $table->text('subject');
            $table->string('doc_type','15');
            $table->integer('prepared_name','25');
            $table->datetime('prepared_date');
            $table->string('working_days','5');
            $table->text('start');
            $table->text('end');
            $table->text('beginning_balance');
            $table->text('less_applied_for');
            $table->text('remaining_balance');
            $table->text('recommendation');
            $table->integer('immediate_supervisor');
            $table->integer('division_chief');
            $table->integer('approved_status');
            $table->integer('status');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('cdo');
    }
}
