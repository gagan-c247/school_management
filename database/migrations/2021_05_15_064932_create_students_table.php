<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('file_id')->nullable();
            $table->unsignedBigInteger('class_id')->nullable();
            $table->string('username')->unique();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->date('dob')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('pincode')->nullable();
            $table->string('mobile')->nullable();
            $table->enum('status',['1','0'])->default('1');
            $table->enum('gender',['boy','girl']);
            $table->string('about')->nullable();
            $table->timestamps();
            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
