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
            $table->double('salary');
            $table->string('leave_type');
            $table->string('leave_type_others_1');
            $table->string('leave_type_others_2');
            $table->string('vication_loc');
            $table->string('abroad_others');
            $table->string('sick_loc');
            $table->string('in_hospital_specify');
            $table->string('out_patient_specify');
            $table->string('applied_num_days');
            $table->date('inc_from');
            $table->date('inc_to');
            $table->string('com_requested');
            $table->date('credit_date');
            $table->string('vication_total');
            $table->string('sick_total');
            $table->string('over_total');
            $table->string('a_days_w_pay');
            $table->string('a_days_wo_pay');
            $table->string('a_others');
            $table->string('reco_approval');
            $table->text('reco_disaprove_due_to');
            $table->text('disaprove_due_to');
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
