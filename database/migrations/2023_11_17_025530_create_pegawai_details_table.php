<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->char('gender');
            $table->string('phone');
            $table->string('email');
            $table->timestamps();
        });

        Schema::create('employee_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->text('address');
            $table->string('status');
            $table->date('hired_on');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_details'); 
        Schema::dropIfExists('employees'); 
    }
}
