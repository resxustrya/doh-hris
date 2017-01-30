<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class Leave extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave', function(Blueprint $table){
            $table->increments('id');
            $table->string('userid');
            $table->string('office_agency');
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middlename');
            $table->date('date_filling');
            $table->string('position');
            $table->string('month_salary');
            $table->string('vication_leave_type');
            $table->string('vacation_others');
            $table->string('sick_leave_type');
            $table->text('sick_others');
            $table->string('vacation_loc');
            $table->string('abroad_others');
            $table->string('med_loc');
            $table->string('out_patient_others');
            $table->string('applied_num_days');
            $table->date('inc_from');
            $table->date('inc_to');
            $table->string('requested');
            $table->softDeletes();
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
        Schema::drop('leave');
    }
}
