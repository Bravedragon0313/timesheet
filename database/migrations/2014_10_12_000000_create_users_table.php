<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('fullname');
            $table->string('employee_id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('departmentid');
            $table->string('email')->unique()->nullable();
            $table->string('education');
            $table->string('citizenship');
            $table->string('supervisor');
            $table->integer('is_timesheets')->default(0);
            $table->integer('is_summary')->default(0);
            $table->integer('is_accounting')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('rates');
            $table->string('mime')->nullable();
            $table->string('original_filename')->nullable();
            $table->string('filename')->nullable();
            $table->string('socket_id')->nullable();
            $table->string('online')->default('N');
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
