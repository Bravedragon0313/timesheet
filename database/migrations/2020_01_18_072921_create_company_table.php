<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name');
            $table->string('company_address');
            $table->string('company_alt_add');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('country');
            $table->string('phone_number');
            $table->string('alt_phone_number');
            $table->string('email');
            $table->string('alt_email');
            $table->string('employee_type');
            $table->string('comments');
            $table->integer('number_of_employees')->default(0);            
            $table->integer('number_work_hours_week')->default(0);
            $table->integer('number_vacation_hours')->default(0);
            $table->integer('number_vacation_days')->default(0);            
            $table->integer('number_of_department')->default(0);
            $table->integer('week_days_work')->default(0);
            $table->integer('week_day1')->default(0);
            $table->integer('week_day2')->default(0);
            $table->integer('week_day3')->default(0);
            $table->integer('week_day4')->default(0);
            $table->integer('week_day5')->default(0);
            $table->integer('week_day6')->default(0);
            $table->integer('week_day7')->default(0);   
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
        Schema::dropIfExists('companies');
    }
}
